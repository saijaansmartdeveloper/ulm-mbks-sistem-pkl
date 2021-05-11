<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    protected $table = 'prodi';
    protected $primaryKey  = 'uuid';
    public $incrementing = false;


    public function major()
    {
        return $this->belongsTo(Major::class, 'jurusan_uuid');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'uuid');
    }
}
