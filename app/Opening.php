<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opening extends Model
{
    protected $table = 'openings';
    protected $fillable = ['first_name', 'last_name', 'email'];
}
