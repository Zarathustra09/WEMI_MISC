<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMA extends Model
{
    use HasFactory;
    protected $table = 'tmas';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_started',
        'date_graduated',
    ];
    protected $casts = [
        'date_started' => 'date',
        'date_graduated' => 'date',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}