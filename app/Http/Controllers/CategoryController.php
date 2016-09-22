<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use DateTime;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Exception;

use App\Category;



class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getCategory ($id = null) {
        if ( $id == null) {
            $categories = Category::orderBy('id', 'asc')->get();
        } else {
            $categories = Category::find($id);
        }
        return $this->response()->array($categories);
    }
    /**
    * Post Category
    *
    */
    public function postCategory(Request $request) {
        $date = new DateTime();
        $status = HttpResponse::HTTP_CREATED;
        $category = new Category;

        $category->name = $request->input('name');
        $category->display_name = $request->input('display_name');
        $category->description = $request->input('description');
        $category->parent_cat = $request->input('parent_cat');
        $category->course_hours = $request->input('course_hours');
        $category->created_at =  $date;

        try {
            $category->save();
            $response = $this->getCategory($category->id);
            return $response->setStatusCode($status);
        } catch (Exceptions $e) {
            return $this->response()->errorBadRequest();
        }
    }
    /**
     * Update Category.
     * @param  Request  $request
     * @param  int|null $id
     * @return Response
     */
    public function updateCategory (Request $request, $id) {
        try{
        $date = new DateTime();
        $status = HttpResponse::HTTP_ACCEPTED;
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->display_name = $request->input('display_name');
        $category->description = $request->input('description');
        $category->parent_cat = $request->input('parent_cat');
        $category->course_hours = $request->input('course_hours');
        $category->updated_at =  $date;
        $category->save();
        $response = $this->getCategory($category->id);
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
    public function deleteCategory (Request $request, $id) {
        $category = Category::find($id);
        // Regular Delete
        try {           
             // Regular Delete
            if(isset($category)) {
                $category->delete(); // This will work no matter what // This will work no matter what
                return $this->response()->noContent();
            }
            return $this->response()->errorNotFound();
        } catch(Exception $e) {
            return $this->response()->errorNotFound();
        }
    }
}
