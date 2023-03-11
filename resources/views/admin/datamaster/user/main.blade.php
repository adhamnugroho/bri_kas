@extends('admin.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data {{ $judul }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $judul }} Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel {{ $judul }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">



                            {{-- <br><br><br> --}}

                            <div class="row">

                                <div class="col-lg-7 p-1 mb-n5">
                                    <a href="{{ route('usersCreate') }}" class="btn btn-primary btn-sm ml-2">
                                        Tambah Data User
                                    </a>
                                </div>

                                <div class="col-md-2 col-sm-2 col-xs-12 m-b-0 ">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select name="" id="search-option"
                                                class="input-sm form-control option-search select-custom w-100">
                                                <option value="">Pilih Kolom Untuk Pencarian</option>
                                                <option value="no">No</option>
                                                <option value="nama">Nama</option>
                                                <option value="username">Username</option>
                                                <option value="email">Email</option>
                                                <option value="status">Status</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3 col-sm-2 col-xs-12 m-b-0 ">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="search" id="search" class="input-sm form-control"
                                                placeholder="Cari Data" class="input-sm form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <table id="tabel-data-user" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>id</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $key => $us)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $us->nama }}
                                            </td>
                                            <td>
                                                {{ $us->username }}
                                            </td>
                                            <td>{{ $us->email }}</td>
                                            <td>
                                                @if ($us->status == 'Aktif')
                                                    <button class="btn btn-primary btn-md">{{ $us->status }}</button>
                                                @else
                                                    <button class="btn btn-secondary btn-md">{{ $us->status }}</button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('usersShow', $us->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('usersEdit', $us->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" id="button-delete"
                                                    onclick="confirmDeleteUser()">
                                                    <i class="fa fa-trash"></i>

                                                </button>

                                            </td>
                                            <td style="display:none;">
                                                {{ $us->id }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>id</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section('script')
    {{-- Datatable --}}
    <script>
        var tabelDataUser = $("#tabel-data-user").DataTable({

            "columnDefs": [{
                    "name": "no",
                    "targets": 0,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "nama",
                    "targets": 1,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "username",
                    "targets": 2,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "email",
                    "targets": 3,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "status",
                    "targets": 4,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "id_user",
                    "targets": 6,
                    "searchable": true,
                    "type": "html",
                    "visible": false
                }
            ],

            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": true,
            "searching": true

        }); //.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        // console.log(tabelData1);
    </script>


    {{-- Delete Data User --}}
    {{-- <script src="{{ asset('routes-js/routes.js') }}" type="text/javascript"></script> --}}

    <script>
        // const Router = new Object();
        // $('#button-delete').on('click', confirmDeleteUser());


        // Konfirmasi Delete Data User
        function confirmDeleteUser() {

            $('#tabel-data-user tbody').on('click', 'td', function() {

                var id_user = tabelDataUser.cell(this, 'id_user:name', {
                    order: 'original'
                }).data();


                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Ingin Menghapus Data User Ini?',
                    text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi!',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya!',
                }).then((result) => {

                    alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('usersDelete', id_user);


                        // console.log(hasil_route);

                        window.open(hasil_route, '_self');

                    }
                });

                console.log(id_user);
            });

            console.log('berhasil');

            


        }
    </script>


    {{-- Search --}}
    <script>
        // Jquery untuk mencari data user
        $('#search').on('keyup', cariDataUser);

        // Jquery saat event tombol x input:search diklik
        $('#search').on('search.dt', cariDataUser);


        function cariDataUser() {

            let optionSearch = document.getElementById("search-option").value;
            let dataSearch = document.getElementById("search").value;

            // console.log(search.value);
            // console.log(optionSearch);

            let kolomSearch = tabelDataUser.columns(optionSearch + ":name")
                .search(dataSearch)
                .draw();


            if (kolomSearch.empty) {

                tabelDataUser.draw();
            }
        }
    </script>
@endsection
