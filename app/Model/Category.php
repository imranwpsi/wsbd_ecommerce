<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	protected $table = "categories";
	protected $fillable = ['id', 'name', 'banner', 'icon', 'featured', 'created_at', 'updated_at'];

	function categoryName() {
		return $this->hasOne('App\Model\Category', 'id', 'parent_id');
	}
}
