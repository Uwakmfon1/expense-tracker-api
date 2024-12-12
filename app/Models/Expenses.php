<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $fillable = ['category_id', 'user_id','name',
        'type','amount','start_date','end_date','description'];

}
