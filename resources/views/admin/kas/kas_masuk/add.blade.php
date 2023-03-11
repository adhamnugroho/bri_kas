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
                            <a href="{{ route('kasMasuk') }}">{{ $judul }} Page</a>
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
                        <form method="POST" action="{{ route('kasMasukStore') }}">

                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="jenis_pemasukan">
                                        Jenis Pemasukan <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control" id="jenis_pemasukan" name="jenis_pemasukan"
                                        placeholder="Masukkan Jenis Pemasukan" value="{{ old('jenis_pemasukan') }}"
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
                                    <label for="tanggal_masuk">
                                        Tanggal Masuk <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk"
                                        placeholder="Masukkan Tanggal Masuk" value="{{ old('tanggal_masuk') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_penyetor">
                                        Nama Penyetor <sup class="text-danger">*</sup>
                                    </label>
                                    <select name="nama_penyetor" id="nama_penyetor" class="form-control" required>
                                        <option value="">.:: Pilih Penyetor ::.</option>

                                        @foreach ($users as $key => $us)
                                            <option value="{{ old('nama_penyetor') ? old('nama_penyetor') : $us->id }}">
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
                                    <a href="{{ route('kasMasuk') }}" class="btn btn-warning ml-4">Kembali</a>
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
