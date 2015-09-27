<?php

namespace App;

use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Morilog\Jalali\jDate;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract
{
    use Authenticatable, CanResetPassword, HasRoleAndPermission;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'company', 'email', 'password', 'image', 'cover', 'description', 'confirmed', 'confirmation_code', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Created by Emad Mirzaie on 01/09/2015.
     * Human dates
     */
    public function getHumanCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function getHumanUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->diffForHumans();
    }

    /**
     * Created by Emad Mirzaie on 01/09/2015.
     * Shamsi Dates
     */
    public function getShamsiCreatedAtAttribute()
    {
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }
    public function getShamsiUpdatedAtAttribute()
    {
        return jDate::forge($this->attributes['updated_at'])->format('Y/m/d');
    }

    /**
     * Created by Emad Mirzaie on 01/09/2015.
     * get user role
     */
    public function getUserRoleNameAttribute(){
        return $this->roles()->first()->name;
    }

/**
 * Created by Emad Mirzaie on 01/09/2015.
 * User status and email confirmation status
 */
    public function getUserStatusAttribute(){
        $statuses=[
            0 => ['name'=>trans('users.deactiveStatus'), 'type'=>'danger'],
            1 => ['name'=>trans('users.activeStatus'), 'type'=>'success']
        ];
        return $statuses[$this->attributes['status']];
    }
    public function getUserConfirmedStatusAttribute(){
        $statuses=[
            0 => ['name'=>trans('users.notConfirmedStatus'), 'type'=>'danger'],
            1 => ['name'=>trans('users.confirmedStatus'), 'type'=>'success']
        ];
        return $statuses[$this->attributes['confirmed']];
    }

    /**
     * Created by Emad Mirzaie on 08/09/2015.
     * username and image attributes
     */

    public function getAvatarAttribute(){
        if(is_null($this->attributes['image'])){
            return 'user-default-avatar.jpg';
        }else{
            return $this->attributes['image'];
        }
    }

    public function getBannerAttribute(){
        if(is_null($this->attributes['cover'])){
            return 'default.jpg';
        }else{
            return $this->attributes['cover'];
        }
    }

    public function getUsernameAttribute(){
        if($this->hasRole(3)){
            if(!is_null($this->attributes['company']) and !empty($this->attributes['company']) ){
                return $this->attributes['company'];
            }else{
                return $this->attributes['first_name'].' '.$this->attributes['last_name'];
            }
        }else{
            return $this->attributes['first_name'].' '.$this->attributes['last_name'];
        }
    }

    public function info(){
        return $this->hasOne('App\Info');
    }

    public function location(){
        return $this->hasOne('App\Location');
    }

    public function educations(){
        return $this->hasMany('App\Education');
    }

    public function biography(){
        return $this->hasOne('App\Biography');
    }

    public function files(){
        return $this->hasMany('App\File');
    }

    public function articles(){
        return $this->hasMany('App\Article');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function skills(){
        return $this->hasMany('App\Skill');
    }

    public function recommendations(){
        return $this->hasMany('App\Recommendation');
    }

    public function endorses(){
        return $this->hasMany('App\Endorse');
    }

}
