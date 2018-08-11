<?php

namespace App\Mail\Label\Organisation\UserManager;

use App\Models\LabelUserInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserInviteEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $LabelUserInvite;

    /**
     * Create a new message instance.
     *
     * @param LabelUserInvite $LabelUserInvite
     */
    public function __construct(LabelUserInvite $LabelUserInvite)
    {
        $this->LabelUserInvite = $LabelUserInvite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->LabelUserInvite->label->name.' have invited you to Beat Fund.')
            ->from('no-reply@beat.fund')
            ->view('email.label.organisation.user_manager.invite_user');
    }
}
