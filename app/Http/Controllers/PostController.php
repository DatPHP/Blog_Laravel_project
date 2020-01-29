<?php

namespace App\Http\Controllers;
use App\Like;
use App\Post;
use App\Tag;
use Auth;

use Gate;
use Illuminate\Http\Request;




class PostController extends Controller
{
    public function getIndex()
    {
        
       // $posts = Post::all();
        $posts=Post::orderBy('created_at','desc')->paginate(2);
        
       // $post = new Post();
       // $posts = $post->getPosts($session);
        return view('blog.index', ['posts' => $posts]);
    }

    public function getAdminIndex()
    {
           
       
         // $posts = Post::all();
         $posts=Post::orderBy('title','asc')->get();
       // $post = new Post();
       // $posts = $post->getPosts($session);
        return view('admin.index', ['posts' => $posts]);
    }

    public function getPost( $id)
    {
        //$post = Post::find($id);
         $post = Post::where('id',$id)->with('likes')->first();
        //$post = new Post();
       // $post = $post->getPost($session, $id);
        return view('blog.post', ['post' => $post]);
    }
    
    
    
    
    

   
    
    // method POST 
    
    
    
    public function create(Request $request){
        $post = new Post();
        $post->id=$request->input('id');
        $post->title=$request->input('title');
        $post->content=$request->input('content');
        $post->user_id=$request->input('user_id');
        
        $post->save();
        return response()->json($post);
        
    }
    
    
    
    
    
    
    
    
    
     public function getLikePost( $id)
    {
        //$post = Post::find($id);
         $post = Post::where('id',$id)->first();
        //$post = new Post();
       // $post = $post->getPost($session, $id);
         $like= new Like();
         $post->likes()->save($like);
        return redirect()->back();
    }
    
    public function getAdminCreate()
    {
           
      
        $tags= Tag::all();
        return view('admin.create',['tags'=>$tags]);
    }

    public function getAdminEdit( $id)
    {
        
           
       
       // $post = new Post();
      //  $post = $post->getPost($session, $id);
        
        $post=Post::find($id);
        $tags= Tag::all();
        return view('admin.edit', ['post' => $post, 'postId' => $id,'tags'=>$tags]);
    }

    public function postAdminCreate( Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        
        $user = Auth::user();
        if(!$user){
            return redirect()->back();
        }
        
        $post = new Post([
            'title'=>$request->input('title'),
            'content'=>$request->input('content')
            
        ]);
        
        $user->posts()->save($post);
        
        
        $post->tags()->attach($request->input('tags')=== null?[]:$request->input('tags'));
               return redirect()->route('admin.index')->with('info', 'Post created, Title is: ' . $request->input('title'));
      
     //   $post->addPost($session, $request->input('title'), $request->input('content'));
        
 
    
    }

    public function postAdminUpdate( Request $request)
    {
        
       
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);
       // $post = new Post();
       // $post->editPost($session, $request->input('id'), $request->input('title'), $request->input('content'));
        $post = Post::find($request->input('id'));
        
        if(Gate::denies('manipulate-post',$post)){
            return redirect()->back();
        }
        
        $post->title=$request->input('title');
        $post->content=$request->input('content');
    
        $post->save();
        
       // $post->tags()->detach();
       //  $post->tags()->attach($request->input('tags')=== null?[]:$request->input('tags'));
        
    
        $post->tags()->sync($request->input('tags')=== null?[]:$request->input('tags'));
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }
    
    
    public function getAdminDelete($id)
    {
        
           
      
        $post=Post::find($id);
         if(Gate::denies('manipulate-post',$post)){
            return redirect()->back();
        }
        $post->likes()->delete();
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.index')->with('info','Post deleted!');
        
    }
  //  public function store(Request $request){
        //Controller Logic 
   // }
    
    
    
    
    /////// test api 
    
    public function index()
    {
        return Post::all();
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
        $post = Post::findOrFail($id);
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

