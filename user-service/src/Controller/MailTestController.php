<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class MailTestController extends AbstractController
{
    #[Route('/test-mail', name: 'test_mail')]
    public function testMail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('noreply@example.com')
            ->to('you@example.com')
            ->subject('تست ارسال ایمیل مستقیم')
            ->text('اگر این پیام را دریافت کردی، پس ارسال ایمیل مستقیم کار می‌کند!');

        $mailer->send($email);

        return new Response('ایمیل ارسال شد (یا حداقل تلاش شد).');
    }
}
