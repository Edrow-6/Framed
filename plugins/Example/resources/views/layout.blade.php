<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title . ' | ' . $app }}</title>

    {{-- Favicon --}}
    <link href="" rel="icon">

    {{-- Polices --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind and Styles --}}
    <link href="" rel="stylesheet">
    <link href="" rel="stylesheet">
  </head>
  <body class="flex flex-col min-h-screen {{ $body_classes }}">
    <header>
      @include('components.navbar')
    </header>

    <main class="flex-grow bg-gradient-to-b from-white to-blue-100">
      @yield('content')
    </main>

    @include('components.footer')
    @include('components.scripts')
  </body>
</html>