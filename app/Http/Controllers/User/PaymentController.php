<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Iamolayemi\Paystack\Facades\Paystack;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Setting;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Initialize a new paystack payment
     *
     * @return void
     */
    public function initialize()
    {
        // Generate a unique payment reference
        $reference = Paystack::generateReference();

        // prepare payment details from form request
        $paymentDetails = [
            'email' => request('email'),
            'amount' => request('amount'),
            'reference' => $reference,
            'callback_url' =>  route('callback')
        ];

        // initialize new payment and get the response from the api call.
        $response = Paystack::transaction()
            ->initialize($paymentDetails)->response();

        if (!$response['status']) {
            // notify that something went wrong
        }

        // redirect to authorization url
        return redirect($response['data']['authorization_url']);
    }


    public function callback()
    {
        // get reference  from request
        $reference = request('reference') ?? request('trxref');

        // verify payment details
        $payment = Paystack::transaction()->verify($reference)->response('data');

        // check payment status
        if ($payment['status'] == 'success') {
            // payment is successful
            // code your business logic here
        } else {
            // payment is not successful
        }
    }

    public function housePayment()
    {
        return Inertia('User/Payment/House');
    }

    public function otherPayment()
    {
        return Inertia('User/Payment/Other');
    }

    public function onlineBanking()
    {
        $setting = Setting::where('id', 1)->value('site_rent');

        return Inertia('User/Banking/OnlineBanking', compact('setting'));
    }

    public function offlineBanking()
    {
        $setting = Setting::where('id', 1)->select(['account_name', 'account_number', 'bank_name'])->first();

        return Inertia('User/Banking/OfflineBanking', compact('setting'));
    }

    public function crypto()
    {
        return Inertia('User/Banking/Crypto');
    }

    public function demoPayment()
    {
        Transaction::create([
            'user_id' => auth()->user()->id,
            'title' => 'Lodge Payment',
            'amount' => '120000',
            'year' => '2022',
            'status' => NULL,
            'paid' => 1
        ]);

        $current_time = Carbon::now();

        User::where('id', auth()->user()->id)->update([
            'paid' => 1,
            'rent_due' => $current_time->addMonths(12)
        ]);

        return redirect()->route('online.banking')->with('message', 'Successfully paid');
    }

    public function otherOnlineBanking()
    {
        return Inertia('User/Other/OnlineBanking');
    }
}
