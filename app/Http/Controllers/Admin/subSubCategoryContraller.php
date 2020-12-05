<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\SubSubCategory;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;
use App\Model\SubCategory;
use App\Model\Brand;

class subSubCategoryContraller extends Controller {

	use CommonTrait;

	public function index() {

		$categories = SubSubCategory::with('category','brands','subCategory')->orderBy('id', 'desc')->get();
		$brandArr = [];
		foreach ($categories as $key => $value) {
			$brandArr[$key] = json_decode($value->brand_id);
		}
		$brands = Brand::pluck('name', 'id')->toArray();
		return view('admin.subSubCategory.index', compact('categories'));
	}

	public function create() {

		$category = SubCategory::orderBy('name','asc')->get();
		$brands = Brand::orderBy('name','asc')->get();
		return view('admin/subSubCategory/addEdit',compact('category','brands'));
	}

	public function store(Request $request) {
		$request->validate([
			'name' => 'required|unique:categories',
		]);

		SubSubCategory::create($request->all());

		return back()->with('flash_message_success', __('label.sub_category_has_been_saved_successfully'));
	}

	public function show(SubSubCategory $subSubCategory) {
		//
	}

	public function edit(SubSubCategory $subSubCategory) {
		$category = Category::orderBy('name','asc')->get();
		$brands = Brand::orderBy('name','asc')->get();
		return view('admin/subCategory/addEdit', compact('subCategory','category','brands'));
	}

	public function update(Request $request, SubSubCategory $subSubCategory) {
		$request->validate([
			'name' => 'required|unique:categories,name,' . $subCategory->id,
		]);

		if ($request->hasFile('banner')) {
			@unlink(public_path($category->banner));
			$banner = $this->imageUpload('uploads/subCategories/banner', $request->file('banner'));
			$banner = ['banner' => $banner];
		}

		SubCategory::where('id', $subCategory->id)->update(array_merge($request->except(['_token', '_method']), isset($banner) ? $banner : [], isset($icon) ? $icon : []));

		return back()->with('flash_message_success', __('label.sub_category_has_been_updated_successfully'));
	}

	public function destroy(SubSubCategory $subSubCategory) {

		@unlink(public_path($subCategory->banner));
		@unlink(public_path($subCategory->icon));
		$subCategory->delete();

		return back()->with('flash_message_success', __('label.sub_category_has_been_deleted_successfully'));
	}
}
