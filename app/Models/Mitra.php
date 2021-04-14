<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Mitra extends Authenticatable
{
    use HasFactory, Notifiable;

    public $incrementing = false;

    public $guarded         = ['uuid'];
    protected $table        = 'mitra';
    protected $primaryKey   = 'uuid';

    protected $fillable = [
        'uuid', 'nama_mitra', 'divisi_mitra', 'alamat_mitra', 'penanggung_jawab_mitra', 'pamong_mitra', 'email', 'username', 'password', 'phone'
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
