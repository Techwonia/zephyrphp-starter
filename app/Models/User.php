<?php

declare(strict_types=1);

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use ZephyrPHP\Database\Model;
use ZephyrPHP\Auth\AuthenticatableInterface;
use ZephyrPHP\Auth\Authenticatable;
use ZephyrPHP\Authorization\Traits\HasRoles;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[ORM\HasLifecycleCallbacks]
class User extends Model implements AuthenticatableInterface
{
    use Authenticatable;
    use HasRoles;

    #[ORM\Column(type: 'string', length: 255)]
    protected string $name = '';

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    protected string $email = '';

    #[ORM\Column(type: 'string', length: 255)]
    protected string $password = '';

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    protected ?string $rememberToken = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected ?string $twoFactorSecret = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    protected bool $twoFactorEnabled = false;

    #[ORM\Column(type: 'text', nullable: true)]
    protected ?string $twoFactorRecoveryCodes = null;

    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'users')]
    #[ORM\JoinTable(name: 'role_user')]
    private Collection $roles;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->initializeRoles();
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getAuthPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRememberToken(): ?string
    {
        return $this->rememberToken;
    }

    public function setRememberToken(string $token): void
    {
        $this->rememberToken = $token;
    }

    public function getRememberTokenName(): string
    {
        return 'rememberToken';
    }

    public function getTwoFactorSecret(): ?string
    {
        return $this->twoFactorSecret;
    }

    public function setTwoFactorSecret(?string $secret): self
    {
        $this->twoFactorSecret = $secret;
        return $this;
    }

    public function isTwoFactorEnabled(): bool
    {
        return $this->twoFactorEnabled;
    }

    public function setTwoFactorEnabled(bool $enabled): self
    {
        $this->twoFactorEnabled = $enabled;
        return $this;
    }

    public function getTwoFactorRecoveryCodes(): ?string
    {
        return $this->twoFactorRecoveryCodes;
    }

    public function setTwoFactorRecoveryCodes(?string $codes): self
    {
        $this->twoFactorRecoveryCodes = $codes;
        return $this;
    }
}
