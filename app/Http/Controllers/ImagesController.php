<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Images;

/**
 * 
 */
class ImagesController extends Controller
{
    /**
     * 
     */
    public function all() {
        return Images::all();
    }

    /**
     * 
     */
    public function add(Request $request) {
        $params = $request->all();
        
        $imageObject = new Images;

        if(array_key_exists("name", $params)) {
            $imageObject->name = $params["name"];
        }

        if(array_key_exists("image", $params)) {
            $image = base64_decode($params["image"]);
            $fileName = 'api/image/'.uniqid().'.png';
            Storage::put($fileName, $image);

            $imageObject->image = $fileName;
        }

        $imageObject->save();
    }

    /**
     * 
     */
    public function getPeview($fileName) {
        return response()->file(storage_path('app/api/image/'.$fileName), ['Content-type' => 'image/png']);
    }

    /**
     * 
     */
    public function delete($id) {
        return Objects::destroy($id);
    }
}
