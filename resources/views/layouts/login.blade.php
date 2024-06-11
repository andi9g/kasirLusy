<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VANSESCO</title>
  @include('layouts.header')


</head>
<body class="hold-transition login-page bgku">
  @yield('content')


@include('layouts.footer')
@include('sweetalert::alert')
</body>
</html>
