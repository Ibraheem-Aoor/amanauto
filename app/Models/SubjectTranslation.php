<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'locale',
        'subject_id',
    ];
}
