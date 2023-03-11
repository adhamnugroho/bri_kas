<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $judul = 'Users';
    protected $menu = 'data_pengguna';
    protected $sub_menu = '';
    protected $directory = 'admin.datamaster.user';


    public function index()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['users'] = Users::where('level_user', 'Pengguna')->get();


        return view($this->directory . ".main", $data);
    }


    public function create()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['provinsi'] = Provinsi::all();
        $data['kabupaten'] = Kabupaten::all();


        return view($this->directory . ".add", $data);
    }


    public function store(Request $request)
    {

        // Memasukkan request ke dalam variabel
        $nama = $request->nama;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $no_telp = $request->no_telp;
        $provinsi_id = $request->provinsi_id;
        $kabupaten_id = $request->kabupaten_id;
        $status = $request->status;
        $alamat_lengkap = $request->alamat_lengkap;


        // Pengecekan kosong tidaknya suatu variabel
        if (empty($nama)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nama Lengkap Harus Diisi');
        }

        if (empty($username)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Username Harus Diisi');
        }

        if (empty($email)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Email Harus Diisi');
        }

        if (empty($password)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Password Harus Diisi');
        }

        if (empty($no_telp)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom No. Telephone Harus Diisi');
        }

        if (empty($provinsi_id)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Provinsi Harus Dipilih');
        }

        if (empty($kabupaten_id)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Kabupaten Harus Dipilih');
        }

        if (empty($status)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Status Harus Dipilih');
        }

        if (empty($alamat_lengkap)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Alamat Lengkap Harus Diisi');
        }


        // Pengecekan ada apa tidaknya username dan email pada database
        $cek_username = Users::where('username', $username)->first();
        $cek_email = Users::where('email', $email)->first();

        if (!empty($cek_username)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Username Sudah Terdaftar Pada Sistem');
        }

        if (!empty($cek_email)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Email Sudah Terdaftar Pada Sistem');
        }


        // Menyimpan data ke database
        $users = new Users();
        $users->nama = $nama;
        $users->username = $username;
        $users->email = $email;
        $users->password = Hash::make($password);
        $users->no_telp = $no_telp;
        $users->provinsi_id = $provinsi_id;
        $users->kabupaten_id = $kabupaten_id;
        $users->status = $status;
        $users->alamat_lengkap = $alamat_lengkap;
        $users->level_user = 'Pengguna';
        $users->save();

        if ($users) {

            return redirect()->route('users')->with('status', 'success')->with('message', 'Berhasil Menyimpan Data');
        } else {

            return back()->withInput()->with('status', 'error')->with('message', 'Gagal Menyimpan Data!');
        }
    }


    public function show($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['provinsi'] = Provinsi::all();
        $data['kabupaten'] = Kabupaten::all();
        $data['users'] = Users::where('id', $id)->first();


        return view($this->directory . ".show", $data);
    }


    public function edit($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['provinsi'] = Provinsi::all();
        $data['kabupaten'] = Kabupaten::all();
        $data['users'] = Users::where('id', $id)->first();


        return view($this->directory . ".edit", $data);
    }


    public function update(Request $request, $id)
    {


        // Memasukkan request ke dalam variabel
        $nama = $request->nama;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $no_telp = $request->no_telp;
        $provinsi_id = $request->provinsi_id;
        $kabupaten_id = $request->kabupaten_id;
        $status = $request->status;
        $alamat_lengkap = $request->alamat_lengkap;


        // Pengecekan kosong tidaknya suatu variabel
        if (empty($nama)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nama Lengkap Harus Diisi');
        }

        if (empty($username)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Username Harus Diisi');
        }

        if (empty($email)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Email Harus Diisi');
        }

        // if (empty($password)) {

        //     return back()->withInput()->with('status', 'error')->with('message', 'Kolom Password Harus Diisi');
        // }

        if (empty($no_telp)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom No. Telephone Harus Diisi');
        }

        if (empty($provinsi_id)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Provinsi Harus Dipilih');
        }

        if (empty($kabupaten_id)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Kabupaten Harus Dipilih');
        }

        if (empty($status)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Status Harus Dipilih');
        }

        if (empty($alamat_lengkap)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Alamat Lengkap Harus Diisi');
        }


        // Pengecekan sama apa tidaknya username dan email pada database
        $cek_username = Users::where('username', $username)
            ->where('id', '!=', $id)
            ->first();

        $cek_email = Users::where('email', $email)
            ->where('id', '!=', $id)
            ->first();

        if (!empty($cek_username)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Username Sudah Terdaftar Pada Sistem');
        }

        if (!empty($cek_email)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Email Sudah Terdaftar Pada Sistem');
        }


        // Menyimpan data ke database
        $users = Users::where('id', $id)->first();
        $users->nama = $nama;
        $users->username = $username;
        $users->email = $email;
        if (!empty($password)) {

            $users->password = Hash::make($password);
        }
        $users->no_telp = $no_telp;
        $users->provinsi_id = $provinsi_id;
        $users->kabupaten_id = $kabupaten_id;
        $users->status = $status;
        $users->alamat_lengkap = $alamat_lengkap;
        $users->level_user = 'Pengguna';
        $users->save();

        if ($users) {

            return redirect()->route('users')->with('status', 'success')->with('message', 'Berhasil Mengubah Data');
        } else {

            return back()->withInput()->with('status', 'error')->with('message', 'Gagal Mengubah Data!');
        }
    }


    public function destroy($id) {

        $users = Users::where('id', $id)->first();

        if(!empty($users)) {

            $users->delete();

            return redirect()->route('users')->with('status', 'success')->with('message', 'Berhasil Menghapus Data');
        } else {

            return redirect()->route('users')->with('status', 'error')->with('message', 'Gagal Menghapus Data');
        }
    }

    public function getKabupaten(Request $request)
    {

        // return $request->id_provinsi;

        $kabupaten = Kabupaten::where('id_provinsi', $request->id_provinsi)->get();


        if ($kabupaten->count() > 0) {

            return ['status' => 'success', 'code' => 200, "message" => 'Berhasil Mengambil Data', 'data' => $kabupaten];
        } else {

            return ['status' => 'error', 'code' => 500, "message" => 'Gagal Mengambil Data', 'data' => $kabupaten];
        }
    }
}
