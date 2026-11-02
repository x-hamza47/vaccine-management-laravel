<!-- About Section -->
<section id="about" class="relative scroll-mt-24 overflow-hidden bg-[#000319] py-24">

    <div aria-hidden="true" class="pointer-events-none absolute -left-20 top-10 size-[26rem] rounded-full bg-blue-600/15 blur-[120px]"></div>
    <div aria-hidden="true" class="pointer-events-none absolute -right-20 bottom-0 size-[22rem] rounded-full bg-cyan-500/10 blur-[120px]"></div>

    <div class="relative mx-auto max-w-6xl px-4">

        {{-- Heading + intro --}}
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-medium uppercase tracking-widest text-cyan-400">About MediLab</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                About
                <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Us</span>
            </h2>
            <p class="mt-5 leading-relaxed text-slate-300">
                MediLab is a digital platform designed to streamline the vaccination process for hospitals,
                parents, and administrators. Our goal is to ensure timely and accessible vaccinations by
                providing a centralized vaccine management system for online vaccine booking, vaccine tracking,
                and communication.
            </p>
        </div>

        {{-- Image card --}}
        <div class="relative mt-12 overflow-hidden rounded-3xl border border-white/10 bg-white/5 p-2 shadow-[0_8px_60px_rgba(37,99,235,0.25)] backdrop-blur-xl">
            <div class="relative aspect-[16/9] overflow-hidden rounded-2xl sm:aspect-[21/9]">
                <img src="{{ asset('assets/img/about.webp') }}"
                    alt="Parents and hospital staff using the MediLab vaccine management system"
                    width="1200" height="514" loading="lazy" class="size-full object-cover">
                <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-t from-[#000319]/80 via-[#000319]/20 to-transparent"></div>
            </div>
        </div>

        {{-- Features: numbered row with connecting line --}}
        <div class="relative mt-14">
            <div aria-hidden="true" class="absolute left-[16.6%] right-[16.6%] top-6 hidden h-px bg-gradient-to-r from-blue-600/0 via-cyan-500/60 to-blue-600/0 md:block"></div>

            <ul class="grid gap-6 md:grid-cols-3">

                <li class="relative">
                    <div class="mx-auto flex size-12 items-center justify-center rounded-full border border-white/10 bg-[#000319] text-sm font-bold text-cyan-400 ring-4 ring-[#000319]">01</div>
                    <div class="mt-4 h-full rounded-2xl border border-white/10 bg-white/5 p-6 text-center backdrop-blur-xl transition hover:bg-white/10">
                        <div class="mx-auto flex size-11 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M9 3h6M10 3v6l-5 9a2 2 0 0 0 1.7 3h10.6a2 2 0 0 0 1.7-3l-5-9V3" /><path d="m9.5 15 2 2 3.5-3.5" />
                            </svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-white">Trusted Vaccination Records</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-300">Securely manage vaccination history for every child with real-time updates and accessible reports.</p>
                    </div>
                </li>

                <li class="relative">
                    <div class="mx-auto flex size-12 items-center justify-center rounded-full border border-white/10 bg-[#000319] text-sm font-bold text-cyan-400 ring-4 ring-[#000319]">02</div>
                    <div class="mt-4 h-full rounded-2xl border border-white/10 bg-white/5 p-6 text-center backdrop-blur-xl transition hover:bg-white/10">
                        <div class="mx-auto flex size-11 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="4" width="18" height="18" rx="2" /><path d="M16 2v4M8 2v4M3 10h18M12 14v4M10 16h4" />
                            </svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-white">Simplified Scheduling</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-300">Schedule and manage appointments easily through smart reminders and an intuitive calendar system, following each child's vaccination schedule.</p>
                    </div>
                </li>

                <li class="relative">
                    <div class="mx-auto flex size-12 items-center justify-center rounded-full border border-white/10 bg-[#000319] text-sm font-bold text-cyan-400 ring-4 ring-[#000319]">03</div>
                    <div class="mt-4 h-full rounded-2xl border border-white/10 bg-white/5 p-6 text-center backdrop-blur-xl transition hover:bg-white/10">
                        <div class="mx-auto flex size-11 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8Z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-white">Support for Hospitals &amp; Families</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-300">Empowering both healthcare providers and families through dedicated dashboards and real-time status tracking.</p>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</section><!-- /About Section -->