@php
    $seoTitle = $seoTitle ?? 'MediLab | Vaccine Management System';
    $seoDescription =
        $seoDescription ??
        'Vaccine management system for hospital vaccination appointments. Book vaccines online and track your child’s vaccination schedule.';
    $seoImage = $seoImage ?? asset('assets/img/og-image.jpg');
    $seoImageAlt = $seoImageAlt ?? 'MediLab vaccine management system for parents and hospitals';
    $seoUrl = $seoUrl ?? config('app.url') . strtok(request()->getRequestUri(), '?');
@endphp

<title>{{ $seoTitle }}</title>
<meta name="description" content="{{ $seoDescription }}">
<meta name="author" content="Hamza Aamir">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="theme-color" content="#000319">
<link rel="canonical" href="{{ $seoUrl }}">

{{-- Open Graph --}}
<meta property="og:type" content="website">
<meta property="og:site_name" content="MediLab">
<meta property="og:locale" content="en_US">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoUrl }}">
<meta property="og:image" content="{{ $seoImage }}">
<meta property="og:image:secure_url" content="{{ $seoImage }}">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $seoImageAlt }}">

{{-- Twitter / X --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoImage }}">
<meta name="twitter:image:alt" content="{{ $seoImageAlt }}">