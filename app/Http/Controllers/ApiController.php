<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class ApiController extends Controller
{
    public function create(Request $request){
        $students = new Student();
        
        $students->fname=$request->input('fname');
        $students->lname=$request->input('lname');
        $students->email=$request->input('email');
        $students->password=$request->input('password');
        $students->save();
        return response()->json($students);
        
    }
    
     public function index()
    {
        return Student::all();
    }
 
    public function show($id)
    {
        return Post::find($id);
    }

    public function store(Request $request)
    {
        return Post::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $post = Article::findOrFail($id);
        $post->update($request->all());

        return $post;
    }

    public function delete(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return 204;
    }
}
