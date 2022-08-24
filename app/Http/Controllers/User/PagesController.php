<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Setting;

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
                                    ->select(['id', 'user_id', 'title', 'amount', 'year', 'link', 'created_at'])
                                    ->with(['user' => function($query){
                                        $query->select(['id', 'name', 'room_no']);
                                    }])
                                    ->paginate(10);

        return Inertia('User/Receipt', compact('transactions'));
    }

    public function userHistory()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)
                                    ->select(['id', 'title', 'amount', 'status', 'created_at'])
                                    ->paginate(10);

        return Inertia('User/TransactionHistory', compact('transactions'));
    }

    public function userLegal()
    {
        return Inertia('User/Legal');
    }

    public function userDetails()
    {
        $user = User::where('id', auth()->user()->id)
                    ->select(['name', 'email', 'type', 'lga', 'state', 'gender', 'occupation', 'room_no'])
                    ->first();

        return Inertia('User/AccountDetails', compact('user'));
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
