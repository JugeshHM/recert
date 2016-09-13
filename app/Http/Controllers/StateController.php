<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\State;
use DateTime;

class StateController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getState ($id = null, $status = HttpResponse::HTTP_OK) {
        if ( $id == null) {
            $states = State::orderBy('id', 'asc')->get();
        } else {
            $states = State::find($id);
        }
        return response()->json($states, $status);
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
            return $this->getState($state->id, $status);
        } catch (Exceptions $e) {
            return response()->json(['error' => $e], 400);
        }
    }
    /**
     * Update state.
     * @param  Request  $request
     * @param  int|null $id
     * @return Response
     */
    public function updateState (Request $request, $id) {
        $date = new DateTime();
        $status = HttpResponse::HTTP_ACCEPTED;
        $state = State::find($id);
        $state->name = $request->input('name');
        $state->display_name = $request->input('display_name');
        $state->description = $request->input('description');
        $state->updated_at =  $date;
        $state->save();
        return $this->getState($state->id, $status);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteState (Request $request, $id) {
        $status = HttpResponse::HTTP_NOT_FOUND;
        $state = State::find($id);
        // Regular Delete
        $state->delete(); // This will work no matter what
        // Force Delete
        $state->users()->sync([]); // Delete relationship data
        $state->perms()->sync([]); // Delete relationship data
        $state->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete
        return response()->json(null, $status);
    }
}
