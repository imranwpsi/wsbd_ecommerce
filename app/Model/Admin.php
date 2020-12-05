<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable {
	use Notifiable;

	protected $guard = 'admin';

	protected $fillable = [
		'name', 'email', 'username', 'password', 'email_verfied_at',
	];

	protected $hidden = ['password'];
}