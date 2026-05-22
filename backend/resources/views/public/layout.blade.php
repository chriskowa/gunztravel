<!DOCTYPE html>
<html lang="id">
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-K27KWHGZ');</script>
        <!-- End Google Tag Manager -->
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16762703567"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'AW-16762703567');
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @php
            $pageTitle = trim($__env->yieldContent('title'));
            $pageDescription = trim($__env->yieldContent('meta_description'));
            $canonicalUrl = trim($__env->yieldContent('canonical')) ?: url()->current();
            $robots = trim($__env->yieldContent('robots'));
            $ogTitle = trim($__env->yieldContent('og_title')) ?: $pageTitle;
            $ogDescription = trim($__env->yieldContent('og_description')) ?: $pageDescription;
            $ogImage = trim($__env->yieldContent('og_image'));
        @endphp

        <title>{{ $pageTitle }}</title>
        <meta name="description" content="{{ $pageDescription }}">
        @hasSection('canonical')
            <link rel="canonical" href="{{ $canonicalUrl }}">
        @endif
        @hasSection('robots')
            <meta name="robots" content="{{ $robots }}">
        @endif

        <meta property="og:site_name" content="Gunz Travel">
        <meta property="og:title" content="{{ $ogTitle }}">
        <meta property="og:description" content="{{ $ogDescription }}">
        <meta property="og:url" content="{{ $canonicalUrl }}">
        <meta property="og:type" content="website">
        @if ($ogImage !== '')
            <meta property="og:image" content="{{ $ogImage }}">
            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:image" content="{{ $ogImage }}">
        @else
            <meta name="twitter:card" content="summary">
        @endif
        @vite(['resources/css/app.css'])
    </head>
    <body class="bg-cream text-slate-900">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K27KWHGZ"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        @php
            $homeUrl = url('/');
            $phone = '6281805093192';
            $waText = 'Halo Gunz Travel, saya ingin bertanya tentang layanan travel atau sewa mobil.';
            $waHref = 'https://wa.me/'.$phone.'?text='.rawurlencode($waText);
            $logoUrl = url('logo-gunz-travel.webp');
        @endphp

        <header class="sticky top-0 z-50 w-full border-b border-slate-200/70 bg-white/80 glass">
            <div class="mx-auto max-w-7xl px-3 sm:px-4 lg:px-6">
                <div class="hidden py-2 lg:block">
                    <div class="flex items-center justify-between text-sm text-slate-600">
                        <p class="truncate">Gunz Travel & Tourism, Jl. Cokroaminoto No.43, Klojen, Kota Malang</p>
                        <div class="flex items-center gap-5">
                            <a class="font-semibold text-slate-700 hover:text-brand-700" href="tel:+6281805093192">0818-0509-3192</a>
                            <span class="hidden xl:inline">24 Jam by Reservation</span>
                        </div>
                    </div>
                </div>

                <nav class="flex items-center justify-between py-3 lg:py-4" aria-label="Navigasi utama">
                    <a href="{{ $homeUrl }}" class="flex items-center gap-3" aria-label="Gunz Travel beranda">
                        <div class="logo-mark-shadow flex h-11 w-11 items-center justify-center overflow-hidden rounded-2xl bg-white ring-2 ring-brand-300 shadow-sm">
                            <img src="{{ $logoUrl }}" alt="Logo Gunz Travel" class="h-full w-full object-contain p-1" width="44" height="44" loading="eager" decoding="async" />
                        </div>
                        <div class="leading-tight">
                            <p class="text-base font-extrabold tracking-tight text-slate-950">Gunz Travel</p>
                            <p class="text-xs font-semibold text-slate-500">Travel · Rental · Tour</p>
                        </div>
                    </a>

                    <div class="hidden items-center gap-1 rounded-full border border-slate-200 bg-white/70 p-1 text-sm font-semibold text-slate-700 lg:flex">
                        <a class="rounded-full px-4 py-2 transition hover:bg-brand-50 hover:text-brand-800" href="{{ $homeUrl }}/#layanan">Layanan</a>
                        <a class="rounded-full px-4 py-2 transition hover:bg-brand-50 hover:text-brand-800" href="{{ $homeUrl }}/#armada">Armada</a>
                        <a class="rounded-full px-4 py-2 transition hover:bg-brand-50 hover:text-brand-800" href="{{ $homeUrl }}/#harga">Harga</a>
                        <a class="rounded-full px-4 py-2 transition hover:bg-brand-50 hover:text-brand-800" href="{{ $homeUrl }}/#area">Area</a>
                        <a class="rounded-full px-4 py-2 transition hover:bg-brand-50 hover:text-brand-800" href="{{ $homeUrl }}/#faq">FAQ</a>
                        <a class="rounded-full px-4 py-2 transition hover:bg-brand-50 hover:text-brand-800" href="{{ route('articles.index') }}">Blog</a>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="tel:+6281805093192" class="hidden items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-3 text-sm font-extrabold text-slate-800 transition hover:border-brand-300 hover:bg-brand-50 lg:inline-flex">Telepon</a>
                        <a href="{{ $waHref }}" target="_blank" rel="noopener" class="cta-glow hidden items-center justify-center rounded-full bg-brand-500 px-5 py-3 text-sm font-extrabold text-ink-900 transition hover:bg-ink-900 hover:text-white sm:inline-flex">Pesan via WhatsApp</a>
                        <button id="publicMenuOpen" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-700 lg:hidden" type="button" aria-label="Buka menu">☰</button>
                    </div>
                </nav>
            </div>
        </header>

        <div id="publicMobileMenu" class="fixed inset-0 z-[60] hidden lg:hidden" role="dialog" aria-modal="true">
            <div id="publicMenuBackdrop" class="absolute inset-0 bg-slate-950/40"></div>
            <div class="absolute right-0 top-0 h-full w-[86%] max-w-sm bg-white shadow-2xl">
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="logo-mark-shadow flex h-10 w-10 items-center justify-center overflow-hidden rounded-2xl bg-white ring-2 ring-brand-300">
                            <img src="{{ $logoUrl }}" alt="Logo Gunz Travel" class="h-full w-full object-contain p-1" width="40" height="40" loading="eager" decoding="async" />
                        </div>
                        <div class="leading-tight">
                            <p class="text-sm font-black text-slate-950">Gunz Travel</p>
                            <p class="text-xs font-semibold text-slate-500">Travel · Rental · Tour</p>
                        </div>
                    </div>
                    <button id="publicMenuClose" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white" type="button" aria-label="Tutup menu">×</button>
                </div>

                <div class="px-5 py-5">
                    <div class="grid gap-2 text-sm font-extrabold text-slate-800">
                        <a href="{{ $homeUrl }}/#layanan" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">Layanan</a>
                        <a href="{{ $homeUrl }}/#armada" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">Armada</a>
                        <a href="{{ $homeUrl }}/#harga" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">Harga</a>
                        <a href="{{ $homeUrl }}/#area" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">Area</a>
                        <a href="{{ $homeUrl }}/#faq" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">FAQ</a>
                        <a href="{{ route('articles.index') }}" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">Blog</a>
                        <a href="{{ route('login') }}" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">Admin</a>
                    </div>

                    <div class="mt-5 rounded-3xl border border-slate-200 bg-white p-4">
                        <p class="text-xs font-extrabold uppercase tracking-wide text-brand-700">Kontak cepat</p>
                        <p class="mt-2 text-sm font-semibold text-slate-700">Respon cepat via WhatsApp, bisa booking 24 jam</p>
                        <div class="mt-4 grid gap-2">
                            <a href="{{ $waHref }}" target="_blank" rel="noopener" class="cta-glow inline-flex items-center justify-center rounded-2xl bg-brand-500 px-5 py-4 text-sm font-black text-ink-900 hover:bg-ink-900 hover:text-white">Chat WhatsApp</a>
                            <a href="tel:+6281805093192" class="inline-flex justify-center rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-black text-slate-800 hover:border-brand-300 hover:bg-brand-50">Telepon</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="mx-auto max-w-7xl px-4 py-10 pb-28 sm:px-6 sm:pb-10 lg:px-6">
            @yield('content')
        </main>

        <footer class="border-t border-slate-200 bg-white px-4 py-12 lg:px-6">
            <div class="mx-auto grid max-w-7xl gap-8 md:grid-cols-4">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3">
                        <div class="logo-mark-shadow flex h-10 w-10 items-center justify-center overflow-hidden rounded-2xl bg-white ring-2 ring-brand-300">
                            <img src="{{ $logoUrl }}" alt="Logo Gunz Travel" class="h-full w-full object-contain p-1" width="40" height="40" loading="lazy" decoding="async" />
                        </div>
                        <div>
                            <p class="font-black text-slate-950">Gunz Travel</p>
                            <p class="text-xs text-slate-500">Travel, Rental, Tour</p>
                        </div>
                    </div>
                    <p class="mt-5 max-w-md text-sm leading-7 text-slate-600">Melayani travel Malang Juanda, travel Malang Surabaya, sewa mobil Malang, Hiace, Elf, shuttle bandara, perjalanan dinas, wisata religi, Bromo, Bali, Jogja, dan city tour Malang Batu.</p>
                </div>

                <div>
                    <p class="font-black text-slate-950">Kontak</p>
                    <div class="mt-4 grid gap-2 text-sm text-slate-600">
                        <a href="tel:+6281805093192">0818-0509-3192</a>
                        <a href="{{ $waHref }}" target="_blank" rel="noopener">WhatsApp Admin</a>
                        <p>Jl. Cokroaminoto No.43, Klojen, Kota Malang</p>
                    </div>
                </div>

                <div>
                    <p class="font-black text-slate-950">Halaman</p>
                    <div class="mt-4 grid gap-2 text-sm text-slate-600">
                        <a href="{{ url('/travel-malang-juanda/') }}">Travel Malang Juanda</a>
                        <a href="{{ url('/travel-malang-surabaya/') }}">Travel Malang Surabaya</a>
                        <a href="{{ url('/travel-juanda-malang/') }}">Travel Juanda Malang</a>
                        <a href="{{ url('/sewa-mobil-malang/') }}">Sewa Mobil Malang</a>
                        <a href="{{ url('/sewa-hiace-malang/') }}">Sewa Hiace Malang</a>
                        <a href="{{ url('/paket-wisata-bromo/') }}">Paket Wisata Bromo</a>
                    </div>
                </div>
            </div>

            <div class="mx-auto mt-10 max-w-7xl border-t border-slate-200 pt-6 text-sm text-slate-500">
                <p>© <span>{{ date('Y') }}</span> Gunz Travel. All rights reserved.</p>
            </div>
        </footer>

        <div class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200 bg-white p-3 shadow-2xl sm:hidden">
            <a href="{{ $waHref }}" target="_blank" rel="noopener" class="cta-glow flex w-full items-center justify-center rounded-full bg-brand-500 px-5 py-4 text-sm font-black text-ink-900 hover:bg-ink-900 hover:text-white">Pesan via WhatsApp</a>
        </div>

        <script>
            const menu = document.getElementById('publicMobileMenu')
            const openBtn = document.getElementById('publicMenuOpen')
            const closeBtn = document.getElementById('publicMenuClose')
            const backdrop = document.getElementById('publicMenuBackdrop')

            function openMenu() {
                menu.classList.remove('hidden')
                document.body.style.overflow = 'hidden'
            }

            function closeMenu() {
                menu.classList.add('hidden')
                document.body.style.overflow = ''
            }

            openBtn?.addEventListener('click', openMenu)
            closeBtn?.addEventListener('click', closeMenu)
            backdrop?.addEventListener('click', closeMenu)
        </script>
    </body>
</html>
