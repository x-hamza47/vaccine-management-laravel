<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Medilab </title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('assets/img/site.webmanifest') }}">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.cs') }}s" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
         <img src="{{ asset('assets/img/android-chrome-512x512.png') }}" alt="">
          <h1 class="sitename">Medilab</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Home<br></a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            {{-- <li><a href="#departments">Departments</a></li> --}}
            {{-- <li><a href="#doctors">Doctors</a></li> --}}
            <li><a href="#contact">Contact</a></li>
            @auth
              
            <li><a href="{{ route('auth.logout') }}">Logout</a></li>
            <a class="cta-btn d-none d-sm-block" href="{{ route('show.dashboard') }}">Dashboard</a>
            @endauth
            @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register.show') }}">Register</a></li>
            @endguest
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="cta-btn d-none d-sm-block" href="#appointment">Make an Appointment</a>

      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <img src="{{ asset('assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

      <div class="container position-relative">

        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
          <h2>WELCOME TO MEDILAB</h2>
          <p>Protecting communities through organized and accessible vaccination services.</p>
        </div><!-- End Welcome -->

        <div class="content row gy-4">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
              <h3>Why Choose Medilab?</h3>
              <p>
                Medilab helps parents, hospitals, and administrators streamline the vaccination process. From scheduling appointments to tracking doses and reminders — we ensure no child misses essential protection.
              </p>
              <div class="text-center">
                <a href="#about" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
              </div>
            </div>
          </div><!-- End Why Box -->

          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="d-flex flex-column justify-content-center">
              <div class="row gy-4">

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                    <i class="bi bi-clipboard-data"></i>
                    <h4>Smart Vaccination Scheduling</h4>
                    <p>Effortlessly book and manage vaccination appointments with real-time updates and notifications.</p>
                  </div>
                </div><!-- End Icon Box -->

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                    <i class="bi bi-gem"></i>
                    <h4>Secure Health Records</h4>
                    <p>Maintain safe and centralized vaccine history for each child, accessible by parents and hospitals.</p>
                  </div>
                </div><!-- End Icon Box -->

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                    <i class="bi bi-inboxes"></i>
                    <h4>Hospital & Parent Portals</h4>
                    <p>Dedicated dashboards for hospitals and parents to manage and track appointments, vaccines, and requests.</p>
                  </div>
                </div><!-- End Icon Box -->

              </div>
            </div>
          </div>
        </div><!-- End  Content-->

      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4 gx-5">

          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
            <img src="{{ asset('assets/img/about.jp') }}g" class="img-fluid" alt="">
            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
          </div>

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <h3>About Us</h3>
            <p>
              Medilab is a digital platform designed to streamline the vaccination process for hospitals, parents, and administrators. Our goal is to ensure timely and accessible vaccinations by providing a centralized system for appointment scheduling, vaccine tracking, and communication.
            </p>
            <ul>
              <li>
                <i class="fa-solid fa-vial-circle-check"></i>
                <div>
                  <h5>Trusted Vaccination Records</h5>
                  <p>Securely manage vaccination history for every child with real-time updates and accessible reports.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-pump-medical"></i>
                <div>
                  <h5>Simplified Scheduling</h5>
                  <p>Schedule and manage appointments easily through smart reminders and an intuitive calendar system.</p>
                </div>
              </li>
              <li>
                <i class="fa-solid fa-heart-circle-xmark"></i>
                <div>
                  <h5>Support for Hospitals & Families</h5>
                  <p>Empowering both healthcare providers and families through dedicated dashboards and real-time status tracking.</p>
                </div>
              </li>
            </ul>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-solid fa-syringe"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="{{ \App\Models\VaccinationSchedule::where('status','completed')->count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Vaccines Administered</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-regular fa-hospital"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="{{ \App\Models\Hospital::count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hospitals</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-solid fa-child"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="{{ \App\Models\Children::count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Children Registered</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-solid fa-capsules"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="{{ \App\Models\Vaccine::where('available', true)->count() }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>Vaccine Types Available</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Empowering families and healthcare providers with smart, secure, and accessible vaccination solutions.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="fas fa-calendar-check"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Online Appointment Booking</h3>
              </a>
              <p>Schedule vaccination appointments easily from anywhere, at any time. Our system helps parents and hospitals coordinate seamlessly.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-notes-medical"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Digital Vaccination Records</h3>
              </a>
              <p>Maintain secure, centralized records for each child's vaccination history — accessible by parents and healthcare providers.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-hospital-user"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Hospital Management Dashboard</h3>
              </a>
              <p>Hospitals can view upcoming appointments, manage vaccine inventory, and monitor patient data through a real-time dashboard.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3> Automated SMS & Email Reminders</h3>
              </a>
              <p>Never miss a vaccination date again. Our system sends timely reminders to parents for upcoming appointments.</p>
              <a href="#" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-child"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3> Child Profile & Health Tracking</h3>
              </a>
              <p>Parents can manage profiles for multiple children, view past and upcoming vaccines, and track health records.</p>
              <a href="#" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-capsules"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Vaccine Inventory Management</h3>
              </a>
              <p>Efficiently manage and monitor vaccine stocks with alerts for low inventory and expired batches.</p>
              <a href="#" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Appointment Section -->
    <section id="appointment" class="appointment section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Appointment</h2>
        <p>Book, track, and manage your child's vaccination appointments with ease and confidence.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <form action="{{ route('web.store') }}" method="POST" role="form" class="php-email-form">
          @csrf
          <div class="row">
            <div class="col-md form-group">
              @if ($childs->isNotEmpty())
              <select name="child_id" id="hospital" class="form-select">
                <option disabled selected>Select Child</option>
                @foreach ($childs as $child)
                <option value="{{ $child->id }}">{{ $child->name }}</option>               
                @endforeach
              </select>
              @else
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name">
              @endif
            </div>

            {{-- <div class="col-md form-group mt-3 mt-md-0">
              <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" required="">
            </div> --}}
          </div>
          <div class="row">
            <div class="col-md-4 form-group mt-3">
              <input type="date" name="date" class="form-control datepicker" id="date" placeholder="Appointment Date">
            </div>
            <div class="col-md-4 form-group mt-3">
              <select name="hospital" id="hospital" class="form-select">
                <option disabled selected>Select Hospital</option>
                @foreach ($hospitals as $hospital)
                <option value="{{ $hospital->id }}">{{ $hospital->hospital_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4 form-group mt-3">
              <select name="vaccine" id="vaccine" class="form-select" >
                <option value="">Select Vaccine</option>
                @foreach ($vaccines as $vaccine)
                <option value="{{ $vaccine->id }}">{{ $vaccine->name }}</option>
                @endforeach
              </select>
            </div>
          </div>


          <div class="mt-3">
            {{-- <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div> --}}
            <div class="text-center"><button type="submit">Make an Appointment</button></div>
          </div>
        </form>

      </div>

    </section><!-- /Appointment Section -->

    <!-- Departments Section -->
    <section id="departments" class="departments section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Focus Areas</h2>
        <p>Key areas we cover through our digital vaccination system to protect every life.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#departments-tab-1">Pediatrics</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-2">Maternal Care</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-3">Outreach Units</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-4">Immunization Records</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#departments-tab-5">Public Awareness</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="departments-tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Pediatrics</h3>
                    <p>Our platform ensures that children from birth through adolescence receive timely and complete vaccinations. We help parents track their child’s immunization schedule, receive reminders, and access digital vaccination records. Hospitals and clinics can monitor coverage and manage upcoming pediatric appointments with ease.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="{{ asset('assets/img/departments-1.jpg') }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Maternal Care</h3>
                    <p>Vaccinations during pregnancy play a vital role in protecting both mother and child. VaxCare supports healthcare providers in tracking and managing essential maternal vaccines such as Tetanus, Influenza, and Hepatitis B. Our system allows hospitals to schedule, notify, and maintain maternal vaccine records efficiently.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="{{ asset('assets/img/departments-2.jpg') }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Outreach Units</h3>
                    <p>To bridge the gap in healthcare access, we support mobile outreach programs that deliver vaccines to remote, rural, or underserved communities. These field units can log vaccinations on-site using our digital system, ensuring accurate data tracking and expanded vaccine coverage across regions.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="{{ asset('assets/img/departments-3.jpg') }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Immunization Records</h3>
                    <p>Every vaccination given is stored securely in our centralized database. Parents can view their child’s full immunization history anytime, and hospitals can verify records during visits. This reduces paperwork, avoids duplicate vaccines, and supports compliance with national health programs.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="{{ asset('assets/img/departments-4.jpg') }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="departments-tab-5">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Public Awareness</h3>
                    <p>Educating the public is critical for vaccination success. VaxCare integrates tools for hospitals and health agencies to run awareness campaigns, share informative content, and send reminders via SMS or email. This ensures families stay informed about upcoming vaccines, benefits, and timelines.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="{{ asset('assets/img/departments-5.jpg') }}" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Departments Section -->

    <!-- Doctors Section -->
    <section id="doctors" class="doctors section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Doctors</h2>
        <p>Meet the dedicated professionals who ensure safe and timely vaccinations for every child.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('assets/img/doctors/doctors-1.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Dr. Asad Siddiqui</h4>
                <span>Chief Pediatrician</span>
                <p>With over 15 years of experience in child healthcare, Dr. Asad leads our vaccination program to ensure every child receives timely immunization.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('assets/img/doctors/doctors-2.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4> Dr. Farah Qureshi</h4>
                <span>Immunologist</span>
                <p>Specializing in vaccine-preventable diseases, Dr. Farah ensures our protocols are aligned with global immunization standards and practices.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('assets/img/doctors/doctors-3.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Dr. Aslam</h4>
                <span>Family Physician</span>
                <p>Dr. Aslam works closely with parents, providing guidance and support throughout their child's vaccination journey.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('assets/img/doctors/doctors-4.jp') }}g" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Dr. Kanwal</h4>
                <span>Public Health Advisor</span>
                <p>Dr. Kanwal supports our outreach and awareness campaigns, ensuring vulnerable communities have access to essential vaccines.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Doctors Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Frequently Asked Questions</h2>
        <p>Find quick answers to common questions about vaccination bookings, records, and system usage.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

              <div class="faq-item faq-active">
                <h3>How can I book a vaccination appointment for my child?</h3>
                <div class="faq-content">
                  <p>You can book an appointment by logging into your parent account and selecting an available date and time from the hospital's schedule. Once booked, you will receive confirmation via SMS and email.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Can I view my child’s vaccination history online?</h3>
                <div class="faq-content">
                  <p>Yes, all registered parents can access their child’s complete vaccination records from the dashboard, including completed doses and upcoming vaccines.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>What happens if I miss a scheduled appointment?</h3>
                <div class="faq-content">
                  <p>If you miss an appointment, you can reschedule it from your account. You will also receive automated reminders to avoid missing important future doses.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>How do hospitals update the vaccination status?</h3>
                <div class="faq-content">
                  <p>Hospitals have dedicated dashboards to manage appointments. After administering a vaccine, the hospital staff marks it as "completed," and the system updates the child's record in real-time.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <div class="container">

        <div class="row align-items-center">

          <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
            <h3>Testimonials</h3>
            <p>
              Hear from parents, healthcare workers, and clinic staff who’ve used our system to simplify vaccination management and ensure timely care.
            </p>
          </div>

          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">

            <div class="swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>
              <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <div class="d-flex">
                      <img src="{{ asset('assets/img/testimonials/testimonials-1.jpg') }}" class="testimonial-img flex-shrink-0" alt="">
                      <div>
                        <h3>Dr. Bilal Khan </h3>
                        <h4>General Practitioner</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>Whether it's routine vaccines or urgent outreach, this system helps us manage all vaccination needs with reliability and ease.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <div class="d-flex">
                      <img src="{{ asset('assets/img/testimonials/testimonials-2.jpg') }}" class="testimonial-img flex-shrink-0" alt="">
                      <div>
                        <h3>Dr. Amina Tariq</h3>
                        <h4>Pediatric Consultant</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>This system has significantly improved our appointment handling and record-keeping. Parents now come well-informed, and we spend less time on paperwork.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <div class="d-flex">
                      <img src="{{ asset('assets/img/testimonials/testimonials-3.jp') }}g" class="testimonial-img flex-shrink-0" alt="">
                      <div>
                        <h3>Samina Javed</h3>
                        <h4>Mother of 2</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>As a working mom, getting timely reminders and having my kids’ vaccine history in one place is a lifesaver. Highly recommended for all parents!</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->


                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <div class="d-flex">
                      <img src="{{ asset('assets/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img flex-shrink-0" alt="">
                      <div>
                        <h3>Hospital Admin</h3>
                        <h4>City Medical Center</h4>
                        <div class="stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                      </div>
                    </div>
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>We were able to reduce missed appointments by 40% thanks to SMS/email reminders. The dashboard is intuitive, and our staff adapted quickly.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                  </div>
                </div><!-- End testimonial item -->

              </div>
              <div class="swiper-pagination"></div>
            </div>

          </div>

        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p>A glimpse into our vaccination drives, healthcare staff, and community outreach programs.</p>
      </div><!-- End Section Title -->

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('assets/img/gallery/gallery-1.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('assets/img/gallery/gallery-1.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('assets/img/gallery/gallery-2.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('assets/img/gallery/gallery-2.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('assets/img/gallery/gallery-3.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('assets/img/gallery/gallery-3.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('assets/img/gallery/gallery-4.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('assets/img/gallery/gallery-4.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('assets/img/gallery/gallery-5.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('assets/img/gallery/gallery-5.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('assets/img/gallery/gallery-6.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('assets/img/gallery/gallery-6.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('assets/img/gallery/gallery-7.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('assets/img/gallery/gallery-7.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset('assets/img/gallery/gallery-8.jpg') }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset('assets/img/gallery/gallery-8.jpg') }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

        </div>

      </div>

    </section><!-- /Gallery Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Have questions or need support? Reach out to our team for assistance with appointments, records, or system access.</p>
      </div><!-- End Section Title -->

      <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div><!-- End Google Maps -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Location</h3>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+1 5589 55488 55</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>info@example.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Medilab</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Hic solutasetp</h4>
          <ul>
            <li><a href="#">Molestiae accusamus iure</a></li>
            <li><a href="#">Excepturi dignissimos</a></li>
            <li><a href="#">Suscipit distinctio</a></li>
            <li><a href="#">Dilecta</a></li>
            <li><a href="#">Sit quas consectetur</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nobis illum</h4>
          <ul>
            <li><a href="#">Ipsam</a></li>
            <li><a href="#">Laudantium dolorum</a></li>
            <li><a href="#">Dinera</a></li>
            <li><a href="#">Trodelas</a></li>
            <li><a href="#">Flexo</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Medilab</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script> --}}
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>