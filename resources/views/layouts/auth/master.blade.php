
<body>
  <!-- Top Bar -->
  @include('layouts.auth.includes.header')
  {{-- <main> --}}
    @yield('content')
    <!-- content here -->
    @include('layouts.auth.includes.footer')
  {{-- </main> --}}

  {{-- Laravel Mix - JS File --}}
  {{-- <script src="{{ mix('js/admin.js') }}"></script> --}}
  <!-- Scripts -->
  @stack('script')

</body>

</html>
