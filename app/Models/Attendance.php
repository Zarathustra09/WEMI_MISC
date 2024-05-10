<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;


    protected $table = 'attendance';
    protected $fillable = ['date_attended', 'user_id'];

    protected $casts = [
        'date_attended' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
