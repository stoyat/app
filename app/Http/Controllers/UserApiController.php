<?php

namespace App\Http\Controllers;

use App\User;

class UserApiController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if ($user === null) {
            return response()->json([], 404);
        }
        return response()->json($user, 200);
    }
}
