<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products";
    protected $primaryKey = "id";
    protected $fillable = ['nombre','cantidad','presentacion','precio','category_id'];

}
