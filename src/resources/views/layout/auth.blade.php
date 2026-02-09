<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COACHTECH</title>
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
  <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  @yield('css')
</head>

<body class="auth-body">
  <div class="header">
    <h1 class="header__heading">
      <a href="/">COACHTECH</a>
    </h1>
  </div>
  <div class="content">
      @yield('content')
  </div>
</body>
</html>