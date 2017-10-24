@extends('layouts.admin')


@section('content')
 <h1>Posts</h1>

 @if(session('updated_post'))
     <p class="alert alert-warning">{{session('updated_post')}}</p>
 @endif

 @if(session('post_is_inserted'))
    <p class="alert alert-success"> {{session('post_is_inserted')}}</p>
 @endif

 @if(session('deleted_post'))
     <p class="alert alert-danger"> {{session('deleted_post')}}</p>
 @endif



 <table class="table table-striped table-hover ">
  <thead>
    <tr>
         <th>Id</th>
        <th>Author</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
        <th>Photo</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
  </thead>
  <tbody>

  @if($posts)
      @foreach($posts as $post)
    <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->user->name}}</td>
        <td>{{($post->category)?$post->category->name:'Uncategorized'}}</td>
        <td><a href="{{route('admin.posts.edit',$post->id)}}">{{$post->title}}</a></td>
        {{--go limitirame pregledot na content-ot od body na 20 karakteri--}}
        <td>{{str_limit($post->body,35)}}</td>
        <td><img width="50" height="50" src="{{($post->photo)?$post->photo->path:'/images/placeholder.jpg'}}" alt=""></td>
        <td>{{$post->created_at->diffForHumans()}}</td>
        <td>{{$post->updated_at->diffForHumans()}}</td>
    </tr>
    @endforeach
   @endif
  </tbody>
</table>

@endsection