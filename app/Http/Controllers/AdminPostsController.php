<?php

namespace App\Http\Controllers;

use App\Category;
use App\CommentReply;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
//treba ovaa klasa session za flash(oti ima uste edna)
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::all();
        
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = Category::lists('name','id')->all();// se formira {'1'=>'Php','2'=>'Javascript','3'=>'Laravel','4'=>'React'}


        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //nizata od cel request od gormata ja stavame vo input nizata
        $input = $request->all();

        //go zacuvuvame avtentificiraniot user vo $user promenlivata
         $user = Auth::user();

        //prasuvame dali imame  request photo_id kako file i go zacuvuvame vo $file
        if($file = $request->file('photo_id')){

            //konktinirame momentalno vreme na originalnoto ime na slikata
            $name = time().$file->getClientOriginalName();

            //kreirame $photo so imeto od requestot kako value
            $photo  = Photo::create(['path'=>$name]);

            //ja premestuvame slikata od temporalniot folder vo /public/images
            $file->move('images',$name);

            //na key:photo_id mu davame value na photo_id od tabelata
            $input['photo_id'] = $photo->id;
        }
        
        
       //preku relacijata so user( so cel za da go zacuvame user_id vo posts tabelata) formirame nov posts($input parametarot e niza)
          $user->posts()->create($input);

        $request->session()->flash('post_is_inserted','Post is inserted');

        return redirect('/admin/posts');
      

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        $categories = Category::lists('name','id')->all();
        
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request, $id)
    {

        $input =$request->all();


        $post = Post::findOrFail($id);
        
        if($file = $request->file('photo_id')){
            $name =  time().$file->getClientOriginalName();

            $file->move('images',$name);

            $photo =  Photo::create(['path'=>$name]);

            $input['photo_id'] = $photo->id;

        }

        //go naodjame prviot post na user-ot so konkreten id i mu pravime update
        Auth::user()->posts()->whereId($id)->first()->update($input);

        $request->session()->flash('updated_post','Post has been updated');

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {


        $post =Post::find($id);

        //prvin ja briseme slikata od public/images folderot ,pa duri potoa go briseme post-ot
        unlink(public_path(). $post->photo->path);

        $post->delete();


        $request->session()->flash('deleted_post','Post is deleted');

        return redirect('admin/posts');
    }


    public function post($id) {

        $post   = Post::findOrFail($id);

        $comments = $post->comments()->where('is_active',1)->get();

        $comment_replies = CommentReply::where('is_active',1)->get();
        

        return view('post',compact('post','comments','comment_replies'));
    }

}
