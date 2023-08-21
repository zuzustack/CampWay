<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CampWay</title>
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/own.css">
  </head>
  <body>
    
    {{-- Navbar --}}
    @include('components.navbar_admin')
    {{-- End Navbar --}}

    <div class="d-flex h-full-nav">
        {{-- Sidebar --}}
        @include('components.sidebar_user')
        {{-- Content --}}

        @yield('content')
    </div>
    {{-- Content --}}

    <script src="/js/bootstrap/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  </body>
</html>