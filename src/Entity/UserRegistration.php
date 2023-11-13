<?php
// api/src/Entity/Book.php
namespace App\Entity;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Controller\CreateBookPublication;
use App\Controller\UserRegistrationController;

#[ApiResource(operations: [
    new Post(
        name: 'registration', 
        uriTemplate: '/register', 
        controller: UserRegistrationController::class
    )
])]
class UserRegistration
{
    public $email = null;

    public $password = null;

}