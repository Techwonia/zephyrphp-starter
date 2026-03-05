<?php

declare(strict_types=1);

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ZephyrPHP\Database\Model;

#[ORM\Entity]
#[ORM\Table(name: 'roles')]
#[ORM\HasLifecycleCallbacks]
class Role extends Model
{
    #[ORM\Column(type: 'string', length: 100, unique: true)]
    protected string $name = '';

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    protected string $slug = '';

    #[ORM\Column(type: 'text', nullable: true)]
    protected ?string $description = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'roles')]
    private Collection $users;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->users = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }
}
