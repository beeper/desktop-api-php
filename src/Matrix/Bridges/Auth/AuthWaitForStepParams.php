<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Wait for the next step after displaying data to the user.
 *
 * @see BeeperDesktop\Services\Matrix\Bridges\AuthService::waitForStep()
 *
 * @phpstan-type AuthWaitForStepParamsShape = array{
 *   bridgeID: string, loginProcessID: string
 * }
 */
final class AuthWaitForStepParams implements BaseModel
{
    /** @use SdkModel<AuthWaitForStepParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $bridgeID;

    #[Required]
    public string $loginProcessID;

    /**
     * `new AuthWaitForStepParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthWaitForStepParams::with(bridgeID: ..., loginProcessID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthWaitForStepParams)->withBridgeID(...)->withLoginProcessID(...)
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
    public static function with(string $bridgeID, string $loginProcessID): self
    {
        $self = new self;

        $self['bridgeID'] = $bridgeID;
        $self['loginProcessID'] = $loginProcessID;

        return $self;
    }

    public function withBridgeID(string $bridgeID): self
    {
        $self = clone $this;
        $self['bridgeID'] = $bridgeID;

        return $self;
    }

    public function withLoginProcessID(string $loginProcessID): self
    {
        $self = clone $this;
        $self['loginProcessID'] = $loginProcessID;

        return $self;
    }
}
