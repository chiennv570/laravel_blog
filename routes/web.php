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
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/foo', function () {
    return 'Hello World';
});

Route::match(['get', 'post'], '/hello', function () {

});

Route::view('/welcome1', 'welcome')->name('welcome');

//Route::get('user/{id}', function ($id) {
//    return 'User ' . $id;
//});

Route::get('posts/{post}/comments/{comment?}', function ($postId, $commentId = null) {
    return "post : $postId, comment: $commentId";
});

Route::get('user/{name}', function ($name) {
    return "Name: $name";
})->where('name', '[A-Za-z]+');

Route::get('user/{id}', function ($id) {
    return "UserId: $id";
})->where('id', '[0-9]+');

Route::get('user/{id}/{name}', function ($id, $name) {
    return "Id : $id, name: $name";
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

Route::get('name/user/profile', function () {
    $url = route('welcome');
    //var_dump($url); die;
    //return redirect()->route('profile');
    return redirect($url);
})->name('profile');

Route::group(array('domain' => '{account}.myapp.com'), function() {

    Route::get('/', function($account, $id) {
        // ...
        return Redirect::to('https://www.myapp.com'.'/'.$account);
    });

});


Route::get('test1', function () {

})->middleware(\App\Http\Middleware\CheckAge::class)->name('chien');