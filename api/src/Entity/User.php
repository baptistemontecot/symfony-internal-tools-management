<?php

namespace App\Entity;

use App\Enum\DepartmentType;
use App\Enum\RoleType;
use App\Enum\StatusType;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'name', length: 100)]
    private ?string $name = null;

    #[ORM\Column(name: 'email', length: 150)]
    private ?string $email = null;

    #[ORM\Column(name: 'department', enumType: DepartmentType::class)]
    private ?DepartmentType $department = null;

    #[ORM\Column(name: 'role', type: Types::SIMPLE_ARRAY, nullable: true, enumType: RoleType::class)]
    private ?array $role = null;

    #[ORM\Column(name: 'status', nullable: true, enumType: StatusType::class)]
    private ?StatusType $status = null;

    #[ORM\Column(name: 'hire_date', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $hire_date = null;

    #[ORM\Column(name: 'created_at', nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(name: 'updated_at', nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    /**
     * @var Collection<int, UserToolAccess>
     */
    #[ORM\OneToMany(targetEntity: UserToolAccess::class, mappedBy: 'user_id')]
    private Collection $toolAccesses;

    public function __construct()
    {
        $this->toolAccesses = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDepartment(): ?DepartmentType
    {
        return $this->department;
    }

    public function setDepartment(DepartmentType $department): static
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return RoleType[]|null
     */
    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(?array $role): static
    {
        $this->role = $role;

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

    public function getHireDate(): ?\DateTime
    {
        return $this->hire_date;
    }

    public function setHireDate(?\DateTime $hire_date): static
    {
        $this->hire_date = $hire_date;

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
    public function getToolAccesses(): Collection
    {
        return $this->toolAccesses;
    }

    public function addToolAccess(UserToolAccess $toolAccess): static
    {
        if (!$this->toolAccesses->contains($toolAccess)) {
            $this->toolAccesses->add($toolAccess);
            $toolAccess->setUserId($this);
        }

        return $this;
    }

    public function removeToolAccess(UserToolAccess $toolAccess): static
    {
        if ($this->toolAccesses->removeElement($toolAccess)) {
            // set the owning side to null (unless already changed)
            if ($toolAccess->getUserId() === $this) {
                $toolAccess->setUserId(null);
            }
        }

        return $this;
    }
}
