<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct() {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Title
        $title = "Home";
        //Email confirmation status
        $emailConfirmedRecord = DB::table('email_confirmations')->where([
            ['user_id', '=', auth()->user()->id]
        ])->first();
        if ($emailConfirmedRecord->confirmed === 0) {
            $errors = ["Please do confirm your email! It let's us know this is a real account! (We dont spam!)"];
        } else {
            $errors = null;
        }
        // Getting recent 5 todos
        $today = Carbon::today()->toDateString();
        $todos = DB::table('to_dos')->where([['user_id', '=', auth()->user()->id]])->orderBy('created_at','desc')->take(5)->get();
        // Getting assignment statuses
        $assignments_complete = DB::table('assignments')->where([
            ['user_id', '=', auth()->user()->id],
            ['complete', '=', '1']
        ])->get();
        $assignments_overdue = DB::table('assignments')->where([
            ['user_id', '=', auth()->user()->id],
            ['due_date', '<', $today],
            ['complete', '=', '0']
        ])->get();
        $assignments_not_complete = DB::table('assignments')->where([
            ['user_id', '=', auth()->user()->id],
            ['complete', '=', '0']
        ])->get();
        // Getting 5 upcoming assignments
        $assignments = DB::table('assignments')->where([['user_id', '=', auth()->user()->id], ['due_date', '>', $today]])->orderBy('due_date', 'asc')->take(5)->get();
        // Getting recent 5 notes
        $notes = DB::table('notes')->where([['user_id', '=', auth()->user()->id]])->orderBy('created_at', 'desc')->take(5)->get();
        // Getting financial details
        $bankBalance = 0;
        $totalInForMonth = 0;
        $totalOutForMonth = 0;
        $recordsOutForMonth = DB::table('finances')->where([
            ['user_id', '=', auth()->user()->id],
            ['created_at', '>=', Carbon::now()->startOfMonth()],
            ['direction', '=', "Out"]
        ])->get();
        foreach ($recordsOutForMonth as $record) {
            $totalOutForMonth += $record->amount;
        }
        $recordsInForMonth = DB::table('finances')->where([
            ['user_id', '=', auth()->user()->id],
            ['created_at', '>=', Carbon::now()->startOfMonth()],
            ['direction', '=', "In"]
        ])->get();
        foreach ($recordsInForMonth as $record) {
            $totalInForMonth += $record->amount;
        }
        $bankBalanceRecord = DB::table('bank_balances')->where([
            ['user_id', '=', auth()->user()->id]
        ])->first();
        if ($bankBalanceRecord) {
            $bankBalance = $bankBalanceRecord->balance;
        } else {
            $bankBalance = 0;
        }
        $finances = DB::table('finances')->where([['user_id', '=', auth()->user()->id]])->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard.home', compact("title", "todos", "assignments_complete", "assignments_overdue", "assignments_not_complete", "assignments", "notes", "bankBalance", "totalInForMonth", "totalOutForMonth", "finances", "bankBalanceRecord"))->withErrors($errors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

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
