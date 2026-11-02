<!-- Departments Section -->
@php
    $focusAreas = [
        ['Pediatrics', 'departments-1.webp', 'Child receiving a vaccination from a pediatric nurse',
         'Our platform ensures that children from birth through adolescence receive timely and complete vaccinations. We help parents track their child’s immunization schedule, receive reminders, and access digital vaccination records. Hospitals and clinics can monitor coverage and manage upcoming pediatric appointments with ease.'],
        ['Maternal Care', 'departments-2.webp', 'Pregnant woman at a maternal vaccination checkup',
         'Vaccinations during pregnancy play a vital role in protecting both mother and child. MediLab supports healthcare providers in tracking and managing essential maternal vaccines such as Tetanus, Influenza, and Hepatitis B. Our system allows hospitals to schedule, notify, and maintain maternal vaccine records efficiently.'],
        ['Outreach Units', 'departments-3.webp', 'Mobile vaccination outreach team serving a remote community',
         'To bridge the gap in healthcare access, we support mobile outreach programs that deliver vaccines to remote, rural, or underserved communities. These field units can log vaccinations on-site using our digital system, ensuring accurate data tracking and expanded vaccine coverage across regions.'],
        ['Immunization Records', 'departments-4.webp', 'Digital immunization record on a screen',
         'Every vaccination given is stored securely in our centralized database. Parents can view their child’s full immunization history anytime, and hospitals can verify records during visits. This reduces paperwork, avoids duplicate vaccines, and supports compliance with national health programs.'],
        ['Public Awareness', 'departments-5.webp', 'Health worker running a vaccination awareness campaign',
         'Educating the public is critical for vaccination success. MediLab integrates tools for hospitals and health agencies to run awareness campaigns, share informative content, and send reminders via SMS or email. This ensures families stay informed about upcoming vaccines, benefits, and timelines.'],
    ];
@endphp

<section id="departments" class="relative scroll-mt-24 overflow-hidden bg-[#000319] py-24">

    <div aria-hidden="true" class="pointer-events-none absolute -left-24 top-20 size-[26rem] rounded-full bg-blue-600/15 blur-[120px]"></div>
    <div aria-hidden="true" class="pointer-events-none absolute -right-24 bottom-0 size-[22rem] rounded-full bg-cyan-500/10 blur-[120px]"></div>

    <div class="relative mx-auto max-w-6xl px-4">

        {{-- Section title --}}
        <div class="mx-auto max-w-3xl text-center">
            <p class="text-sm font-medium uppercase tracking-widest text-cyan-400">Where we help</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                Our <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Focus Areas</span>
            </h2>
            <p class="mt-4 leading-relaxed text-slate-300">
                Key areas we cover through our digital vaccination system to protect every life.
            </p>
        </div><!-- End Section Title -->

        <div id="focus-tabs" class="mt-12">

            {{-- Tabs --}}
            <div role="tablist" aria-label="Focus areas"
                class="flex gap-2 overflow-x-auto rounded-2xl border border-white/10 bg-white/5 p-2 backdrop-blur-xl md:justify-center">
                @foreach ($focusAreas as $i => $area)
                    <button type="button" role="tab" id="focus-tab-{{ $i }}"
                        aria-controls="focus-panel-{{ $i }}"
                        aria-selected="{{ $i === 0 ? 'true' : 'false' }}"
                        tabindex="{{ $i === 0 ? '0' : '-1' }}"
                        class="shrink-0 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white aria-selected:bg-gradient-to-r aria-selected:from-blue-600 aria-selected:to-cyan-500 aria-selected:text-white aria-selected:shadow-lg aria-selected:shadow-blue-600/30">
                        {{ $area[0] }}
                    </button>
                @endforeach
            </div>

            {{-- Panels --}}
            @foreach ($focusAreas as $i => $area)
                <div role="tabpanel" id="focus-panel-{{ $i }}" aria-labelledby="focus-tab-{{ $i }}"
                    @if ($i !== 0) hidden @endif
                    class="mt-4 rounded-3xl border border-white/10 bg-white/5 p-6 shadow-[0_8px_60px_rgba(37,99,235,0.2)] backdrop-blur-xl sm:p-8">
                    <div class="grid items-center gap-8 lg:grid-cols-5">
                        <div class="lg:col-span-3">
                            <h3 class="text-2xl font-semibold text-white">{{ $area[0] }}</h3>
                            <p class="mt-4 leading-relaxed text-slate-300">{{ $area[3] }}</p>
                        </div>
                        <div class="lg:col-span-2">
                            <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/5 p-1.5">
                                <img src="{{ asset('assets/img/' . $area[1]) }}" alt="{{ $area[2] }}"
                                    width="480" height="360" loading="lazy"
                                    class="h-auto w-full rounded-xl object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        (() => {
            const root = document.getElementById('focus-tabs');
            const tabs = [...root.querySelectorAll('[role="tab"]')];
            const panels = [...root.querySelectorAll('[role="tabpanel"]')];
            const show = i => {
                tabs.forEach((t, n) => {
                    t.setAttribute('aria-selected', n === i);
                    t.tabIndex = n === i ? 0 : -1;
                });
                panels.forEach((p, n) => { p.hidden = n !== i; });
                tabs[i].focus();
            };
            tabs.forEach((t, i) => {
                t.addEventListener('click', () => show(i));
                t.addEventListener('keydown', e => {
                    if (e.key === 'ArrowRight') show((i + 1) % tabs.length);
                    if (e.key === 'ArrowLeft') show((i - 1 + tabs.length) % tabs.length);
                });
            });
        })();
    </script>
</section><!-- /Departments Section -->