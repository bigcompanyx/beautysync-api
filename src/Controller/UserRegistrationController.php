<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\User as UserDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class UserRegistrationController extends AbstractController
{
    public function __construct( 
        private UserPasswordHasherInterface $passwordHasher, 
        private EntityManagerInterface $entityManager)
    {

    }

    public function __invoke(#[MapRequestPayload] UserDTO $userCreateRequest): Response
    {
        $user = (new User())
            ->setEmail($userCreateRequest->getEmail())
            ->setRoles($userCreateRequest->getRoles())
        ;
        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $userCreateRequest->getPassword()
        );
        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->json(['id' => $user->getId()]);
    }
}