@extends('layouts.admin')

@section('content')

 <div class="col-sm-6">
     <h2>Add category</h2>
     @include('includes.formerrors')




     {!! Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store']) !!}



     <div class="form-group">

         {!! Form::label('name','Category: ') !!}
         {!! Form::text('name',null,['class'=>'form-control']) !!}

     </div>





     <div class="form-group">

         {!! Form::submit('Create category',['class'=>'btn btn-primary']) !!}

     </div>

     {!! Form::close() !!}

 </div>

    <div class="col-sm-6">
        <h2>Categories</h2>
        @if(session('category_added'))
           <p class="alert alert-success"> {{session('category_added')}}</p>
        @endif

        @if(session('category_updated'))
            <p class="alert alert-warning"> {{session('category_updated')}}</p>
        @endif

        @if(session('category_deleted'))
            <p class="alert alert-danger"> {{session('category_deleted')}}</p>
        @endif

    <table class="table table-striped table-hover ">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
            <th>Created at</th>
        </tr>
      </thead>
      <tbody>
      @if($categories)
          @foreach($categories as $category)
        <tr>
          <td>{{$category->id}}</td>
          <td><a href="{{route('admin.categories.edit',$category->id)}}">{{$category->name}}</a></td>
          <td>{{$category->created_at?$category->created_at->diffForHumans():''}}</td>
        </tr>
        @endforeach
      @endif
      </tbody>
    </table>
    </div>

@endsection