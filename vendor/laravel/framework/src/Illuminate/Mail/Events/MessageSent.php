<?php

namespace Illuminate\Mail\Events;

use Swift_Attachment;

class MessageSent
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

    /**
     * Get the serializable representation of the object.
     *
     * @return array
     */
    public function __serialize()
    {
        $hasAttachments = collect($this->message->getChildren())
                                ->whereInstanceOf(Swift_Attachment::class)
                                ->isNotEmpty();

        return $hasAttachments ? [
            'messages' => base64_encode(serialize($this->message)),
            'data' => base64_encode(serialize($this->data)),
            'hasAttachments' => true,
        ] : [
            'messages' => $this->message,
            'data' => $this->data,
            'hasAttachments' => false,
        ];
    }

    /**
     * Marshal the object from its serialized data.
     *
     * @param  array  $data
     * @return void
     */
    public function __unserialize(array $data)
    {
        if (isset($data['hasAttachments']) && $data['hasAttachments'] === true) {
            $this->message = unserialize(base64_decode($data['messages']));
            $this->data = unserialize(base64_decode($data['data']));
        } else {
            $this->message = $data['messages'];
            $this->data = $data['data'];
        }
    }
}
