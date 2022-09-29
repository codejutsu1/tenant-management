<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;

class AdminRejectPayment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    private $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.adminRejectPayment')
                    ->with([
                        'name' => $this->transaction->user->name,
                        'title' => $this->transaction->title,
                        'amount' => $this->transaction->amount,
                    ]);
    }
}
