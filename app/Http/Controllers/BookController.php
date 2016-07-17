<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorize('manageUsers');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('book/index', ['books' => $books]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book/create');
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
            'title' => 'required|alpha|max:255',
            'author' => 'required|alpha|max:255',
            'year' => 'required|numeric|min:0|max:'.date('Y'),
            'genre' => 'required|alpha|max:255'
        ];

        $validator = Validator::make($request->all(), $validate_r);

        if($validator->fails()){
            return Redirect::to('books/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $book = new Book();
            $book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;
            $book->save();

            Session::flash('message', 'Successfully added book');
            return Redirect::to('books');
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
        $book = Book::find($id);
        $users = $book->users()->paginate(10);
        return view('book/show', ['book'=>$book, 'users' => $users]);
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
        $book = Book::find($id);
        return view('book/edit', ['book'=>$book]);
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
        $validate_r = [
            'title' => 'required|alpha|max:255',
            'author' => 'required|alpha|max:255',
            'year' => 'required|numeric|min:0|max:'.date('Y'),
            'genre' => 'required|alpha|max:255'
        ];

        $validator = Validator::make($request->all(), $validate_r);

        if($validator->fails()){
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $book = Book::find($id);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;
            $book->save();

            Session::flash('message', 'Successfully updated book');
            return Redirect::to('books');
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
        Book::find($id)->delete();
        Session::flash('message', 'Successfully deleted book with Id: '.$id);
        return Redirect::back();
        //
    }
}
