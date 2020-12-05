<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class BrandController extends Controller {

	use CommonTrait;

	public function index() {
		$brands = Brand::orderBy('id', 'desc')->get();
		return view('admin.brand.index', compact('brands'));
	}

	public function create() {
		return view('admin/brand/addEdit');
	}

	public function store(Request $request) {
		$request->validate([
			'name' => 'required|unique:brands',
		]);

		$logo = '';
		if ($request->hasFile('logo')) {
			$logo = $this->imageUpload('uploads/brands/', $request->file('logo'));
		}
		$images = ['logo' => $logo];
		Brand::create(array_merge($request->all(), $images));

		return back()->with('flash_message_success', __('label.brand_has_been_saved_successfully'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function show(Brand $brand) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Brand $brand) {
		return view('admin/brand/addEdit', compact('brand'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Brand $brand) {
		$request->validate([
			'name' => 'required|unique:brands,name,' . $brand->id,
		]);

		if ($request->hasFile('logo')) {
			@unlink(public_path($brand->logo));
			$logo = $this->imageUpload('uploads/brands', $request->file('logo'));
			$logo = ['logo' => $logo];
		}

		Brand::where('id', $brand->id)->update(array_merge($request->except(['_token', '_method']), isset($logo) ? $logo : []));

		return back()->with('flash_message_success', __('label.brand_has_been_updated_successfully'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Category  $category
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Brand $brand) {
		@unlink(public_path($brand->logo));
		$brand->delete();
		return back()->with('flash_message_success', __('label.brand_has_been_deleted_successfully'));
	}
}
