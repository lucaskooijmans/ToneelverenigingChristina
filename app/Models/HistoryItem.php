<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryItem extends Model
{
    protected $fillable = ['header', 'optional_text_one', 'image_path', 'optional_text_two', 'optional_footer', 'date', 'milestone', 'contribution'];
    protected $table = 'history_item';
    use HasFactory;
}
