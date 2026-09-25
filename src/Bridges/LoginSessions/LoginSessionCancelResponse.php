<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSessions;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type LoginSessionCancelResponseShape = array{
 *   bridgeID: string, loginSessionID: string, status: 'cancelled'
 * }
 */
final class LoginSessionCancelResponse implements BaseModel
{
    /** @use SdkModel<LoginSessionCancelResponseShape> */
    use SdkModel;

    /** @var 'cancelled' $status */
    #[Required]
    public string $status = 'cancelled';

    #[Required]
    public string $bridgeID;

    #[Required]
    public string $loginSessionID;

    /**
     * `new LoginSessionCancelResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginSessionCancelResponse::with(bridgeID: ..., loginSessionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginSessionCancelResponse)->withBridgeID(...)->withLoginSessionID(...)
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
    public static function with(string $bridgeID, string $loginSessionID): self
    {
        $self = new self;

        $self['bridgeID'] = $bridgeID;
        $self['loginSessionID'] = $loginSessionID;

        return $self;
    }

    public function withBridgeID(string $bridgeID): self
    {
        $self = clone $this;
        $self['bridgeID'] = $bridgeID;

        return $self;
    }

    public function withLoginSessionID(string $loginSessionID): self
    {
        $self = clone $this;
        $self['loginSessionID'] = $loginSessionID;

        return $self;
    }

    /**
     * @param 'cancelled' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
