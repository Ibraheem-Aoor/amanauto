<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubService extends Model
{
    use HasFactory;

    protected $fillable = ['club_id' , 'service_id'];
}
