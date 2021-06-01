<?php

namespace App\Controller;

    use DateTime;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bridge\Twig\Mime\TemplatedEmail;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
    use Symfony\Component\Mailer\MailerInterface;

class ContactController
{
    private const FROM_ADDRESS = "admin@resaciel.eu";

    private MailerInterface $mailer;
    private DateTime $dateTime;
    private EntityManagerInterface $em;

    public function __construct(MailerInterface $mailer, EntityManagerInterface $em)
    {
        $this->mailer = $mailer;
        $this->dateTime = new DateTime();
        $this->em = $em;
    }

    /**
     * Envoi un mail
     */
    public function sendEmail(string $email, array $context): Response
    {

        $email = (new TemplatedEmail())
            ->from(self::FROM_ADDRESS)
            ->to($email)
            ->subject("Confirmation de votre inscription")
            ->htmlTemplate('contact/index.html.twig')
            ->context($context);
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            return new Response(
                $e,
                Response::HTTP_BAD_REQUEST
            );
        }


        return new Response(
            'E-mail sent',
            Response::HTTP_OK
        );
    }
}
