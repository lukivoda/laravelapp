<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users =  User::all();

      return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $roles =  Role::lists('name','id')->all();;/* ni vraca {
                                               1: "admin",
                                               2: "editor",
                                               3: "author",
                                               4: "subscriber"
                                              }*/


        return view('admin.posts.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        if($request->password == ''){
            $input =$request->except('password');
        }else {
            // site name attributi gi stavame bo niza $input
            $input = $request->all();
            //go kriptuvame password-ot dobien so Post metodata a skladiran vo input nizata
            $input['password'] = bcrypt($request->password);
        }






        //proveruvame dali sme dobile file name preku post method-ot
        if($file = $request->file('file') ){
            //go zacuvuvame imeto na slikata + konkatinirame i vreme za da imame edinecno ime na slikite
            $name = time() . $file->getClientOriginalName();
            //ja premesuvame slikata vo images folder koj sam se formira vo public folderot
            $file->move('images',$name);

            //kreirame slika i ja skladirame vo $photo objektot
            $photo = Photo::create(['path' => $name]);

            //na key:photo_id mu davame value na photo_id od tabelata
            $input['photo_id'] = $photo->id;
        }




        //formirame nov user
       User::create($input);
        
        Session::flash('added_user','User created');

       // refresh na admin/user
     return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user  = User::findOrFail($id);

        $roles = Role::lists('name','id')->all();/* ni vraca {
                                               1: "admin",
                                               2: "editor",
                                               3: "author",
                                               4: "subscriber"
                                              }*/

        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {

        if($request->password == ''){
            $input = $request->all();
            //$input = $request->except('password');
            //ako ne vneseme password ostanuva istiot password
            $input['password'] = User::findOrFail($id)->password;
        }else {
            // site name attributi gi stavame bo niza $input
            $input = $request->all();
            //go kriptuvame password-ot dobien so Post metodata a skladiran vo input nizata
            $input['password'] = bcrypt($request->password);
        }



        $user = User::findOrFail($id);

        //proveruvame dali sme dobile file name preku post method-ot
        if($file = $request->file('file')) {
            //go zacuvuvame imeto na slikata + konkatinirame i vreme za da imame edinecno ime na slikite
            $name = time() . $file->getClientOriginalName();
            //ja premesuvame slikata vo images folder koj sam se formira vo public folderot
            $file->move('images',$name);

            //kreirame slika i ja skladirame vo $photo objektot
            $photo  = Photo::create(['path'=>$name]);

            //na key:photo_id mu davame value na photo_id od tabelata
            $input['photo_id'] = $photo->id;


        }


       $user->update($input);

    Session::flash('updated_user','User has been updated');

        return redirect('admin/users');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $user =User::findOrFail($id);

        //briseme slikata od public/images(nema potreba da pisuvame /images/ oti go imame vo accessor vo Photo modelot)
        unlink(public_path().$user->photo->path);
        
        $user->delete();


    //formirame sesija so edna poraka koja isceznuva po edna egzekucija vo /admin/users
        Session::flash('deleted_user','User is deleted');

        return redirect('/admin/users');
    }
}
