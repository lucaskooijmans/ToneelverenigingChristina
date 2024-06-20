<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'starttime',
        'endtime',
        'image',
        'location',
        'available_seats',
        'tickets_remaining',
        'tickets_sold',
        'tickets_added',
        'tickets_removed',
        'price',
    ];
    protected $table = 'performances';

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
}
