<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objects extends Model
{
    //
    protected $fillable = array('name', 'object', 'image', 'mtl');
}
