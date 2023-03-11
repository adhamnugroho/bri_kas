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
                                    <a href="{{ route('kasKeluarCreate') }}" class="btn btn-primary btn-sm ml-2">
                                        Tambah Data {{ $judul }}
                                    </a>
                                </div>

                                <div class="col-md-2 col-sm-2 col-xs-12 m-b-0 ">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select name="" id="search-option"
                                                class="input-sm form-control option-search select-custom w-100">
                                                <option value="">Pilih Kolom Untuk Pencarian</option>
                                                <option value="no">No</option>
                                                <option value="jenis_pengeluaran">Jenis Pengeluaran</option>
                                                <option value="nominal">Nominal</option>
                                                <option value="tanggal_keluar">Tanggal Keluar</option>
                                                <option value="nama_penarik">Nama Penarik</option>
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


                            <table id="tabel-data-kas-keluar" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pengeluaran</th>
                                        <th>Nominal</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Nama Penarik</th>
                                        <th>Action</th>
                                        <th>id</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($kas_keluar as $key => $kk)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $kk->jenis_pengeluaran }}
                                            </td>
                                            <td>
                                                Rp. {{ $kk->nominal }}
                                            </td>
                                            <td>{{ $kk->tanggal_keluar }}</td>
                                            <td>
                                                {{ $kk->users->nama }}
                                            </td>
                                            <td>
                                                <a href="{{ route('kasKeluarShow', $kk->id_kas_keluar) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('kasKeluarEdit', $kk->id_kas_keluar) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" id="button-delete"
                                                    onclick="confirmDeleteKasKeluar()">
                                                    <i class="fa fa-trash"></i>

                                                </button>

                                            </td>
                                            <td style="display:none;">
                                                {{ $kk->id_kas_keluar }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pengeluaran</th>
                                        <th>Nominal</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Nama Penarik</th>
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
        var tabelDataKasKeluar = $("#tabel-data-kas-keluar").DataTable({

            "columnDefs": [{
                    "name": "no",
                    "targets": 0,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "jenis_pengeluaran",
                    "targets": 1,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "nominal",
                    "targets": 2,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "tanggal_keluar",
                    "targets": 3,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "nama_penarik",
                    "targets": 4,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "id_kas_keluar",
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


    {{-- Delete Data Kas Keluar --}}
    <script>
        // const Router = new Object();
        // $('#button-delete').on('click', confirmDeleteKasKeluar());


        // Konfirmasi Delete Data Kas Keluar
        function confirmDeleteKasKeluar() {

            $('#tabel-data-kas-keluar tbody').on('click', 'td', function() {

                var id_kas_keluar = tabelDataKasKeluar.cell(this, 'id_kas_keluar:name', {
                    order: 'original'
                }).data();


                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Ingin Menghapus Data Kas Keluar Ini?',
                    text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi!',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya!',
                }).then((result) => {

                    // alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('kasKeluarDelete', id_kas_keluar);


                        // console.log(hasil_route);

                        window.open(hasil_route, '_self');

                    }
                });

                // console.log(id_kas_keluar);
            });

            // console.log('berhasil');

        }
    </script>


    {{-- Search --}}
    <script>
        // Jquery untuk mencari data user
        $('#search').on('keyup', cariDatakasKeluar);

        // Jquery saat event tombol x input:search diklik
        $('#search').on('search.dt', cariDatakasKeluar);


        function cariDatakasKeluar() {

            let optionSearch = document.getElementById("search-option").value;
            let dataSearch = document.getElementById("search").value;

            // console.log(search.value);
            // console.log(optionSearch);

            let kolomSearch = tabelDataKasKeluar.columns(optionSearch + ":name")
                .search(dataSearch)
                .draw();


            if (kolomSearch.empty) {

                tabelDataUser.draw();
            }
        }
    </script>
@endsection
