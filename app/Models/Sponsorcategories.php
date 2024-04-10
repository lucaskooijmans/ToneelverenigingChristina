<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorcategories extends Model
{
    use HasFactory;

    protected $fillable = ['sponsorcategories'];

    public function sponsors()
    {
        return $this->hasMany('sponsor', 'category_id');
    }
}
