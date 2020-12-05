<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model {
	protected $table = "sub_sub_categories";
	protected $fillable = ['id', 'name', 'sub_category_id', 'brand_id', 'created_at', 'updated_at'];

	function subCategory() {
		return $this->hasOne('App\Model\SubCategory', 'id', 'sub_category_id');
	}
	function category() {
		return $this->hasOne('App\Model\Category', 'id', 'category_id');
	}
	function brands() {
		return $this->hasMany('App\Model\Brand', 'id', 'brand_id');
	}
}
