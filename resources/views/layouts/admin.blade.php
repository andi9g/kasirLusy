<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VANSESCO BOUTIQUE</title>
  @include('layouts.header')
  <style>
    .btn-success {
        background: #eebbc3
        border: none;
        color: rgb(148, 14, 37);
    }
    .bg-success {
        background: #eebbc3 !important;
    }

    .card-secondary {
        border-top: 3px solid #eebbc3 !important;
    }

    .active {
        background: #b8c1ec !important;
        color: rgb(255, 255, 255) !important;
        font-weight: bold !important;
    }
    .active a {
        color: rgb(255, 255, 255) !important;
    }
    .sidebar-dark-primary {
        background: #232946 !important;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed text-lg">
<div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


      <li class="nav-item dropdown show">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
            <i class="far fa-user"></i>
        </a>
        <div
            class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
            style="left: inherit; right: 0px;">
            <span class="dropdown-item dropdown-header">
              <img src="{{ url('gambar', [empty(Auth::user()->gambar)?'user.png':Auth::user()->gambar]) }}" width="50%" alt="">
            </span>



            <div class="dropdown-divider"></div>
            <a href="{{ url('profil', []) }}" class="dropdown-item">
                <i class="fas fa-user mr-2"></i>
                Profil
            </a>

            <div class="dropdown-divider"></div>
            <form action="{{ route('logout', []) }}" method="post">
              @csrf
              <button type="submit" class="dropdown-item dropdown-footer bg-danger">LOGOUT</button>
            </form>
        </div>
    </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard', []) }}" class="brand-link text-center">
        <img src="{{ url('gambar/logo', ['logo.png']) }}" width="80%" alt="">
        <p><b>VANSESCO BOUTIQUE</b></p>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('home', []) }}" class="nav-link @yield('activehome')">
              <i class="nav-icon fas fa-home"></i>
              <p>
                HOME
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('transaksi', []) }}" class="nav-link @yield('activetransaksi')">
              <i class="nav-icon fas fa-dollar"></i>
              <p>
                TRANSAKSI
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('laporan', []) }}" class="nav-link @yield('activelaporan')">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                LAPORAN
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    {{-- <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@yield('judul')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">@yield('judul')</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div> --}}

    <section class="content pt-4">

        @yield('content')


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{date('Y')}} <a href="https://adminlte.io"></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

</div>
<!-- ./wrapper -->

@include('layouts.footer')
@include('sweetalert::alert')
@yield('myScript')
</body>
</html>
