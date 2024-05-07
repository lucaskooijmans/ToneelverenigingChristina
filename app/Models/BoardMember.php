<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    use HasFactory;
    protected $table = 'boardmembers';
    protected $fillable = ['id', 'name', 'email', 'phone', 'description', 'image_url'];

}
 