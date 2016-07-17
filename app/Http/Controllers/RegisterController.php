<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookUser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorize('manageRegister');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = BookUser::With(['user', 'book'])->orderBy('created_at', 'desc')->paginate(10);
        return view('register/index', ['records' => $records]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->lists('full_name', 'id');
        $books = Book::all()->lists('title', 'id');
        return view('register/create', ['users' => $users, 'books' => $books]);
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
        $validate_r = [
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
        ];

        $validator = Validator::make($request->all(), $validate_r);

        if($validator->fails()){
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $book = Book::find($request->book_id);
            $user = User::find($request->user_id);
            $user->books()->attach($book->id);

            Session::flash('message', 'Successfully assigned book id '.$book->id.' for user id '.$user->id);
            return Redirect::to('home');
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
        return Redirect::back();
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
        return Redirect::back();
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
        return Redirect::back();
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
        BookUser::find($id)->delete();
        Session::flash('message', 'Successfully deleted record with Id: '.$id);
        return Redirect::back();
    }
}
