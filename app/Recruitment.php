<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Morilog\Jalali\jDate;

class Recruitment extends Model
{
    use SearchableTrait;
    protected $table = 'recruitments';

    protected $fillable = [
        'status', 'user_id', 'active',
        'group_title', 'job_title', 'job_description', 'job_condition', 'job_office',
        'job_responsibility', 'job_certification', 'category_id',
        'image', 'job_style', 'tags_list'
    ];

    protected $searchable = [
        'columns' => [
            'job_title' => 10,
            'job_description' => 10,

        ]
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function payment()
    {
        return $this->morphOne('App\Payment', 'itemable');
    }

    public function getShamsiExpiredAtAttribute()
    {
        $created_at = $this->attributes['created_at'];
        $expired_at = Carbon::parse($created_at)->addMonth();
        return jDate::forge($expired_at)->format('Y/m/d');
    }

    public function getExpiredAtAttribute()
    {
        $created_at = $this->attributes['created_at'];
        $expired_at = Carbon::parse($created_at)->addMonth();
        return $expired_at;
    }

    public function getShamsiCreatedAtAttribute()
    {
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function questions()
    {
        return $this->belongsToMany('App\RecruitmentQuestionnaire', 'question_recruitment', 'recruitment_id', 'question_id')->withTimestamps();
    }

    public function requesters()
    {
        return $this->hasMany('App\RecruitmentRequester');
    }

    public function scopeValid($query)
    {
        $created_at = $this->created_at;
        $expired_at = Carbon::parse($created_at)->subMonth(1);
        $query->where('created_at', '>=', $expired_at);
    }
}
