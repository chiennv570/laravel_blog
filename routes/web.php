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


//share bien cho view info.infomation
View::composer('info.infomation', function ($view) {
    return $view->with('thongtin', 'Day la trang ca nhan1');
});


//share bien cho view info.infomatiion and welcome
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
    return view('layout.master');
});

// get url
Route::get('url/full', function () {
    return URL::full();
});

// get url asset
Route::get('url/asset', function () {
    //return URL::asset('css/mystyle.css', true);  // => https://laravel.local/css/mystyle.css (la https)
    //return URL::asset('css/mystyle.css'); // => http://laravel.local/css/mystyle.css (la http)

    // URL::asset la Laravel4 con asset la Laravel5
    return asset('css/mystyle.css');
});

Route::get('url/to', function () {
//    return URL::to('test', [
//        'chien', 'diachi11'
//    ]);
    return URL::to('test', [
        'chien',
        'diachi11'
    ], true);  // => https://laravel.local/test/chien/diachi11 (https)
});

Route::get('/thongtin/{name}/chien123/{diachi}', function ($name, $diachi1) {
    return "Name: $name, Dia chi: $diachi1";
});

Route::get('url/secure', function () {
    // se tra ve https luon ko can them true cuoi
    return secure_url('thong-tin', ['chien', '12344423']);  // => https://laravel.local/thong-tin/chien/12344423
});


// create table khoapham
Route::get('schema/create', function () {
    Schema::create('khoapham', function ($table) {
        $table->increments('id');
        $table->string('tenmonhoc');
        $table->integer('gia');
        $table->text('ghichu')->nullable();
        $table->timestamps();
    });
});


// rename table khoapham => kpt
Route::get('schema/rename', function () {
    Schema::rename('khoapham', 'kpt');
});

// drop table
Route::get('schema/drop', function () {
    Schema::drop('kpt');
});

// drop table check exist
Route::get('schema/drop-exists', function () {
    Schema::dropIfExists('khoapham');
});


// change attr column
Route::get('schema/change-col-attr', function () {
    Schema::table('khoapham', function ($table) {
        $table->string('tenmonhoc', 50)->change();
    });
});


// delete column
Route::get('schema/drop-col', function () {
    Schema::table('khoapham', function ($table) {
        $table->dropColumn('ghichu');
        $table->string('test');
    });
});

// delete multi column
Route::get('schema/drop-multi-col', function () {
    Schema::table('khoapham', function ($table) {
        $table->dropColumn(['test', 'gia']);
    });
});


// relation (khoa ngoai)
Route::get('schema/create/cate', function () {
    Schema::create('category', function ($table) {
        $table->increments('id');
        $table->string('name', 100);
        $table->timestamps();
    });
});


Route::get('schema/create/product', function () {
    Schema::create('product', function ($table) {
        $table->increments('id');
        $table->string('name');
        $table->integer('price');
        $table->integer('cate_id')->unsigned();
        $table->foreign('cate_id')->references('id')->on('category')->onDelete('cascade');
        $table->timestamps();
    });
});


// query select all
Route::get('query/select-all', function () {
    $data = DB::table('chiennguyen')->get();

    foreach ($data as $d) {
        echo "<pre>";
        print_r($d);
    }
});

// select column
Route::get('query/select-column', function () {
    $data = DB::table('chiennguyen')->select('hoten')->get();

    echo "<pre>";
    print_r($data);
});

Route::get('query/order-by', function () {
    $data = DB::table('chiennguyen')->select('hoten')->orderBy('id', 'DESC')->get();

    echo "<pre>";
    print_r($data);
});

Route::get('query/limit', function () {
    // skip: offset
    // take: limit

    $data = DB::table('chiennguyen')->skip(2)->take(2)->get(); // =>offset = 2, limit = 2

    echo "<pre>";
    print_r($data);
});


// get id >= 2 and <=4
Route::get('query/between', function () {
    $data = DB::table('chiennguyen')->whereBetween('id', [2, 4])->get();

    echo "<pre>";
    print_r($data);
});


// get id id < 2 and id > 4
Route::get('query/not-between', function () {
    $data = DB::table('chiennguyen')->whereNotBetween('id', [2, 4])->get();

    echo "<pre>";
    print_r($data);
});


// where in
Route::get('query/where-in', function () {
    $data = DB::table('chiennguyen')->whereIn('id', [1, 2, 10])->get();

    echo "<pre>";
    print_r($data);
});

// where not in
Route::get('query/where-not-in', function () {
    $data = DB::table('chiennguyen')->whereNotIn('id', [1, 2, 10])->get();

    echo "<pre>";
    print_r($data);
});


//dem so luong record
Route::get('query/count', function () {
    $data = DB::table('chiennguyen')->count();

    echo $data;
});


// get max column
Route::get('query/max', function () {
    $data = DB::table('chiennguyen')->max('sodienthoai');

    echo $data;
});

// get min column
Route::get('query/min', function () {
    $data = DB::table('chiennguyen')->min('sodienthoai');

    echo $data;
});


// get avg column
Route::get('query/avg', function () {
    $data = DB::table('chiennguyen')->avg('id');

    echo $data;
});


// get sum column
Route::get('query/sum', function () {
    $data = DB::table('chiennguyen')->sum('id');

    echo $data;
});


// relation
Route::get('schema/create/cate', function () {
    Schema::create('cate_news', function ($table) {
        $table->increments('id');
        $table->string('name');
        $table->timestamps();
    });
});


Route::get('schema/create/news', function () {
    Schema::create('news', function ($table) {
        $table->increments('id');
        $table->string('title');
        $table->string('intro');
        $table->integer('cate_id')->unsigned();
        $table->timestamps();
    });
});

// join 2 table
Route::get('query/join', function () {
    $data = DB::table('news')->join('cate_news', 'cate_news.id', '=', 'news.cate_id')->get();

    echo "<pre>";
    print_r($data);
});

// insert record to table
Route::get('query/insert', function () {
    DB::table('news')->insert([
        'title'   => 'title insert',
        'intro'   => 'intro insert',
        'cate_id' => 2
    ]);

    return 'Insert successly';
});

// insert multi data
Route::get('query/insert-multi', function () {
    DB::table('news')->insert([
        [
            'title'   => 'title insert',
            'intro'   => 'intro insert',
            'cate_id' => 2
        ],
        [
            'title'   => 'title insert1',
            'intro'   => 'intro insert2',
            'cate_id' => 2
        ],
        [
            'title'   => 'title insert2',
            'intro'   => 'intro insert2',
            'cate_id' => 2
        ],
    ]);

    return 'Insert successly';
});

// get last Id insert
Route::get('query/insert-get-id', function () {
    $id = DB::table('news')->insertGetId([
        'title'   => 'last title',
        'intro'   => 'last intro',
        'cate_id' => 3
    ]);

    echo 'asdasdasdasdasdasdasdasdasdasdasdasdasdas';
});
