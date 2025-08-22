<?php

namespace App\Entity;

use App\Enum\StatusType;
use DateTimeImmutable;
use App\Enum\DepartmentType;
use OpenApi\Annotations as OA;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ToolRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;


/**
 * @OA\Schema(
 *     schema="Tool",
 *     type="object",
 *     required={"id", "name", "category_id", "monthly_cost", "active_users_count", "owner_department"}
 * )
 */
#[ORM\Entity(repositoryClass: ToolRepository::class)]
#[ORM\Table(name: 'tools')]
class Tool
{
    /**
     * @OA\Property(type="integer")
     * @var ?int
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    #[Groups(['tools.index'])]
    private ?int $id = null;

    /**
     * @OA\Property(type="string")
     * @var ?string
     */
    #[ORM\Column(name: 'name', length: 100)]
    #[Groups(['tools.index'])]
    private ?string $name = null;

    /**
     * @OA\Property(type="string", nullable=true)
     * @var string|NULL
     */
    #[ORM\Column(name: 'description', type: Types::TEXT, nullable: true)]
    #[Groups(['tools.index'])]
    private ?string $description = null;

    /**
     * @OA\Property(type="string", nullable=true)
     * @var string|NULL
     */
    #[ORM\Column(name: 'vendor', length: 100, nullable: true)]
    #[Groups(['tools.index'])]
    private ?string $vendor = null;

    /**
     * @OA\Property(type="string", nullable=true)
     * @var string|NULL
     */
    #[ORM\Column(name: 'website_url', length: 255, nullable: true)]
    #[Groups(['tools.index'])]
    private ?string $website_url = null;

//    /**
//     * @OA\Property(ref: '#/components/schemas/Category')
//     * @var ?Category
//     */
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'category_id', nullable: false)]
    #[Groups(['tools.index'])]
    private ?Category $category_id = null;

    /**
     * @OA\Property(
     *     type="string",
     *     pattern="^\d+(\.\d{1,2})?$",
     * )
     * @var string|NULL
     */
    #[ORM\Column(name: 'monthly_cost', type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['tools.index'])]
    private ?string $monthly_cost = null;

    /**
     * @OA\Property(type="boolean", nullable=true)
     * @var int|NULL
     */
    #[ORM\Column(name: 'active_users_count', type: Types::BOOLEAN, nullable: true)]
    #[Groups(['tools.index'])]
    private ?int $active_users_count = null;

    /**
     * @OA\Property(type="string", nullable=true)
     * @var ?DepartmentType|NULL
     */
    #[ORM\Column(name: 'owner_department', nullable: true, enumType: DepartmentType::class)]
    #[Groups(['tools.index'])]
    private ?DepartmentType $owner_department = null;

    /**
     * @OA\Property(type="string")
     * @var ?StatusType|NULL
     */
    #[ORM\Column(name: 'status', nullable: false, enumType: StatusType::class)]
    #[Groups(['tools.index'])]
    private ?StatusType $status = null;

    /**
     * @OA\Property(type="string", format="date-time", nullable=true)
     * @var ?DateTimeImmutable|NULL
     */
    #[ORM\Column(name: 'created_at', nullable: true)]
    #[Groups(['tools.index'])]
    private ?\DateTimeImmutable $created_at = null;

    /**
     * @OA\Property(type="string", format="date-time", nullable=true)
     * @var ?DateTimeImmutable|NULL
     */
    #[ORM\Column(name: 'updated_at', nullable: true)]
    #[Groups(['tools.show'])]
    private ?\DateTimeImmutable $updated_at = null;

    /**
     * @var Collection<int, UserToolAccess>
     */
    #[ORM\OneToMany(targetEntity: UserToolAccess::class, mappedBy: 'tool_id')]
    private Collection $userAccesses;

    public function __construct()
    {
        $this->userAccesses = new ArrayCollection();
    }

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

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    public function setVendor(?string $vendor): static
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->website_url;
    }

    public function setWebsiteUrl(string $website_url): static
    {
        $this->website_url = $website_url;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): static
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getMonthlyCost(): ?string
    {
        return $this->monthly_cost;
    }

    public function setMonthlyCost(string $monthly_cost): static
    {
        $this->monthly_cost = $monthly_cost;

        return $this;
    }

    public function getActiveUsersCount(): ?int
    {
        return $this->active_users_count;
    }

    public function setActiveUsersCount(int $active_users_count): static
    {
        $this->active_users_count = $active_users_count;

        return $this;
    }

    public function getOwnerDepartment(): ?DepartmentType
    {
        return $this->owner_department;
    }

    public function setOwnerDepartment(?DepartmentType $owner_department): static
    {
        $this->owner_department = $owner_department;

        return $this;
    }

    public function getStatus(): ?StatusType
    {
        return $this->status;
    }

    public function setStatus(?StatusType $status): static
    {
        $this->status = $status;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, UserToolAccess>
     */
    public function getUserAccesses(): Collection
    {
        return $this->userAccesses;
    }

    public function addUserAccess(UserToolAccess $userAccess): static
    {
        if (!$this->userAccesses->contains($userAccess)) {
            $this->userAccesses->add($userAccess);
            $userAccess->setToolId($this);
        }

        return $this;
    }

    public function removeUserAccess(UserToolAccess $userAccess): static
    {
        if ($this->userAccesses->removeElement($userAccess)) {
            // set the owning side to null (unless already changed)
            if ($userAccess->getToolId() === $this) {
                $userAccess->setToolId(null);
            }
        }

        return $this;
    }
}
