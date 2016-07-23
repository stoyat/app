<?php

namespace App\Http\Controllers;

use App\BookUser;
use App\User;
use Illuminate\Http\Request;

class UserBookApiController extends Controller
{

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

        if ($validator->fails()) {
            return response()->json([], 422);
        } else {
            $book = Book::find($request->book_id);
            $user = User::find($request->user_id);
            $user->books()->attach($book->id);
            return response()->json([], 201);
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
        $User = User::find($id);
        if ($User === null) {
            return response()->json($User->books, 200);
        } else {
            return response()->json([], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = BookUser::find($id);
        if ($user === null) {
            $statusCode = 404;
        } else {
            $user->delete();
            $statusCode = 200;
        }
        return response()->json([], $statusCode);
    }
}
