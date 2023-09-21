<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(LoginRequest $req)
    {

        $credentials = $req->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Your password is incorrect'
            ], 401);
        } else {
            $token = $req->user()->createToken(Auth::user()->name);
            $data = [
                '_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse()->toDateTimeString()
            ];
            return response()->json([
                $data
            ], 200);
        }
    }
}
