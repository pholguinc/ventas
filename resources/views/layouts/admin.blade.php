<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href='{{ url('storage/img') }}/favicon.ico' />
</head>

<body>
  <div class="loader" style="background: url('{{ asset('storage/img/loading.gif')}}') 50% 50% no-repeat #f9f9f9;;"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include('layouts.partials.navbar')
      <div class="main-sidebar sidebar-style-2">
         @include('layouts.partials.sidebar')
      </div>
      <!-- Main Content -->
      <div class="main-content">
       @yield('content')
        @include('layouts.partials.colors')
      </div>
       @include('layouts.partials.footer')
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
