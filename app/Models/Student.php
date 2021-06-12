<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;


class Student extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    public $incrementing = false;

    protected $guarded      = 'student';
    protected $table        = 'mahasiswa';
    protected $primaryKey   = 'uuid';
    protected $keyType      = 'string';

    protected $fillable = [
        'uuid', 'nim_mahasiswa', 'nama_mahasiswa', 'email', 'password', 'phone', 'prodi_uuid', 'jurusan_uuid'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getGuardNameAttribute()
    {
        return $this->guarded;
    }

    public function getStudentLinkProfileAttribute()
    {
        return '<a href="'.url('student/profile/' . $this->uuid).'"><strong>'.$this->nama_mahasiswa.'</strong></a>' ;
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'mahasiswa_uuid')->where('status_kegiatan', 1);
    }

    public function jurusan()
    {
        return $this->belongsTo(Major::class, 'jurusan_uuid');
    }

    public function prodi()
    {
        return $this->belongsTo(StudyProgram::class, 'prodi_uuid');
    }

}
