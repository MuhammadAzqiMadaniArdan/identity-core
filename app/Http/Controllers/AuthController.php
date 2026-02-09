<?php

namespace App\Http\Controllers;

use App\Events\SendEmailVerification;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Jobs\SendResetPasswordEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginView(Request $request)
    {
        return view('auth.login');
    }
    public function logout(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    "message" => "User Not Authenticated",
                ], Response::HTTP_UNAUTHORIZED);
            }

            $user->tokens->each(function ($token) {
                $token->revoked = true;
                $token->save();
            });

            $tokenIds = $user->tokens->pluck('id')->toArray();

            if (!empty($tokenIds) && $request->cookie('refresh_token')) {
                DB::table('oauth_refresh_tokens')->whereIn('access_token_id', $tokenIds)->where('revoked', false)->update(['revoked' => true]);
            }
            DB::commit();
            return response()->json(["message"])->withCookie(Cookie::forget('refresh_token'))->withCookie(Cookie::forget(config('session.cookie')));
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
