@extends('layouts.admin')


@section('content')

    @if(count($replies)>0)

        <h1>Replies</h1>


        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Body</th>
                <th>Created at</th>
                <th>Updated at </th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            @foreach($replies as $reply)

                @if($i==0)
                <h4 class="text-center">Comment: '<i>{{$reply->comment->body}}</i>'</h4>
                @endif
                <?php $i++; ?>

                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{($reply->body)}}</td>
                    <td>{{$reply->created_at->diffForHumans()}}</td>
                    <td>{{ $reply->updated_at->diffForHumans()}}</td>

                    <td>
                        {{--ako  e komentarot aktiven do kontrolerot pracame ['is_active'=>0]--}}
                        {{--ako  komentarot ne e aktiven do kontrolerot pracame ['is_active'=>1]--}}
                        {{--nizata ja stavame vo update metodata--}}
                        @if($reply->is_active ==1)


                            {!! Form::open(['method'=>'Patch','action'=>['CommentRepliesController@update',$reply->id]]) !!}


                            <input type="hidden" name="is_active" value="0">

                            {!! Form::submit('Disapprove',['class'=>'btn btn-info']) !!}


                            {!! Form::close() !!}


                        @else


                            {!! Form::open(['method'=>'Patch','action'=>['CommentRepliesController@update',$reply->id]]) !!}


                            <input type="hidden" name="is_active" value="1">

                            {!! Form::submit('Approve',['class'=>'btn btn-warning']) !!}


                            {!! Form::close() !!}



                        @endif
                    </td>

                    <td>
                        {!! Form::open(['method'=>'Delete','action'=>['CommentRepliesController@destroy',$reply->id]]) !!}




                        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}


                        {!! Form::close() !!}


                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    @else <h1 class="text-center">No Replies for this comment</h1>


    @endif
@endsection