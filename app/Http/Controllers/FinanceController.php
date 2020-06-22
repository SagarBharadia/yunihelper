<?php

namespace App\Http\Controllers;

use App\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreFinanceRequest;
use App\Http\Requests\UpdateFinanceRequest;
use App\Http\Requests\SetBalanceRequest;
use Carbon\Carbon;

use Mail;

class FinanceController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function permission(Finance $finance) {
        $user = app('auth')->user();

        if ($finance->user_id === $user->id) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Finances";
        $totalOutForMonth = 0;
        $totalInForMonth = 0;
        $bankBalance = 0;
        $bankBalanceSet = false;

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
            $bankBalanceSet = true;
        } else {
            $bankBalance = 0;
        }

        $tenMostRecentRecords = DB::table('finances')->where([
            ['user_id', '=', auth()->user()->id]
        ])->orderBy('created_at', 'desc')->take(10)->get();

        return view('dashboard.finances.index', compact('title', 'totalOutForMonth', 'totalInForMonth', 'bankBalance', 'tenMostRecentRecords', 'bankBalanceSet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New Purchase";
        return view('dashboard.finances.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinanceRequest $request)
    {
        $finance = Finance::create([
            'name' => request('name'),
            'amount' => request('amount'),
            'reason' => request('reason'),
            'direction' => request('direction'),
            'user_id' => auth()->id()
        ]);

        $bankBalance = DB::table('bank_balances')->where([
                        ['user_id', '=', auth()->user()->id]
                    ])->first();

        if (request('direction') == 'In') {
            $newBalance = $bankBalance->balance + request("amount");
            DB::update('update bank_balances set balance = ? where user_id = ?',[$newBalance,auth()->user()->id]);
        } else if (request('direction') == 'Out') {
            $newBalance = $bankBalance->balance - request("amount");
            DB::update('update bank_balances set balance = ? where user_id = ?',[$newBalance,auth()->user()->id]);
        }

      return redirect()->route('finances');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
        if ($this->permission($finance)) {
            $title = $finance->name;
            return view('dashboard.finances.show', compact('title', 'finance'));
        } else {
            $errors = [
                "You do not have permission to view that resource!"
            ];
            return redirect()->route('finances')->withErrors($errors);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Finance $finance)
    {

        if ($this->permission($finance)) {
            $title = "Edit Financial Record";
            return view('dashboard.finances.edit', compact('title', 'finance'));
        } else {
            $errors = [
                "You do not have permission to view that resource!"
            ];
            return redirect()->route('finances')->withErrors($errors);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinanceRequest $request, Finance $finance)
    {
        if ($this->permission($finance)) {
            $finance->name = request('name');
            $finance->amount = request('amount');
            $finance->direction = request('direction');
            $finance->reason = request('reason');
            $finance->save();
            return redirect()->route('finances')->with('message', 'Finance record updated.');
        } else {
            $errors = [
                "You do not have permission to update that resource!"
            ];
            return redirect()->route('finances')->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance $finance)
    {
        if ($this->permission($finance)) {
            $userBalance = DB::table('bank_balances')->where('user_id', '=', auth()->user()->id)->first();
            $newUserBalance = $userBalance->balance + $finance->amount;

            DB::table('bank_balances')->where('user_id', '=', auth()->user()->id)->update(['balance' => $newUserBalance]);

            $finance->delete();
            return redirect()->route('finances')->with('message', 'Record deleted.');
        } else {
            $errors = [
                "You do not have permission to delete that resource!"
            ];
            return redirect()->route('finances')->withErrors($errors);
        }
    }

    /**
     * Setting the inital balance of the user
     *
     * @param \Illuminate\Http\Request $request
     * @param double $bankBalance
     * @return \Illuminate\Http\Response
     */
    public function setBalance(SetBalanceRequest $request) {

        DB::table('bank_balances')->insert(
            ['user_id' => auth()->user()->id, 'balance' => request('balance'), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        );

        return redirect()->route('finances')->with('message', 'Thanks for setting your balance! You can manage the rest from here now.');

    }
    /**
     * Showing all records / purchases the user has entered
     * 
     * @return \Illuminate\Http\Response
     */
    public function showAll() {
        $title = "All Records";
        $allFinanceRecords = auth()->user()->finances;
        return view('dashboard.finances.showAll', compact('title', 'allFinanceRecords'));
    }

    public function testMail() {
        return url('/');
    }
}
