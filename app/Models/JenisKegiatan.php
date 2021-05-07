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

    protected $fillable = ['kode_jenis_kegiatan', 'nama_kampus_mengajar', 'deskripsi_kampus_mengajar'];

    public function magang()
    {
        return $this->hasMany(Kegiatan::class, 'uuid');
    }
}
