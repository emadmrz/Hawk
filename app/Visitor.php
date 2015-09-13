<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';
    protected $fillable=['ip','browser','position'];
    public function scopeDaily($query){
        $query->whereBetween('created_at', [Carbon::now()->subDay(), Carbon::now()]);
    }
    public function scopeMonthly($query){
        $query->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()]);
    }
    public function scopeWeekly($query){
        $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
    }
    public function scopeYearly($query){
        $query->whereBetween('created_at', [Carbon::now()->subYear(), Carbon::now()]);
    }
}