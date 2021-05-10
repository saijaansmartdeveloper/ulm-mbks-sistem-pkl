<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monev extends Model
{
    use HasFactory;

    protected $table        = 'monev';
    protected $primaryKey   = 'uuid';
    public $incrementing    = 'false';
    protected $keyType      = 'string';

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'kegiatan_uuid');
    }
}
