<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use DateTime;

class RoleController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getRole ($id = null, $status = HttpResponse::HTTP_OK) {
        if ( $id == null) {
            $roles = Role::orderBy('id', 'asc')->get();
        } else {
            $roles = Role::find($id);
        }
        return response()->json($roles, $status);
    }
    /**
    * Post role
    *
    */
    public function postRole(Request $request) {
        $date = new DateTime();
        $status = HttpResponse::HTTP_CREATED;
        $role = new Role;

        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->created_at =  $date;

        try {
            $role->save();
            return $this->getRole($role->id, $status);
        } catch (Exceptions $e) {
            return response()->json(['error' => $e], 400);
        }
    }
    /**
     * Update Role.
     * @param  Request  $request
     * @param  int|null $id
     * @return Response
     */
    public function updateRole (Request $request, $id) {
        $date = new DateTime();
        $status = HttpResponse::HTTP_ACCEPTED;
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->updated_at =  $date;
        $role->save();
        return $this->getRole($role->id, $status);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteRole (Request $request, $id) {
        $status = HttpResponse::HTTP_NOT_FOUND;
        $role = Role::find($id);
        // Regular Delete
        $role->delete(); // This will work no matter what
        // Force Delete
        $role->users()->sync([]); // Delete relationship data
        $role->perms()->sync([]); // Delete relationship data
        $role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete
        return response()->json(null, $status);
    }
}
