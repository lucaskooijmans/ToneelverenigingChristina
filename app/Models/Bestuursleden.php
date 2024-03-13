<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bestuursleden extends Model
{
    use HasFactory;
    protected $table = 'bestuursleden';
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'description',
        'image_url',
    ];
}
