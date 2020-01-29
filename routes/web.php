<?php

use App\User;
use Illuminate\Support\Facades\Input;

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


/*


Route::get('/', function () {
    return view('welcome');
});

//Route::get('/hello','PostController@getIndex')->name('blog.index');

Route::get('/hello',[
        'uses'=>'PostController@getIndex',
        'as'=>'blog.index'
       ] );
/*
Route::get('/hello', function () {
    return view('blog.index');
})->name('blog.index');
*/







/*
Route::get('/hi/{nane}', function ($t) {
    return 'Good morning '.$t;
});

Route::get('/post/{id}',function($id){

    if($id==1)
    {
      $post=[
          'title'=>'Learning Laravel',
          'content'=>'This Blog post will get you right on track with Laravel!!'
      ] ;


    }
    else
    {
        $post=[
          'title'=>'Something else..',
          'content'=>'Some other content '
      ] ;

    }
  //  return $post['title'];
    return view('blog.post',['post'=>$post]);
} )->name('blog.post');


Route::get('about-page',function(){
     return view('other.about');
 })->name('other.about');



 Route::group(['prefix'=>'admin'],function()
 {
    Route::get('',function(){
    return view('admin.index');
 })->name('admin.index');

 Route::get('create',function(){
     return view('admin.create');
 })->name('admin.create');

 Route::post('create',function(	\Illuminate\Http\Request $request,
         \Illuminate\Validation\Factory $validator){
    $validation= $validator->make($request->all(),[
         'title'=>'required|min:5',
         'content'=>'required|min:10'
     ]);
    if($validation->fails()){
        return redirect()->back()->withErrors($validation);
    }

     return redirect()
             ->route('admin.index')
             ->with('info','Post edited, Title: '.$request->input('title'));



 })->name('admin.create');

 Route::get('edit/{id}',function($id){

     if($id==1)
    {
      $post=[
          'title'=>'Learning Laravel',
          'content'=>'This Blog post will get you right on track with Laravel!!'
      ] ;


    }
    else
    {
        $post=[
          'title'=>'Something else..',
          'content'=>'Some other content '
      ] ;

    }
     return view('admin.edit',['post'=>$post]);
 })->name('admin.edit');

  Route::post('edit',function(\Illuminate\Http\Request $request,
           \Illuminate\Validation\Factory $validator){

      $validation= $validator->make($request->all(),[
         'title'=>'required|min:5',
         'content'=>'required|min:10'
     ]);
    if($validation->fails()){
        return redirect()->back()->withErrors($validation);
    }


     return redirect()
             ->route('admin.index')
             ->with('info','Post edited, new Title: '.$request->input('title'));
 })->name('admin.update');

 });
 *
 *
 *
 *
 */

Route::get('file','FileController@index');
Route::post('file','Filecontroller@doUpload');



Route::get('/chao',function(){
    echo "Xin chao Dat!";
});



Route::get('/', function () {
    return view('welcome');
});



Route::get('/hello', [
    'uses' => 'PostController@getIndex',
    'as' => 'blog.index'
]);

Route::get('post/{id}', [
    'uses' => 'PostController@getPost',
    'as' => 'blog.post'
]);

Route::get('post/{id}/like', [
    'uses' => 'PostController@getLikePost',
    'as' => 'blog.post.like'
]);



Route::get('about', function () {
    return view('other.about');
})->name('other.about');



Route::any('/search',function(){
    $q = Input::get ( 'q' );
    $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
        return view('welcome')->withDetails($user)->withQuery ( $q );
    else return view ('welcome')->withMessage('No Details found. Try to search again !');
});




Route::get ( '/', function () {
    return view ( 'welcome' );
} );
Route::any ( '/search', function () {
    $q = Input::get ( 'q' );
    $user = User::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->get ();
    if (count ( $user ) > 0)
        return view ( 'welcome' )->withDetails ( $user )->withQuery ( $q );
    else
        return view ( 'welcome' )->withMessage ( 'No Details found. Try to search again !' );
} );


Route::group(['prefix' => 'admin','middleware'=>['auth']], function() {
    Route::get('', [
        'uses' => 'PostController@getAdminIndex',
        'as' => 'admin.index'
    ]);

    Route::get('create', [
        'uses' => 'PostController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::post('create', [
        'uses' => 'PostController@postAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'PostController@getAdminEdit',
        'as' => 'admin.edit'
    ]);



    Route::get('delete/{id}', [
        'uses' => 'PostController@getAdminDelete',
        'as' => 'admin.delete'
    ]);

    Route::post('edit', [
        'uses' => 'PostController@postAdminUpdate',
        'as' => 'admin.update'
    ]);
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::post('login',[
        'uses'=>'SigninController@signin',
        'as'=>'auth.signin'
        ]);

