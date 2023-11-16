<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SubscriptionPlanRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionPlanRepository::class)]
#[ApiResource()]
class SubscriptionPlan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(length: 255)]
    private ?string $durationUnit = null;

    #[ORM\Column(nullable: true)]
    private ?int $trialDuration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $trialDurationUnit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDurationUnit(): ?string
    {
        return $this->durationUnit;
    }

    public function setDurationUnit(string $durationUnit): static
    {
        $this->durationUnit = $durationUnit;

        return $this;
    }

    public function getTrialDuration(): ?int
    {
        return $this->trialDuration;
    }

    public function setTrialDuration(?int $trialDuration): static
    {
        $this->trialDuration = $trialDuration;

        return $this;
    }

    public function getTrialDurationUnit(): ?string
    {
        return $this->trialDurationUnit;
    }

    public function setTrialDurationUnit(?string $trialDurationUnit): static
    {
        $this->trialDurationUnit = $trialDurationUnit;

        return $this;
    }
}
