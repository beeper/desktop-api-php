<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams\Chat;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Required when mode='start'. Merged user-like contact payload used to resolve the best identifier.
 *
 * @phpstan-type UserShape = array{
 *   id?: string|null,
 *   email?: string|null,
 *   fullName?: string|null,
 *   phoneNumber?: string|null,
 *   username?: string|null,
 * }
 */
final class User implements BaseModel
{
    /** @use SdkModel<UserShape> */
    use SdkModel;

    /**
     * Known user ID when available.
     */
    #[Optional]
    public ?string $id;

    /**
     * Email candidate.
     */
    #[Optional]
    public ?string $email;

    /**
     * Display name hint used for ranking only.
     */
    #[Optional]
    public ?string $fullName;

    /**
     * Phone number candidate (E.164 preferred).
     */
    #[Optional]
    public ?string $phoneNumber;

    /**
     * Username/handle candidate.
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
        ?string $id = null,
        ?string $email = null,
        ?string $fullName = null,
        ?string $phoneNumber = null,
        ?string $username = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $email && $self['email'] = $email;
        null !== $fullName && $self['fullName'] = $fullName;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $username && $self['username'] = $username;

        return $self;
    }

    /**
     * Known user ID when available.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Email candidate.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Display name hint used for ranking only.
     */
    public function withFullName(string $fullName): self
    {
        $self = clone $this;
        $self['fullName'] = $fullName;

        return $self;
    }

    /**
     * Phone number candidate (E.164 preferred).
     */
    public function withPhoneNumber(string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * Username/handle candidate.
     */
    public function withUsername(string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
