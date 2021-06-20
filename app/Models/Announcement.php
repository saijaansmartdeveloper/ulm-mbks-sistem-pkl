<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function show_announcement($jurusan = null, $prodi = null)
    {
        if ($jurusan == null && $prodi == null) {
            return $this->paginate(1);
        } else {
            if ($jurusan == null) {
                if ($prodi != null) {
                    return DB::table('pengumuman')
                        ->whereRaw('jurusan_uuid is null OR jurusan_uuid = ? and prodi_uuid = ?', [$jurusan, $prodi])
                        ->paginate(1);
                }
            } else {
                if ($prodi == null) {
                    return DB::table('pengumuman')
                        ->whereRaw('jurusan_uuid is null OR jurusan_uuid = ?', [$jurusan])
                        ->paginate(1);
                } else {
                    return DB::table('pengumuman')
                        ->whereRaw('jurusan_uuid is null OR jurusan_uuid = ? and prodi_uuid = ?', [$jurusan, $prodi])
                        ->paginate(1);
                }
            }
        }
    }


}
