<?php

namespace App\Service;

use App\Model\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactEmailService
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send_email(Contact $contact)
    {
        $from = 'noreply@agence.fr';
        $to = 'contact@agence.fr';
        $subject = 'Contact';

        $email = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->textTemplate('email/contact.txt.twig')
            ->context([
                'contact' => $contact
            ]);

        $this->mailer->send($email);
    }

}