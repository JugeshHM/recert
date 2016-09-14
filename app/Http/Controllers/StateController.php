<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use DateTime;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Exception;

use App\State;


class StateController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getState ($id = null) {
        if ( $id == null) {
            $states = State::orderBy('id', 'asc')->get();
        } else {
            $states = State::find($id);
        }
        return $this->response()->array($states);
    }
    /**
    * Post state
    *
    */
    public function postState(Request $request) {
        $date = new DateTime();
        $status = HttpResponse::HTTP_CREATED;
        $state = new State;

        $state->name = $request->input('name');
        $state->display_name = $request->input('display_name');
        $state->description = $request->input('description');
        $state->created_at =  $date;

        try {
             $state->save();
             $response = $this->getState($state->id);
             return $response->setStatusCode($status); 
        } catch (Exceptions $e) {
             return $this->response()->errorBadRequest();
        }
    }
    /**
     * Update state.
     * @param  Request  $request
     * @param  int|null $id
     * @return Response
     */
    public function updateState (Request $request, $id) {
        try {
            $date = new DateTime();
            $status = HttpResponse::HTTP_ACCEPTED;
            $state = State::find($id);
            $state->name = $request->input('name');
            $state->display_name = $request->input('display_name');
            $state->description = $request->input('description');
            $state->updated_at =  $date;
            $state->save();
            $response = $this->getState($state->id);
            return $response->setStatusCode($status);
        } catch (Exception $e) {
            return $this->response()->errorNotFound();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteState (Request $request, $id) {
        try{
            $state = State::find($id);
             // Regular Delete
            if($state)
            $state->delete(); // This will work no matter what
            return $this->response()->noContent();
        } catch(Exception $e) {
            return $this->response()->errorNotFound();
        }
    }
}
