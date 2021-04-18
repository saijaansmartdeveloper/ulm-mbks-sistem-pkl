<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';
    protected $primaryKey  = 'uuid';
    public $incrementing = false;
    

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_uuid');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'uuid');
    }
}
