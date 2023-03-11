<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\KasMasuk;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasMasukController extends Controller
{
    protected $judul = 'Kas Masuk';
    protected $menu = 'kas_masuk';
    protected $sub_menu = '';
    protected $directory = 'admin.kas.kas_masuk';


    public function index()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_masuk'] = KasMasuk::with(['users'])
            ->orderBy('created_at', 'DESC')
            ->get();


        return view($this->directory . ".main", $data);
    }


    public function create()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['users'] = Users::where('level_user', 'Pengguna')->get();
        $data['kas'] = Kas::orderBy('created_at', 'DESC')->first();


        return view($this->directory . ".add", $data);
    }


    public function store(Request $request)
    {

        // return $request->all();

        // Memasukkan request ke dalam variabel
        $jenis_pemasukan = $request->jenis_pemasukan;
        $nominal = $request->nominal;
        $tanggal_masuk = $request->tanggal_masuk;
        $nama_penyetor = $request->nama_penyetor;
        $keterangan = $request->keterangan;


        // Pengecekan kosong tidaknya suatu variabel
        if (empty($jenis_pemasukan)) {

            return back()->withInput()
                ->with('status', 'error')
                ->with('message', 'Kolom Jenis Pemasukan Harus Diisi');
        }

        if (empty($nominal)) {

            return back()->withInput()
                ->with('status', 'error')
                ->with('message', 'Kolom Nominal Harus Diisi');
        }

        if (empty($tanggal_masuk)) {

            return back()->withInput()
                ->with('status', 'error')
                ->with('message', 'Kolom Tanggal Kas Harus Diisi');
        }

        if (empty($nama_penyetor)) {

            return back()->withInput()
                ->with('status', 'error')
                ->with('message', 'Kolom Nama Penyetor Harus Diisi');
        }



        // Menyimpan data ke database
        $kasMasuk = new KasMasuk();
        $kasMasuk->jenis_pemasukan = $jenis_pemasukan;
        $kasMasuk->nominal = $nominal;
        $kasMasuk->tanggal_masuk = $tanggal_masuk;
        $kasMasuk->user_id = $nama_penyetor;
        $kasMasuk->kas_id = 1;

        if (!empty($keterangan)) {

            $kasMasuk->keterangan = $keterangan;
        } else {

            $kasMasuk->keterangan = '-';
        }

        $kasMasuk->save();



        if ($kasMasuk) {

            // Menambah saldo pada tabel kas
            $kas = new Kas();

            $kasSekarang = Kas::orderBy('id_kas', 'DESC')->first();

            // return $kasSekarang->total_kas;

            $kas->total_kas = ($kasSekarang->total_kas + $nominal);

            $kas->save();


            if ($kas) {

                $kasMasuk = KasMasuk::orderBy('id_kas_masuk', 'DESC')->first();

                $kasSekarang = Kas::orderBy('id_kas', 'DESC')->first();
                $kasMasuk->kas_id = $kasSekarang->id_kas;

                // return $kasSekarang->id_kas;

                $kasMasuk->save();


                if ($kasMasuk) {

                    return redirect()->route('kasMasuk')
                        ->with('status', 'success')
                        ->with('message', 'Berhasil Menyimpan Data');
                } else {

                    return back()->withInput()
                        ->with('status', 'error')
                        ->with('message', 'Tidak dapat Menyimpan Data kas_id');
                }
            } else {

                return back()->withInput()
                    ->with('status', 'error')
                    ->with('message', 'Tidak dapat Menyimpan Data Pada Salah Satu Tabel');
            }
        } else {

            return back()->withInput()
                ->with('status', 'error')
                ->with('message', 'Gagal Menyimpan Data!');
        }
    }


    public function show($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_masuk'] = KasMasuk::with(['kas'])
            ->where('id_kas_masuk', $id)
            ->first();

        // dd($data['kas_masuk']);

        $data['users'] = Users::all();

        // return $data['kas_masuk'];


        return view($this->directory . ".show", $data);
    }


    public function edit($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_masuk'] = KasMasuk::where('id_kas_masuk', $id)
            ->first();

        $data['users'] = Users::where('level_user', 'Pengguna')->get();


        return view($this->directory . ".edit", $data);
    }


    public function update(Request $request, $id)
    {

        // return $request->all();

        // Memasukkan request ke dalam variabel
        $jenis_pemasukan = $request->jenis_pemasukan;
        $nominal = $request->nominal;
        $tanggal_masuk = $request->tanggal_masuk;
        $nama_penyetor = $request->nama_penyetor;
        $keterangan = $request->keterangan;


        // Pengecekan kosong tidaknya suatu variabel
        if (empty($jenis_pemasukan)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Jenis Pemasukan Harus Diisi');
        }

        if (empty($nominal)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nominal Harus Diisi');
        }

        if (empty($tanggal_masuk)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Tanggal Kas Harus Diisi');
        }

        if (empty($nama_penyetor)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nama Penyetor Harus Diisi');
        }



        // Menyimpan data ke database
        $kasMasuk = KasMasuk::where('id_kas_masuk', $id)->first();
        $kasMasuk->jenis_pemasukan = $jenis_pemasukan;
        $kasMasuk->tanggal_masuk = $tanggal_masuk;
        $kasMasuk->user_id = $nama_penyetor;

        if (!empty($keterangan)) {

            $kasMasuk->keterangan = $keterangan;
        } else {

            $kasMasuk->keterangan = '-';
        }


        // Pengecekan nominal
        $kasMasuk_kasId = $kasMasuk->kas_id;
        $kasMasuk_nominal = $kasMasuk->nominal;

        $kas = Kas::where('id_kas', $kasMasuk_kasId)->first();
        $kas_totalKas = $kas->total_kas;

        if ($nominal < $kasMasuk_nominal) {

            // Mengambil Nominal kurang
            $nominal_kurang = $kasMasuk_nominal - $nominal;

            // Mengurangi total_kas yang sudah ada
            $kas_totalKas_hasil = $kas_totalKas - $nominal_kurang;

            $kas->total_kas = $kas_totalKas_hasil;

            $kas->save();

            if ($kas) {

                $kas = Kas::orderBy('id_kas', 'DESC')->first();
                $kas_totalKas = $kas->total_kas;

                $kas_totalKas_hasil = $kas_totalKas - $nominal_kurang;

                $kas->total_kas = $kas_totalKas_hasil;

                $kas->save();
            }
        } else if ($nominal > $kasMasuk_nominal) {

            // Mengambil Nominal Tambah
            $nominal_tambah = $nominal - $kasMasuk_nominal;

            // Menambah total_kas yang sudah ada
            $kas_totalKas_hasil = $kas_totalKas + $nominal_tambah;

            $kas->total_kas = $kas_totalKas_hasil;

            $kas->save();


            if ($kas) {

                $kas = Kas::orderBy('id_kas', 'DESC')->first();
                $kas_totalKas = $kas->total_kas;

                $kas_totalKas_hasil = $kas_totalKas + $nominal_tambah;

                $kas->total_kas = $kas_totalKas_hasil;

                $kas->save();
            }
        }

        $kasMasuk->nominal = $nominal;


        $kasMasuk->save();


        if ($kasMasuk) {

            return redirect()->route('kasMasuk')->with('status', 'success')->with('message', 'Berhasil Mengubah Data');
        } else {

            return back()->withInput()->with('status', 'error')->with('message', 'Gagal Mengubah Data!');
        }
    }


    public function destroy($id)
    {

        $kas_masuk = KasMasuk::where('id_kas_masuk', $id)->first();
        $kasMasuk_nominal = $kas_masuk->nominal;

        if (!empty($kas_masuk)) {

            $kas_masuk->delete();

            if ($kas_masuk) {

                $kas = Kas::orderBy('id_kas', 'DESC')->first();
                $kas_totalKas = $kas->total_kas;

                $kas_totalKas_hasil = $kas_totalKas - $kasMasuk_nominal;

                $kas->total_kas = $kas_totalKas_hasil;

                $kas->save();

                if ($kas) {

                    return redirect()->route('kasMasuk')->with('status', 'success')->with('message', 'Berhasil Menghapus Data');
                } else {

                    return redirect()->route('kasMasuk')->with('status', 'error')->with('message', 'Gagal Menghapus Data');
                }
            } else {

                return redirect()->route('kasMasuk')->with('status', 'error')->with('message', 'Gagal Menghapus Data');
            }
        } else {

            return redirect()->route('kasMasuk')->with('status', 'error')->with('message', 'Data Tidak Ada');
        }
    }
}
