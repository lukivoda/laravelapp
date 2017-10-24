@extends('layouts.admin')

@section('content')
    <h1>Edit Post</h1>


    @include('includes.formerrors')


    <div class="col-sm-6">
        <img src="{{($post->photo)?$post->photo->path:'/images/placeholder.jpg'}}" alt="" class="img-responsive img-rounded">
    </div>


    <div class="col-sm-6">

      {{--konvertiranje na form-ot vo model so  dodavanje na $post parametar--}}
      {{--gi vlecime kolonite od posts tabelata--}}
       {!! Form::model($post,['method'=>'Patch','action'=>['AdminPostsController@update',$post->id],'files'=>true]) !!}




       <div class="form-group">

           {!! Form::label('title','Title: ') !!}
           {!! Form::text('title',null,['class'=>'form-control']) !!}

       </div>


       <div class="form-group">

           {!! Form::label('category_id','Category: ') !!}
           {!! Form::select('category_id',[''=>'Choose category ']+$categories,null,['class'=>'form-control']) !!}



       </div>



       <div class="form-group">

           {!! Form::label('photo_id','Upload Photo: ') !!}
           {!! Form::file('photo_id',null,['class'=>'form-control']) !!}

       </div>

      <div class="form-group">
          {!! Form::label('body','Body: ') !!}
          {!! Form::textarea('body',null,['class'=>'form-control']) !!}

      </div>



       <div class="form-group">

           {!! Form::submit('Update post',['class'=>'btn btn-primary','style'=>'float:left']) !!}

       </div>

       {!! Form::close() !!}


          {{--forma za brisenje na post-ovite so method delete--}}
           {!! Form::open(['method'=>'Delete','action'=>['AdminPostsController@destroy',$post->id]]) !!}

           <div class="form-group">

               {!! Form::submit('Delete post',['class'=>'btn btn-danger','style'=>'margin-left:5%;']) !!}

           </div>

           {!! Form::close() !!}
    </div>
@endsection