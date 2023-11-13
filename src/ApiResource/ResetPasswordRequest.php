<?php
// api/src/Entity/Book.php
namespace App\ApiResource;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Controller\CreateBookPublication;
use App\Controller\ResetPasswordController;
use App\Controller\ResetPasswordRequestController;
use App\Controller\UserRegistrationController;

#[ApiResource(
    shortName: "Reset Password Request",
    operations: [
    new Post(
        name: 'app_forgot_password_request', 
        uriTemplate: '/reset-password/request', 
        controller: ResetPasswordRequestController::class
    )
])]
class ResetPasswordRequest
{
    public $email = null;

}