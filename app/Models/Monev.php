<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monev extends Model
{
    use HasFactory;

    public $incrementing    = 'false';

    protected $table        = 'laporan_monev';
    protected $primaryKey   = 'uuid';
    protected $keyType      = 'string';

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'kegiatan_uuid');
    }
}
