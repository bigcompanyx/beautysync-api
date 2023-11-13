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
class ResetPasswordResetController extends AbstractController
{
    public function __construct(
        private ResetPasswordService $resetPasswordService
    ) 
    {
    }

    /**
     * Validates and process the reset URL that the user clicked in their email.
     */

    public function __invoke(#[MapRequestPayload] ResetPasswordRequest $resetPasswordRequest, string $token = null): Response
    {
        try{
            $this->json($this->resetPasswordService->reset($resetPasswordRequest, $token));
            return $this->json(['message' => 'Password updated']);
        }catch(\Throwable $e){
            return $this->json(['message'=> $e->getMessage()]);
        }
    }

}