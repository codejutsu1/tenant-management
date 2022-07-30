<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Iamolayemi\Paystack\Facades\Paystack;
use App\Models\Transaction;

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
        return Inertia('User/Banking/OnlineBanking');
    }

    public function offlineBanking()
    {
        return Inertia('User/Banking/OfflineBanking');
    }

    public function crypto()
    {
        return Inertia('User/Banking/Crypto');
    }

    public function installmental()
    {
        return Inertia('User/Banking/Installmental');
    }

    public function demoPayment()
    {
        Transaction::create([
            'user_id' => auth()->user()->id,
            'title' => 'Lodge Payment',
            'amount' => '120000',
            'year' => '2022',
            'status' => 1,
            'paid' => 1
        ]);

        User::where('id', auth()->user()->id)->update([
            'paid' => 1
        ]);

        return redirect()->route('online.banking')->with('message', 'Successfully paid');
    }

    public function otherOnlineBanking()
    {
        return Inertia('User/Other/OnlineBanking');
    }

    public function demoOtherPayment(Request $request)
    {
        Transaction::create([
            'user_id' => auth()->user()->id,
            'title' => $request->description,
            'amount' => $request->amount,
            'year' => '2022',
            'status' => 0,
            'paid' => 1
        ]);

        return redirect()->route('other.online.banking')
                    ->with('message', 'Successfully paid');
    }

    public function demoInstallmentalPay(Request $request)
    {
        dd($request);
        Transaction::create([
            'user_id' => auth()->user()->id,
            'title' => 'Lodge Rent Installmentally',
            'amount' => $request->amount,
            'year' => '2022',
            'period' => $request->length . ' ' . $request->period,
            'status' => 0,
            'paid' => 1
        ]);

        return redirect()->route('installmental')
                    ->with('message', 'Successfully paid');
    }
}
