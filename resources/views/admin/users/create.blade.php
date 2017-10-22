@extends('layouts.admin')

@section('content')
<h1>Create users</h1>



{!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store','files'=>true]) !!}

@include('includes.formerrors')


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
    {!! Form::select('is_active',[1=>'Active',0=>'Not Active'],0,['class'=>'form-control']) !!}

    </div>

     <div class="form-group">

    {!! Form::label('password','Password: ') !!}
    {!! Form::password('password',['class'=>'form-control']) !!}

    </div>

  <div class="form-group">

    {!! Form::label('file','Upload Photo: ') !!}
    {!! Form::file('file',null,['class'=>'form-control']) !!}

   </div>



    <div class="form-group">

        {!! Form::submit('Create user',['class'=>'btn btn-primary']) !!}

    </div>

    {!! Form::close() !!}

@endsection