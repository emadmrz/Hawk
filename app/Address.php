<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $tabel = 'addresses';
    protected $fillable = ['user_id', 'address'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
