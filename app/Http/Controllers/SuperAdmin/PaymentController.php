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

        if($transaction->title == 'Lodge Payment')
        {
            $payer = User::where('id', $transaction->user_id)->first();            
            
            User::where('room_no', $payer->room_no)->update([
                'paid' => 1
            ]);

            if(!$transaction->user->legal){
                Legal::create([
                    'user_id' => $transaction->user_id,
                    'room_no' => $transaction->user->room_no ?? 1,
                    'year' => '2022'
                ]);
            }

            $payer->payer = 1;
            $payer->legal = 1;
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

        // Creating the legal information
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $multilevelNumberingStyleName = 'multilevel';
        $phpWord->addNumberingStyle(
            $multilevelNumberingStyleName,
            array(
                'type'   => 'multilevel',
                'levels' => array(
                    array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'upperLetter', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                ),
            )
        );

        $fontStyleName = 'P-Style';
        $phpWord->addFontStyle($fontStyleName, array('name' => 'Verdana', 'size' => 12));

        $fontStyle = 'P-Style';
        $phpWord->addFontStyle($fontStyle, array('name' => 'Verdana', 'size' => 12));

        $section = $phpWord->addSection();

        $phpWord->addTitleStyle(1, array('bold' => true, 'size' => 16, 'underline' => 'single'), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

        $section->addTitle('TENANCY AGREEMENT', 1);

        $section->addTextBreak();

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
            . ' and premises situate at Here, at the rate of rent of $3,000.00 per annum.', 0 , $fontStyleName, $multilevelNumberingStyleName,
        );

        $section->addListItem('The Tenant had paid the rent hereby reserved before the execution of this agreement, receipt whereof the'
            . ' Landlord hereby acknowledges by endorsing this agreement.', 0 , $fontStyleName, $multilevelNumberingStyleName,
        );  

        $section->addListItem('The Guarantor in consideration of the landlord letting a tenement of the Tenant hereby'
            . " agrees and covenants to bind himself or herself for the tenant's good conduct and observances"
            . ' of all his covenants set out hereunder.' , 0 , $fontStyleName, $multilevelNumberingStyleName,
        );

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        $legal = Legal::with('user')->where('user_id', $transaction->user->id)->first();

        $destination_path = 'app\public\legal';
        $legal_file = $legal->user->name . '_' . $legal->id . $legal->year . '_legal.docx';

        try {
            $objWriter->save(storage_path($destination_path.'\\'.$legal_file));
        } catch (Exception $e) {
            dd($e);
        }

        Legal::where('user_id', $transaction->user->id)->update([
            'link' => $legal_file
        ]);


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

        return redirect()->back()
                    ->with('message', 'Updated Payment Information');
    }
}
