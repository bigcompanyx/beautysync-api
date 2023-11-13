<?php

namespace App\Controller;


use App\Model\ForgotPasswordRequest;
use App\Model\ResetPasswordRequest;
use App\Service\ResetPasswordService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;


#[AsController]
class ResetPasswordRequestController extends AbstractController
{
    public function __construct(
        private ResetPasswordService $resetPasswordService
    ) 
    {
    }

    /**
     * Display & process form to request a password reset.
     */

    public function __invoke(#[MapRequestPayload] ForgotPasswordRequest $resetPasswordRequest): Response
    {
        try{
            $this->resetPasswordService->request($resetPasswordRequest->getEmail());
            return $this->json(['message' => 'Password reset link was sent to your email address']);
        }catch(\Throwable $e){
            return $this->json(['message'=> $e->getMessage()]);
        }

    }

}