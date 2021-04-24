<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monev extends Model
{
    use HasFactory;

    protected $table = 'monev';
    protected $primaryKey = 'uuid';
    public $incrementing = 'false';
}