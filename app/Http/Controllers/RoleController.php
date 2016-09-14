<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use DateTime;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Exception;

use App\Role; 

class RoleController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getRole ($id = null) {
        if ( $id == null) {
            $roles = Role::orderBy('id', 'asc')->get();
        } else {
            $roles = Role::find($id);
        }
        return $this->response()->array($roles);
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
            $response = $this->getRole($role->id);
            return $response->setStatusCode($status); 
        } catch (Exceptions $e) {
            return $this->response()->errorBadRequest();
        }
    }
    /**
     * Update Role.
     * @param  Request  $request
     * @param  int|null $id
     * @return Response
     */
    public function updateRole (Request $request, $id) {
        try{
            $date = new DateTime();
            $status = HttpResponse::HTTP_ACCEPTED;
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            $role->updated_at =  $date;
            $role->save();
            $response = $this->getRole($role->id);
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
    public function deleteRole (Request $request, $id) {
        try{
            $role = Role::find($id);
            // Regular Delete
            if($role)
            $role->delete(); // This will work no matter what
            return $this->response()->noContent();
        } catch(Exception $e) {
            return $this->response()->errorNotFound();
            }
     
    }
}
