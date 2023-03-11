<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- FavIcon --}}
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('template-admin/dist/img/favicon-package/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('template-admin/dist/img/favicon-package/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('template-admin/dist/img/favicon-package/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('template-admin/dist/img/favicon-package/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('template-admin/dist/img/favicon-package/safari-pinned-tab.svg') }}"
        color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    {{-- Title --}}
    <title>BRIKAS | {{ $judul }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Toast --}}
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/toastr/toastr.min.css') }}" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template-admin/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>BRI</b>KAS</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body text-center">
                <img src="{{ asset('template-admin/dist/img/bri-logo-225x225.jpg') }}" alt="" class="rounded">

                <form action="{{ route('postLogin') }}" method="get" class="mt-4">

                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('template-admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script
        src="{{ asset('template-admin/plugins/bootstrap/js/bootstrap.bundle.min.jsplugins/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template-admin/dist/js/adminlte.min.js') }}"></script>
    {{-- Toastr --}}
    <script src="{{ asset('template-admin/plugins/toastr/toastr.min.js') }}"></script>
    {{-- Sweetalert 2 --}}
    <script src="{{ asset('template-admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>


    <script>
        $.ajaxSetup({

            headers: {

                'X-CSRF': $('meta[name="crsf-token"]').attr('content')
            }
        });


        // Template Toast dengan Sweet Alert
        // Template harus didefinisikan terlebih dahulu, sebelum menggunakan template
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });


        @if (Session::has('status'))
            @if (Session::get('status') == 'success')

                Toast.fire({

                    icon: '{{ Session::get('status') }}',
                    title: '{{ Session::get('message') }}',
                })
            @else
                Toast.fire({

                    icon: '{{ Session::get('status') }}',
                    title: '{{ Session::get('message') }}',
                })
            @endif
        @endif
    </script>

</body>

</html>
