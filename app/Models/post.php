<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{   
    //do not guard anything everything is undercontrol
    protected $guarded = []; 
    public function user()
    {
        return $this->belongsTo(User::class); //one to many relationship with User model.
    }
}
