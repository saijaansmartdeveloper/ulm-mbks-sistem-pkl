<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportActivity extends Model
{
    use HasFactory;

    public $incrementing    = 'false';

    protected $table        = 'laporan_activity';
    protected $primaryKey   = 'uuid';
    protected $keyType      = 'string';

    protected $fillable = [
        'uuid',
        'judul_laporan_activity',
        'catatan_laporan_activity',
        'tanggal_laporan_activity',
        'file_laporan_activity',
        'jenis_laporan',
        'kegiatan_uuid',
        'dosen_uuid',
        'prodi_uuid',
        'jurusan_uuid'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'kegiatan_uuid');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'dosen_uuid');
    }
}
