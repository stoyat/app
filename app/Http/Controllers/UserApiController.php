<?php

namespace App\Http\Controllers;

use App\User;

class UserApiController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $this->authorize('manageUsers');
        $validate_r = [
            'firstname' => 'required|alpha|max:255',
            'lastname' => 'required|alpha|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        $validator = Validator::make($request->all(), $validate_r);

        if($validator->fails()){
            return response()->json([], 422);
        } else {
            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json($user, 200);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::With('books')->find($id);
        if ($user === null) {
            return response()->json([], 404);
        }
        return response()->json($user, 200);
    }
}
