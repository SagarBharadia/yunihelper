<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Mail;

class RegistrationController extends Controller
{

    public function __construct() {
      $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Register";
        return view('staticpages.register', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {

        $user = User::create([
            'firstname' => request('firstname'),
            'lastname' => request('lastname'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'username' => strtolower(request('username'))
        ]);

        auth()->login($user);

        $confirmationToken = str_random(16);

        DB::table('email_confirmations')->insert([
            'user_id' => auth()->user()->id,
            'token' => $confirmationToken,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $confirmationUrl = url('/') . "/user/" . auth()->user()->id . "/confirmEmail/" . $confirmationToken;

        $data = ['confirmationUrl' => $confirmationUrl];
        $template_path = 'emails.emailconfirmation';


        Mail::send($template_path, $data, function($message) {
            // Set the receiver and subject of the mail.
            $message->to(auth()->user()->email, "YuniHelper")->subject('Please confirm your email');
            // Set the sender
            $message->from('yunihelper@hotmail.com','YuniHelper');
        });


        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
