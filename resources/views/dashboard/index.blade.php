@include('dashboard.partials.header')

{{-- * Sidebar --}}
@if (Auth::check())
    @include('dashboard.layout.sidebar')
@endif
{{-- * sidebar end --}}

  {{--! Content --}}
    @yield('content')
  {{-- ! End Content --}}

@include('dashboard.partials.footer')