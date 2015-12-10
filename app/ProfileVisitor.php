<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProfileVisitor extends Model
{
    protected $table = 'profile_visitor';
    protected $fillable = ['user_id', 'profile_id'];

    public function scopeLastHour($query){
        $query->where('created_at', '>=', Carbon::now()->subHour());
    }

}
