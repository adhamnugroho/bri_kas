<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\KasKeluar;
use App\Models\KasMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $judul = 'Dashboard';
    protected $menu = 'dashboard';
    protected $sub_menu = '';
    protected $direktori = 'admin.dashboard';


    public function main(Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_masuk'] = KasMasuk::all()->sum('nominal');
        $data['kas_keluar'] = KasKeluar::all()->sum('nominal');

        $kas = Kas::orderBy('id_kas', 'DESC')->first();
        $data['kas'] = $kas->total_kas;
        

        return view($this->direktori . '.main', $data);
    }
}
