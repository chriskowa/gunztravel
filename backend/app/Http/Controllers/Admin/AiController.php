<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiController extends Controller
{
    public function generate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'topic' => ['required', 'string', 'max:255'],
            'field' => ['required', 'in:title,meta_title,excerpt,content,meta_description'],
            'current' => ['nullable', 'string'],
        ]);

        $key = (string) config('services.openai.key');
        $model = (string) config('services.openai.model');
        $endpoint = (string) config('services.openai.endpoint');

        if ($key === '' || $model === '' || $endpoint === '') {
            return response()->json(['message' => 'Konfigurasi OpenAI belum lengkap.'], 500);
        }

        $topic = trim($validated['topic']);
        $field = $validated['field'];
        $current = trim((string) ($validated['current'] ?? ''));

        [$system, $user, $maxTokens] = $this->buildPrompt($field, $topic, $current);
        $payload = $this->buildPayload($endpoint, $model, $system, $user, $maxTokens);

        try {
            $res = Http::timeout(45)
                ->withHeaders([
                    'Authorization' => 'Bearer '.$key,
                    'Content-Type' => 'application/json',
                ])
                ->post($endpoint, $payload);

            $text = trim($this->extractText($endpoint, $res));

            if ($text === '') {
                return response()->json(['message' => 'AI tidak menghasilkan output.'], 500);
            }

            return response()->json(['text' => $text]);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Gagal memanggil AI.'], 500);
        }
    }

    private function buildPrompt(string $field, string $topic, string $current): array
    {
        $system = 'Kamu adalah copywriter SEO berbahasa Indonesia untuk website travel & rental (Gunz Travel). '
            .'Tulis ringkas, jelas, tidak bertele-tele. '
            .'Output hanya sesuai format yang diminta. Jangan pakai markdown fence (```), jangan pakai tanda kutip pembuka/penutup.';

        $common = "Topik: {$topic}.\n";
        if ($current !== '') {
            $common .= "Konteks saat ini (boleh dipakai/diimprove): {$current}\n";
        }

        return match ($field) {
            'title' => [
                $system,
                $common
                    ."Buat 1 judul artikel yang menarik dan SEO-friendly.\n"
                    ."Aturan: 45–70 karakter, tidak pakai emoji.\n"
                    ."Output: hanya judul.",
                140,
            ],
            'meta_title' => [
                $system,
                $common
                    ."Buat 1 meta title SEO.\n"
                    ."Aturan: maksimal 60 karakter, mengandung kata kunci utama, brand boleh di akhir.\n"
                    ."Output: hanya meta title.",
                160,
            ],
            'excerpt' => [
                $system,
                $common
                    ."Buat 1 excerpt/lead paragraph.\n"
                    ."Aturan: 1–2 kalimat, maksimal 160 karakter, menggugah untuk klik.\n"
                    ."Output: hanya excerpt.",
                200,
            ],
            'meta_description' => [
                $system,
                $common
                    ."Buat 1 meta description SEO.\n"
                    ."Aturan: 130–160 karakter, mengandung kata kunci, ada ajakan ringan.\n"
                    ."Output: hanya meta description.",
                220,
            ],
            'content' => [
                $system,
                $common
                    ."Buat konten artikel lengkap.\n"
                    ."Aturan:\n"
                    ."- Output HARUS HTML valid untuk editor (p, h2, h3, ul, li).\n"
                    ."- Minimal 800 kata.\n"
                    ."- Struktur: pembuka (p), 4–6 section (h2 + p), 1 list (ul), penutup (p).\n"
                    ."- Sisipkan 1 section FAQ kecil (h2 + 3 tanya-jawab singkat).\n"
                    ."- Jangan pakai <html>, <head>, <body>.\n"
                    ."Output: hanya HTML.",
                1400,
            ],
        };
    }

    private function buildPayload(string $endpoint, string $model, string $system, string $user, int $maxTokens): array
    {
        $lower = Str::lower($endpoint);

        if (Str::contains($lower, '/chat/completions')) {
            return [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user', 'content' => $user],
                ],
                'temperature' => 0.7,
                'max_tokens' => $maxTokens,
            ];
        }

        return [
            'model' => $model,
            'input' => [
                ['role' => 'system', 'content' => $system],
                ['role' => 'user', 'content' => $user],
            ],
            'temperature' => 0.7,
            'max_output_tokens' => $maxTokens,
        ];
    }

    private function extractText(string $endpoint, Response $res): string
    {
        if (! $res->successful()) {
            return '';
        }

        $data = $res->json();
        $lower = Str::lower($endpoint);

        if (Str::contains($lower, '/chat/completions')) {
            return (string) data_get($data, 'choices.0.message.content', '');
        }

        $fromOutputText = (string) data_get($data, 'output_text', '');
        if ($fromOutputText !== '') {
            return $fromOutputText;
        }

        return (string) data_get($data, 'output.0.content.0.text', '');
    }
}

