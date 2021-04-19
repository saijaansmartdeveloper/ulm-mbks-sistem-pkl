<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKegiatan extends Model
{
    use HasFactory;

    protected $table        = 'jenis_kegiatan';
    protected $primaryKey   = 'uuid';
    public $incrementing    = false;

    public function magang()
    {
        return $this->hasMany(Magang::class, 'uuid');
    }
}
