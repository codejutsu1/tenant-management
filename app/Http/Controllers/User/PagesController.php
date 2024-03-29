<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Setting;
use App\Models\Legal;

class PagesController extends Controller
{
    public function index()
    {
        return inertia('Web/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
    
    public function dashboardUser()
    {
        $user = User::where('id', auth()->user()->id)->select('room_no', 'paid')->first();

        $amount = Setting::where('id', 1)->value('site_rent');

        return inertia('User/Dashboard', compact('user', 'amount'));
    }

    public function userPayment()
    {
        return Inertia('User/Payment');
    }

    public function userReceipt()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)
                                    ->select(['id', 'user_id', 'title', 'amount', 'status', 'year', 'link', 'created_at'])
                                    ->with(['user' => function($query){
                                        $query->select(['id', 'name', 'room_no']);
                                    }])
                                    ->paginate(10);

        $legals = Legal::where('user_id', auth()->user()->id)->select(['id', 'room_no', 'year', 'link', 'created_at'])->get();

        return Inertia('User/Receipt', compact('transactions', 'legals'));
    }

    public function userHistory()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)
                                    ->select(['id', 'title', 'amount', 'status', 'created_at'])
                                    ->paginate(10);

        return Inertia('User/TransactionHistory', compact('transactions'));
    }

    public function userDetails()
    {
        $user = User::where('id', auth()->user()->id)
                    ->select(['name', 'email', 'type', 'lga', 'state', 'gender', 'occupation', 'room_no'])
                    ->first();

        $caretakers = User::where('role_id', 2)
                            ->select(['id', 'name', 'email', 'phone', 'gender'])
                            ->get();            

        return Inertia('User/AccountDetails', compact('user', 'caretakers'));
    }

    public function chooseRoom()
    {
        return Inertia('User/Chooseroom');
    }

    public function chooseaRoom(Request $request)
    {
        $request->validate([
            'room_no' => ['required', 'numeric'],
        ]);

        User::where('id', auth()->user()->id)->update([
            'room_no' => $request->room_no
        ]);

        return redirect()->route('dashboard.user')->with('message', 'You have successfully chosen a room');
    }
}
