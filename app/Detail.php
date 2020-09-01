<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    //
    protected $table = "orders_products";
    protected $primaryKey = "id";

    protected $fillable = ['order_id','product_id','precio','cantidad'];
}
