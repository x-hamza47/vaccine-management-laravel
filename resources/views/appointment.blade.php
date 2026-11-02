<!-- Appointment Section -->
<section id="appointment" class="relative scroll-mt-24 overflow-hidden bg-[#000319] py-24">

    <div aria-hidden="true" class="pointer-events-none absolute -right-20 top-10 size-[26rem] rounded-full bg-cyan-500/10 blur-[120px]"></div>
    <div aria-hidden="true" class="pointer-events-none absolute -left-20 bottom-0 size-[24rem] rounded-full bg-blue-600/15 blur-[120px]"></div>

    <div class="relative mx-auto max-w-6xl px-4">
        <div class="grid items-center gap-12 lg:grid-cols-5">

            {{-- Left: title --}}
            <div class="lg:col-span-2">
                <p class="text-sm font-medium uppercase tracking-widest text-cyan-400">Book online</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                    <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Appointment</span>
                </h2>
                <p class="mt-4 leading-relaxed text-slate-300">
                    Book, track, and manage your child's vaccination appointments with ease and confidence.
                </p>
            </div><!-- End Section Title -->

            {{-- Right: form card --}}
            <div class="lg:col-span-3">
                <div class="rounded-3xl border border-white/10 bg-white/5 p-6 shadow-[0_8px_60px_rgba(37,99,235,0.25)] backdrop-blur-xl sm:p-8">

                    @if (session('success'))
                        <div role="status" class="mb-5 rounded-xl border border-emerald-400/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-300">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div role="alert" class="mb-5 rounded-xl border border-red-400/20 bg-red-500/10 px-4 py-3 text-sm text-red-300">{{ session('error') }}</div>
                    @endif
                    @if ($errors->any())
                        <div role="alert" class="mb-5 rounded-xl border border-red-400/20 bg-red-500/10 px-4 py-3 text-sm text-red-300">
                            <ul class="list-inside list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('web.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            @if ($childs->isNotEmpty())
                                <label for="child" class="mb-1.5 block text-sm font-medium text-slate-200">Child</label>
                                <select name="child_id" id="child" required
                                    class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30">
                                    <option disabled selected value="" class="bg-[#000319]">Select Child</option>
                                    @foreach ($childs as $child)
                                        <option value="{{ $child->id }}" class="bg-[#000319]">{{ $child->name }}</option>
                                    @endforeach
                                </select>
                            @elseguest
                                <label for="name" class="mb-1.5 block text-sm font-medium text-slate-200">Your Name</label>
                                <input type="text" name="name" id="name" placeholder="Your Name"
                                    class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30">
                            @else
                                <p class="rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-300">
                                    You have no children added yet.
                                    <a href="{{ url('/dashboard') }}" class="text-blue-400 underline-offset-4 hover:underline">Add a child in your dashboard</a> first.
                                </p>
                            @endif
                        </div>

                        <div class="grid gap-5 sm:grid-cols-3">
                            <div>
                                <label for="date" class="mb-1.5 block text-sm font-medium text-slate-200">Date</label>
                                <input type="date" name="date" id="date" required min="{{ now()->toDateString() }}"
                                    class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white outline-none transition [color-scheme:dark] focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30">
                            </div>
                            <div>
                                <label for="hospital" class="mb-1.5 block text-sm font-medium text-slate-200">Hospital</label>
                                <select name="hospital" id="hospital" required
                                    class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30">
                                    <option disabled selected value="" class="bg-[#000319]">Select Hospital</option>
                                    @foreach ($hospitals as $hospital)
                                        <option value="{{ $hospital->id }}" class="bg-[#000319]">{{ $hospital->hospital_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="vaccine" class="mb-1.5 block text-sm font-medium text-slate-200">Vaccine</label>
                                <select name="vaccine" id="vaccine" required
                                    class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30">
                                    <option disabled selected value="" class="bg-[#000319]">Select Vaccine</option>
                                    @foreach ($vaccines as $vaccine)
                                        <option value="{{ $vaccine->id }}" class="bg-[#000319]">{{ $vaccine->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-3 font-medium text-white shadow-lg shadow-blue-600/30 transition hover:brightness-110">
                            Make an Appointment
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section><!-- /Appointment Section -->