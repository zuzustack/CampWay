<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/blog', function(){
    $firebase = (new Factory)
        ->withServiceAccount(__DIR__ . "/../pbo-campway-firebase-adminsdk-wy8r2-54b699be52.json")
        ->withDatabaseUri('https://pbo-campway-default-rtdb.asia-southeast1.firebasedatabase.app');

    $database = $firebase->createDatabase();
    
    $blog = $database
        ->getReference('blog');
    
    return Response::json([
        'blog' => $blog->getvalue()
    ]);
})->name('vue');

Route::get('/create', function(){
    $firebase = (new Factory)
        ->withServiceAccount(__DIR__ . "/../pbo-campway-firebase-adminsdk-wy8r2-54b699be52.json")
        ->withDatabaseUri('https://pbo-campway-default-rtdb.asia-southeast1.firebasedatabase.app');

    $database = $firebase->createDatabase();
    
    $blog = $database
        ->getReference('blog')
        ->push([
            'title' => 'lah1',
            'description' => "desclah", 
        ]);
})->name('vue');

Route::get('/blog/{uuid}', function(Request $request, $uuid){
    $firebase = (new Factory)
        ->withServiceAccount(__DIR__ . "/../pbo-campway-firebase-adminsdk-wy8r2-54b699be52.json")
        ->withDatabaseUri('https://pbo-campway-default-rtdb.asia-southeast1.firebasedatabase.app');

    $database = $firebase->createDatabase();
    
    $blog = $database
        ->getReference("blog/$uuid")
        ->set(null);
})->name('vue');

Route::get('/test', function(){
    var_dump(__DIR__);
})->name('vue');


