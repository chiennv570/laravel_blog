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
    try {
        $a = 1 / 0;
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
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

Route::group(array('domain' => '{account}.myapp.com'), function () {

    Route::get('/', function ($account, $id) {
        // ...
        return Redirect::to('https://www.myapp.com' . '/' . $account);
    });

});


Route::get('test1', function () {

})->middleware(\App\Http\Middleware\CheckAge::class)->name('chien');


//======================Call Controller

Route::get('call-controller', 'MyController@hello');

Route::get('call-view', function () {
    $name = 'chien';
    $view = 'admin';

    return view('info.infomation', ['name2' => $name]);
});

Route::group(['prefix' => 'thuc-don'], function () {
    Route::get('bun-bo', function () {
        echo "This is bun bo";
    });

    Route::get('bun-mam', function () {
        echo "This is bun mam";
    });

    Route::get('bun-moc', function () {
        echo "This is bun moc";
    });
});

View::share('title', 'Lap trinh Laravel 5x'); // share bien tat ca cac view deu nhan duoc bien title

View::composer('info.infomation', function ($view) {
    return $view->with('thongtin', 'Day la trang ca nhan1');
});

//View::composer(['info.infomation', 'welcome'], function ($view) {
//    return $view->with('thongtin', 'Day la trang ca nhan');
//});

Route::get('check-view', function () {
    if (view()->exists('info.infomation')) {
        return "Ton tai view";
    } else {
        return "Khong ton tai view";
    }
});

Route::get('goi-view', function () {
    return view('layout.layout');
});
