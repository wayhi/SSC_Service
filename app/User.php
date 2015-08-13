<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //

	protected $table = 'users';



	public function groups()
	{

		return $this->belongsToMany('App\Group','users_groups','user_id','group_id');
	}

}
