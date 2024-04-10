<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'logo', 'isActive', 'category_id'];

    public function category()
    {
        return $this->belongsTo('sponsorcategories', 'category_id');
    }
    
}
