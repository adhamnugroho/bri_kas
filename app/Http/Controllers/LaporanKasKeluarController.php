<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use Illuminate\Http\Request;

class LaporanKasKeluarController extends Controller
{
    protected $judul = 'Laporan Kas Keluar';
    protected $menu = 'laporan_rekapitulasi';
    protected $sub_menu = 'laporan_kas_keluar';
    protected $direktori = 'admin.laporan_rekapitulasi.laporan_kas_keluar';


    public function index(Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;


        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {

            $data['laporan_kas_keluar'] = KasKeluar::with(['users'])
                ->whereBetween('tanggal_keluar', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();
        } else {

            $data['laporan_kas_keluar'] = KasKeluar::with(['users'])
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

            $data['laporan_kas_keluar'] = KasKeluar::with(['users'])
                ->whereBetween('tanggal_keluar', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();
        } else {

            $data['laporan_kas_keluar'] = KasKeluar::with(['users'])
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        $data['tanggal_awal'] = $request->tanggal_awal;
        $data['tanggal_akhir'] = $request->tanggal_awal;


        return view($this->direktori . ".print", $data);
    }
}
