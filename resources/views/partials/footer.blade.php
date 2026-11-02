<!-- Footer -->
<footer id="footer" class="relative overflow-hidden border-t border-white/10 bg-[#000319]">

    <div aria-hidden="true" class="pointer-events-none absolute left-1/2 top-0 size-[28rem] -translate-x-1/2 -translate-y-1/2 rounded-full bg-blue-600/15 blur-[130px]"></div>

    <div class="relative mx-auto max-w-6xl px-4 pb-8 pt-16">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">

            <div class="lg:col-span-2">
                <a href="{{ route('web.index') }}" class="inline-flex items-center gap-2" aria-label="MediLab home">
                    <img src="{{ asset('assets/img/android-chrome-512x512.png') }}" alt="MediLab logo" width="32" height="32" class="size-8 rounded-lg">
                    <span class="text-lg font-semibold text-white">Medi<span class="text-blue-400">Lab</span></span>
                </a>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-slate-300">
                    A vaccine management system for hospital vaccination appointments, online vaccine booking and child vaccination schedules.
                </p>
                <div class="mt-5 flex items-center gap-3">
                    <a href="https://github.com/x-hamza47" target="_blank" rel="noopener" aria-label="Hamza Aamir on GitHub"
                        class="flex size-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-slate-300 transition hover:bg-white/10 hover:text-white">
                        <svg class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 .5a11.5 11.5 0 0 0-3.64 22.41c.58.1.79-.25.79-.56v-2c-3.2.7-3.88-1.37-3.88-1.37-.52-1.33-1.28-1.69-1.28-1.69-1.04-.71.08-.7.08-.7 1.15.08 1.76 1.19 1.76 1.19 1.03 1.76 2.69 1.25 3.35.96.1-.74.4-1.25.73-1.54-2.55-.29-5.24-1.28-5.24-5.69 0-1.26.45-2.28 1.19-3.09-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.17 1.18a10.9 10.9 0 0 1 5.77 0c2.2-1.49 3.17-1.18 3.17-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.83 1.19 3.09 0 4.42-2.69 5.39-5.25 5.68.41.36.78 1.06.78 2.14v3.17c0 .31.21.67.8.56A11.5 11.5 0 0 0 12 .5Z" /></svg>
                    </a>
                    <a href="https://www.linkedin.com/in/hamza-aamir-dev/" target="_blank" rel="noopener" aria-label="Hamza Aamir on LinkedIn"
                        class="flex size-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-slate-300 transition hover:bg-white/10 hover:text-white">
                        <svg class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.86 0-2.14 1.45-2.14 2.94v5.67H9.34V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28ZM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12ZM7.12 20.45H3.56V9h3.56v11.45Z" /></svg>
                    </a>
                    <a href="mailto:hamzaamir72007@gmail.com" aria-label="Email Hamza Aamir"
                        class="flex size-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-slate-300 transition hover:bg-white/10 hover:text-white">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" /><path d="m3 7 9 6 9-6" /></svg>
                    </a>
                </div>
            </div>

            <nav aria-label="Footer navigation">
                <h2 class="text-sm font-semibold uppercase tracking-widest text-cyan-400">Explore</h2>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li><a href="#hero" class="transition hover:text-white">Home</a></li>
                    <li><a href="#about" class="transition hover:text-white">About us</a></li>
                    <li><a href="#services" class="transition hover:text-white">Services</a></li>
                    <li><a href="#faq" class="transition hover:text-white">FAQ</a></li>
                    <li><a href="#contact" class="transition hover:text-white">Contact</a></li>
                </ul>
            </nav>

            <nav aria-label="Account links">
                <h2 class="text-sm font-semibold uppercase tracking-widest text-cyan-400">Account</h2>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    @auth
                        <li><a href="{{ url(auth()->user()->role === 'parent' ? '/dashboard' : '/admin') }}" class="transition hover:text-white">Dashboard</a></li>
                    @endauth
                    @guest
                        <li><a href="{{ url('/dashboard/login') }}" class="transition hover:text-white">Login</a></li>
                        <li><a href="{{ url('/dashboard/register') }}" class="transition hover:text-white">Register</a></li>
                    @endguest
                    <li><a href="#appointment" class="transition hover:text-white">Make an Appointment</a></li>
                </ul>
            </nav>
        </div>

        <div class="mt-12 flex flex-col items-center justify-between gap-3 border-t border-white/10 pt-6 text-xs text-slate-400 sm:flex-row">
            <p>© {{ date('Y') }} MediLab. All rights reserved.</p>
            <p class="text-center">
                Built by
                <a href="https://hamzaamir-portfolio.web.app/" target="_blank" rel="noopener"
                    title="Hamza Aamir, Full Stack Developer (Laravel, React, Node.js)"
                    class="font-semibold text-blue-400 transition hover:text-cyan-400">Hamza Aamir</a>
                · Template base by <a href="https://bootstrapmade.com/" target="_blank" rel="noopener" class="underline-offset-2 hover:text-white hover:underline">BootstrapMade</a>
            </p>
        </div>
    </div>
</footer>