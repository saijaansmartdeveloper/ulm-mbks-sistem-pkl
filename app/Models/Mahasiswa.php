<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;


class Mahasiswa extends Authenticatable
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

    public function guardName(){
        return "student";
    }

    public function kegiatan()
    {
        return $this->hasOne(Magang::class, 'mahasiswa_uuid');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_uuid');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_uuid');
    }

}
