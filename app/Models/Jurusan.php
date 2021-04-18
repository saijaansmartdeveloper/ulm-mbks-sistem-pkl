<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $primaryKey  = 'uuid';
    public $incrementing = false;

    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'uuid');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'uuid');
    }
}
