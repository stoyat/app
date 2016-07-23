<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books, 200);
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
            return response()->json([], 422);
        } else {
            $book = new Book();
            $book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;
            $book->save();

            return response()->json($book, 201);
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
        if($book === null) {
            return response()->json([], 404);
        }
        return response()->json($book, 200);
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
        $book = Book::find($id);
        if($book === null) {
            return response()->json([], 404);
        }
        $book->delete();
        return response()->json([], 200);
        //
    }
}
