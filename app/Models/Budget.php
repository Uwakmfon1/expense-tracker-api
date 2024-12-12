<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['category_id','user_id','name','amount','start_date','end_date'];

}
