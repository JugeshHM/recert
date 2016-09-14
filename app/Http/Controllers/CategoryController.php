<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use DateTime;

class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getCategory ($id = null, $status = HttpResponse::HTTP_OK) {
        if ( $id == null) {
            $categories = Category::orderBy('id', 'asc')->get();
        } else {
            $categories = Category::find($id);
        }
        return response()->json($categories, $status);
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
        $category->created_at =  $date;

        try {
            $category->save();
            return $this->getCategory($category->id, $status);
        } catch (Exceptions $e) {
            return response()->json(['error' => $e], 400);
        }
    }
    /**
     * Update Category.
     * @param  Request  $request
     * @param  int|null $id
     * @return Response
     */
    public function updateCategory (Request $request, $id) {
        $date = new DateTime();
        $status = HttpResponse::HTTP_ACCEPTED;
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->display_name = $request->input('display_name');
        $category->description = $request->input('description');
        $category->updated_at =  $date;
        $category->save();
        return $this->getCategory($category->id, $status);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteCategory (Request $request, $id) {
        $status = HttpResponse::HTTP_NOT_FOUND;
        $category = Category::find($id);
        // Regular Delete
        $category->delete(); // This will work no matter what
        // Force Delete
        //$category->users()->sync([]); // Delete relationship data
        //$category->perms()->sync([]); // Delete relationship data
        //$category->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete
        return response()->json(null, $status);
    }
}
