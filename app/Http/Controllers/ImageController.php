<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function uploadTestImage(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $path = Storage::disk('public')->put('tests', $request->file('image'));

        $url = env('APP_URL') . 'storage/' . $path;
        return redirect()->back()->with([
            'status' => true,
            'message' => $url
        ]);

    }
}
