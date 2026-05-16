<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Login;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * The profile info of the logged-in user on the remote network.
 *
 * @phpstan-type ProfileShape = array{
 *   avatar?: string|null,
 *   email?: string|null,
 *   name?: string|null,
 *   phone?: string|null,
 *   username?: string|null,
 * }
 */
final class Profile implements BaseModel
{
    /** @use SdkModel<ProfileShape> */
    use SdkModel;

    /**
     * The user's avatar.
     */
    #[Optional]
    public ?string $avatar;

    /**
     * The user's email address.
     */
    #[Optional]
    public ?string $email;

    /**
     * The user's displayname.
     */
    #[Optional]
    public ?string $name;

    /**
     * The user's phone number.
     */
    #[Optional]
    public ?string $phone;

    /**
     * The user's username.
     */
    #[Optional]
    public ?string $username;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $avatar = null,
        ?string $email = null,
        ?string $name = null,
        ?string $phone = null,
        ?string $username = null,
    ): self {
        $self = new self;

        null !== $avatar && $self['avatar'] = $avatar;
        null !== $email && $self['email'] = $email;
        null !== $name && $self['name'] = $name;
        null !== $phone && $self['phone'] = $phone;
        null !== $username && $self['username'] = $username;

        return $self;
    }

    /**
     * The user's avatar.
     */
    public function withAvatar(string $avatar): self
    {
        $self = clone $this;
        $self['avatar'] = $avatar;

        return $self;
    }

    /**
     * The user's email address.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The user's displayname.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The user's phone number.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }

    /**
     * The user's username.
     */
    public function withUsername(string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
