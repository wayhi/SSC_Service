<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

	protected $table = 'groups';

	public function users()
	{

		return $this->belongsToMany('App\User','users_groups','group_id','user_id');
	}

}
