<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Mahasiswa extends Authenticatable
{
    use HasFactory, Notifiable;

    public $incrementing = false;

    public $guarded         = ['uuid'];
    protected $table        = 'mahasiswa';
    protected $primaryKey   = 'uuid';

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
}
