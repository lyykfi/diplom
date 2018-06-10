<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Objects;

/**
 * 
 */
class ObjectsController extends Controller
{
    /**
     * 
     */
    public function all() {
        return Objects::all();
    }

    /**
     * 
     */
    public function add(Request $request) {
        $params = $request->all();
        
        $object = new Objects;

        if(array_key_exists("name", $params)) {
            $object->name = $params["name"];
        }
        
        if(array_key_exists("object", $params)) {
            $obj = base64_decode($params["object"]);
            $fileName = 'api/objects/'.uniqid().'.obj';
            Storage::put($fileName, $obj);

            $object->object = $fileName;
        }

        if(array_key_exists("mtl", $params)) {
            $obj = base64_decode($params["mtl"]);
            $mtl_name = $params["mtl_name"];
            $mtl_name = preg_replace('/[^A-Za-z0-9_\-]/', '_', $mtl_name);
            $fileName = 'api/mtl/'.$mtl_name;

            //Storage::put($fileName, $obj);

            $object->mtl = $fileName;
        }

        if(array_key_exists("image", $params)) {
            $image = base64_decode($params["image"]);
            $fileName = 'api/preview/'.uniqid().'.png';

            Storage::put($fileName, $image);

            $object->image = $fileName;
        }

        $object->save();
    }

    /**
     * 
     */
    public function getPeview($fileName) {
        return response()->file(storage_path('app/api/preview/'.$fileName), ['Content-type' => 'image/png']);
    }

    /**
     * 
     */
    public function getObject($fileName) {
        return response()->file(storage_path('app/api/objects/'.$fileName.'.obj'));
    }

    /**
     * 
     */
    public function getMTL($fileName) {
        $fileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $fileName);

        return response()->file(storage_path('app/api/mtl/'.$fileName.'_mtl'));
    }

    /**
     * 
     */
    public function delete($id) {
        return Objects::destroy($id);
    }
}
