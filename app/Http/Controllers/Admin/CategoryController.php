<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller {

	use CommonTrait;

	public function index() {
		$categories = Category::orderBy('id', 'desc')->get();
		return view('admin.category.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admin/category/addEdit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$request->validate([
			'name' => 'required|unique:categories',
		]);

		$banner = '';
		$icon = '';
		if ($request->hasFile('banner')) {
			$banner = $this->imageUpload('uploads/categories/banner/', $request->file('banner'));
		}

		if ($request->hasFile('icon')) {
			$icon = $this->imageUpload('uploads/categories/icon', $request->file('icon'));
		}

		$images = ['banner' => $banner, 'icon' => $icon];
		Category::create(array_merge($request->all(), $images));

		return back()->with('flash_message_success', __('label.category_has_been_saved_successfully'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(Category $category) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Category $category) {
		return view('admin/category/addEdit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Category $category) {
		$request->validate([
			'name' => 'required|unique:categories,name,' . $category->id,
		]);

		if ($request->hasFile('banner')) {
			@unlink(public_path($category->banner));
			$banner = $this->imageUpload('uploads/categories/banner', $request->file('banner'));
			$banner = ['banner' => $banner];
		}

		if ($request->hasFile('icon')) {
			@unlink(public_path($category->icon));
			$icon = $this->imageUpload('uploads/categories/icon', $request->file('icon'));
			$icon = ['icon' => $icon];
		}

		Category::where('id', $category->id)->update(array_merge($request->except(['_token', '_method']), isset($banner) ? $banner : [], isset($icon) ? $icon : []));

		return back()->with('flash_message_success', __('label.category_has_been_updated_successfully'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Category $category) {
		@unlink(public_path($category->banner));
		@unlink(public_path($category->icon));
		$category->delete();
		return back()->with('flash_message_success', __('label.category_has_been_deleted_successfully'));
	}
}
