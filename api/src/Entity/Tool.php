<?php

namespace App\Entity;

use App\Enum\DepartmentType;
use App\Enum\StatusType;
use App\Repository\ToolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToolRepository::class)]
#[ORM\Table(name: 'tools')]
class Tool
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'name', length: 100)]
    private ?string $name = null;

    #[ORM\Column(name: 'description', type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(name: 'vendor', length: 100, nullable: true)]
    private ?string $vendor = null;

    #[ORM\Column(name: 'website_url', length: 255)]
    private ?string $website_url = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'category_id', nullable: false)]
    private ?Category $category_id = null;

    #[ORM\Column(name: 'monthly_cost', type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $monthly_cost = null;

    #[ORM\Column(name: 'active_users_count', type: Types::BOOLEAN, nullable: true)]
    private ?int $active_users_count = null;

    #[ORM\Column(name: 'owner_department', nullable: true, enumType: DepartmentType::class)]
    private ?DepartmentType $owner_department = null;

    #[ORM\Column(name: 'status', nullable: false, enumType: StatusType::class)]
    private ?StatusType $status = null;

    #[ORM\Column(name: 'created_at', nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(name: 'updated_at', nullable: true)]
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
