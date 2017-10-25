<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/admin',function(){
    
    return view('admin.index');
});



Route::group(['middleware'=>'admin'],function(){


    //route za controller-ot sozdaden so resource komanda(admin/users ke bide dostapno samo za admin)
    Route::resource('admin/users','AdminUsersController');


    //route za controller-ot sozdaden so resource komanda(admin/posts ke bide dostapno samo za admin)
    Route::resource('admin/posts','AdminPostsController');

    //route za controller-ot sozdaden so resource komanda(admin/categories bide dostapno samo za admin)
    Route::resource('admin/categories','AdminCategoriesController');

    //route za controller-ot sozdaden so resource komanda(admin/media bide dostapno samo za admin) iako controller-ot AdminMediasController ne ni e napraven so resource
    Route::resource('admin/media','AdminMediasController');
    
   

});


