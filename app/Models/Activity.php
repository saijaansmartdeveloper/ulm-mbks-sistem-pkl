<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public $incrementing    = false;

    protected $table        = 'kegiatan';
    protected $primaryKey   = 'uuid';

    public function jenis_kegiatan()
    {
        return $this->belongsTo(TypeOfActivity::class, 'jenis_kegiatan_uuid');
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'kegiatan_uuid')->orderBy('updated_at', 'desc')->take(3);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'mahasiswa_uuid');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'dosen_uuid');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'mitra_uuid');
    }
}
