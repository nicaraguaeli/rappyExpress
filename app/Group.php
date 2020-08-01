<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $table = "groups";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = ['nombre'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
