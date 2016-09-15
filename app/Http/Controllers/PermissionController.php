<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use DateTime;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Exception;

use App\Permission; 

class PermissionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getPermission ($id = null) {
        if ( $id == null) {
            $permissions = Permission::orderBy('id', 'asc')->get();
        } else {
            $permissions = Permission::find($id);
        }
        return $this->response()->array($permissions);
    }
    /**
    * Post permission
    *
    */
    public function postPermission(Request $request) {
        $date = new DateTime();
        $status = HttpResponse::HTTP_CREATED;
        $permission = new Permission;

        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->description = $request->input('description');
        $permission->created_at =  $date;

        try {
            $permission->save(); 
            $response = $this->getPermission($permission->id);
            return $response->setStatusCode($status); 
        } catch (Exceptions $e) {
            return $this->response()->errorBadRequest();
        }
    }
    /**
     * Update Permission.
     * @param  Request  $request
     * @param  int|null $id
     * @return Response
     */
    public function updatePermission (Request $request, $id) {
        try{
            $date = new DateTime();
            $status = HttpResponse::HTTP_ACCEPTED;
            $permission = Permission::find($id);
            $permission->name = $request->input('name');
            $permission->display_name = $request->input('display_name');
            $permission->description = $request->input('description');
            $permission->updated_at =  $date;
            $permission->save();
            $response = $this->getPermission($permission->id);
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
    public function deletePermission (Request $request, $id) {
        $permission = Permission::find($id);
        try {
            // Regular Delete
            if(isset($permission)) {
                $permission->delete(); // This will work no matter what
                return $this->response()->noContent();
            }
            return $this->response()->errorNotFound();
        } catch(Exception $e) {
            return $this->response()->errorNotFound();
           }
     
    }
}
