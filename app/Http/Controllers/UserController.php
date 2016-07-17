<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('manageUsers');
        $users = User::paginate(10);
        return view('user/index', ['users' => $users]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('manageUsers');
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('manageUsers');
        $validate_r = [
            'firstname' => 'required|alpha|max:255',
            'lastname' => 'required|alpha|max:255',
            'email' => 'required|email|unique:users',
        ];

        $validator = Validator::make($request->all(), $validate_r);

        if($validator->fails()){
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->save();

            Session::flash('message', 'Successfully created user');
            return Redirect::back();
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
        $this->authorize('manageUsers');
        $user = User::find($id);
        $books = $user->books()->paginate(10);
        return view('user/show', [ 'user' => $user, 'books' => $books]);
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
        $this->authorize('edit', $user);
        return view('user/edit', [ 'user' => $user]);
        //
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
        $this->authorize('edit', $user);

        $validate_r = [
            'firstname' => 'required|alpha|max:255',
            'lastname' => 'required|alpha|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'min:6|confirmed'
        ];

        $validator = Validator::make($request->all(), $validate_r);

        if($validator->fails()){
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;

            if($request->password != '')
                $user->password = bcrypt($request->password);

            $user->save();

            Session::flash('message', 'Successfully updated');
            return Redirect::back();
        }
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
        $this->authorize('manageUsers');
        User::find($id)->delete();
        Session::flash('message', 'Successfully deleted user with Id: '.$id);
        return Redirect::back();
        //
    }
}
