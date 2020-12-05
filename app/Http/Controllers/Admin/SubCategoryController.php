<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\SubCategory;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class SubCategoryController extends Controller {

	use CommonTrait;

	public function index() {
		
		$categories = SubCategory::with('category')->orderBy('id', 'desc')->get();

		$brandArr = [];
		foreach ($categories as $key => $value) {
			$brandArr[$key] = json_decode($value->brand_id);
		}
		$brands = Brand::pluck('name', 'id')->toArray();
		return view('admin.subCategory.index', compact('categories', 'brandArr', 'brands'));
	}

	public function create() {
		$category = Category::orderBy('name', 'asc')->get();
		$brands = Brand::orderBy('name', 'asc')->get();
		return view('admin/subCategory/addEdit', compact('category', 'brands'));
	}

	public function store(Request $request) {

		$request->validate([
			'name' => 'required|unique:categories',
		]);

		$banner = '';
		if ($request->hasFile('banner')) {
			$banner = $this->imageUpload('uploads/subCategories/banner/', $request->file('banner'));
		}

		$images = ['banner' => $banner];
		SubCategory::create(array_merge($request->all(), $images));

		return back()->with('flash_message_success', __('label.sub_category_has_been_saved_successfully'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(SubCategory $subCategory) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function edit(SubCategory $subCategory) {
		$brandArr = json_decode($subCategory->brand_id);
		$category = Category::orderBy('name', 'asc')->get();
		$brands = Brand::orderBy('name', 'asc')->get();
		return view('admin/subCategory/addEdit', compact('subCategory', 'category', 'brands', 'brandArr'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, SubCategory $subCategory) {
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(SubCategory $subCategory) {
		@unlink(public_path($subCategory->banner));
		@unlink(public_path($subCategory->icon));
		$subCategory->delete();
		return back()->with('flash_message_success', __('label.sub_category_has_been_deleted_successfully'));
	}
}
