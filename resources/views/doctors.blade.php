<!-- Doctors Section -->
@php
    $doctors = [
        ['Dr. Asad Siddiqui', 'Chief Pediatrician', 'doctors-1.webp',
         'With over 15 years of experience in child healthcare, Dr. Asad leads our vaccination program to ensure every child receives timely immunization.'],
        ['Dr. Farah Qureshi', 'Immunologist', 'doctors-2.webp',
         'Specializing in vaccine-preventable diseases, Dr. Farah ensures our protocols are aligned with global immunization standards and practices.'],
        ['Dr. Aslam', 'Family Physician', 'doctors-3.webp',
         'Dr. Aslam works closely with parents, providing guidance and support throughout their child\'s vaccination journey.'],
        ['Dr. Kanwal', 'Public Health Advisor', 'doctors-4.webp',
         'Dr. Kanwal supports our outreach and awareness campaigns, ensuring vulnerable communities have access to essential vaccines.'],
    ];
@endphp

<section id="doctors" class="relative scroll-mt-24 overflow-hidden bg-[#000319] py-24">

    <div aria-hidden="true" class="pointer-events-none absolute left-1/2 top-10 size-[30rem] -translate-x-1/2 rounded-full bg-blue-600/15 blur-[130px]"></div>

    <div class="relative mx-auto max-w-6xl px-4">

        {{-- Section title --}}
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-medium uppercase tracking-widest text-cyan-400">Our team</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Doctors</span>
            </h2>
            <p class="mt-4 leading-relaxed text-slate-300">
                Meet the dedicated professionals who ensure safe and timely vaccinations for every child.
            </p>
        </div><!-- End Section Title -->

        <div class="mt-14 grid gap-5 lg:grid-cols-2">
            @foreach ($doctors as $doc)
                <article class="group relative flex flex-col items-center gap-6 overflow-hidden rounded-3xl border border-white/10 bg-white/5 p-6 text-center shadow-[0_8px_40px_rgba(37,99,235,0.15)] backdrop-blur-xl transition hover:bg-white/10 sm:flex-row sm:text-left">

                    <div aria-hidden="true" class="pointer-events-none absolute -right-12 -top-12 size-44 rounded-full bg-blue-600/20 blur-3xl transition group-hover:bg-cyan-500/25"></div>

                    <div class="relative shrink-0 rounded-full bg-gradient-to-r from-blue-600 to-cyan-500 p-[3px] shadow-lg shadow-blue-600/30">
                        <img src="{{ asset('assets/img/doctors/' . $doc[2]) }}"
                            alt="{{ $doc[0] }}, {{ $doc[1] }} at MediLab"
                            width="128" height="128" loading="lazy"
                            class="size-32 rounded-full border-4 border-[#000319] object-cover">
                    </div>

                    <div class="relative">
                        <h3 class="text-lg font-semibold text-white">{{ $doc[0] }}</h3>
                        <span class="mt-2 inline-block rounded-full border border-cyan-400/20 bg-cyan-400/10 px-3 py-1 text-xs font-medium text-cyan-300">{{ $doc[1] }}</span>
                        <p class="mt-3 text-sm leading-relaxed text-slate-300">{{ $doc[3] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section><!-- /Doctors Section -->