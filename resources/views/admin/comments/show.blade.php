@extends('layouts.admin')


@section('content')

    @if(count($comments)>0)

        <h1>Comments for "<i>{{$post->title}}</i>"</h1>

        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Body</th>
                <th>View Replies</th>
                <th>Created at</th>

            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{($comment->body)}}</td>
                    <td><a href="{{route('admin.comments.replies.show',$comment->id)}}">View</a></td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>


                    <td>
                        {{--ako  e komentarot aktiven do kontrolerot pracame ['is_active'=>0]--}}
                        {{--ako  komentarot ne e aktiven do kontrolerot pracame ['is_active'=>1]--}}
                        {{--nizata ja stavame vo update metodata--}}
                        @if($comment->is_active ==1)


                            {!! Form::open(['method'=>'Patch','action'=>['PostCommentsController@update',$comment->id]]) !!}


                            <input type="hidden" name="is_active" value="0">

                            {!! Form::submit('Disapprove',['class'=>'btn btn-info']) !!}


                            {!! Form::close() !!}


                        @else


                            {!! Form::open(['method'=>'Patch','action'=>['PostCommentsController@update',$comment->id]]) !!}


                            <input type="hidden" name="is_active" value="1">

                            {!! Form::submit('Approve',['class'=>'btn btn-warning']) !!}


                            {!! Form::close() !!}



                        @endif
                    </td>

                    <td>
                        {!! Form::open(['method'=>'Delete','action'=>['PostCommentsController@destroy',$comment->id]]) !!}




                        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}


                        {!! Form::close() !!}


                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    @else <h1 class="text-center">No Comments for this post</h1>


    @endif
@endsection