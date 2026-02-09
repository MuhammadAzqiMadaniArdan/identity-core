<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TokenController extends Controller
{
    public function handle(Request $request)
    {
        Log::info($request->cookie());
        if($request->cookie('refresh_token'))
        {
            return $this->refresh($request);
            
        }
        return $this->issue($request);
    }
    public function issue(Request $request)
    {
        Log::info("pakai issue");
        $tokenRequest = Request::create(
            '/oauth/token',
            'POST',
            $request->all()
        );

        $response = app()->handle($tokenRequest);

        $data = json_decode($response->getContent(),true);

        if(!isset($data['refresh_token']))
        {
            return $response;
        }

        $cookie = cookie(
            'refresh_token',
            $data['refresh_token'],
            60 * 24 * 30, // sebulan
            '/',
            null,
            true,
            true,
            false,
            'Strict'
        );

        unset($data['refresh_token']);

        return response()->json($data)->withCookie($cookie);
    }

    public function refresh(Request $request)
    {
        Log::info("pakai refresh");

        $refreshToken = $request->cookie('refresh_token');
        
        if(!$refreshToken){
            return response()->json([
                'message' => "unauthorize"
            ],Response::HTTP_UNAUTHORIZED);
        }

        $tokenRequest = Request::create('oauth/token','POST',[
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => config('services.passport.avera_client_web_id')
        ]);

        $response = app()->handle($tokenRequest);
        $data = json_decode($response->getContent(),true);

        if(!isset($data['access_token']))
        {
            return response()->json(["message" => 'Akses unauthorize'],Response::HTTP_UNAUTHORIZED);
        }

        $cookie = cookie(
            'refresh_token',
            $data['refresh_token'],
            60 * 24 * 7,
            '/',
            null,
            true,
            true,
            false,
            'Strict'
        );

        unset($data['refresh_token']);

        return response()->json($data)->withCookie($cookie);
    }
}
