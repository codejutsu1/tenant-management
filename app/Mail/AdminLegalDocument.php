<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Legal;

class AdminLegalDocument extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    private $legal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Legal $legal)
    {
        $this->legal = $legal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.adminLegalDocument')
                    ->attachFromStorage('public/legal/'. $this->legal->link, $this->legal->link, [
                        'mime' => 'application/pdf'
                    ])
                    ->with([
                        'name' => $this->legal->user->name,
                    ]);
    }
}
