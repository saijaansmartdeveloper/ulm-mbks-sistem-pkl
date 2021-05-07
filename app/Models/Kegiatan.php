<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $guarded      = [];
    protected $table        = 'kegiatan';
    protected $primaryKey   = 'uuid';
    public $incrementing    = false;

    public function jenis_kegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'jenis_kegiatan_uuid');
    }

    public function journals()
    {
        return $this->hasMany(Jurnal::class, 'magang_uuid')->orderBy('updated_at', 'desc')->take(3);
    }

    public function student()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_uuid');
    }

    public function lecturer()
    {
        return $this->belongsTo(Dosen::class, 'dosen_uuid');
    }

    public function partner()
    {
        return $this->belongsTo(Mitra::class, 'mitra_uuid');
    }
}
