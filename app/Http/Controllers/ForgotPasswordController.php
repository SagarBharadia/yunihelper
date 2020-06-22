<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Mail;

class ForgotPasswordController extends Controller
{
    public function forgotPassword() {
    	$title = "Forgot Password";
    	return view('staticpages.forgotpassword', compact('title'));
    }
    public function forgotPasswordEmail(ForgotPasswordRequest $request) {

    	$resetToken = str_random(16);

        $id = DB::table('reset_password')->insertGetId([
        	'email' => request('email'),
            'token' => $resetToken,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $confirmationUrl = url('/') . "/resetpassword/" . $id . "/" . $resetToken;

        $data = ['confirmationUrl' => $confirmationUrl];
        $template_path = 'emails.resetpassword';


        Mail::send($template_path, $data, function($message) {
            // Set the receiver and subject of the mail.
            $message->to(request('email'), "YuniHelper")->subject('Reset your password');
            // Set the sender
            $message->from('yunihelper@hotmail.com','YuniHelper');
        });

        $errors = ['Please check your inbox for the email reset link!'];
        return redirect()->back()->withErrors($errors);

    }
    public function resetPasswordView($id, $resetPasswordToken) {
    	$exists = DB::table('reset_password')->where([ ['id', '=', $id], ['token', '=', $resetPasswordToken], ['reset', '=', 0] ])->latest()->first();
    	if (count($exists) > 0) {
    		$title = "Reset Password";
    		return view('staticpages.resetpassword', compact('title', 'id', 'resetPasswordToken'));
    	} else {
    		$errors = "Looks like that password reset link has already been used. Need another one?";
    		return redirect('/forgotpassword')->withErrors($errors);
    	}
    }
    public function resetPassword(Request $request) {
    	$request->validate([
            'password' => 'required'
        ]);
        $resetRecord = DB::table('reset_password')->where([ ['id', '=', request('id')], ['token', '=', request('resetPasswordToken')], ['reset', '=', 0] ])->latest()->first();
    	if (count($resetRecord)>0) {
    		$email = $resetRecord->email;
    		DB::table('users')->where([ ['email', '=', $email] ])->update(['password' => bcrypt(request('password')) ]);
    		DB::table('reset_password')->where([ ['id', '=', $resetRecord->id] ])->update(['reset' => 1]);
    		$errors = "Your password has been reset! Please login again.";
    		return redirect()->route('login')->withErrors($errors);
    	} else {
    		$errors = "nope";
    		return redirect('/forgotpassword')->withErrors($errors);
    	}
    }
}
