@extends('layouts.admin')

@section('content')

    <h1>Media</h1>

    @if($photos)

        @if(session("photo_deleted"))
          <p class="alert alert-danger">{{session("photo_deleted")}}</p>
        @endif
    <table class="table table-striped table-hover ">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Created At</th>

        </tr>
      </thead>
      <tbody>
      @foreach($photos as $photo)
        <tr>
          <td>{{$photo->id}}</td>
          <td><img height='50' src="{{$photo->path}}" alt=""></td>
          <td>{{$photo->created_at?$photo->created_at->diffForHumans():'No Date'}}</td>
          <td>

                   {{--forma za brisenje na useri-te so method delete--}}
                      {!! Form::open(['method'=>'Delete','action'=>['AdminMediasController@destroy',$photo->id]]) !!}

                      <div class="form-group">

                          {!! Form::submit('Delete photo',['class'=>'btn btn-danger','style'=>'margin-left:5%;']) !!}

                      </div>

                      {!! Form::close() !!}




          </td>
        </tr>
         @endforeach
      </tbody>
    </table>
    @endif


@endsection