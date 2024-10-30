<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    // set fillable that was set up on the migration
    protected $fillable = [
        'exercise',
        'sets',
        'reps',
        'weight',
        'category',
    ];
}
