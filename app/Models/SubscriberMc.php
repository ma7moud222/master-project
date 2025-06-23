<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriberMc extends Model
{
    protected $table = 'subscribers';
    protected $fillable = ['email'];
}
