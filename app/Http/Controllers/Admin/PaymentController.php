<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class PaymentController extends Controller
{
    public function showPaymentDetails()
    {
        $transactions = Transaction::whereNull('status')
                                    ->where('paid', 1)
                                    ->select(['id','user_id','title', 'amount', 'paid', 'created_at'])
                                    ->with(['user' => function($query){
                                        $query->select(['id', 'name', 'room_no']);
                                    }])
                                    ->paginate(10);
                                         
        return Inertia('Admin/NewPayment', compact('transactions'));
    }

    public function adminAllTransactions()
    {
        $transactions = Transaction::where('paid', 1)
                                    ->select(['id', 'user_id','title', 'amount', 'paid', 'status', 'created_at'])
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

        // $section = $phpWord->addSection();

        // $document = 'WHEREBY IT IS AGREED AS FOLLOWS: -'
        // .' 1. The landlord shall let and hereby lets and the tenant'      
        // ;

        // $fontstyle = array('name' => 'verdana', 'size' => '12');

        // $section->addTitle('TENANCY AGREEMENT', 1);

        // $section->addText($document, $fontstyle);

        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        $fontStyleName = 'myOwnStyle';
        $phpWord->addFontStyle($fontStyleName, array('color' => 'FF0000'));

        $paragraphStyleName = 'P-Style';
        $phpWord->addParagraphStyle($paragraphStyleName, array('spaceAfter' => 95));

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

        $predefinedMultilevelStyle = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED);

        // New section
        $section = $phpWord->addSection();

        // Lists
        $section->addText('Multilevel list.');
        $section->addListItem('List Item I', 0, null, $multilevelNumberingStyleName);
        $section->addListItem('List Item I.a', 1, null, $multilevelNumberingStyleName);
        $section->addListItem('List Item I.b', 1, null, $multilevelNumberingStyleName);
        $section->addListItem('List Item II', 0, null, $multilevelNumberingStyleName);
        $section->addListItem('List Item II.a', 1, null, $multilevelNumberingStyleName);
        $section->addListItem('List Item III', 0, null, $multilevelNumberingStyleName);
        $section->addTextBreak(2);

        $section->addText('Basic simple bulleted list.');
        $section->addListItem('List Item 1');
        $section->addListItem('List Item 2');
        $section->addListItem('List Item 3');
        $section->addTextBreak(2);

        $section->addText('Continue from multilevel list above.');
        $section->addListItem('List Item IV', 0, null, $multilevelNumberingStyleName);
        $section->addListItem('List Item IV.a', 1, null, $multilevelNumberingStyleName);
        $section->addTextBreak(2);

        $section->addText('Multilevel predefined list.');
        $section->addListItem('List Item 1', 0, $fontStyleName, $predefinedMultilevelStyle, $paragraphStyleName);
        $section->addListItem('List Item 2', 0, $fontStyleName, $predefinedMultilevelStyle, $paragraphStyleName);
        $section->addListItem('List Item 3', 1, $fontStyleName, $predefinedMultilevelStyle, $paragraphStyleName);
        $section->addListItem('List Item 4', 1, $fontStyleName, $predefinedMultilevelStyle, $paragraphStyleName);
        $section->addListItem('List Item 5', 2, $fontStyleName, $predefinedMultilevelStyle, $paragraphStyleName);
        $section->addListItem('List Item 6', 1, $fontStyleName, $predefinedMultilevelStyle, $paragraphStyleName);
        $section->addListItem('List Item 7', 0, $fontStyleName, $predefinedMultilevelStyle, $paragraphStyleName);
        $section->addTextBreak(2);

        $section->addText('List with inline formatting.');
        $listItemRun = $section->addListItemRun();
        $listItemRun->addText('List item 1');
        $listItemRun->addText(' in bold', array('bold' => true));
        $listItemRun = $section->addListItemRun(1, $predefinedMultilevelStyle, $paragraphStyleName);
        $listItemRun->addText('List item 2');
        $listItemRun->addText(' in italic', array('italic' => true));
        $footnote = $listItemRun->addFootnote();
        $footnote->addText('this is a footnote on a list item');
        $listItemRun = $section->addListItemRun();
        $listItemRun->addText('List item 3');
        $listItemRun->addText(' underlined', array('underline' => 'dash'));
        $section->addTextBreak(2);

        // Numbered heading
        $headingNumberingStyleName = 'headingNumbering';
        $phpWord->addNumberingStyle(
            $headingNumberingStyleName,
            array('type'   => 'multilevel',
                'levels' => array(
                    array('pStyle' => 'Heading1', 'format' => 'decimal', 'text' => '%1'),
                    array('pStyle' => 'Heading2', 'format' => 'decimal', 'text' => '%1.%2'),
                    array('pStyle' => 'Heading3', 'format' => 'decimal', 'text' => '%1.%2.%3'),
                ),
            )
        );
        $phpWord->addTitleStyle(1, array('size' => 16), array('numStyle' => $headingNumberingStyleName, 'numLevel' => 0));
        $phpWord->addTitleStyle(2, array('size' => 14), array('numStyle' => $headingNumberingStyleName, 'numLevel' => 1));
        $phpWord->addTitleStyle(3, array('size' => 12), array('numStyle' => $headingNumberingStyleName, 'numLevel' => 2));

        $section->addTitle('Heading 1', 1);
        $section->addTitle('Heading 2', 2);
        $section->addTitle('Heading 3', 3);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

        try {
            $objWriter->save(storage_path('phpword.docx'));
        } catch (Exception $e) {
            dd($e);
        }


        return response()->download(storage_path('helloWorld2.docx'));

        return redirect()->route('show.payment.details')
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
