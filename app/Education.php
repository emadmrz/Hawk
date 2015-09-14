<?php

namespace App;

use App\Repositories\EducationRepository;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    protected $fillable = ['user_id', 'university_id', 'degree', 'field', 'entrance_year', 'graduate_year', 'status'];
    protected $appends = ['status_name', 'degree_name'];

    public function getStatusNameAttribute(){
        $educationRepository =new EducationRepository();
        $status = $educationRepository->statuses();
        return $status[$this->attributes['status']];
    }
    public function getDegreeNameAttribute(){
        $educationRepository =new EducationRepository();
        $degree = $educationRepository->degrees();
        return $degree[$this->attributes['degree']];
    }

    public function university(){
        return $this->belongsTo('App\University');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
