<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dedication extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'father_name',
        'mother_name',
        'date_dedicated',
        'user_id',
        // Add other fillable fields here
    ];

    protected $casts = [
        'date_dedicated' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
