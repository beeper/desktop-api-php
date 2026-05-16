<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Users;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Search for users on the remote network.
 *
 * @see BeeperDesktop\Services\Matrix\Bridges\UsersService::search()
 *
 * @phpstan-type UserSearchParamsShape = array{
 *   loginID?: string|null, query?: string|null
 * }
 */
final class UserSearchParams implements BaseModel
{
    /** @use SdkModel<UserSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * An optional explicit login ID to do the action through.
     */
    #[Optional]
    public ?string $loginID;

    /**
     * The search query to send to the remote network.
     */
    #[Optional]
    public ?string $query;

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
        ?string $loginID = null,
        ?string $query = null
    ): self {
        $self = new self;

        null !== $loginID && $self['loginID'] = $loginID;
        null !== $query && $self['query'] = $query;

        return $self;
    }

    /**
     * An optional explicit login ID to do the action through.
     */
    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

        return $self;
    }

    /**
     * The search query to send to the remote network.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
