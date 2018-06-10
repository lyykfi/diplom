<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/objects", "ObjectsController@all");
Route::get("/preview/{fileName}", "ObjectsController@getPeview");
Route::get("/objects/{fileName}.obj", "ObjectsController@getObject");
Route::get("/objects/{fileName}.mtl", "ObjectsController@getMTL");
Route::get("/api/mtl/{fileName}", "ObjectsController@getMTL");
Route::post("/objects", "ObjectsController@add");
Route::delete("/objects/{id}", "ObjectsController@delete");

Route::get("/images", "ImagesController@all");
Route::get("/image/{fileName}", "ImagesController@getPeview");
Route::post("/images", "ImagesController@add");
Route::delete("/images/{id}", "ImagesController@delete");