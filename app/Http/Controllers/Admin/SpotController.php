<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Http\Controllers\Controller;
use App\TouristSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SpotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function indexData(){
        $spot = TouristSpot::all();

        foreach ($spot as $s){
            if($s->gallery){
                if($s->gallery->images->count() >= 1){
                    $image = '/storage/'.$s->gallery->images->first()->src;
                } else {
                    $image = 0;
                }
            }
            $data[] = [
                'id' => $s->id,
                'name' => $s->name,
                'image' => $image,
            ];
        }
        return $data;
    }

    public function store(Request $request){
        if($request->thumbnail > 0){
            $album = new Gallery();
            $album->title = $request->name;
            $album->save();

            $a_id = $album->id;

            $article = new TouristSpot();
            $article->name = $request->name;
            $article->slug = Str::slug($request->name);
            $article->description = $request->description;
            $article->gallery_id = $a_id;
            $article->save();

            return [$a_id, $article->id];

        } else {
            $article = new TouristSpot();
            $article->name = $request->name;
            $article->slug = Str::slug($request->name);
            $article->description = $request->description;
            $article->save();

            return [0, $article->id];
        }
    }
}
