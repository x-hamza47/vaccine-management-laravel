@php
    $faqs = [
        [
            'q' => 'How can I book a vaccination appointment for my child?',
            'a' =>
                'Log in to your parent account, choose your child, a hospital, a vaccine and your preferred date, then submit the request. The hospital reviews it and updates its status in your dashboard.',
        ],
        [
            'q' => 'Can I view my child’s vaccination history online?',
            'a' =>
                'Yes. Registered parents can see their child’s vaccination records from the dashboard, including completed doses and upcoming vaccines.',
        ],
        [
            'q' => 'What happens if I miss a scheduled appointment?',
            'a' =>
                'You can request a new appointment from your account. Check the child vaccination schedule in your dashboard so you know which doses are still due.',
        ],
        [
            'q' => 'How do hospitals update the vaccination status?',
            'a' =>
                'Hospitals have a dedicated dashboard to manage appointments. After a vaccine is given, hospital staff mark it as completed and the child’s record is updated.',
        ],
        [
            'q' => 'Who can register on MediLab?',
            'a' =>
                'Parents register to book hospital vaccination appointments and track their children. Hospitals register to manage vaccines, requests and records. Hospital accounts are approved before they can be used.',
        ],
        [
            'q' => 'What is an online vaccine booking system?',
            'a' =>
                'It lets parents request vaccination appointments over the internet instead of visiting or calling the hospital first. MediLab is a vaccine management system that connects parents and hospitals in one place.',
        ],
        [
            'q' => 'Who built MediLab?',
            'a' =>
                'MediLab is a portfolio project designed and developed by Hamza Aamir, a full stack developer working with Laravel and React.',
            'link' => ['https://hamzaamir-portfolio.web.app/', 'See Hamza Aamir’s portfolio'],
        ],
    ];

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(
            fn($f) => [
                '@type' => 'Question',
                'name' => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ],
            $faqs,
        ),
    ];
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('partials.seo.meta')

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/img/site.webmanifest') }}">

    <!-- Fonts: one family, only the weights you use -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('partials.seo.schema')
</head>

<body class="bg-[#000319] font-sans text-slate-200 antialiased">

    @include('partials.header')

    <main class="main">

        {{-- ! Hero Section --}}
        @include('hero')

        {{-- ! About Section --}}
        @include('about')

        {{-- ! Stats Section --}}
        @include('stats')

        {{-- ! Serivce Section --}}
        @include('services')

        {{-- ! Appointment Section --}}
        @include('appointment')

        {{-- ! Departments Section --}}
        @include('departments')

        {{-- ! Doctors Section --}}
        @include('doctors')

        {{-- ! FAQ Section --}}
        @include('faq')

        {{-- ! Testimonials Section --}}
        @include('testimonials')

        {{-- ! Gallery Section --}}
        @include('gallery')






        {{-- ! Contact Section --}}
        @include('contact')

    </main>

    @include('partials.footer')
    <!-- Scroll Top -->
    <button type="button" id="scroll-top" aria-label="Back to top"
        class="invisible fixed bottom-5 right-5 z-40 flex size-11 translate-y-2 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 text-white opacity-0 shadow-lg shadow-blue-600/40 transition hover:brightness-110">
        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m6 15 6-6 6 6" />
        </svg>
    </button>
    <script>
        (() => {
            const b = document.getElementById('scroll-top');
            const toggle = () => {
                const show = window.scrollY > 400;
                b.classList.toggle('invisible', !show);
                b.classList.toggle('opacity-0', !show);
                b.classList.toggle('translate-y-2', !show);
            };
            window.addEventListener('scroll', toggle, {
                passive: true
            });
            toggle();
            b.addEventListener('click', () => window.scrollTo({
                top: 0,
                behavior: 'smooth'
            }));
        })();
    </script>

    <!-- Preloader -->
    {{-- <div id="preloader"></div> --}}

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    {{-- <script src="{{ asset('assets/js/main.js') }}"></script> --}}

</body>

</html>
