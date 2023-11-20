<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use App\Controller\CreateBookPublication;
use App\Controller\UserRegistrationController;
use App\Model\UserRegistrationRequestModel;

#[ApiResource(
    shortName:"User Registration",
    operations: [
        new Post(
            input: UserRegistrationRequestModel::class,
            uriTemplate: '/register',
            controller: UserRegistrationController::class,
            openapi: new Operation(
                summary: 'User registration api resource enpoint',
                description: 'User registration api resource enpoint',
            )
        )
    ]
)]
class UserRegistration
{

}