<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image as Images;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('albumIndex', 'albumIndexData', 'show');
    }

    public function saveImage(Request $request, $id){
        $file = $request->docs;
        $filename = $file->getClientOriginalName();

        $album = Gallery::find($id);

        $folder = $album->title;
        if(Storage::disk('public')->put('uploads/albums/'.$folder.'/'.$filename,  File::get($file))){

            $f = new Images();
            $f->gallery_id = $id;
            $f->src = 'uploads/albums/'.$folder.'/'.$filename;
            $f->type = 0;
            $f->save();

            $imgs = Image::make(storage_path('app/public/uploads/albums/'.$folder.'/'.$filename));
            $imgs->resize(1500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imgs->save(storage_path('app/public/uploads/albums/'.$folder.'/'.$filename));


            if(Storage::disk('public')->put('thumb/uploads/albums/'.$folder.'/'.$filename,  File::get($file))) {
                $imgs2 = Image::make(storage_path('app/public/thumb/uploads/albums/' .$folder. '/' . $filename));
                $imgs2->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $imgs2->save(storage_path('app/public/thumb/uploads/albums/' .$folder. '/' . $filename));
            }

            return response()->json([
                'success' => true,
                'id' => $f->id
            ], 200);
        }

        return response()->json([
            'success' => false
        ], 500);
    }
}
