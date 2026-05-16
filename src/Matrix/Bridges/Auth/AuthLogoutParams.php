<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Log out of an existing login.
 *
 * @see BeeperDesktop\Services\Matrix\Bridges\AuthService::logout()
 *
 * @phpstan-type AuthLogoutParamsShape = array{bridgeID: string}
 */
final class AuthLogoutParams implements BaseModel
{
    /** @use SdkModel<AuthLogoutParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $bridgeID;

    /**
     * `new AuthLogoutParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthLogoutParams::with(bridgeID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthLogoutParams)->withBridgeID(...)
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

    public function withBridgeID(string $bridgeID): self
    {
        $self = clone $this;
        $self['bridgeID'] = $bridgeID;

        return $self;
    }
}
