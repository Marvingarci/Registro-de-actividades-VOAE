<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistance extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 
        'account_number',
        'email', 
        'event_id', 
        'career', 
        'image', 
        'start_asistance',
        'end_asistance',
    ];
}
