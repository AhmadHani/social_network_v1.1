<?php

namespace App\Http\Controllers;
use App\User;
use Session;
use Illuminate\Http\Request;
use Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
              'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'gender'=>"required|bool",
            'about'=>"min:10|max:300"
            


        ]);

        if($request->input("username") != Auth::user()->username){

        
        
        $this->validate($request,[
            'username'=>"required|min:3|max:27|unique:users"


        ]);
        }
        if($request->input("email") != Auth::user()->email){

        
        $this->validate($request,[
                        'email' => 'required|string|email|max:255|unique:users',
        ]);
        }
        Auth::user()->update([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'gender'=>$request->gender
        ]);
        Auth::user()->profile()->update([
            'about'=>$request->about,
            'location'=>$request->location,
            'date_birth'=>$request->date_birth
        ]);
        if($request->hasFile("avatar")){
            Auth::user()->update([
                'avatar'=>$request->avatar->store("public/avatars")
            ]);
        }
        Session::flash("success","Profile Updated!");
        return redirect()->route("profile.show",['username'=>Auth::user()->username]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::where("username",$username)->first();
        return view("profile.show")->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
                $user = User::where("username",$username)->first();
                return view("profile.edit")->withUser($user);

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
