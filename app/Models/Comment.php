<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $incrementing    = false;
    protected $guarded      = ['uuid'];
    protected $table        = 'komentar_jurnal';
    protected $primaryKey   = 'uuid';

    protected $fillable = [
        'uuid',
        'komentar_jurnal',
        'status_updated',
        'jurnal_uuid',
        'dosen_uuid'
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'dosen_uuid');
    }
}
