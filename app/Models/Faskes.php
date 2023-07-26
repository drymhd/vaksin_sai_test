<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faskes extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = ['uuid', 'nm_faskes', 'kota_id', 'type', 'telepon', 'alamat'];


    public function kota(){
        return $this->belongsTo(Kota::class);
    }

    public function kuota(){
        return $this->hasMany(FaskesVaksin::class, 'faskes_id', 'id');
    }
}
