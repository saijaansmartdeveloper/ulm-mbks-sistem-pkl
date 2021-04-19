<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;

    protected $guarded      = [];
    protected $table        = 'magang';
    protected $primaryKey   = 'uuid';
    public $incrementing    = false;

    public function jenis_kegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'jenis_kegiatan_uuid');
    }
}
