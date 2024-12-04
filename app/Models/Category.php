<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable= [
      'id',
      'user_id',
      'parent_category_id',
      'name',
      'type',
      'image_url',
      'description',
    ];
    protected $guarded =[];
}
