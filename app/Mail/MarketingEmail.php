<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MarketingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $firstname;
    public string $lastname;
    public array $categories;

    /**
     * Create a new message instance.
     */
    public function __construct(string $firstname = '', string $lastname = '', array $categories = [])
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->categories = $categories;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Découvrez nos produits qui pourraient vous plaire !')
                    ->view('emails.marketing')
                    ->with([
                        'firstname' => $this->firstname,
                        'lastname' => $this->lastname,
                        'categories' => $this->categories,
                    ]);
    }
}
