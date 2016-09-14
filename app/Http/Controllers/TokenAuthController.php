<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DateTime;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use App\User;

class TokenAuthController extends Controller
{
    public function postLogin(Request $request) {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->response()->errorUnauthorized('invalid_credentials');
            }
        } catch (JWTException $e) {
            return $this->response()->errorInternal('could_not_create_token');
        }

        // if no errors are encountered we can return a JWT
        return $this->response()->array(compact('token'));
    }

    public function autoAuthenticate($user) {
        $user = (Object)$user;
        $credentials = [
            'email' => $user->email,
            'password' => $user->password,
        ];

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->response()->errorUnauthorized('invalid_credentials');
            }
        } catch (JWTException $e) {
            return $this->response()->errorInternal('could_not_create_token');
        }

        // if no errors are encountered we can return a JWT
        return $this->response()->array(compact('token'));
    }

    public function getProfile() {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return  $this->response()->errorNotFound('user_not_found');
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return $this->response()->errorUnauthorized('token_expired');
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->response()->errorUnauthorized('token_invalid');
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return $this->response()->errorUnauthorized('token_absent');
        }
        return $this->response()->array(compact('user'));
    }

    public function postRegister(Request $request) {
        $date = new DateTime();
        $newuser = [
            'name' => $date->getTimestamp(),
            'email' => $request->input('email')
        ];
        $tempdata = array_merge($newuser, array('password' => $request->input('password')));
        $password = Hash::make($request->input('password'));
        $newuser['password'] = $password;
        try {
            User::create($newuser);
            return $this->autoAuthenticate($tempdata);
        } catch (Exceptions $e) {
            return $this->response()->errorBadRequest('Bad Request');
        }
    }
}
