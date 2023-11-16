<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\WorkingHoursDayRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkingHoursDayRepository::class)]
#[ApiResource()]
class WorkingHoursDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $dayName = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $workStart = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $workEnd = null;

    #[ORM\Column(nullable: true)]
    private ?bool $open = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDayName(): ?string
    {
        return $this->dayName;
    }

    public function setDayName(string $dayName): static
    {
        $this->dayName = $dayName;

        return $this;
    }

    public function getWorkStart(): ?\DateTimeImmutable
    {
        return $this->workStart;
    }

    public function setWorkStart(\DateTimeImmutable $workStart): static
    {
        $this->workStart = $workStart;

        return $this;
    }

    public function getWorkEnd(): ?\DateTimeImmutable
    {
        return $this->workEnd;
    }

    public function setWorkEnd(\DateTimeImmutable $workEnd): static
    {
        $this->workEnd = $workEnd;

        return $this;
    }

    public function isOpen(): ?bool
    {
        return $this->open;
    }

    public function setOpen(?bool $open): static
    {
        $this->open = $open;

        return $this;
    }
}
