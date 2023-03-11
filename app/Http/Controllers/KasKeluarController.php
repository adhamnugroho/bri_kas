<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\KasKeluar;
use App\Models\Users;
use Illuminate\Http\Request;

class KasKeluarController extends Controller
{
    protected $judul = 'Kas Keluar';
    protected $menu = 'kas_keluar';
    protected $sub_menu = '';
    protected $directory = 'admin.kas.kas_keluar';


    public function index()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_keluar'] = KasKeluar::with(['users'])
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
        $jenis_pengeluaran = $request->jenis_pengeluaran;
        $nominal = $request->nominal;
        $tanggal_keluar = $request->tanggal_keluar;
        $nama_penarik = $request->nama_penarik;
        $keterangan = $request->keterangan;


        // Pengecekan kosong tidaknya suatu variabel
        if (empty($jenis_pengeluaran)) {

            return back()->withInput()
                ->with('status', 'error')
                ->with('message', 'Kolom Jenis Pengeluaran Harus Diisi');
        }

        if (empty($nominal)) {

            return back()->withInput()
                ->with('status', 'error')
                ->with('message', 'Kolom Nominal Harus Diisi');
        }

        if (empty($tanggal_keluar)) {

            return back()->withInput()
                ->with('status', 'error')
                ->with('message', 'Kolom Tanggal Kas Harus Diisi');
        }

        if (empty($nama_penarik)) {

            return back()->withInput()
                ->with('status', 'error')
                ->with('message', 'Kolom Nama Penarik Harus Diisi');
        }



        // Menyimpan data ke database
        $kasKeluar = new KasKeluar();
        $kasKeluar->jenis_pengeluaran = $jenis_pengeluaran;
        $kasKeluar->nominal = $nominal;
        $kasKeluar->tanggal_keluar = $tanggal_keluar;
        $kasKeluar->user_id = $nama_penarik;
        $kasKeluar->kas_id = 1;

        if (!empty($keterangan)) {

            $kasKeluar->keterangan = $keterangan;
        } else {

            $kasKeluar->keterangan = '-';
        }

        $kasKeluar->save();



        if ($kasKeluar) {

            // Menambah saldo pada tabel kas
            $kas = new Kas();

            $kasSekarang = Kas::orderBy('id_kas', 'DESC')->first();

            // return $kasSekarang->total_kas;

            $kas->total_kas = ($kasSekarang->total_kas - $nominal);

            $kas->save();


            if ($kas) {

                $kasKeluar = KasKeluar::orderBy('id_kas_keluar', 'DESC')->first();

                $kasSekarang = Kas::orderBy('id_kas', 'DESC')->first();
                $kasKeluar->kas_id = $kasSekarang->id_kas;

                // return $kasSekarang->id_kas;

                $kasKeluar->save();


                if ($kasKeluar) {

                    return redirect()->route('kasKeluar')
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

        $data['kas_keluar'] = KasKeluar::with(['kas'])
            ->where('id_kas_keluar', $id)
            ->first();

        // dd($data['kas_keluar']);

        $data['users'] = Users::all();

        // return $data['kas_keluar'];


        return view($this->directory . ".show", $data);
    }


    public function edit($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_keluar'] = KasKeluar::where('id_kas_keluar', $id)
            ->first();

        $data['users'] = Users::where('level_user', 'Pengguna')->get();


        return view($this->directory . ".edit", $data);
    }


    public function update(Request $request, $id)
    {

        // return $request->all();

        // Memasukkan request ke dalam variabel
        $jenis_pengeluaran = $request->jenis_pengeluaran;
        $nominal = $request->nominal;
        $tanggal_keluar = $request->tanggal_keluar;
        $nama_penarik = $request->nama_penarik;
        $keterangan = $request->keterangan;


        // Pengecekan kosong tidaknya suatu variabel
        if (empty($jenis_pengeluaran)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Jenis Pengeluaran Harus Diisi');
        }

        if (empty($nominal)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nominal Harus Diisi');
        }

        if (empty($tanggal_keluar)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Tanggal Kas Harus Diisi');
        }

        if (empty($nama_penarik)) {

            return back()->withInput()->with('status', 'error')->with('message', 'Kolom Nama Penarik Harus Diisi');
        }



        // Menyimpan data ke database
        $kasKeluar = KasKeluar::where('id_kas_keluar', $id)->first();
        $kasKeluar->jenis_pengeluaran = $jenis_pengeluaran;
        $kasKeluar->tanggal_keluar = $tanggal_keluar;
        $kasKeluar->user_id = $nama_penarik;

        if (!empty($keterangan)) {

            $kasKeluar->keterangan = $keterangan;
        } else {

            $kasKeluar->keterangan = '-';
        }


        // Pengecekan nominal
        $kasKeluar_kasId = $kasKeluar->kas_id;
        $kasKeluar_nominal = $kasKeluar->nominal;

        $kas = Kas::where('id_kas', $kasKeluar_kasId)->first();
        $kas_totalKas = $kas->total_kas;

        if ($nominal < $kasKeluar_nominal) {

            // Mengambil Nominal kurang
            $nominal_tambah = $kasKeluar_nominal - $nominal;

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
        } else if ($nominal > $kasKeluar_nominal) {

            // Mengambil Nominal kurang
            $nominal_kurang = $nominal - $kasKeluar_nominal;

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
        }

        $kasKeluar->nominal = $nominal;


        $kasKeluar->save();


        if ($kasKeluar) {

            return redirect()->route('kasKeluar')->with('status', 'success')->with('message', 'Berhasil Mengubah Data');
        } else {

            return back()->withInput()->with('status', 'error')->with('message', 'Gagal Mengubah Data!');
        }
    }


    public function destroy($id)
    {

        $kas_keluar = KasKeluar::where('id_kas_keluar', $id)->first();
        $kasKeluar_nominal = $kas_keluar->nominal;

        if (!empty($kas_keluar)) {

            $kas_keluar->delete();

            if ($kas_keluar) {

                $kas = Kas::orderBy('id_kas', 'DESC')->first();
                $kas_totalKas = $kas->total_kas;

                $kas_totalKas_hasil = $kas_totalKas + $kasKeluar_nominal;

                $kas->total_kas = $kas_totalKas_hasil;

                $kas->save();

                if ($kas) {

                    return redirect()->route('kasKeluar')->with('status', 'success')->with('message', 'Berhasil Menghapus Data');
                } else {

                    return redirect()->route('kasKeluar')->with('status', 'error')->with('message', 'Gagal Mengupdate Data');
                }
            } else {

                return redirect()->route('kasKeluar')->with('status', 'error')->with('message', 'Gagal Menghapus Data');
            }
        } else {

            return redirect()->route('kasKeluar')->with('status', 'error')->with('message', 'Data Tidak Ada');
        }
    }
}
