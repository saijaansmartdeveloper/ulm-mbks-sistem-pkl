<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isNull;

class Jurnal extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $guarded      = ['uuid'];
    protected $table        = 'jurnal';
    protected $primaryKey   = 'uuid';

    protected $fillable = [
        'uuid',
        'catatan_jurnal',
        'tanggal_jurnal',
        'magang_uuid',
        'status_jurnal',
        'komentar_jurnal',
        'tanggal_verifikasi',
        'file_image_jurnal',
        'file_dokumen_jurnal'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    function getStatusJurnalWithLabelAttribute()
    {
        switch ($this->status_jurnal) {
            case 'submit' || 'resubmit' :
                return '<i class="text-success">' . $this->status_jurnal . '</i>';
            case 'revision' :
                return '<i class="text-warning">' . $this->status_jurnal . '</i>';
            case 'rejected' :
                return '<i class="text-danger">' . $this->status_jurnal . '</i>';
            case 'accepted' :
                return '<i class="text-primary">' . $this->status_jurnal . '</i>';
            default :
                return '<i class="text-secondary">undefinied</i>';

        }
    }

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'magang_uuid');
    }
}
