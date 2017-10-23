@extends('layouts.admin')

@section('content')
    <h1>Edit user</h1>

    @include('includes.formerrors')

  <div class="col-sm-3">
      <img src="{{($user->photo)?$user->photo->path:'/images/placeholder.gif'}}" alt="" class="img-responsive img-rounded">
  </div>


    <div class="col-sm-9">

   {{--konvertiranje na form-ot vo model i dodavanje na $user parametar so sto gi imame vrednostite od tabelata users kako value--}}
    {!! Form::model($user,['method'=>'Patch','action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}




    <div class="form-group">

        {!! Form::label('name','Name: ') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}

    </div>

    <div class="form-group">

        {!! Form::label('email','Email: ') !!}
        {!! Form::email('email',null,['class'=>'form-control']) !!}

    </div>

    <div class="form-group">

        {!! Form::label('role_id','Role: ') !!}
        {!! Form::select('role_id',[''=>'Choose Role']+$roles,null,['class'=>'form-control']) !!}

    </div>

    <div class="form-group">


        {!! Form::label('is_active','Status: ') !!}
        {{--za da ja zememe vrednosta od kolonata is_active za default pisuvame null--}}
        {!! Form::select('is_active',[1=>'Active',0=>'Not Active'],null,['class'=>'form-control']) !!}

    </div>

    <div class="form-group">

        {!! Form::label('password','Password: ') !!}
        {!! Form::password('password',['class'=>'form-control' ]) !!}

    </div>

    <div class="form-group">

        {!! Form::label('file','Upload Photo: ') !!}
        {!! Form::file('file',null,['class'=>'form-control']) !!}

    </div>



    <div class="form-group">

        {!! Form::submit('Update user',['class'=>'btn btn-primary','style'=>'float:left']) !!}

    </div>

    {!! Form::close() !!}


       {{--forma za brisenje na useri-te so method delete--}}
        {!! Form::open(['method'=>'Delete','action'=>['AdminUsersController@destroy',$user->id]]) !!}

        <div class="form-group">

            {!! Form::submit('Delete user',['class'=>'btn btn-danger','style'=>'margin-left:5%;']) !!}

        </div>

        {!! Form::close() !!}



    </div>
@endsection