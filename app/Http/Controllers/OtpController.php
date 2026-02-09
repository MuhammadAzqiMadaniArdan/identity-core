<?php

namespace App\Http\Controllers;

use App\Jobs\SendOtpEmailJob;
use App\Models\EmailOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
{
    public function request(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'email' => 'required|email|max:255'
            ]);
            
            $code = random_int(100000, 999999);
            
            EmailOtp::where('email',$request->email)->whereNull('used_at')->update(['used_at' => now()]);
            
            EmailOtp::create([
                'email' => $request->email,
                'code_hash' => Hash::make($code),
                'expires_at' => now()->addMinutes(5)
            ]);

            DB::commit();

            dispatch(new SendOtpEmailJob($request->email,$code));
            
            return view('auth.verify-otp',[
                'email' => $request->email
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function verify(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'email' => 'required|email|max:255',
                'code' => 'required|digits:6',
            ]);
            
            $otp = EmailOtp::where('email', $request->email)->whereNull('used_at')->where('expires_at', '>', now())->latest()->lockForUpdate()->first();
            
            if (!$otp || ! Hash::check($request->code, $otp->code_hash)) {
                abort(401, 'Invalid OTP');
            }

            $otp->update(['used_at' => now()]);

            $user = User::firstOrCreate(['email' => $request->email], ['email_verified_at' => now()]);

            DB::commit();
            Auth::login($user);

            return redirect()->intended('/oauth/authorize');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
