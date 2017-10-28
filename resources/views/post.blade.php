@extends('layouts.blog-post')



@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->path}}" alt="">

    <hr>

    <!-- Post Content -->
    <p >{{$post->body}}</p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        @include('includes.formerrors')


       @if(session('approval_waiting'))
         <p class="alert alert-warning">{{session('approval_waiting')}}</p>
        @endif
      <h4>Leave a comment:</h4>
     {!! Form::open(['method'=>'Post','action'=>'PostCommentsController@store']) !!}
        {{--hidden input za pracanje na post_id vo store preku post method-ot--}}
        <input type="hidden" name="post_id" value="{{$post->id}}">

         <div class="form-group">
             {!! Form::textarea('body',null,['class'=>'form-control']) !!}
         </div>

        <div class="form-group">
            {!! Form::submit('Post comment',['class'=>'btn btn-primary form-control']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    <hr>

    <!-- Posted Comments -->
   {{--ako user-ot e logiran--}}
   @if(Auth::check())
    <!-- Comment -->
    {{--ako imame komentari--}}
    @if($comments)
    @foreach($comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img  height="64" width='64' class="media-object" src="{{$comment->photo}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
       <p> {{$comment->body}}</p>

            <div class="nested-reply ">

                <button class="btn btn-warning reply_button pull-right">Reply</button>


                <div class="nested-form col-sm-offset-3">

                    {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@commentstore']) !!}




                    <input type="hidden" name="comment_id" value="{{$comment->id}}"  >

                    <div class="form-group">

                        {!! Form::textarea('body',null,['rows'=>'4','class'=>'form-control']) !!}

                    </div>

                    <div class="form-group">

                        {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}

                    </div>

                    {!! Form::close() !!}

                </div>



            </div>
            <br>


            <!-- Nested Comment -->
           {{--ako ima replies--}}
            @if(count($comment_replies)>0)

                @foreach($comment_replies as $reply)

                    @if($reply->comment_id == $comment->id)
            <div id="nested-comment "  class="media">
                <a class="pull-left" href="#">
                    <img width="64" height="64" class="media-object" src="{{$reply->photo}}" alt="">
                </a>

                <div  class="media-body ">
                    <h4 class="media-heading">{{$reply->author}}
                        <small>{{$reply->created_at->diffForHumans()}}</small>
                    </h4>
                   {{$reply->body}}
                </div>


            </div>

                        <br>


                    @endif

                @endforeach

            @endif
            <!-- End Nested Comment -->
        </div>
    </div>
    @endforeach
     @endif
   @endif
@endsection

@section('scripts')

    <script>
  $(".nested-reply .reply_button").click(function(){

     $(this).next().slideToggle('slow');
  });

    </script>

@endsection

