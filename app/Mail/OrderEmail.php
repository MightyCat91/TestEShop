<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $product_list;
    public $cost;

    /**
     * Create a new message instance.
     *
     * @param $product_list
     * @param $cost
     */
    public function __construct($product_list, $cost)
    {
        $this->product_list = $product_list;
        $this->cost = $cost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sender@example.com')
            ->view('mails.order');
    }
}
