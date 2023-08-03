<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credencial extends Model
{
    use HasFactory;

    public $table = 'credenciales';

    protected $fillable = [
        'brand',
        'client_id',
        'secret_id',
    ];

    protected $visible = [
        'brand',
        'client_id',
        'secret_id',
    ];
}
