<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sponsorcategories;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'logo', 'isActive', 'category_id', 'position'];

    public function category()
    {
        return $this->belongsTo(Sponsorcategories::class, 'category_id');
    }
    
}
