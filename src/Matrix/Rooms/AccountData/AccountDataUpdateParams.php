<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms\AccountData;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Set some account data for the client on a given room. This config is only
 * visible to the user that set the account data. The config will be delivered to
 * clients in the per-room entries via [/sync](https://spec.matrix.org/v1.18/client-server-api/#get_matrixclientv3sync).
 *
 * @see BeeperDesktop\Services\Matrix\Rooms\AccountDataService::update()
 *
 * @phpstan-type AccountDataUpdateParamsShape = array{
 *   userID: string, roomID: string, body: mixed
 * }
 */
final class AccountDataUpdateParams implements BaseModel
{
    /** @use SdkModel<AccountDataUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $userID;

    #[Required]
    public string $roomID;

    #[Required]
    public mixed $body;

    /**
     * `new AccountDataUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountDataUpdateParams::with(userID: ..., roomID: ..., body: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountDataUpdateParams)->withUserID(...)->withRoomID(...)->withBody(...)
     * ```
     */
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
        string $userID,
        string $roomID,
        mixed $body
    ): self {
        $self = new self;

        $self['userID'] = $userID;
        $self['roomID'] = $roomID;
        $self['body'] = $body;

        return $self;
    }

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }

    public function withRoomID(string $roomID): self
    {
        $self = clone $this;
        $self['roomID'] = $roomID;

        return $self;
    }

    public function withBody(mixed $body): self
    {
        $self = clone $this;
        $self['body'] = $body;

        return $self;
    }
}
