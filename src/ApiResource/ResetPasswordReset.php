<?php
// api/src/Entity/Book.php
namespace App\ApiResource;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Controller\CreateBookPublication;
use App\Controller\ResetPasswordController;
use App\Controller\ResetPasswordRequestController;
use App\Controller\ResetPasswordResetController;
use App\Controller\UserRegistrationController;

#[ApiResource(
    description: "Reset Password reset",
    operations: [
    new Post(
        name: 'app_reset_password', 
        uriTemplate: '/reset-password/reset/{token}', 
        controller: ResetPasswordResetController::class
    ),
])]
class ResetPasswordReset
{
    public $password = null;

    public $confirmPassword = null;

}