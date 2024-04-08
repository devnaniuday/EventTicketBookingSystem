<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = ['name', 'venue', 'date', 'time', 'price', 'quantity', 'about', 'image', 'organizer_id'];
    use SoftDeletes;

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
    public function order()
    {
        return $this->hasMany(Cart::class);
    }
}
