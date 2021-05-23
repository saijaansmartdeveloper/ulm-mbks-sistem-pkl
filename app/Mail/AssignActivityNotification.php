<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignActivityNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $activity;
    public $guard;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $guard)
    {
        $this->activity = $data;
        $this->guard    = $guard;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("mbkm.fkip@ulm.ac.id", "MBKM FKIP ULM")
            ->subject('Informasi Penempatan MBKM FKIP ULM')
            ->view('mail.assign_activity');
    }
}
