<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\Logins;

use BeeperDesktop\Bridges\Logins\LoginRemoveResponse\Scope;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type LoginRemoveResponseShape = array{
 *   bridgeID: string,
 *   loginID: string,
 *   scope: Scope|value-of<Scope>,
 *   status: 'removed',
 *   affectedAccountIDs?: list<string>|null,
 * }
 */
final class LoginRemoveResponse implements BaseModel
{
    /** @use SdkModel<LoginRemoveResponseShape> */
    use SdkModel;

    /** @var 'removed' $status */
    #[Required]
    public string $status = 'removed';

    #[Required]
    public string $bridgeID;

    #[Required]
    public string $loginID;

    /**
     * Where this bridge login should be removed.
     *
     * @var value-of<Scope> $scope
     */
    #[Required(enum: Scope::class)]
    public string $scope;

    /** @var list<string>|null $affectedAccountIDs */
    #[Optional(list: 'string')]
    public ?array $affectedAccountIDs;

    /**
     * `new LoginRemoveResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginRemoveResponse::with(bridgeID: ..., loginID: ..., scope: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginRemoveResponse)->withBridgeID(...)->withLoginID(...)->withScope(...)
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
     * @param list<string>|null $affectedAccountIDs
     */
    public static function with(
        string $bridgeID,
        string $loginID,
        Scope|string $scope,
        ?array $affectedAccountIDs = null,
    ): self {
        $self = new self;

        $self['bridgeID'] = $bridgeID;
        $self['loginID'] = $loginID;
        $self['scope'] = $scope;

        null !== $affectedAccountIDs && $self['affectedAccountIDs'] = $affectedAccountIDs;

        return $self;
    }

    public function withBridgeID(string $bridgeID): self
    {
        $self = clone $this;
        $self['bridgeID'] = $bridgeID;

        return $self;
    }

    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

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

    /**
     * @param 'removed' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * @param list<string> $affectedAccountIDs
     */
    public function withAffectedAccountIDs(array $affectedAccountIDs): self
    {
        $self = clone $this;
        $self['affectedAccountIDs'] = $affectedAccountIDs;

        return $self;
    }
}
