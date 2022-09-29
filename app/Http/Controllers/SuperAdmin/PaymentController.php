<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Legal;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmPayment;
use App\Mail\AdminConfirmPayment;
use App\Mail\RenewRent;
use App\Mail\AdminRenewRent;


class PaymentController extends Controller
{
    public function newPayment()
    {
        $transactions = Transaction::whereNull('status')
                                    ->where('paid', 1)
                                    ->select(['id', 'user_id','title', 'amount', 'paid', 'created_at'])
                                    ->with(['user' => function($query){
                                        $query->select(['id', 'name', 'room_no']);
                                    }])
                                    ->paginate(10);

        return Inertia('SuperAdmin/Payment', compact('transactions'));
    }

    public function confirmPayment($id)
    {
        Transaction::where('id', $id)->update([
            'status' => 1,
        ]);

        $transaction = Transaction::with('user')->where('id', $id)->first();

        if($transaction->title == 'Lodge Payment')
        {
            $payer = User::where('id', $transaction->user_id)->first();            
            
            User::where('room_no', $payer->room_no)->update([
                'paid' => 1
            ]);

            $payer->payer = 1;
            $payer->save();
        }
        
        $customer = new Party([
            'name' => $transaction->user->name,
            'phone' => $transaction->user->phone,
        ]);

        $client = new Party([
            'name' => 'Nwachukwu Kelechi',
            'phone' => '234 4484883 3477',
            'address' => 'Shell Oil and Gas'
        ]);

        $notes = [
            'For more information',
            'Contact the Admin',
            'Thanks for your payment',
        ];

        $notes = implode("<br>", $notes);

        $item = (new InvoiceItem())->title($transaction->title)->pricePerUnit($transaction->amount);

        $invoice = Invoice::make()
                            ->series('Lodge')
                            ->sequence($transaction->id)
                            ->status(__('invoices::invoice.paid'))
                            ->seller($client)
                            ->currencySymbol('N')
                            ->buyer($customer)
                            ->filename($transaction->title . '_' . $transaction->user->name . '_' . $transaction->id . $transaction->year)
                            ->currencyThousandsSeparator(',')
                            ->addItem($item)
                            ->notes($notes)
                            ->save('public');
        
        Transaction::where('id', $id)->update([
            'url' => $invoice->url(),
            'link' => $transaction->title . '_' . $transaction->user->name . '_' . $transaction->id . $transaction->year . '.pdf'
        ]);

        Mail::to($transaction->user->email)->send(new ConfirmPayment($transaction));
        Mail::to(config('mail.from.address'))->send(new AdminConfirmPayment($transaction));

        // return response()->download(storage_path('helloWorld.docx'));

        return redirect()->route('super.admin.payment')->with('message', 'Successfully Confirmed');
    }

    public function rejectPayment($id)
    {
        Transaction::where('id', $id)->update([
            'status' => 0,
        ]);

        return redirect()->back()
                    ->with('message', 'You have denied this transaction'); 
    }

    public function allTransactions()
    {
        $transactions = Transaction::where('paid', 1)
                                    ->select(['id', 'user_id','title', 'amount', 'paid', 'status', 'created_at'])
                                    ->with(['user' => function($query){
                                        $query->select(['id', 'name', 'room_no']);
                                    }])
                                    ->paginate(10);

        return Inertia('SuperAdmin/AllTransactions', compact('transactions'));
    }

    public function renewPayment($id)
    {
        User::where('id', $id)->update([
            'paid' => 0
        ]);

        $date = User::where('id', $id)->first();

        Mail::to($date->email)->send(new RenewRent($date));
        Mail::to(config('mail.from.address'))->send(new AdminRenewRent($date));

        return redirect()->back()
                    ->with('message', 'Updated Payment Information');
    }
}
