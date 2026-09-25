<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\Logins;

use BeeperDesktop\Bridges\Logins\LoginRemoveParams\Scope;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Remove a bridge login from this device or, when supported by the bridge, from all devices.
 *
 * @see BeeperDesktop\Services\Bridges\LoginsService::remove()
 *
 * @phpstan-type LoginRemoveParamsShape = array{
 *   bridgeID: string, scope: Scope|value-of<Scope>
 * }
 */
final class LoginRemoveParams implements BaseModel
{
    /** @use SdkModel<LoginRemoveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Bridge ID.
     */
    #[Required]
    public string $bridgeID;

    /**
     * Where this bridge login should be removed.
     *
     * @var value-of<Scope> $scope
     */
    #[Required(enum: Scope::class)]
    public string $scope;

    /**
     * `new LoginRemoveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginRemoveParams::with(bridgeID: ..., scope: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginRemoveParams)->withBridgeID(...)->withScope(...)
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
     *
     * @param Scope|value-of<Scope> $scope
     */
    public static function with(string $bridgeID, Scope|string $scope): self
    {
        $self = new self;

        $self['bridgeID'] = $bridgeID;
        $self['scope'] = $scope;

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

    /**
     * Where this bridge login should be removed.
     *
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }
}
