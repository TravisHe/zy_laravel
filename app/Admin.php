<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'job_title', 'is_active', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function job() {
      return $this->belongsTo('App\JobTitle', 'job_title');
    }

    /**
     * To check the logged in accout is actived or not
     */
    public function isActive(){
      if($this->is_active == 1){
        return true;
      }
        return false;
    }

    /**
     * send the password reset notification.
     *
     * @param string $token
     * @return void
     */
     public function sendPasswordResetNotification($token)
     {
        $this->notify(new AdminResetPasswordNotification($token));
     }

}
