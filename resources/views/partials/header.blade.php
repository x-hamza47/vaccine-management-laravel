<header class="fixed inset-x-0 top-0 z-50">

    {{-- Top bar: backlink to your portfolio --}}
    <div class="border-b border-white/10 bg-[#000319]/80 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-2 text-xs text-slate-300">
            <a href="https://hamzaamir-portfolio.web.app/" target="_blank" rel="noopener"
                title="Hamza Aamir, Full Stack Developer (Laravel, React, Node.js)"
                class="transition hover:text-white">
                Portfolio project by <span class="font-semibold text-blue-400">Hamza Aamir</span>
                <span class="hidden sm:inline">· Full Stack Developer (Laravel, React)</span> ↗
            </a>

            <div class="flex items-center gap-4">
                <a href="https://github.com/x-hamza47" target="_blank" rel="noopener" aria-label="Hamza Aamir on GitHub"
                    class="transition hover:text-white">
                    <svg class="size-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .5a11.5 11.5 0 0 0-3.64 22.41c.58.1.79-.25.79-.56v-2c-3.2.7-3.88-1.37-3.88-1.37-.52-1.33-1.28-1.69-1.28-1.69-1.04-.71.08-.7.08-.7 1.15.08 1.76 1.19 1.76 1.19 1.03 1.76 2.69 1.25 3.35.96.1-.74.4-1.25.73-1.54-2.55-.29-5.24-1.28-5.24-5.69 0-1.26.45-2.28 1.19-3.09-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.17 1.18a10.9 10.9 0 0 1 5.77 0c2.2-1.49 3.17-1.18 3.17-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.83 1.19 3.09 0 4.42-2.69 5.39-5.25 5.68.41.36.78 1.06.78 2.14v3.17c0 .31.21.67.8.56A11.5 11.5 0 0 0 12 .5Z"/></svg>
                </a>
                <a href="https://www.linkedin.com/in/hamza-aamir-dev/" target="_blank" rel="noopener"
                    aria-label="Hamza Aamir on LinkedIn" class="transition hover:text-white">
                    <svg class="size-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.86 0-2.14 1.45-2.14 2.94v5.67H9.34V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28ZM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12ZM7.12 20.45H3.56V9h3.56v11.45ZM22.22 0H1.77C.79 0 0 .77 0 1.73v20.54C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.73V1.73C24 .77 23.2 0 22.22 0Z"/></svg>
                </a>
                <a href="mailto:hamzaamir72007@gmail.com" aria-label="Email Hamza Aamir"
                    class="transition hover:text-white">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Main nav: glass pill --}}
    <div class="mx-auto mt-3 max-w-6xl px-4">
        <nav
            class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-3 shadow-[0_8px_32px_rgba(37,99,235,0.15)] backdrop-blur-xl">

            <a href="{{ route('web.index') }}" class="flex items-center gap-2" aria-label="MediLab home">
                <img src="{{ asset('assets/img/android-chrome-512x512.png') }}" alt="MediLab logo"
                    class="size-8 rounded-lg">
                <span class="text-lg font-semibold text-white">Medi<span class="text-blue-400">Lab</span></span>
            </a>

            {{-- Desktop links --}}
            <ul class="hidden items-center gap-1 text-sm text-slate-300 md:flex">
                <li><a href="#hero" class="rounded-lg px-3 py-2 transition hover:bg-white/10 hover:text-white">Home</a></li>
                <li><a href="#about" class="rounded-lg px-3 py-2 transition hover:bg-white/10 hover:text-white">About</a></li>
                <li><a href="#services" class="rounded-lg px-3 py-2 transition hover:bg-white/10 hover:text-white">Services</a></li>
                <li><a href="#contact" class="rounded-lg px-3 py-2 transition hover:bg-white/10 hover:text-white">Contact</a></li>
            </ul>

            {{-- Desktop buttons --}}
            <div class="hidden items-center gap-2 md:flex">
                @auth
                    <a href="{{ url(auth()->user()->role === 'parent' ? '/dashboard' : '/admin') }}"
                        class="rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-blue-600/30 transition hover:brightness-110">
                        Dashboard
                    </a>
                @endauth
                @guest
                    <a href="{{ url('/dashboard/login') }}"
                        class="rounded-xl px-4 py-2 text-sm text-slate-200 transition hover:bg-white/10">Login</a>
                    <a href="{{ url('/dashboard/register') }}"
                        class="rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-blue-600/30 transition hover:brightness-110">
                        Register
                    </a>
                @endguest
            </div>

            {{-- Mobile button --}}
            <button id="menu-btn" type="button" aria-label="Open menu" aria-expanded="false"
                class="rounded-lg p-2 text-white hover:bg-white/10 md:hidden">
                <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </nav>

        {{-- Mobile menu --}}
        <div id="mobile-menu"
            class="mt-2 hidden rounded-2xl border border-white/10 bg-[#000319]/90 p-3 backdrop-blur-xl md:hidden">
            <a href="#hero" class="block rounded-lg px-3 py-2 text-slate-200 hover:bg-white/10">Home</a>
            <a href="#about" class="block rounded-lg px-3 py-2 text-slate-200 hover:bg-white/10">About</a>
            <a href="#services" class="block rounded-lg px-3 py-2 text-slate-200 hover:bg-white/10">Services</a>
            <a href="#contact" class="block rounded-lg px-3 py-2 text-slate-200 hover:bg-white/10">Contact</a>
            @auth
                <a href="{{ url(auth()->user()->role === 'parent' ? '/dashboard' : '/admin') }}"
                    class="mt-2 block rounded-xl bg-blue-600 px-3 py-2 text-center font-medium text-white">Dashboard</a>
            @endauth
            @guest
                <div class="mt-2 grid grid-cols-2 gap-2">
                    <a href="{{ url('/dashboard/login') }}"
                        class="rounded-xl border border-white/10 px-3 py-2 text-center text-slate-200">Login</a>
                    <a href="{{ url('/dashboard/register') }}"
                        class="rounded-xl bg-blue-600 px-3 py-2 text-center font-medium text-white">Register</a>
                </div>
            @endguest
        </div>
    </div>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            const open = menu.classList.toggle('hidden') === false;
            btn.setAttribute('aria-expanded', open);
        });
        menu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => menu.classList.add('hidden')));
    </script>
</header>