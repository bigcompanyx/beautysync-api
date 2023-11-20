<?php
// api/src/Entity/Book.php
namespace App\ApiResource;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use App\Controller\ResetPasswordRequestController;
use App\Controller\ResetPasswordResetController;
use App\Model\ForgotPasswordRequest;
use App\Model\ResetPasswordRequest;

#[ApiResource(
    operations: [
    new Post(
        input: ResetPasswordRequest::class,
        uriTemplate: '/reset-password/reset/{token}', 
        controller: ResetPasswordResetController::class,
        openapi: new Operation(
            summary: 'Reset password request',
            description: 'Reset password api resource endpoint',
        )
    ),
    new Post(
        name: "Request",
        input: ForgotPasswordRequest::class,
        uriTemplate: '/reset-password/request', 
        controller: ResetPasswordRequestController::class,
        openapi: new Operation(
            summary: 'Get reset token',
            description: 'Request password reset token api resource endpoint',
        )
    )
])]
class ResetPassword
{

}