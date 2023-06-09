<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsi';
    protected $primaryKey = 'id_provinsi';
    

    // relation one to many
    public function kabupaten() {

        return $this->hasMany(Kabupaten::class, 'id_provinsi');
    }
}
