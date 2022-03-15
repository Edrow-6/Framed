<!DOCTYPE html>
<html lang="en">
  <head>
    @include('shared.head')
  </head>
  <body class="flex flex-col min-h-screen {{ $body_classes }}">
    <header>
      @include('shared.navbar')
    </header>

    <main class="flex-grow bg-gradient-to-b from-white to-blue-100">
      @yield('content')
    </main>

    @include('shared.footer')
    @include('shared.scripts')
  </body>
</html>