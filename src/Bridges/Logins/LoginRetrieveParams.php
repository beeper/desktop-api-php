<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\Logins;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Get one bridge login.
 *
 * @see BeeperDesktop\Services\Bridges\LoginsService::retrieve()
 *
 * @phpstan-type LoginRetrieveParamsShape = array{bridgeID: string}
 */
final class LoginRetrieveParams implements BaseModel
{
    /** @use SdkModel<LoginRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Bridge ID.
     */
    #[Required]
    public string $bridgeID;

    /**
     * `new LoginRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginRetrieveParams::with(bridgeID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginRetrieveParams)->withBridgeID(...)
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
