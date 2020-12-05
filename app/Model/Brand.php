<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {
	protected $table = "brands";
	protected $fillable = ['id', 'name', 'logo', 'created_at', 'updated_at'];
}
