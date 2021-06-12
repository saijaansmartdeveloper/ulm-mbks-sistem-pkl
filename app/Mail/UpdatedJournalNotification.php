<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdatedJournalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $uuid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $journal_uuid)
    {
        $this->user  = $user;
        $this->uuid  = $journal_uuid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("mbkm.fkip@ulm.ac.id", "MBKM FKIP ULM")
            ->subject('Log Book MBKM FKIP ULM')
            ->view('mail.journal_updated');
    }
}
