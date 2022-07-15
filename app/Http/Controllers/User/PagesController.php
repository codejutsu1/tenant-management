<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Transaction;
use App\Models\User;

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
        return inertia('User/Dashboard');
    }

    public function userPayment()
    {
        return Inertia('User/Payment');
    }

    public function userReceipt()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)
                                    ->select(['id', 'user_id', 'amount', 'year'])
                                    ->with(['user' => function($query){
                                        $query->select(['id', 'room_no']);
                                    }])
                                    ->paginate(10);

        return Inertia('User/Receipt', compact('transactions'));
    }

    public function userHistory()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)
                                    ->select(['id', 'title', 'amount', 'status'])
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
}
