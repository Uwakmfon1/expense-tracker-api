<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = ['user_id','name','description','target_amount','current_amount','deadline','priority','status'];
}
