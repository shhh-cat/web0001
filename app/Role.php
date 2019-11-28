<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	public function permissions()
    {
    	return $this->belongsToMany('App\Permission');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    protected $fillable = [
        'name', 'description',
    ];
}
