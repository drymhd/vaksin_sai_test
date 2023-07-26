<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaskesVaksin extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = ['uuid', 'kuota', 'faskes_id', 'vaksin_id'];

    public function vaksin(){
        return $this->belongsTo(Vaksin::class, 'vaksin_id');
    }
    public function faskes(){
        return $this->belongsTo(Faskes::class, 'faskes_id');
    }
}
