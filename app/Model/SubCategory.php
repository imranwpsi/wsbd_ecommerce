<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model {
	protected $table = "sub_categories";
	protected $fillable = ['id', 'name', 'banner', 'category_id', 'brand_id', 'created_at', 'updated_at'];

	function category() {
		return $this->hasOne('App\Model\Category', 'id', 'category_id');
	}
	function brands() {
		return $this->hasMany('App\Model\Brand', 'id', 'brand_id');
	}
}
