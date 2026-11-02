<!-- Testimonials Section -->
@php
    $testimonials = [
        ['Dr. Bilal Khan', 'General Practitioner', 'testimonials-1.webp',
         'Whether it\'s routine vaccines or urgent outreach, this system helps us manage all vaccination needs with reliability and ease.'],
        ['Dr. Amina Tariq', 'Pediatric Consultant', 'testimonials-2.webp',
         'This system has significantly improved our appointment handling and record-keeping. Parents now come well-informed, and we spend less time on paperwork.'],
        ['Samina Javed', 'Mother of 2', 'testimonials-3.webp',
         'As a working mom, getting timely reminders and having my kids’ vaccine history in one place is a lifesaver. Highly recommended for all parents!'],
        ['Hospital Admin', 'City Medical Center', 'testimonials-5.webp',
         'We were able to reduce missed appointments by 40% thanks to SMS/email reminders. The dashboard is intuitive, and our staff adapted quickly.'],
    ];
@endphp

<section id="testimonials" aria-labelledby="testimonials-heading"
    class="relative scroll-mt-24 overflow-hidden bg-[#000319] py-24">

    <div aria-hidden="true" class="pointer-events-none absolute -left-24 top-10 size-[26rem] rounded-full bg-blue-600/15 blur-[120px]"></div>
    <div aria-hidden="true" class="pointer-events-none absolute -right-24 bottom-0 size-[22rem] rounded-full bg-cyan-500/10 blur-[120px]"></div>

    <div class="relative mx-auto max-w-6xl px-4">
        <div class="grid items-center gap-10 lg:grid-cols-5">

            {{-- Title + controls --}}
            <div class="lg:col-span-2">
                <p class="text-sm font-medium uppercase tracking-widest text-cyan-400">Feedback</p>
                <h2 id="testimonials-heading" class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Testimonials</span>
                </h2>
                <p class="mt-4 leading-relaxed text-slate-300">
                    Hear from parents, healthcare workers, and clinic staff who’ve used our system to simplify
                    vaccination management and ensure timely care.
                </p>

                <div class="mt-6 flex items-center gap-3">
                    <button type="button" id="t-prev" aria-label="Previous testimonial"
                        class="flex size-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-white backdrop-blur-xl transition hover:bg-white/10">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 6-6 6 6 6" /></svg>
                    </button>
                    <button type="button" id="t-next" aria-label="Next testimonial"
                        class="flex size-10 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30 transition hover:brightness-110">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 6 6 6-6 6" /></svg>
                    </button>
                    <div id="t-dots" class="ml-2 flex items-center gap-2" aria-hidden="true"></div>
                </div>
            </div><!-- End Title -->

            {{-- Slider --}}
            <div class="lg:col-span-3">
                <ul id="t-track"
                    class="flex cursor-grab snap-x snap-mandatory gap-4 overflow-x-auto scroll-smooth pb-4 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    @foreach ($testimonials as $t)
                        <li class="w-[85%] shrink-0 snap-start sm:w-[24rem]">
                            <figure class="flex h-full select-none flex-col rounded-3xl border border-white/10 bg-white/5 p-6 shadow-[0_8px_40px_rgba(37,99,235,0.18)] backdrop-blur-xl transition hover:bg-white/10">

                                <svg class="size-8 text-cyan-400/70" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9.5 6C6.5 7 4 9.8 4 13.5V18h6v-6H7c0-2 1-3.5 3-4.2L9.5 6Zm9 0c-3 1-5.5 3.8-5.5 7.5V18h6v-6h-3c0-2 1-3.5 3-4.2L18.5 6Z" /></svg>

                                <blockquote class="mt-3 flex-1 text-sm leading-relaxed text-slate-200">
                                    <p>{{ $t[3] }}</p>
                                </blockquote>

                                <figcaption class="mt-6 flex items-center gap-3 border-t border-white/10 pt-5">
                                    <div class="shrink-0 rounded-full bg-gradient-to-r from-blue-600 to-cyan-500 p-[2px]">
                                        <img src="{{ asset('assets/img/testimonials/' . $t[2]) }}"
                                            alt="Photo of {{ $t[0] }}, {{ $t[1] }}"
                                            width="48" height="48" loading="lazy" draggable="false"
                                            class="size-12 rounded-full border-2 border-[#000319] object-cover">
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="truncate text-sm font-semibold text-white">{{ $t[0] }}</h3>
                                        <p class="truncate text-xs text-slate-400">{{ $t[1] }}</p>
                                        <div class="mt-1 flex gap-0.5 text-amber-400" role="img" aria-label="5 out of 5 stars">
                                            @for ($s = 0; $s < 5; $s++)
                                                <svg class="size-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="m12 2 3.1 6.3 6.9 1-5 4.9 1.2 6.8L12 17.8 5.8 21l1.2-6.8-5-4.9 6.9-1L12 2Z" /></svg>
                                            @endfor
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>

    <script>
        (() => {
            const track = document.getElementById('t-track');
            const slides = [...track.children];
            const dotsBox = document.getElementById('t-dots');
            const step = () => slides[0].getBoundingClientRect().width + 16;
            const atEnd = () => track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;

            // dots
            const dots = slides.map((_, i) => {
                const d = document.createElement('span');
                d.className = 'h-2 w-2 rounded-full bg-white/20 transition-all';
                dotsBox.appendChild(d);
                return d;
            });
            const syncDots = () => {
                const i = atEnd() ? slides.length - 1 : Math.round(track.scrollLeft / step());
                dots.forEach((d, n) => {
                    d.className = 'h-2 rounded-full transition-all ' +
                        (n === i ? 'w-6 bg-gradient-to-r from-blue-600 to-cyan-500' : 'w-2 bg-white/20');
                });
            };
            track.addEventListener('scroll', syncDots, { passive: true });
            syncDots();

            // buttons
            const next = () => atEnd() ? track.scrollTo({ left: 0 }) : track.scrollBy({ left: step() });
            const prev = () => track.scrollLeft <= 4 ? track.scrollTo({ left: track.scrollWidth }) : track.scrollBy({ left: -step() });
            document.getElementById('t-next').addEventListener('click', next);
            document.getElementById('t-prev').addEventListener('click', prev);

            // autoplay (paused on hover/focus, off for reduced motion)
            let timer;
            const start = () => { if (!matchMedia('(prefers-reduced-motion: reduce)').matches) timer = setInterval(next, 5000); };
            const stop = () => clearInterval(timer);
            start();
            ['mouseenter', 'focusin', 'touchstart'].forEach(e => track.parentElement.addEventListener(e, stop, { passive: true }));
            ['mouseleave', 'focusout'].forEach(e => track.parentElement.addEventListener(e, start));

            // mouse drag
            let down = false, startX = 0, startLeft = 0;
            track.addEventListener('pointerdown', e => {
                if (e.pointerType !== 'mouse') return;
                down = true; startX = e.clientX; startLeft = track.scrollLeft;
                track.classList.remove('scroll-smooth', 'snap-x', 'snap-mandatory');
                track.classList.replace('cursor-grab', 'cursor-grabbing');
            });
            window.addEventListener('pointermove', e => { if (down) track.scrollLeft = startLeft - (e.clientX - startX); });
            window.addEventListener('pointerup', () => {
                if (!down) return;
                down = false;
                track.classList.add('scroll-smooth', 'snap-x', 'snap-mandatory');
                track.classList.replace('cursor-grabbing', 'cursor-grab');
            });
        })();
    </script>
</section><!-- /Testimonials Section -->