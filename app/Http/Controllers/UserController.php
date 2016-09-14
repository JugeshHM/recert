<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Exception;

use App\User;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser($id = null) {
        if ( $id == null) {
            $users = User::orderBy('id', 'asc')->get();
        } else {
            $users = User::find($id);
        }
        return $this->response()->array($users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id) {
        try {
            $status = HttpResponse::HTTP_ACCEPTED;
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            $response=$this->getUser($user->id);
            return $response->setStatusCode($status);
        } catch(Exception $e) {
            return $this->response()->errorNotFound();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id) {
        try{
            $user = User::find($id);
            if($user)
            $user->delete();
            return $this->response()->noContent();
        } catch(Exception $e) {
            return $this->response()->errorNotFound();
        }
        
    }
}
