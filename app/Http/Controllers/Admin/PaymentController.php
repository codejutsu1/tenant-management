<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;

class PaymentController extends Controller
{
    public function showPaymentDetails()
    {
        $transactions = Transaction::whereNull('status')
                                    ->where('paid', 1)
                                    ->select(['id','user_id','title', 'amount', 'paid'])
                                    ->with(['user' => function($query){
                                        $query->select(['id', 'name', 'room_no']);
                                    }])
                                    ->paginate(10);
                                         
        return Inertia('Admin/NewPayment', compact('transactions'));
    }

    public function adminAllTransactions()
    {
        $transactions = Transaction::where('paid', 1)
                                    ->select(['id', 'user_id','title', 'amount', 'paid', 'status'])
                                    ->with(['user' => function($query){
                                        $query->select(['id', 'name', 'room_no']);
                                    }])
                                    ->paginate(10);

        return Inertia('Admin/AllTransactions', compact('transactions'));                                    
    }

    public function adminConfirmPayment($id)
    {
        Transaction::where('id', $id)->update([
            'status' => 1,
        ]);

        return redirect()->back()
                    ->with('message', 'You have confirmed this transaction');
    }

    public function adminRejectPayment($id)
    {
        Transaction::where('id', $id)->update([
            'status' => 0,
        ]);

        return redirect()->back()
                    ->with('message', 'You have denied this transaction'); 
    }

    public function adminRenewPayment($id)
    {
        User::where('id', $id)->update([
            'paid' => 0
        ]);

        return redirect()->back()
                    ->with('message', 'Updated Payment Information');
    }
}
