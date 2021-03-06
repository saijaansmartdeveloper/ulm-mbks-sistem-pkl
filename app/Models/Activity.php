<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded      = [];
    protected $table        = 'kegiatan';
    protected $primaryKey   = 'uuid';
    public $incrementing    = false;


    protected $fillable = [
        'uuid',
        'mulai_kegiatan',
        'lama_kegiatan',
        'akhir_kegiatan',
        'file_sk_kegiatan',
        'link_survey',
        'status_kegiatan',
        'status_kegiatan',
        'status_mitra',
        'dosen_uuid',
        'mitra_uuid',
        'mahasiswa_uuid',
        'user_uuid',
        'jenis_kegiatan_uuid',
        'prodi_uuid',
        'jurusan_uuid'
    ];

    public function typeofactivity()
    {
        return $this->belongsTo(TypeOfActivity::class, 'jenis_kegiatan_uuid');
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'kegiatan_uuid')->orderBy('updated_at', 'desc');
    }

    public function report_activities()
    {
        return $this->hasMany(ReportActivity::class, 'kegiatan_uuid')->orderBy('tanggal_laporan_activity', 'asc');
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

    public function admin_prodi()
    {
        return $this->belongsTo(User::class, 'user_uuid');
    }
}
