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

                            <div class="row justify-content-end">

                                <div class="col-sm-2 text-center pt-sm-1">
                                    Range Tanggal
                                </div>

                                <div class="col-md-3">

                                    <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal"
                                        value="{{ isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : date('Y-m-d') }}">
                                </div>

                                <div class="col-0">
                                    -
                                </div>

                                <div class="col-md-3">

                                    <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir"
                                        value="{{ isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : date('Y-m-d') }}">
                                </div>

                                <button type="submit" class="btn btn-primary ml-3 col-sm-1" onclick="cariDataKasKeluar()"
                                    id="tombol_cari">

                                    <i class="fa fa-search"></i>
                                    Cari
                                </button>

                            </div>

                            <div class="row justify-content-end mt-lg-3 mb-n2">
                                <button class="btn btn-warning" onclick="print()">
                                    <i class="fa fa-print"></i>
                                    Print
                                </button>
                            </div>


                            <table id="tabel-data-kas-keluar" class="table table-hovered text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pengeluaran</th>
                                        <th>Nominal</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Nama Penarik</th>
                                        <th>Keterangan</th>
                                        <th>id</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($laporan_kas_keluar as $key => $lkk)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                {{ $lkk->jenis_pengeluaran }}
                                            </td>
                                            <td>
                                                Rp. {{ $lkk->nominal }}
                                            </td>
                                            <td>{{ $lkk->tanggal_keluar }}</td>
                                            <td>
                                                {{ $lkk->users->nama }}
                                            </td>
                                            <td>
                                                {{ $lkk->keterangan }}
                                            </td>
                                            <td style="display:none;">
                                                {{ $lkk->id_kas_keluar }}
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
                                        <th>Keterangan</th>
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


    {{-- Search --}}
    <script>
        // // Jquery untuk mencari data user
        // $('#search').on('keyup', cariDataKasKeluar);

        // // Jquery saat event tombol x input:search diklik
        // $('#search').on('search.dt', cariDataKasKeluar);


        function cariDataKasKeluar() {

            let tanggal_awal = document.getElementById("tanggal_awal").value;
            let tanggal_akhir = document.getElementById("tanggal_akhir").value;

            // console.log(search.value);
            // console.log(optionSearch);


            const hasil_route = route('laporanKasKeluar', {
                tanggal_awal,
                tanggal_akhir
            });


            // console.log(hasil_route);

            window.open(hasil_route, '_self');
        }
    </script>


    {{-- Print --}}
    <script>
        function print() {
            let tanggal_awal = document.getElementById("tanggal_awal").value;
            let tanggal_akhir = document.getElementById("tanggal_akhir").value;

            const hasil_route = route('laporanKasKeluarPrint', {
                tanggal_awal,
                tanggal_akhir
            });

            // console.log(hasil_route);

            window.open(hasil_route, '_blank');
        }
    </script>
@endsection
