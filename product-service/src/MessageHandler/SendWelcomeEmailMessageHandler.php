<?php

namespace App\MessageHandler;

use App\Message\SendWelcomeEmailMessage;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
final class SendWelcomeEmailMessageHandler
{

    public function __construct(private MailerInterface $mailer)
    {
    }

    public function __invoke(SendWelcomeEmailMessage $message): void
    {
        $email = (new Email())
            ->from('noreply@example.com')
            ->to($message->email)
            ->subject('Registered Successfully!')
            ->text('Thank you for registering!');
        $this->mailer->send($email);
    }
}
