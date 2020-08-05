<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $table = "orders";
    protected $primaryKey = "id";

    protected $fillable = ['product_id','customer_id','nombre','precio','presentacion','imagen','cantidad','confirmado','enviado'];
}
