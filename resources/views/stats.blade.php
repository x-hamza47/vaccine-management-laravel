<!-- Stats Section -->
<section id="stats" aria-labelledby="stats-heading" class="relative scroll-mt-24 bg-[#000319] py-16">

    <div class="mx-auto max-w-6xl px-4">

        <h2 id="stats-heading" class="sr-only">MediLab vaccine management system in numbers</h2>

        <dl class="grid grid-cols-2 gap-px overflow-hidden rounded-3xl border border-white/10 bg-white/10 shadow-[0_8px_60px_rgba(37,99,235,0.2)] lg:grid-cols-4">

            <div class="flex flex-col-reverse items-center gap-1 bg-[#000319]/95 px-6 py-8 text-center backdrop-blur-xl transition hover:bg-white/5">
                <dt class="text-sm text-slate-300">Vaccines Administered</dt>
                <dd class="flex flex-col items-center gap-3">
                    <span class="flex size-11 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m18 2 4 4M17 7l3-3M19 9l-8.7 8.7a2.12 2.12 0 0 1-3 0l-1-1a2.12 2.12 0 0 1 0-3L15 5M9 11l4 4M5 19l-3 3M14 4l6 6" /></svg>
                    </span>
                    <span data-count="{{ \App\Models\VaccinationSchedule::where('status', 'completed')->count() }}"
                        class="text-3xl font-bold tabular-nums text-white sm:text-4xl">{{ number_format(\App\Models\VaccinationSchedule::where('status', 'completed')->count()) }}</span>
                </dd>
            </div>

            <div class="flex flex-col-reverse items-center gap-1 bg-[#000319]/95 px-6 py-8 text-center backdrop-blur-xl transition hover:bg-white/5">
                <dt class="text-sm text-slate-300">Hospitals</dt>
                <dd class="flex flex-col items-center gap-3">
                    <span class="flex size-11 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="3" width="16" height="18" rx="2" /><path d="M12 8v6M9 11h6M10 21v-4h4v4" /></svg>
                    </span>
                    <span data-count="{{ \App\Models\Hospital::count() }}"
                        class="text-3xl font-bold tabular-nums text-white sm:text-4xl">{{ number_format(\App\Models\Hospital::count()) }}</span>
                </dd>
            </div>

            <div class="flex flex-col-reverse items-center gap-1 bg-[#000319]/95 px-6 py-8 text-center backdrop-blur-xl transition hover:bg-white/5">
                <dt class="text-sm text-slate-300">Children Registered</dt>
                <dd class="flex flex-col items-center gap-3">
                    <span class="flex size-11 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="5" r="2.5" /><path d="M7 11l5 1.5 5-1.5M12 12.5V16M9 21l3-5 3 5" /></svg>
                    </span>
                    <span data-count="{{ \App\Models\Children::count() }}"
                        class="text-3xl font-bold tabular-nums text-white sm:text-4xl">{{ number_format(\App\Models\Children::count()) }}</span>
                </dd>
            </div>

            <div class="flex flex-col-reverse items-center gap-1 bg-[#000319]/95 px-6 py-8 text-center backdrop-blur-xl transition hover:bg-white/5">
                <dt class="text-sm text-slate-300">Vaccine Types Available</dt>
                <dd class="flex flex-col items-center gap-3">
                    <span class="flex size-11 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m10.5 20.5 10-10a4.95 4.95 0 1 0-7-7l-10 10a4.95 4.95 0 1 0 7 7Z" /><path d="m8.5 8.5 7 7" /></svg>
                    </span>
                    <span data-count="{{ \App\Models\Vaccine::where('available', true)->count() }}"
                        class="text-3xl font-bold tabular-nums text-white sm:text-4xl">{{ number_format(\App\Models\Vaccine::where('available', true)->count()) }}</span>
                </dd>
            </div>

        </dl>
    </div>

    <script>
        (() => {
            const els = document.querySelectorAll('#stats [data-count]');
            if (!('IntersectionObserver' in window) || matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            const fmt = new Intl.NumberFormat();
            const run = el => {
                const end = parseInt(el.dataset.count, 10) || 0;
                if (!end) return;
                const t0 = performance.now(), dur = 1200;
                const step = now => {
                    const p = Math.min((now - t0) / dur, 1);
                    el.textContent = fmt.format(Math.round(end * (1 - Math.pow(1 - p, 3))));
                    if (p < 1) requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
            };
            const io = new IntersectionObserver(entries => {
                entries.forEach(e => { if (e.isIntersecting) { run(e.target); io.unobserve(e.target); } });
            }, { threshold: 0.4 });
            els.forEach(el => io.observe(el));
        })();
    </script>
</section><!-- /Stats Section -->