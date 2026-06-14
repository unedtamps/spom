<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:1024',
        ]);

        $file = $request->file('image');
        $fileName = Str::orderedUuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/origin', $fileName);

        return response()->json([
            'data' => [
                'filePath' => '/storage/origin/' . $fileName,
            ]
        ]);
    }
}
