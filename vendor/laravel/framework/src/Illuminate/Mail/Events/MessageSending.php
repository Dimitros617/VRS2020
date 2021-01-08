<?php

namespace Illuminate\Mail\Events;

class MessageSending
{
    /**
     * The Swift messages instance.
     *
     * @var \Swift_Message
     */
    public $message;

    /**
     * The messages data.
     *
     * @var array
     */
    public $data;

    /**
     * Create a new event instance.
     *
     * @param  \Swift_Message  $message
     * @param  array  $data
     * @return void
     */
    public function __construct($message, $data = [])
    {
        $this->data = $data;
        $this->message = $message;
    }
}
