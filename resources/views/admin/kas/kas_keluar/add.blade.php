@extends('admin.layout.app')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="ml-3">Data {{ $judul }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('kasKeluar') }}">{{ $judul }} Page</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Data {{ $judul }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-7 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah {{ $judul }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('kasKeluarStore') }}">

                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="jenis_pengeluaran">
                                        Jenis Pengeluaran <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran"
                                        placeholder="Masukkan Jenis Pengeluaran" value="{{ old('jenis_pengeluaran') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="total_kas" class="text-danger">
                                        Saldo Terakhir (Dalam Mata Uang Rupiah )
                                    </label>
                                    <input type="number" class="form-control" id="total_kas" name="total_kas"
                                        placeholder="Masukkan total_kas" value="{{ $kas->total_kas }}" required disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nominal">
                                        Nominal (Dalam Mata Uang Rupiah ) <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="number" class="form-control" id="nominal" name="nominal"
                                        placeholder="Masukkan Nominal" value="{{ old('nominal') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_keluar">
                                        Tanggal Keluar <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar"
                                        placeholder="Masukkan Tanggal Keluar" value="{{ old('tanggal_keluar') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_penarik">
                                        Nama Penarik <sup class="text-danger">*</sup>
                                    </label>
                                    <select name="nama_penarik" id="nama_penarik" class="form-control" required>
                                        <option value="">.:: Pilih Penarik ::.</option>

                                        @foreach ($users as $key => $us)
                                            <option value="{{ old('nama_penarik') ? old('nama_penarik') : $us->id }}">
                                                {{ $us->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">
                                        Keterangan <span class="text-info">(Opsional)</span>
                                    </label>
                                    <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"
                                        placeholder="Masukkan Keterangan">{{ old('keterangan') }}</textarea>
                                </div>


                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('kasKeluar') }}" class="btn btn-warning ml-4">Kembali</a>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
