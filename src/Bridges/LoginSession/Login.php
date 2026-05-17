<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession;

use BeeperDesktop\Bridges\LoginSession\Login\RemoveScope;
use BeeperDesktop\Bridges\LoginSession\Login\Status;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\User;

/**
 * Signed-in identity for a bridge. One bridge login can contain multiple chat accounts.
 *
 * @phpstan-import-type UserShape from \BeeperDesktop\User
 *
 * @phpstan-type LoginShape = array{
 *   bridgeID: string,
 *   loginID: string,
 *   removeScopes: list<RemoveScope|value-of<RemoveScope>>,
 *   status: \BeeperDesktop\Bridges\LoginSession\Login\Status|value-of<\BeeperDesktop\Bridges\LoginSession\Login\Status>,
 *   accountIDs?: list<string>|null,
 *   statusText?: string|null,
 *   user?: null|User|UserShape,
 * }
 */
final class Login implements BaseModel
{
    /** @use SdkModel<LoginShape> */
    use SdkModel;

    /**
     * Bridge ID.
     */
    #[Required]
    public string $bridgeID;

    /**
     * Bridge login ID.
     */
    #[Required]
    public string $loginID;

    /** @var list<value-of<RemoveScope>> $removeScopes */
    #[Required(list: RemoveScope::class)]
    public array $removeScopes;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Chat accounts that belong to this bridge login, when known.
     *
     * @var list<string>|null $accountIDs
     */
    #[Optional(list: 'string')]
    public ?array $accountIDs;

    /**
     * Human-friendly bridge login status text.
     */
    #[Optional]
    public ?string $statusText;

    /**
     * User the account belongs to.
     */
    #[Optional]
    public ?User $user;

    /**
     * `new Login()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Login::with(bridgeID: ..., loginID: ..., removeScopes: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Login)
     *   ->withBridgeID(...)
     *   ->withLoginID(...)
     *   ->withRemoveScopes(...)
     *   ->withStatus(...)
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
     * @param list<RemoveScope|value-of<RemoveScope>> $removeScopes
     * @param Status|value-of<Status> $status
     * @param list<string>|null $accountIDs
     * @param User|UserShape|null $user
     */
    public static function with(
        string $bridgeID,
        string $loginID,
        array $removeScopes,
        Status|string $status,
        ?array $accountIDs = null,
        ?string $statusText = null,
        User|array|null $user = null,
    ): self {
        $self = new self;

        $self['bridgeID'] = $bridgeID;
        $self['loginID'] = $loginID;
        $self['removeScopes'] = $removeScopes;
        $self['status'] = $status;

        null !== $accountIDs && $self['accountIDs'] = $accountIDs;
        null !== $statusText && $self['statusText'] = $statusText;
        null !== $user && $self['user'] = $user;

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
     * Bridge login ID.
     */
    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

        return $self;
    }

    /**
     * @param list<RemoveScope|value-of<RemoveScope>> $removeScopes
     */
    public function withRemoveScopes(array $removeScopes): self
    {
        $self = clone $this;
        $self['removeScopes'] = $removeScopes;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(
        Status|string $status
    ): self {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Chat accounts that belong to this bridge login, when known.
     *
     * @param list<string> $accountIDs
     */
    public function withAccountIDs(array $accountIDs): self
    {
        $self = clone $this;
        $self['accountIDs'] = $accountIDs;

        return $self;
    }

    /**
     * Human-friendly bridge login status text.
     */
    public function withStatusText(string $statusText): self
    {
        $self = clone $this;
        $self['statusText'] = $statusText;

        return $self;
    }

    /**
     * User the account belongs to.
     *
     * @param User|UserShape $user
     */
    public function withUser(User|array $user): self
    {
        $self = clone $this;
        $self['user'] = $user;

        return $self;
    }
}
