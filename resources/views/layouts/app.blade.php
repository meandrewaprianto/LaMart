<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | LaMart</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css') }}"/>

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}" />
    
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- NavBar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-widget="pushmenu" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('images/'. Auth::user()->foto) }}" class="user-image img-circle elevation-2" alt="User Image"/>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <li class="user-header bg-primary">
                        <img src="{{ asset('images/'. Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image"/>
                        <p>
                            {{ Auth::user()->name }} - 
                            @if(Auth::user()->level == 1)
                                Admin
                            @else
                                Kasir
                            @endif
                            | LaMart
                        </p>
                        <small>Member since July, 2023</small>
                    </li>
                    <!-- Menu Footer -->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right">Sign out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            </ul>
        </nav>
   

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="{{ asset('images/logo.png') }}" alt="LaMart Logo" class="brand-image img-circle elevation-3" style="opacity: 1.0">
                <span class="brand-text font-weight-light">LaMart</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- sidebar menu -->
                <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('/')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    @if (Auth::user()->level == 1)
                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('kategori')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-cube"></i>
                            <p>Kategori</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('produk')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-cubes"></i>
                            <p>Produk</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('member')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>Member</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('supplier')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>Supplier</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('pengeluaran')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-money-check-alt"></i>
                            <p>Pengeluaran</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('user')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>User</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('penjualan')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>Penjualan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('pembelian')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-download"></i>
                            <p>Pembelian</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('laporan')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Laporan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('setting')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Setting</p>
                        </a>
                    </li>

                    @else
                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('transaksi')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Transaksi</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="{{ (request()->is('transaksiBaru')) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>Transaksi Baru</p>
                        </a>
                    </li>
                    @endif
                </ul>
                </nav>
            </div>
        </aside>

        <!-- Content wrapper. contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @section('breadcrumb')
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                @show
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                @yield('content')
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="#">LaMart</a>.</strong>
            All rights reserved. By Andrew Aprianto
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b>1.0.0
            </div>
        </footer>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
