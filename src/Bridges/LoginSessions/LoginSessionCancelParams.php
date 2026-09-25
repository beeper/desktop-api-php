<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSessions;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Cancel a temporary bridge login session.
 *
 * @see BeeperDesktop\Services\Bridges\LoginSessionsService::cancel()
 *
 * @phpstan-type LoginSessionCancelParamsShape = array{bridgeID: string}
 */
final class LoginSessionCancelParams implements BaseModel
{
    /** @use SdkModel<LoginSessionCancelParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Bridge ID.
     */
    #[Required]
    public string $bridgeID;

    /**
     * `new LoginSessionCancelParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginSessionCancelParams::with(bridgeID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginSessionCancelParams)->withBridgeID(...)
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
    public static function with(string $bridgeID): self
    {
        $self = new self;

        $self['bridgeID'] = $bridgeID;

        return $self;
    }

    /**
     * Bridge ID.
     */
    public function withBridgeID(string $bridgeID): self
    {
        $self = clone $this;
        $self['bridgeID'] = $bridgeID;

        return $self;
    }
}
