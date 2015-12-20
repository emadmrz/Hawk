<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{
    protected $table = 'showcases';
    protected $fillable = ['user_id', 'profile_id', 'status', 'approved'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function profile(){
        return $this->belongsTo('App\User', 'profile_id', 'id');
    }

    public function payment()
    {
        return $this->morphOne('App\Payment', 'itemable');
    }

    public function getSituationAttribute(){
        $approved = $this->attributes['approved'];
        $status = $this->attributes['status'];
        if($approved == 1 and $status == 1 and $this->attributes['updated_at'] >= Carbon::now()->subMonth() ){
            return 1;
        }elseif($approved == 0 and $status == 0){
            return 0;
        }elseif($approved == 1 and $status == 0){
            return 2;
        }

    }

    public function scopeActive($query)
    {
        return $query->where('status',1)->where('status',1)->where('updated_at', '>=', Carbon::now()->subMonth());
    }
}
