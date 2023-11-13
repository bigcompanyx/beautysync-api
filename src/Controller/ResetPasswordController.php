<?php

namespace App\Controller;


use App\Model\ForgotPasswordRequest;
use App\Model\ResetPasswordRequest;
use App\Service\ResetPasswordService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/api/v1/public/reset-password')]
class ResetPasswordController extends AbstractController
{
    public function __construct(
        private ResetPasswordService $resetPasswordService
    ) 
    {
    }

    /**
     * Display & process form to request a password reset.
     */
    #[Route('/request', name: 'app_forgot_password_request')]
    public function request(#[MapRequestPayload] ForgotPasswordRequest $resetPasswordRequest): Response
    {
        try{
            $this->resetPasswordService->request($resetPasswordRequest->getEmail());
            return $this->json(['message' => 'Password reset link was sent to your email address']);
        }catch(\Throwable $e){
            return $this->json(['message'=> $e->getMessage()]);
        }

    }

    /**
     * Validates and process the reset URL that the user clicked in their email.
     */
    #[Route('/reset/{token}', name: 'app_reset_password')]
    public function reset(#[MapRequestPayload] ResetPasswordRequest $resetPasswordRequest, string $token = null): Response
    {
        try{
            $this->json($this->resetPasswordService->reset($resetPasswordRequest, $token));
            return $this->json(['message' => 'Password updated']);
        }catch(\Throwable $e){
            return $this->json(['message'=> $e->getMessage()]);
        }
    }

}