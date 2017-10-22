<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

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
        $roles = Role::lists('name','id')->all();/* ni vraca {
                                               1: "admin",
                                               2: "editor",
                                               3: "author",
                                               4: "subscriber"
                                              }*/

       return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

//return $request->all();
       // site name attributi gi stavame bo niza $input
       $input = $request->all();

        //proveruvame dali sme dobile file name preku post
        if($file = $request->file('file') ){
            //go zacuvuvame imeto na slikata + konkatinirame i vreme
            $name = time() . $file->getClientOriginalName();
            //ja premesuvame slikata vo images folder koj samse formira vo public folderot
            $file->move('images',$name);

            //kreirame slika i ja skladirame vo $photo objektot
            $photo = Photo::create(['path' => $name]);

            //na key:photo_id mu davame value na photo_id od tabelata
            $input['photo_id'] = $photo->id;
        }

        //go kriptuvame password-ot dobien so Post metodata a skladiran vo input nizata
        $input['password'] = bcrypt($request->password);

        //formirame nov user
       User::create($input);

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
        return view('admin.users.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
