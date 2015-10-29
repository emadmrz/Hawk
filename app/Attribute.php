<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';
    protected $fillable = ['product_id', 'attribute_group_id', 'value', 'add_price'];

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function attribute_group(){
        return $this->belongsTo('App\AttributeGroup');
    }

}
