<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles,$bool = false)
    {
        if (is_array($roles)) {
            if ($bool) {
                return $this->hasAnyRole($roles) ? true : false;
            }
            else 
                return $this->hasAnyRole($roles) || 
                    abort(401, 'This action is unauthorized.');
        }
        if ($bool) {
            return $this->hasRole($roles) ? true : false;
        }
        else 
            return $this->hasRole($roles) || 
                abort(401, 'This action is unauthorized.');
    }

    
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
    return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
    return null !== $this->roles()->where('name', $role)->first();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'gender', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
