<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    use HasFactory;

    protected $table = 'kas_masuk';
    protected $primaryKey = 'id_kas_masuk';


    public function users() {

        return $this->belongsTo(Users::class, 'user_id');
    }

    public function kas()
    {

        return $this->belongsTo(Kas::class, 'kas_id');
    }
}
