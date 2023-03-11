<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasKeluar extends Model
{
    use HasFactory;

    protected $table = 'kas_keluar';
    protected $primaryKey = 'id_kas_keluar';


    public function kas()
    {

        return $this->belongsTo(Kas::class, 'kas_id');
    }

    public function users()
    {

        return $this->belongsTo(Users::class, 'user_id');
    }
}
