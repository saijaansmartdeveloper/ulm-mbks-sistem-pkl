<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Lecturer extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    public $incrementing = false;

    protected $guarded      = 'lecturer';
    protected $table        = 'dosen';
    protected $primaryKey   = 'uuid';
    protected $keyType      = 'string';


    protected $fillable = [
        'uuid', 'nip_dosen', 'nama_dosen', 'email', 'password', 'prodi_uuid', 'jurusan_uuid'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getLecturerLinkProfileAttribute()
    {
        return '<a href="'.url('lecturer/' . $this->uuid).'"><strong>'.$this->nama_dosen.'</strong></a>' ;
    }

    public function prodi()
    {
        return $this->belongsTo(StudyProgram::class, 'prodi_uuid');
    }

    public function jurusan()
    {
        return $this->belongsTo(Major::class, 'jurusan_uuid');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'dosen_uuid');
    }

    public function monev()
    {
        return $this->hasMany(Monev::class, 'dosen_uuid');
    }

    public function getGuardNameAttribute()
    {
        return $this->guarded;
    }
}
