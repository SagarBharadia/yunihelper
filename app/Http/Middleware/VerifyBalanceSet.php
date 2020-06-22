<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;

use Closure;


class VerifyBalanceSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       	$balance = DB::table('bank_balances')->where([
            ['user_id', '=', auth()->user()->id]
       	])->first();
       	if ($balance === null) {
        	return redirect()->route('finances');
       	}

       	return $next($request);
    }

}