<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baptism extends Model
{
    use HasFactory;

    protected $table = 'baptism';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_baptised',
    ];

    protected $casts = [
        'date_baptised' => 'date',
    ];
}
