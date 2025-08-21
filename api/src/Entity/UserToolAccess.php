<?php

namespace App\Entity;

use App\Enum\StatusType;
use App\Repository\UserToolAccessRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserToolAccessRepository::class)]
class UserToolAccess
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'toolAccesses')]
    #[ORM\JoinColumn(name: 'user_id', nullable: false)]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'userAccesses')]
    #[ORM\JoinColumn(name: 'tool_id', nullable: false)]
    private ?Tool $tool_id = null;

    #[ORM\Column(name: 'granted_at', nullable: true)]
    private ?\DateTimeImmutable $granted_at = null;

    #[ORM\Column(name: 'granted_by')]
    private ?int $granted_by = null;

    #[ORM\Column(name: 'revoked_at', nullable: true)]
    private ?\DateTimeImmutable $revoked_at = null;

    #[ORM\Column(name: 'revoked_by', nullable: true)]
    private ?int $revoked_by = null;

    #[ORM\Column(name: 'status', nullable: true, enumType: StatusType::class)]
    private ?StatusType $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getToolId(): ?Tool
    {
        return $this->tool_id;
    }

    public function setToolId(?Tool $tool_id): static
    {
        $this->tool_id = $tool_id;

        return $this;
    }

    public function getGrantedAt(): ?\DateTimeImmutable
    {
        return $this->granted_at;
    }

    public function setGrantedAt(?\DateTimeImmutable $granted_at): static
    {
        $this->granted_at = $granted_at;

        return $this;
    }

    public function getGrantedBy(): ?int
    {
        return $this->granted_by;
    }

    public function setGrantedBy(int $granted_by): static
    {
        $this->granted_by = $granted_by;

        return $this;
    }

    public function getRevokedAt(): ?\DateTimeImmutable
    {
        return $this->revoked_at;
    }

    public function setRevokedAt(?\DateTimeImmutable $revoked_at): static
    {
        $this->revoked_at = $revoked_at;

        return $this;
    }

    public function getRevokedBy(): ?int
    {
        return $this->revoked_by;
    }

    public function setRevokedBy(?int $revoked_by): static
    {
        $this->revoked_by = $revoked_by;

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
}
