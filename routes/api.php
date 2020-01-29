<?php

use Illuminate\Http\Request;

Use App\Post;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//khóa api căn bản

Route::get('/hello', function(Request $request){
    return response()->json('Hello World! Welcome to datshop.com', 200);
});

Route::get('/hello/{name}',function(Request $request,$name){
    return response()->json('hello '.$name,200);
});

Route::get('/hello/{name}/{age}',function(Request $request,$name,$age){
    return response()->json('hello '.$name.'with age is: '.$age.' old',200);
});


Route::get('/books', function(Request $request){
    $entries = [
        
        [
            "isbn" => "9781593275846",
            "title" => "Eloquent JavaScript, Second Edition",
            "author" => "Marijn Haverbeke"      
        ],
        [
            "isbn" => "9781449331818",
            "title" => "Learning JavaScript Design Patterns",
            "author" => "Addy Osmani"
        ],
        [
            "isbn" => "9781449365035",
            "title" => "Speaking JavaScript",
            "author" => "Axel Rauschmayer",
        ],
        [
            "isbn" => "9781491950296",
            "title" => "Programming JavaScript Applications",
            "author" => "Eric Elliott"
        ]
         
    ];
    return response()->json($entries, 200);
});

Route::post('/books', function(Request $request){
    
    $entries = [
        [
            "isbn" => "9781593275846",
            "title" => "Eloquent JavaScript, Second Edition",
            "author" => "Marijn Haverbeke"      
        ],
        [
            "isbn" => "9781449331818",
            "title" => "Learning JavaScript Design Patterns",
            "author" => "Addy Osmani"
        ]
    ];

    // Get book data from POST
    $book = [
        "isbn" => $request->input('isbn'),
        "title" => $request->input('title'),
        "author" => $request->input('author')
    ];

    // Append news book into current list.
    $entries[] = $book;

    return response()->json($entries, 200);
});


// hết khóa 




//kHOA API basic 02 
Route::get('names', function()
{
    return array(
      1 => "John",
      2 => "Mary",
      3 => "Steven"
    );
});


Route::get('names/{id}', function($id)
{
    $names = array(
      1 => "John",
      2 => "Mary",
      3 => "Steven"
    );    
    return array($id => $names[$id]);
});

//Route::resource('names', 'NameController', array('only' => array('index')));


// het khoa 02


//khoa 03 begin

Route::post('/student','ApiController@create');
Route::get('/student','ApiController@index');

// test api truoc 


 Route::post('/posts','PostController@create');

Route::get('posts', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Post::all();
});
 
Route::get('posts/{id}', function($id) {
    return Post::find($id);
});

/*
Route::post('posts', function(Request $request) {
    return Post::create($request->all);
});

 */

Route::put('posts/{id}', function(Request $request, $id) {
    $post = Article::findOrFail($id);
    $post->update($request->all());

    return $post;
});

Route::delete('posts/{id}', function($id) {
    Post::find($id)->delete();

    return 204;
});
 
 

//Route::get('posts', 'PostController@index');
//Route::get('posts/{id}', 'PostController@show');
//Route::post('posts', 'PostController@store');
//Route::put('posts/{id}', 'PostController@update');
//Route::delete('posts/{id}', 'PostController@delete');