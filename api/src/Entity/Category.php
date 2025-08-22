<?php

namespace App\Entity;

use DateTimeImmutable;
use OpenApi\Annotations as OA;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Symfony\Component\Serializer\Attribute\Groups;

/**
 * @OA\Schema(
 *     schema="Category",
 *     type="object",
 *     required={"id", "name"}
 * )
 */
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: 'categories')]
class Category
{
    /**
     * @OA\Property(type="integer")
     * @var ?int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    /**
     * @OA\Property(type="string")
     * @var ?string
     */
    #[ORM\Column(name: 'name', length: 50)]
    #[Groups(['tools.index'])]
    private ?string $name = null;

    /**
     * @OA\Property(type="string", nullable=true)
     * @var string|NULL
     */
    #[ORM\Column(name: 'description', type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @OA\Property(type="string", nullable=true)
     * @var string|NULL
     */
    #[ORM\Column(name: 'color_hex', length: 7, nullable: true)]
    private ?string $color_hex = null;

    /**
     * @OA\Property(type="string", format="date-time", nullable=true)
     * @var ?DateTimeImmutable|NULL
     */
    #[ORM\Column(name: 'created_at', nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

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

    public function getColorHex(): ?string
    {
        return $this->color_hex;
    }

    public function setColorHex(?string $color_hex): static
    {
        $this->color_hex = $color_hex;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
