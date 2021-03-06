<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isNull;

class Journal extends Model
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
        'kegiatan_uuid',
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
            case 'resubmit':
            case 'submit' :
                return '<i class="text-success">' . $this->status_jurnal . '</i>';
                break;
            case 'revision' :
                return '<i class="text-warning">' . $this->status_jurnal . '</i>';
                break;
            case 'rejected' :
                return '<i class="text-danger">' . $this->status_jurnal . '</i>';
                break;
            case 'accepted' :
                return '<i class="text-primary">' . $this->status_jurnal . '</i>';
                break;
            default :
                return '<i class="text-secondary">undefinied</i>';
                break;
        }
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'kegiatan_uuid')->first();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'jurnal_uuid');
    }

}
