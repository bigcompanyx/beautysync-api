<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\WorkingHoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkingHoursRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/working_hours',
        ),
        new Get(
            uriTemplate: '/working_hours/{id}',
        ),
        new Post(
            uriTemplate: '/working_hours'
        ),
        new Patch(
            uriTemplate: '/working_hours/{id}',
        ),
        new Delete(
            uriTemplate: '/working_hours/{id}',
        )
    ]
)]
class WorkingHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
