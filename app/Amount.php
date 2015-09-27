<?php

namespace App;

use App\Repositories\AmountRepository;
use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    protected $table = 'amounts';
    protected $fillable = ['skill_id', 'pricing_type', 'price' ,'price_unit', 'price_per', 'per_unit', 'description'];
    protected $appends = ['per_unit_name', 'unit_name', 'type_name'];

    public function getPerUnitNameAttribute(){
        $AmountRepository = new AmountRepository();
        $names = $AmountRepository->per_units();
        return $names[$this->attributes['per_unit']];
    }

    public function getUnitNameAttribute(){
        $AmountRepository = new AmountRepository();
        $names = $AmountRepository->units();
        return $names[$this->attributes['price_unit']];
    }

    public function getTypeNameAttribute(){
        $AmountRepository = new AmountRepository();
        $names = $AmountRepository->type();
        return $names[$this->attributes['pricing_type']];
    }

    public function getPriceValueAttribute(){
        if($this->attributes['pricing_type']==1){
            return $this->attributes['price'];
        }else{
            return $this->getTypeNameAttribute();
        }
    }
}
