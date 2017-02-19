<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\BadRequestHtttpException;

class TokenController extends Controller
{

    public function token()
    {
        $token = JWTAuth::getToken();
        if (!$token) {
            return $this->error('token_not_found', 401);
        }
        $token = JWTAuth::refresh($token);
        return response()->json($token);
    }

    public function usertoken()
    {
        $token = JWTAuth::getToken();
        if (!$token) {
            return 'token_not_found';
        } else {
            try {
                if (!$user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
                }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json([
                    'token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json([
                    'token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json([
                    'token_absent'], $e->getStatusCode());
            }
            return $user;
        }
    }

}
