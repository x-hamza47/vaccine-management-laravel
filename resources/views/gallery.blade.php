<!-- Gallery Section -->
@php
    $gallery = [
        ['gallery-1.webp', 'Child receiving a vaccination during a MediLab vaccination drive'],
        ['gallery-2.webp', 'Healthcare staff preparing vaccines at a hospital'],
        ['gallery-3.webp', 'Community outreach team delivering vaccines'],
        ['gallery-4.webp', 'Nurse vaccinating a young patient'],
        ['gallery-5.webp', 'Doctor talking with a parent about their child’s vaccination'],
        ['gallery-6.webp', 'Vaccination drive in a local community'],
        ['gallery-7.webp', 'Healthcare worker checking vaccine supplies'],
        ['gallery-8.webp', 'Medical team at a vaccination awareness event'],
    ];
@endphp

<section id="gallery" aria-labelledby="gallery-heading" class="relative scroll-mt-24 overflow-hidden bg-[#000319] py-24">

    <div aria-hidden="true" class="pointer-events-none absolute left-1/2 top-10 size-[30rem] -translate-x-1/2 rounded-full bg-blue-600/15 blur-[130px]"></div>

    <div class="relative mx-auto max-w-6xl px-4">

        {{-- Section title --}}
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-medium uppercase tracking-widest text-cyan-400">In the field</p>
            <h2 id="gallery-heading" class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Gallery</span>
            </h2>
            <p class="mt-4 leading-relaxed text-slate-300">
                A glimpse into our vaccination drives, healthcare staff, and community outreach programs.
            </p>
        </div><!-- End Section Title -->

        {{-- Bento grid --}}
        <ul class="mt-14 grid auto-rows-[10rem] grid-cols-2 gap-3 md:auto-rows-[13rem] md:grid-cols-4 md:gap-4">
            @foreach ($gallery as $i => $g)
                <li class="{{ $i === 0 ? 'col-span-2 md:row-span-2' : ($i === 3 ? 'col-span-2' : '') }}">
                    <button type="button" data-gallery-index="{{ $i }}"
                        aria-label="Open photo {{ $i + 1 }} of {{ count($gallery) }}: {{ $g[1] }}"
                        class="group relative block size-full overflow-hidden rounded-2xl border border-white/10 bg-white/5 p-1 shadow-[0_8px_32px_rgba(37,99,235,0.15)] backdrop-blur-xl transition hover:bg-white/10 focus-visible:outline-2 focus-visible:outline-cyan-400">
                        <img src="{{ asset('assets/img/gallery/' . $g[0]) }}" alt="{{ $g[1] }}"
                            width="800" height="600" loading="lazy"
                            class="size-full rounded-xl object-cover transition duration-500 group-hover:scale-105">
                        <span aria-hidden="true" class="pointer-events-none absolute inset-1 rounded-xl bg-gradient-to-t from-[#000319]/70 via-transparent to-transparent opacity-0 transition group-hover:opacity-100"></span>
                        <span aria-hidden="true" class="absolute bottom-4 right-4 flex size-9 translate-y-2 items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-cyan-500 text-white opacity-0 shadow-lg shadow-blue-600/40 transition group-hover:translate-y-0 group-hover:opacity-100">
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7" /><path d="m21 21-4.3-4.3M11 8v6M8 11h6" /></svg>
                        </span>
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Lightbox --}}
    <dialog id="lightbox" aria-label="Photo gallery"
        class="m-0 size-full max-h-none max-w-none bg-transparent p-0 backdrop:bg-[#000319]/90 backdrop:backdrop-blur-md">
        <div id="lb-wrap" class="flex size-full flex-col items-center justify-center p-4">
            <button type="button" id="lb-close" aria-label="Close"
                class="absolute right-4 top-4 rounded-xl border border-white/10 bg-white/5 p-2.5 text-white backdrop-blur-xl transition hover:bg-white/10">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18" /></svg>
            </button>

            <div class="relative flex w-full max-w-5xl items-center justify-center">
                <button type="button" id="lb-prev" aria-label="Previous photo"
                    class="absolute left-0 z-10 rounded-xl border border-white/10 bg-[#000319]/60 p-2.5 text-white backdrop-blur-xl transition hover:bg-white/10 sm:-left-14">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 6-6 6 6 6" /></svg>
                </button>
                <img id="lb-img" src="" alt="" class="max-h-[78vh] w-auto max-w-full rounded-2xl border border-white/10 object-contain shadow-[0_8px_60px_rgba(37,99,235,0.35)]">
                <button type="button" id="lb-next" aria-label="Next photo"
                    class="absolute right-0 z-10 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 p-2.5 text-white shadow-lg shadow-blue-600/30 transition hover:brightness-110 sm:-right-14">
                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 6 6 6-6 6" /></svg>
                </button>
            </div>

            <p id="lb-caption" class="mt-4 max-w-2xl text-center text-sm text-slate-300"></p>
            <p id="lb-count" class="mt-1 text-xs text-slate-500" aria-live="polite"></p>
        </div>
    </dialog>

    <script>
        (() => {
            const items = @json(array_map(fn ($g) => ['src' => asset('assets/img/gallery/' . $g[0]), 'alt' => $g[1]], $gallery));
            const dlg = document.getElementById('lightbox');
            const img = document.getElementById('lb-img');
            const cap = document.getElementById('lb-caption');
            const cnt = document.getElementById('lb-count');
            let cur = 0;

            const render = () => {
                img.src = items[cur].src;
                img.alt = items[cur].alt;
                cap.textContent = items[cur].alt;
                cnt.textContent = (cur + 1) + ' / ' + items.length;
            };
            const go = d => { cur = (cur + d + items.length) % items.length; render(); };
            const open = i => { cur = i; render(); dlg.showModal(); document.body.style.overflow = 'hidden'; };
            const close = () => dlg.close();

            document.querySelectorAll('[data-gallery-index]').forEach(b =>
                b.addEventListener('click', () => open(+b.dataset.galleryIndex)));
            document.getElementById('lb-next').addEventListener('click', () => go(1));
            document.getElementById('lb-prev').addEventListener('click', () => go(-1));
            document.getElementById('lb-close').addEventListener('click', close);
            dlg.addEventListener('close', () => { document.body.style.overflow = ''; img.src = ''; });
            dlg.addEventListener('click', e => { if (e.target === dlg || e.target.id === 'lb-wrap') close(); });
            dlg.addEventListener('keydown', e => {
                if (e.key === 'ArrowRight') go(1);
                if (e.key === 'ArrowLeft') go(-1);
            });
        })();
    </script>
</section><!-- /Gallery Section -->