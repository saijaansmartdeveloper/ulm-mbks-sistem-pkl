<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;


class Partner extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    public $incrementing = false;

    protected $guarded      = 'partner';
    protected $table        = 'mitra';
    protected $primaryKey   = 'uuid';
    protected $keyType      = 'string';


    protected $fillable = [
        'uuid',
        'nama_mitra',
        'divisi_mitra',
        'alamat_mitra',
        'penanggung_jawab_mitra',
        'pamong_mitra',
        'email_mitra',
        'email',
        'password',
        'phone'
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

    public function getPartnerLinkProfileAttribute()
    {
        return '<a href="'.url('partner/' . $this->uuid).'"><strong>'.$this->nama_mitra.'</strong></a>' ;
    }

    public function activities()
    {
        return $this->hasOne(Activity::class, 'mitra_uuid');
    }

}
