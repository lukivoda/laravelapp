@extends('layouts.admin')


@section('content')

    <div class="col-sm-6">

       {{--konvertiranje na form-ot vo model i dodavanje na $category parametar--}}
        {!! Form::model($category,['method'=>'Patch','action'=>['AdminCategoriesController@update',$category->id]]) !!}




        <div class="form-group">

            {!! Form::label('name','Category: ') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}

        </div>




        <div class="form-group">

            {!! Form::submit('Update category',['class'=>'btn btn-primary','style'=>'float:left']) !!}

        </div>

        {!! Form::close() !!}


           {{--forma za brisenje na useri-te so method delete--}}
            {!! Form::open(['method'=>'Delete','action'=>['AdminCategoriesController@destroy',$category->id]]) !!}

            <div class="form-group">

                {!! Form::submit('Delete category',['class'=>'btn btn-danger','style'=>'margin-left:5%;']) !!}

            </div>

            {!! Form::close() !!}

        </div>


    <div class="col-sm-6"></div>
@endsection