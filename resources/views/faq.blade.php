<!-- Faq Section -->
<section id="faq" aria-labelledby="faq-heading" class="relative scroll-mt-24 overflow-hidden bg-[#000319] py-24">

    <div aria-hidden="true" class="pointer-events-none absolute -right-24 top-10 size-[26rem] rounded-full bg-cyan-500/10 blur-[120px]"></div>

    <div class="relative mx-auto max-w-6xl px-4">
        <div class="grid gap-12 lg:grid-cols-5">

            {{-- Title --}}
            <div class="lg:col-span-2">
                <p class="text-sm font-medium uppercase tracking-widest text-cyan-400">FAQ</p>
                <h2 id="faq-heading" class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    Frequently Asked
                    <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Questions</span>
                </h2>
                <p class="mt-4 leading-relaxed text-slate-300">
                    Find quick answers to common questions about vaccination bookings, records, and system usage.
                </p>
            </div><!-- End Section Title -->

            {{-- Accordion (native details/summary: no JS, text stays in the HTML for crawlers) --}}
            <div class="space-y-3 lg:col-span-3">
                @foreach ($faqs as $i => $faq)
                    <details name="faq" @if ($i === 0) open @endif
                        class="group rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl transition open:bg-white/10 open:shadow-[0_8px_40px_rgba(37,99,235,0.2)] hover:bg-white/10">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 rounded-2xl px-5 py-4 [&::-webkit-details-marker]:hidden">
                            <h3 class="text-base font-semibold text-white">{{ $faq['q'] }}</h3>
                            <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-white/5 text-cyan-400 transition group-open:rotate-90 group-open:bg-gradient-to-r group-open:from-blue-600 group-open:to-cyan-500 group-open:text-white">
                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 6 6 6-6 6" /></svg>
                            </span>
                        </summary>
                        <div class="px-5 pb-5 text-sm leading-relaxed text-slate-300">
                            <p>{{ $faq['a'] }}</p>
                            @isset($faq['link'])
                                <a href="{{ $faq['link'][0] }}" target="_blank" rel="noopener"
                                    class="mt-3 inline-flex items-center gap-1 font-medium text-blue-400 transition hover:text-cyan-400">
                                    {{ $faq['link'][1] }} 
                                </a>
                            @endisset
                        </div>
                    </details>
                @endforeach
            </div>

        </div>
    </div>

</section><!-- /Faq Section -->