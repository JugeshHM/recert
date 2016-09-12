<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser($id = null, $status = HttpResponse::HTTP_OK) {
        if ( $id == null) {
            $users = User::orderBy('id', 'asc')->get();
        } else {
            $users = User::find($id);
        }
        return response()->json($users, $status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id) {
        $status = HttpResponse::HTTP_ACCEPTED;
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return $this->getUser($user->id, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id) {
        $status = HttpResponse::HTTP_NO_CONTENT;
        $user = User::find($id);
        $user->delete();
        return response()->json(null, $status);
    }
}
