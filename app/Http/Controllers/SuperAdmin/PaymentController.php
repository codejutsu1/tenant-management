<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

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
        // Transaction::where('id', $id)->update([
        //     'status' => 1,
        // ]);

        $transaction = Transaction::with('user')->where('id', $id)->first();
        
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

        // Creating the legal information
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();

        $phpWord->addTitleStyle(1, array('bold' => true, 'size' => 16, 'underline' => 'single'), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

        $section->addTitle('TENANCY AGREEMENT', 1);

        $section->addTextBreak();

        $fontStyle['size'] = 12;

        $textrun = $section->addTextRun($fontStyle);

        $textrun->addText('This Tenancy agreement is', array('bold' => true,'size'=> '12', 'allCaps' => true));
        $textrun->addText(' made this ');
        $textrun->addText(Carbon::now()->format('d'));
        $textrun->addText(' day of ');
        $textrun->addText(Carbon::now()->format('F'));
        $textrun->addText(' Between ');
        $textrun->addText('(Hereinafter referred to as "The Landlord") of the one part and ');
        $textrun->addText($transaction->user->name);
        $textrun->addText(', native of ');
        $textrun->addText($transaction->user->lga . ', ' .$transaction->user->state);
        $textrun->addText(' (Hereinafter referred to as "The Tenant") of the second part.');
        $textrun->addText();

        $section->addText('whereby it is agreed as follows:-', array('bold' => true, 'size'=> '12', 'allCaps' => true));
        
        $section->addListItem('The Landlord shall let and hereby lets and the Tenant shall take and hereby takes a monthly tenancy commencing from the first day'
           .' of one month and so continues from month to month for a period of one year until otherwise'
            .' determined as hereinafter provided at ALL THAT tenement comprising of one room self-content'
            . ' and premises situate at Here, at the rate of rent of $3,000.00 per annum.', 
            array('name' => 'Verdana', 'size' => 12), $predefinedMultilevelStyle
        );

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        try {
            $objWriter->save(storage_path('helloWorld.docx'));
        } catch (Exception $e) {
            dd($e);
        }


        return response()->download(storage_path('helloWorld.docx'));

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

        return redirect()->back()
                    ->with('message', 'Updated Payment Information');
    }
}
