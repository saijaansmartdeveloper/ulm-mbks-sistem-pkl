<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public $incrementing    = false;

    protected $table        = 'kegiatan';
    protected $primaryKey   = 'uuid';

    protected $fillable = [
        'uuid',
        'mulai_kegiatan',
        'lama_kegiatan',
        'akhir_kegiatan',
        'file_sk_kegiatan',
        'status_kegiatan',
        'dosen_uuid',
        'mitra_uuid',
        'mahasiswa_uuid',
        'user_uuid',
        'jenis_kegiatan_uuid',
        'prodi_uuid',
        'jurusan_uuid'
    ];

    public function jenis_kegiatan()
    {
        return $this->belongsTo(TypeOfActivity::class, 'jenis_kegiatan_uuid');
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'kegiatan_uuid')->orderBy('updated_at', 'desc');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'mahasiswa_uuid');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'dosen_uuid');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'mitra_uuid');
    }
}
