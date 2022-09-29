<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AdminRenewRent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    private $date; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $date)
    {
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.adminRenewRent')
                    ->with([
                        'name' => $this->date->name
                    ]);
    }
}
