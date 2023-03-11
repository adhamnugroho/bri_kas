<?php

namespace App\Http\Controllers;

use App\Models\KasMasuk;
use Illuminate\Http\Request;

class LaporanKasMasukController extends Controller
{
    protected $judul = 'Laporan Kas Masuk';
    protected $menu = 'laporan_rekapitulasi';
    protected $sub_menu = 'laporan_kas_masuk';
    protected $direktori = 'admin.laporan_rekapitulasi.laporan_kas_masuk';

    public function index(Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;


        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {

            $data['laporan_kas_masuk'] = KasMasuk::with(['users'])
                ->whereBetween('tanggal_masuk', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();
        } else {

            $data['laporan_kas_masuk'] = KasMasuk::with(['users'])
                ->orderBy('created_at', 'DESC')
                ->get();
        }


        return view($this->direktori . ".main", $data);
    }


    public function print(Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;


        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {

            $data['laporan_kas_masuk'] = KasMasuk::with(['users'])
                ->whereBetween('tanggal_masuk', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();
        } else {

            $data['laporan_kas_masuk'] = KasMasuk::with(['users'])
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        $data['tanggal_awal'] = $request->tanggal_awal;
        $data['tanggal_akhir'] = $request->tanggal_awal;


        return view($this->direktori . ".print", $data);
    }
}
