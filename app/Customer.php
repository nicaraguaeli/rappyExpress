<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = "customers";
    protected $primaryKey = "id";

    protected $fillable = ['nombre','direccion','telefono'];

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}
