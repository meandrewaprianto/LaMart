<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>LaMart | Log in</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css') }}"/>

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}"/>

        <style>
            /* Remove default border, added new one */
            .form-control {
                border-right: 1px solid #ccc !important;
            }
        </style>
    </head>
    <body class="hold-transition login-page">
        <!-- login-box -->
        <div class="login-box">
            <div class="login-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo LaMart" width="150" />
            </div>
            
            <!-- card -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Login untuk menggunakan aplikasi</p>

                    <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus />

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" required />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-cog"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ./card -->
        </div>
        <!-- ./login-box -->
        
        <!-- jQuery -->
        <script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
        <!-- jquery-validation -->
        <script src="{{ asset('adminLTE/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('adminLTE/plugins/jquery-validation/additional-methods.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script>

    </body>
</html>