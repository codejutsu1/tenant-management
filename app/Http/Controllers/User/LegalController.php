<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Legal;

class LegalController extends Controller
{
    public function legalDocument()
    {
        if(!auth()->user()->legal && auth()->user()->paid)
        {
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
            $textrun->addText(auth()->user()->name);
            $textrun->addText(', native of ');
            $textrun->addText(auth()->user()->lga . ', ' .auth()->user()->state);
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


            $destination_path = 'app\public\legal';
            $legal_file = auth()->user()->name . '_' . auth()->user()->id . auth()->user()->year . '_legal.docx';

            try {
                $objWriter->save(storage_path($destination_path.'\\'.$legal_file));
            } catch (Exception $e) {
                dd($e);
            }

            Legal::create([
                'user_id' => auth()->user()->id,
                'room_no' => auth()->user()->room_no ?? 0,
                'year' => auth()->user()->year,
                'link' => $legal_file
            ]);

            return redirect()->back()->with('message', 'Successfully generated legal document');
        }
    }
}
