<?php

namespace App;

use App\Repositories\ReportsRepository;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Report extends Model
{
    protected $table='reports';

    protected $fillable=['user_id','title','description','itemable_id','itemable_type','status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function itemable(){
        return $this->morphTo('itemable');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

    /**
     * Created By Dara on 11/9/2015
     * generate link for each report
     */
    public function getLinkAttribute(){
        $reportRepository=new ReportsRepository();
        return $reportRepository->generateLinks($this);
    }
}
