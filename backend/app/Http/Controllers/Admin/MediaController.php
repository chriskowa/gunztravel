<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function index(): View
    {
        $mediaItems = MediaItem::query()
            ->with('media')
            ->orderByDesc('id')
            ->paginate(40);

        return view('admin.media.index', compact('mediaItems'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'file' => ['required', 'file', 'max:10240'],
        ]);

        $item = MediaItem::create([
            'uploader_id' => $request->user()->id,
            'title' => $validated['title'] ?? null,
        ]);

        $item->addMediaFromRequest('file')->toMediaCollection('file');

        return redirect()->route('admin.media.index')->with('status', 'Media ditambahkan.');
    }

    public function destroy(MediaItem $mediaItem): RedirectResponse
    {
        $mediaItem->clearMediaCollection('file');
        $mediaItem->delete();

        return redirect()->route('admin.media.index')->with('status', 'Media dihapus.');
    }

    public function ckeditor(Request $request): JsonResponse
    {
        $request->validate([
            'upload' => ['required_without:file', 'file', 'max:10240'],
            'file' => ['required_without:upload', 'file', 'max:10240'],
        ]);

        $fileKey = $request->hasFile('upload') ? 'upload' : 'file';

        $item = MediaItem::create([
            'uploader_id' => $request->user()->id,
            'title' => null,
        ]);

        $item->addMediaFromRequest($fileKey)->toMediaCollection('file');
        $media = $item->getFirstMedia('file');

        return response()->json([
            'url' => $media?->getUrl() ?? '',
        ]);
    }

    public function json(): JsonResponse
    {
        $items = Media::query()
            ->with('model')
            ->whereIn('model_type', [MediaItem::class, Post::class])
            ->whereIn('collection_name', ['file', 'cover', 'og'])
            ->orderByDesc('id')
            ->limit(200)
            ->get()
            ->map(function (Media $media) {
                $model = $media->model;
                $title = null;

                return [
                    'id' => $media->id,
                    'title' => $model instanceof MediaItem ? $model->title : ($model instanceof Post ? $model->title.' ('.$media->collection_name.')' : $title),
                    'url' => $media->getUrl(),
                    'thumb' => $media->getUrl('thumb') ?: $media->getUrl(),
                    'collection' => $media->collection_name,
                ];
            });

        return response()->json(['items' => $items->values()]);
    }
}
