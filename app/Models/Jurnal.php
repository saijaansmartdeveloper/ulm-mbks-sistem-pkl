<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $guarded      = ['uuid'];
    protected $table        = 'jurnal';
    protected $primaryKey   = 'uuid';

    protected $fillable = [
        'uuid',
        'catatan_jurnal',
        'tanggal_jurnal',
        'magang_uuid',
        'status_jurnal',
        'komentar_jurnal',
        'tanggal_verifikasi',
        'file_image_jurnal',
        'file_dokumen_jurnal'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
