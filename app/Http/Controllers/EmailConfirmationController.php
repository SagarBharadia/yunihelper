<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmailConfirmationController extends Controller
{
    /**
     * Confirm the registered users email
     * 
     * @param int $id
     * @param string $confirmationToken
     * @return \Illuminate\Http\Response
     */
    public function confirmEmail($user_id, $confirmationToken) {
    	$confirmationRecord = DB::table('email_confirmations')->where('user_id', '=', $user_id)->first();

        if ( ($confirmationToken === $confirmationRecord->token) && ($confirmationRecord->confirmed === 0) ) {
            DB::table('email_confirmations')->where([['user_id', '=', $user_id], ['token', '=', $confirmationToken]])->update(['confirmed' => 1]);
            $message = "Perfect! Thanks for confirming your email! Thats all for now.";
            return redirect()->route('dashboard')->with('message', $message);
        } else {
            return redirect()->route('dashboard');
        }

    }
}
