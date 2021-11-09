<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    //protected $primaryKey = 'locationID';
    protected $keyType = 'string';
    protected $fillable = ['id', 'event_name', 'description', 'release_date', 'start_hour', 'end_hour', 'status'];

}
