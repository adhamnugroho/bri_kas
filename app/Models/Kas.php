<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;


    protected $table = 'kas';
    protected $primaryKey = 'id_kas';


    public function kas_masuk() {

        return $this->hasMany(KasMasuk::class, 'kas_id');
    }
    
    
    public function kas_keluar() {

        return $this->hasMany(KasKeluar::class, 'kas_id');
    } 
}
