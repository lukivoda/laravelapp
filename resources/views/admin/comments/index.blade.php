@extends('layouts.admin')


@section('content')

  @if(count($comments)>0)

      <h1>Comments</h1>

 <table class="table table-striped table-hover ">
   <thead>
     <tr>
       <th>Id</th>
       <th>Post title</th>
       <th>Author</th>
         <th>Author's photo</th>
       <th>Email</th>
         <th>Body</th>
         <th>Created at</th>
         <th>Updated at </th>
     </tr>
   </thead>
   <tbody>
   @foreach($comments as $comment)
     <tr>
       <td>{{$comment->id}}</td>
       <td><a href="{{route('home.post',$comment->post->id)}}">{{$comment->post->title}}</a></td>
       <td>{{$comment->author}}</td>
         <td><img height="50" width="60" src="{{$comment->photo}}" alt=""></td>
         <td>{{$comment->email}}</td>
       <td>{{str_limit($comment->body,20)}}</td>
         <td>{{$comment->created_at->diffForHumans()}}</td>
         <td>{{$comment->updated_at->diffForHumans()}}</td>



     </tr>
       @endforeach
   </tbody>
 </table>

  @else <h1 class="text-center">No Comments</h1>


    @endif
@endsection