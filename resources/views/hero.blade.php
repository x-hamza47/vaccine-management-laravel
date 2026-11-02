<!-- Hero Section -->
<section id="hero" class="relative isolate scroll-mt-24 overflow-hidden bg-[#000319] pb-16 pt-40 sm:pt-44">

    {{-- Your background image with a navy overlay so text stays readable --}}
    <img src="{{ asset('assets/img/hero-bg.webp') }}" alt="" aria-hidden="true"
        class="absolute inset-0 -z-20 size-full object-cover opacity-60">
    <div aria-hidden="true"
        class="absolute inset-0 -z-10 bg-gradient-to-b from-[#000319]/80 via-[#000319]/70 to-[#000319]"></div>

    <div class="mx-auto max-w-6xl px-4">

        {{-- Welcome --}}
        <div class="max-w-3xl">
            <h1 class="text-4xl font-bold leading-tight tracking-tight text-white sm:text-5xl">
                Welcome to MediLab
                <span class="mt-1 block bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">
                    Vaccine Management System
                </span>
            </h1>
            <p class="mt-4 text-base leading-relaxed text-slate-300 sm:text-lg">
                Protecting communities through organized and accessible vaccination services, from online vaccine
                booking to hospital vaccination appointments.
            </p>

            <a href="{{ auth()->check() ? url(auth()->user()->role === 'parent' ? '/dashboard' : '/admin') : url('/dashboard/login') }}"
                class="mt-7 inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-3 font-medium text-white shadow-lg shadow-blue-600/30 transition hover:brightness-110">
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <path d="M16 2v4M8 2v4M3 10h18M12 14v4M10 16h4" />
                </svg>
                Make an Appointment
            </a>
        </div><!-- End Welcome -->

        <div class="mt-14 grid gap-4 lg:grid-cols-12">

            {{-- Why Choose box --}}
            <div class="rounded-2xl border border-white/10 bg-white/5 p-6 shadow-[0_8px_32px_rgba(37,99,235,0.15)] backdrop-blur-xl lg:col-span-4">
                <h2 class="text-xl font-semibold text-white">Why Choose Medilab?</h2>
                <p class="mt-3 text-sm leading-relaxed text-slate-300">
                    Medilab helps parents, hospitals, and administrators streamline the vaccination process.
                    From scheduling appointments to tracking doses and reminders, we ensure no child misses
                    essential protection.
                </p>
                <a href="#about"
                    class="mt-5 inline-flex items-center gap-1 text-sm font-medium text-blue-400 transition hover:text-cyan-400">
                    Learn More
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true"><path d="m9 6 6 6-6 6" /></svg>
                </a>
            </div><!-- End Why Box -->

            {{-- 3 icon boxes --}}
            <div class="grid gap-4 md:grid-cols-3 lg:col-span-8">

                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-xl transition hover:bg-white/10">
                    <div class="flex size-11 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="5" y="3" width="14" height="18" rx="2" />
                            <path d="M9 3h6v3H9zM9 17v-3M12 17v-6M15 17v-4" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-base font-semibold text-white">Smart Vaccination Scheduling</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-300">Effortlessly book and manage vaccination appointments with real-time updates and notifications.</p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-xl transition hover:bg-white/10">
                    <div class="flex size-11 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 3 4 6v6c0 5 3.5 8 8 9 4.5-1 8-4 8-9V6l-8-3Z" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-base font-semibold text-white">Secure Health Records</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-300">Maintain safe and centralized vaccine history for each child, accessible by parents and hospitals.</p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-xl transition hover:bg-white/10">
                    <div class="flex size-11 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-600/30">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M22 12h-6l-2 3h-4l-2-3H2" />
                            <path d="M5.5 5h13L22 12v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-6l3.5-7Z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-base font-semibold text-white">Hospital &amp; Parent Portals</h3>
                    <p class="mt-2 text-sm leading-relaxed text-slate-300">Dedicated dashboards for hospitals and parents to manage and track appointments, vaccines, and requests.</p>
                </div>

            </div>
        </div><!-- End Content -->

    </div>
</section><!-- /Hero Section -->