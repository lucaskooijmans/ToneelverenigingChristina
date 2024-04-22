<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['performance_id', 'buyer_name', 'buyer_email', 'amount', 'unique_number'];

    public function performance()
    {
        return $this->belongsTo(Performance::class);
    }
}
