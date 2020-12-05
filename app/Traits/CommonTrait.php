<?php

namespace App\Traits;

trait CommonTrait {
	public function imageUpload($destinationPath, $file) {
		$iconPath = rand(20, 100) . time() . $file->getClientOriginalName();
		$file->move($destinationPath, $iconPath);
		return $filePath = $destinationPath . '/' . $iconPath;
	}
}