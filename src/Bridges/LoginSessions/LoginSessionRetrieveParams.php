<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSessions;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Get the current state of a temporary bridge login session.
 *
 * @see BeeperDesktop\Services\Bridges\LoginSessionsService::retrieve()
 *
 * @phpstan-type LoginSessionRetrieveParamsShape = array{bridgeID: string}
 */
final class LoginSessionRetrieveParams implements BaseModel
{
    /** @use SdkModel<LoginSessionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Bridge ID.
     */
    #[Required]
    public string $bridgeID;

    /**
     * `new LoginSessionRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginSessionRetrieveParams::with(bridgeID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginSessionRetrieveParams)->withBridgeID(...)
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
