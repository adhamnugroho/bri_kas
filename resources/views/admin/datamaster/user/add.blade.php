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
                            <a href="{{ route('users') }}">{{ $judul }} Page</a>
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
                        <form method="POST" action="{{ route('usersStore') }}">

                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">
                                        Nama <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control mt-3" id="nama" name="nama"
                                        placeholder="Masukkan Nama" value="{{ old('nama') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">
                                        Username <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Masukkan Username" value="{{ old('username') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        Email <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Masukkan Email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        Password <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Masukkan Password" value="{{ old('password') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_telp">
                                        No. Telephone <sup class="text-danger">*</sup>
                                    </label>
                                    <input type="text" class="form-control" id="no_telp" name="no_telp"
                                        placeholder="Masukkan No. Telephone" value="{{ old('no_telp') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="provinsi">
                                        Provinsi <sup class="text-danger">*</sup>
                                    </label>
                                    <select name="provinsi_id" id="provinsi" class="form-control" onchange="getKabupaten()"
                                        required>
                                        <option value="">.:: Pilih Provinsi ::.</option>

                                        @foreach ($provinsi as $key => $prov)
                                            <option
                                                value="{{ old('provinsi_id') ? old('provinsi_id') : $prov->id_provinsi }}">
                                                {{ $prov->nama_provinsi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kabupaten">
                                        Kota / Kabupaten <sup class="text-danger">*</sup>
                                    </label>
                                    <select name="kabupaten_id" id="kabupaten" class="form-control" required>
                                        <option value="">.:: Pilih Kota / Kabupaten ::.</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status">
                                        Status <sup class="text-danger">*</sup>
                                    </label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="">.:: Pilih Status ::.</option>
                                        <option value=" {{ old('status') ? old('status') : 'Aktif' }} ">Aktif</option>
                                        <option value=" {{ old('status') ? old('status') : 'Non-Aktif' }} ">Non-Aktif
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_lengkap">
                                        Alamat Lengkap <sup class="text-danger">*</sup>
                                    </label>
                                    <textarea name="alamat_lengkap" id="alamat_lengkap" cols="30" rows="3" class="form-control"
                                        placeholder="Masukkan Alamat Lengkap" required>{{ old('alamat_lengkap') }}</textarea>
                                </div>


                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('users') }}" class="btn btn-warning ml-4">Kembali</a>
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


@section('script')
    <script>
        function getKabupaten() {

            var id_provinsi = $('#provinsi').val();

            console.log(id_provinsi);

            if (id_provinsi) {


                $.post("{{ route('usersGetKabupaten') }}", {
                    id_provinsi: id_provinsi
                }).done((data) => {

                    // alert(data.status);

                    if (data.status == 'success') {

                        var html = `<option value="">.:: Pilih Kota / Kabupaten ::.</option>`

                        data.data.forEach((v, i) => {

                            html +=
                                `<option value="{{ old('kabupaten_id') ? old('kabupaten_id') : '${v.id_kabupaten}' }}">${v.nama_kabupaten}</option>`
                        })


                        $('#kabupaten').html(html);
                    } else {

                        Toast.fire({
                            icon: 'error',
                            title: `${data.message}`,
                        });
                    }
                });
            } else {

                Toast.fire({
                    icon: 'error',
                    title: 'Provinsi Tidak Boleh Kosong',
                });
            }
        }
    </script>
@endsection
