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
    {{-- <title>Brikas | </title> --}}
    <title>Brikas | {{ $judul }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=" {{ asset('template-admin/plugins/fontawesome-free/css/all.min.css') }} ">
    {{-- Toast --}}
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/toastr/toastr.min.css') }}" />
    {{-- DataTables --}}
    <link rel="stylesheet"
        href="{{ asset('template-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template-admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template-admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="{{ asset('template-admin/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template-admin/dist/css/adminlte.min.css') }}">

    @routes

</head>

<body class="hold-transition sidebar-mini .dark-mode">
    
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.layout.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.layout.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        {{-- Footer --}}
        @include('admin.layout.footer')


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('template-admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template-admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables & Plugins -->
    <script src="{{ asset('template-admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template-admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template-admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('template-admin/dist/js/demo.js') }}"></script>
    {{-- Toasttr --}}
    <script src="{{ asset('template-admin/plugins/toastr/toastr.min.js') }}"></script>
    {{-- Sweetalert 2 --}}
    <script src="{{ asset('template-admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // Template Toast dengan Sweet Alert
        // Template harus didefinisikan terlebih dahulu, sebelum menggunakan template
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3700,
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


    {{-- Datatable --}}
    <script>
        $(function() {

            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>


    <script>
        // Logout
        function logout() {

            swal.fire({

                icon: 'warning',
                title: 'Apakah Anda Yakin Ingin Logout?',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Yakin!',
            }).then((result) => {

                if (result.value) {

                    window.location.replace("{{ route('logout') }}");
                }
            });
        }
    </script>


    @yield('script')

</body>

</html>
