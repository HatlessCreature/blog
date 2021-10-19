<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentReceived extends Mailable
{
    use Queueable, SerializesModels;

    private $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.comment-received')
            ->with([
                'comment' => $this->comment,
                'user' => $this->comment->user,
                'post' => $this->comment->post,
                'author' => $this->comment->post->user
            ])
            ->subject('Comment received')
            ->from($this->comment->user);
    }
}
