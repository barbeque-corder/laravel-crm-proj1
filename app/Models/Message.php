<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function messagable()
    {
        return $this->morphTo('messagable');
    }
    public function getCreatedAtHumanizedAttribute()
    {
        return date('h:m:s, F d, Y', strtotime($this->created_at)); 
    }
    public function scopeFilter()
    {
        
    }
}
