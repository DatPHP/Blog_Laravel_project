@extends('layouts.master')
@section('content')
@include('partials.errors')

<div class="row">
    <div class="col-md-12">
        <form action="{{route('admin.create')}}" method="post">
            <div class="form-group">
                <label for ="title"> </label>
                <input type="text" class="form-control" id="title" name="title"> </input>
            </div>
            
             <div class="form-group">
                 <label for ="content"> </label>
                <input type="text"class="form-control" id="content" name="content" ></input>
            </div>
            
            @foreach($tags as $tag)
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="tags[]" value="{{$tag->id}}"> {{
                        $tag->name}}
                    
                </label>
            </div>
            @endforeach
            
              {{csrf_field()}} 
            <button type="submit" class="btn btn-primary">Submit </button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <p>
            <b>Learning laravel  </b> 
            
            <div class="form-group">
    <input type="checkbox" value="1" checked id="remember_me" name="remember_me">
    <label for="remember_me">Remember me</label>
           </div>
        </p>
    </div>
</div>
   
 
@endsection
