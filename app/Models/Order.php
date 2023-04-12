<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = array('id');
    

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
