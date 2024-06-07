<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nama Website</title>
  @include('layouts.header')
  <style>
    .bgku {
        background-image: url({{ url("gambar", "login.jpg") }});
    }

    .btn-primary {
        background: pink !important;
        border: 1px solid pink !important;
        color: rgb(143, 40, 57) !important;
        font-weight: bold;
    }
  </style>

</head>
<body class="hold-transition login-page bgku">
  @yield('content')


@include('layouts.footer')
@include('sweetalert::alert')
</body>
</html>
