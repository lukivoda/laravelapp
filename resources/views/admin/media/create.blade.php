@extends('layouts.admin')

@section('head')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css">

@endsection

@section('content')

    <h1>Upload Media</h1>

    {!! Form::open(['method'=>'POST','action'=>'AdminMediasController@store','class'=>'dropzone', 'files'=>true]) !!}



        {!! Form::close() !!}



@endsection

@section('footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>

@endsection