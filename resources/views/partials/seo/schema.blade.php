@php
    $site = rtrim(config('app.url'), '/') . '/';
    $portfolio = 'https://hamzaamir-portfolio.web.app/';
    $description = 'Vaccine management system for hospital vaccination appointments, online vaccine booking and child vaccination schedules.';

    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebSite',
                '@id' => $site . '#website',
                'url' => $site,
                'name' => 'MediLab',
                'description' => $description,
                'inLanguage' => 'en',
                'publisher' => ['@id' => $portfolio . '#person'],
            ],
            [
                '@type' => 'WebPage',
                '@id' => $site . '#webpage',
                'url' => $site,
                'name' => 'MediLab | Vaccine Management System',
                'isPartOf' => ['@id' => $site . '#website'],
                'about' => ['@id' => $site . '#app'],
                'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => asset('assets/img/og-image.png'), 'width' => 1200, 'height' => 630],
                'inLanguage' => 'en',
            ],
            [
                '@type' => 'WebApplication',
                '@id' => $site . '#app',
                'name' => 'MediLab',
                'url' => $site,
                'description' => $description,
                'applicationCategory' => 'HealthApplication',
                'operatingSystem' => 'Web',
                'browserRequirements' => 'Requires a modern web browser',
                'inLanguage' => 'en',
                'image' => asset('assets/img/og-image.png'),
                'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
                'author' => ['@id' => $portfolio . '#person'],
                'keywords' => 'vaccine management system, hospital vaccination appointment, online vaccine booking, child vaccination schedule, Laravel web application',
            ],
            [
                '@type' => 'Person',
                '@id' => $portfolio . '#person',
                'name' => 'Hamza Aamir',
                'url' => $portfolio,
                'mainEntityOfPage' => $portfolio,
                'jobTitle' => 'Full Stack Developer',
                'description' => 'Full stack developer building web apps with React, Node.js, MongoDB and Laravel, plus C# desktop apps and interactive 3D with Three.js.',
                'image' => $portfolio . 'og-image.jpg',
                'email' => 'hamzaamir72007@gmail.com',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'Karachi',
                    'addressCountry' => 'PK',
                ],
                'knowsAbout' => [
                    'Laravel', 'PHP', 'React', 'Node.js', 'Express', 'MongoDB', 'MySQL',
                    'TypeScript', 'JavaScript', 'Tailwind CSS', 'Three.js', 'C#', '.NET', 'WinUI 3',
                ],
                'sameAs' => [
                    $portfolio,
                    'https://github.com/x-hamza47',
                    'https://www.linkedin.com/in/hamza-aamir-dev/',
                ],
            ],
        ],
    ];

    if (!empty($faqs)) {
        $schema['@graph'][] = [
            '@type' => 'FAQPage',
            '@id' => $site . '#faq',
            'isPartOf' => ['@id' => $site . '#webpage'],
            'mainEntity' => array_map(fn ($f) => [
                '@type' => 'Question',
                'name' => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ], $faqs),
        ];
    }
@endphp
<script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>