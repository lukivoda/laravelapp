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

Route::get('/post/{id}',['as'=>'home.post','uses'=>'AdminPostsController@post']);


//go vklucuvame middleware admin za site route-s vo  funkcijata(pristap immat samo logiranite user-i kako admin)
Route::group(['middleware'=>'admin'],function(){


    Route::get('/admin',function(){

        return view('admin.index');
    });

    //route za controller-ot sozdaden so resource komanda(admin/users ke bide dostapno samo za admin)
    Route::resource('admin/users','AdminUsersController');


    //route za controller-ot sozdaden so resource komanda(admin/posts ke bide dostapno samo za admin)
    Route::resource('admin/posts','AdminPostsController');

    //route za controller-ot sozdaden so resource komanda(admin/categories bide dostapno samo za admin)
    Route::resource('admin/categories','AdminCategoriesController');

    //route za controller-ot sozdaden so resource komanda(admin/media bide dostapno samo za admin) iako controller-ot AdminMediasController ne ni e napraven so resource
    Route::resource('admin/media','AdminMediasController');
    
   Route::resource('admin/comments','PostCommentsController');

    Route::resource('admin/comments/replies','CommentRepliesController');

});


//go vklucuvame middleware auth za site route-s vo  funkcijata(pristap immat samo logiranite user-i)
Route::group(['middleware'=>'auth'],function(){

    Route::post('comment/reply','CommentRepliesController@commentstore');

});


