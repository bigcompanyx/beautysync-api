<?php

namespace App\Service;

use App\Entity\User;
use App\Model\ResetPasswordRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;

class ResetPasswordService
{
    public function __construct(
        private MailerInterface $mailer,
        private UserPasswordHasherInterface $passwordHasher, 
        private ResetPasswordHelperInterface $resetPasswordHelper,
        private EntityManagerInterface $entityManager,

    )
    {

    }
    public function request(string $email)
    {
       return $this->processSendingPasswordResetEmail(
            $email,
            $this->mailer
        );
    }

    public function reset(ResetPasswordRequest $resetPasswordRequest, string $token = null): void
    {
        if (null === $token) {
            throw new NotFoundHttpException('No reset password token found in the URL or in the session.');
        }

        try {
            $user = $this->resetPasswordHelper->validateTokenAndFetchUser($token);
        } catch (ResetPasswordExceptionInterface $e) {
            throw new \Exception($e);
        }

        $this->resetPasswordHelper->removeResetRequest($token);

        // Encode(hash) the plain password, and set it.
        $encodedPassword = $this->passwordHasher->hashPassword(
            $user,
            $resetPasswordRequest->getPassword()
        );

        $user->setPassword($encodedPassword);
        $this->entityManager->flush();

    }

    private function processSendingPasswordResetEmail(string $emailFormData, MailerInterface $mailer): ResetPasswordToken
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => $emailFormData,
        ]);

        // Do not reveal whether a user account was found or not.
        if (!$user) {
            throw new \Exception('User not found');
        }

        try {
            $resetToken = $this->resetPasswordHelper->generateResetToken($user);
        } catch (ResetPasswordExceptionInterface $e) {
            throw new \Exception($e);
        }

        $email = (new TemplatedEmail())
            ->from(new Address('mailer@sandboxe594718ad9e44d899d604b94ec6d2866.mailgun.org', 'Mail Bot'))
            ->to($user->getEmail())
            ->subject('Your password reset request')
            ->htmlTemplate('reset_password/email.html.twig')
            ->context([
                'resetToken' => $resetToken,
            ])
        ;

        $mailer->send($email);

        return $resetToken;
    }
}