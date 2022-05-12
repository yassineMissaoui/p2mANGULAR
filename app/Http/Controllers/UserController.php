<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
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
        $email = User::where('email', $request->input('email'))->first();
        if(!$email){
            $user = User::create($request->all());
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['user' => null]);
        }
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
        $user = User::find($id);
        return response()->json(['user' => $user]);
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
        $user = User::find($id);
        $user->update([ "name" => $request->name ,"email" => $request->email ,"password" => bcrypt($request->password) ,"contact" => $request->contact , "address" => $request->address]);
        return response()->json(['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['user' => 0]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if(auth()->attempt($loginData)) {
                return response()->json(['user' => auth()->user()]);

 
        } else {
            return response()->json(['user' => 0]);
        }

    }

    public function register(Request $request)
    {      
        
            $validatedData = $request->validate([

                'name'=>'required|max:55',
                'email'=>'email|required|',
                'password' => 'required|',
                'contact' => 'max:20|',
                'address'=>'max:400|',
            ]);
            
            // return $request;
            $validatedData['password'] = bcrypt($request->password);

            // return $request;
            $user = User::create($validatedData); 

        return response(['user'=> $user]);
    }
}
