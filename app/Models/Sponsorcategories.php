<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sponsor;

class Sponsorcategories extends Model
{
    use HasFactory;

    protected $fillable = ['sponsorcategories', 'category_position'];

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class, 'category_id');
    }
}
