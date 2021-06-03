<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'judul_pengumuman',
        'content_pengumuman',
        'jenis_pengumuman',
        'status_pengumuman',
        'tanggal_pengumuman',
        'prodi_uuid',
        'jurusan_uuid',
        'user_uuid'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid')->first();
    }

    public function prodi()
    {
        return $this->belongsTo(StudyProgram::class, 'prodi_uuid')->first();
    }

    public function jurusan()
    {
        return $this->belongsTo(Major::class, 'jurusan_uuid')->first();
    }


}
