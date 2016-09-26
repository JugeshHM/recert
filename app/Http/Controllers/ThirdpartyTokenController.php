<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use DateTime;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Exception;

use Webpatser\Uuid\Uuid;

use App\ThirdpartyToken; 


class ThirdpartyTokenController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getThirdpartyToken ($id = null) {
        if ( $id == null) {
            $tokens = ThirdpartyToken::orderBy('id', 'asc')->get();
        } else {
            $tokens = ThirdpartyToken::find($id);
        }
        return $this->response()->array($tokens);
    }
    /**
    * Post token
    *
    */
    public function postThirdpartyToken(Request $request) {
        $date = new DateTime();
        $status = HttpResponse::HTTP_CREATED;
        $token = new ThirdpartyToken;

        $token->token = Uuid::generate();
        $token->disable = false;
        $token->created_at =  $date;

        try {
            $token->save(); 
            $response = $this->getThirdpartyToken($token->id);
            return $response->setStatusCode($status); 
        } catch (Exceptions $e) {
            return $this->response()->errorBadRequest();
        }
    }
    /**
     * Update ThirdpartyToken.
     * @param  Request  $request
     * @param  int|null $id
     * @return Response
     */
    public function updateThirdpartyToken (Request $request, $id) {
        try{
            $date = new DateTime();
            $status = HttpResponse::HTTP_ACCEPTED;
            $token = ThirdpartyToken::find($id);
            $token->token = Uuid::generate();
            $token->disable = false;
            $token->updated_at =  $date;
            $token->save();
            $response = $this->getThirdpartyToken($token->id);
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
    public function deleteThirdpartyToken (Request $request, $id) {
        $token = ThirdpartyToken::find($id);

        try {
            // Regular Delete
            if(isset($token)) {
                $date = new DateTime();
                $token->disable = true;
                $token->updated_at =  $date;
                $token->save();
                return $this->response()->noContent();
            }
            return $this->response()->errorNotFound();
        } catch(Exception $e) {
            return $this->response()->errorNotFound();
        }
     
    }
}
