<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminMediasController extends Controller
{
   public function index() {

       $photos =Photo::all();

       return view('admin.media.index',compact('photos'));
   }


    public function create(){


    return view('admin.media.create');
}


    public function store(Request $request){

        $file = $request->file('file');

        $name =time().$file->getClientOriginalExtension();

        $file->move('images',$name);

        //slikata ja uploadirame vo databazata
        Photo::create(['path'=>$name]);

        return redirect('/admin/media');
    }


    public function destroy($id){

        $photo = Photo::findOrFail($id);

        unlink(public_path().$photo->path);


        $photo->delete();

        Session::flash('photo_deleted',"Photo is deleted");

        return redirect('admin/media');

    }

}
