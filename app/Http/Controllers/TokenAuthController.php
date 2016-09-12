<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response as HttpResponse;

use JWTAuth;
use DateTime;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Illuminate\Support\Facades\Hash;

class TokenAuthController extends Controller
{
    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], HttpResponse::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function autoAuthenticate($user)
    {
        $user = (Object)$user;
        $credentials = [
            'email' => $user->email,
            'password' => $user->password,
        ];

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], HttpResponse::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function getProfile()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return  response()->json(['user_not_found'],  HttpResponse::HTTP_NOT_FOUND);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function postRegister(Request $request)
    {
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
            return response()->json(['error' => $e], 400);
        }
    }
}
