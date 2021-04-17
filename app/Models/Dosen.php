<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Dosen extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    public $incrementing = false;
    protected $guard        = 'lecturer';
    protected $guarded      = ['uuid'];
    protected $table        = 'dosen';
    protected $primaryKey   = 'uuid';

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
}
