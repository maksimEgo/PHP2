<?php

namespace src\Service;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class NotificationService
{
    private static Transport\TransportInterface $transport;
    private static Mailer $mailer;

    public function __construct()
    {
        self::$transport = Transport::fromDsn('smtp://localhost');
        self::$mailer = new Mailer(self::$transport);
    }

    public static function sendDbErrorEmail($errorMessage): void
    {
        $email = (new Email())
            ->from('sender@example.com')
            ->to('admin@example.com')
            ->subject('Ошибка базы данных')
            ->text('Произошла ошибка при подключении к базе данных: ' . $errorMessage);

        self::$mailer->send($email);
    }
}