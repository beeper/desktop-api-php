<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember3;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Information about the completed login.
 *
 * @phpstan-type CompleteShape = array{userLoginID?: string|null}
 */
final class Complete implements BaseModel
{
    /** @use SdkModel<CompleteShape> */
    use SdkModel;

    /**
     * The unique ID of a login. Defined by the network connector.
     */
    #[Optional('user_login_id')]
    public ?string $userLoginID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $userLoginID = null): self
    {
        $self = new self;

        null !== $userLoginID && $self['userLoginID'] = $userLoginID;

        return $self;
    }

    /**
     * The unique ID of a login. Defined by the network connector.
     */
    public function withUserLoginID(string $userLoginID): self
    {
        $self = clone $this;
        $self['userLoginID'] = $userLoginID;

        return $self;
    }
}
