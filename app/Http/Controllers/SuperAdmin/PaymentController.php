<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function newPayment()
    {
        $transactions = Transaction::whereNull('status')
                                    ->select(['user_id','title', 'amount', 'paid'])
                                    ->with(['user' => function($query){
                                        $query->select(['id', 'name', 'room_no']);
                                    }])
                                    ->paginate(10);

        return Inertia('SuperAdmin/Payment', compact('transactions'));
    }
}
