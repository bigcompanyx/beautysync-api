<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ResetPasswordRequest
{
    #[NotBlank]
    #[Length(min:8, minMessage: "Invalid password length")]
    private ?string $password = null;

    #[NotBlank]
    #[Length(min:8, minMessage: "Invalid password length")]
    #[EqualTo(propertyPath: 'password', message: "Password does not match")]
    private ?string $confirmPassword = null;

    /**
     * Get the value of password
     *
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param ?string $password
     *
     * @return self
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of confirmPassword
     *
     * @return ?string
     */
    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    /**
     * Set the value of confirmPassword
     *
     * @param ?string $confirmPassword
     *
     * @return self
     */
    public function setConfirmPassword(?string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }
}