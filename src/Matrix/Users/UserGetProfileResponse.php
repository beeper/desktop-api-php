<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Users;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type UserGetProfileResponseShape = array{
 *   avatarURL?: string|null, displayname?: string|null, mTz?: string|null
 * }
 */
final class UserGetProfileResponse implements BaseModel
{
    /** @use SdkModel<UserGetProfileResponseShape> */
    use SdkModel;

    /**
     * The user's avatar URL if they have set one, otherwise not present.
     */
    #[Optional('avatar_url')]
    public ?string $avatarURL;

    /**
     * The user's display name if they have set one, otherwise not present.
     */
    #[Optional]
    public ?string $displayname;

    /**
     * The user's time zone.
     */
    #[Optional('m.tz')]
    public ?string $mTz;

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
        ?string $avatarURL = null,
        ?string $displayname = null,
        ?string $mTz = null
    ): self {
        $self = new self;

        null !== $avatarURL && $self['avatarURL'] = $avatarURL;
        null !== $displayname && $self['displayname'] = $displayname;
        null !== $mTz && $self['mTz'] = $mTz;

        return $self;
    }

    /**
     * The user's avatar URL if they have set one, otherwise not present.
     */
    public function withAvatarURL(string $avatarURL): self
    {
        $self = clone $this;
        $self['avatarURL'] = $avatarURL;

        return $self;
    }

    /**
     * The user's display name if they have set one, otherwise not present.
     */
    public function withDisplayname(string $displayname): self
    {
        $self = clone $this;
        $self['displayname'] = $displayname;

        return $self;
    }

    /**
     * The user's time zone.
     */
    public function withMTz(string $mTz): self
    {
        $self = clone $this;
        $self['mTz'] = $mTz;

        return $self;
    }
}
