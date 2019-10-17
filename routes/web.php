<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');


});*/

Route::get('/post','PageController@posts');
Route::get('/register','PageController@create');
Route::post('/register','PageController@store');
Route::get('/login','PageController@viewlogin');
Route::post('/login','PageController@storelogin');
Route::get('/logout','PageController@destroy');



Route::get('/blog','PageController@file');

Route::post('/uplod','PageController@uplodfile');
Route::get('/post','PageController@show');


//test premission

Route::group(['middleware'=>'roles', 'roles'=> ['admin']]  , function() {
Route::get('/admin','PageController@admin')->name('admin');
Route::post('/add' , 'PageController@addRole');


});


//Route::get('/admin','PageController@admin');
/*
Route::get('/admin',[
    'uses'=>'PageController@admin',
    'as'=> 'adminv',
    'middleware'=>'roles',
    'roles'=> ['admin']
]);

Route::post('/add',[
    'uses'=>'PageController@addRole',
    'as'=> 'adminv',
    'middleware'=>'roles',
    'roles'=> ['admin']
]); */



Route::get('/editor',[
    'uses'=>'PageController@editor',
    'as'=> 'editorv',
    'middleware'=>'roles',
    'roles'=> ['admin','editor']
]);