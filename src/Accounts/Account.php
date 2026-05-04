<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts;

use BeeperDesktop\Accounts\Account\Bridge;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\User;

/**
 * A chat account added to Beeper.
 *
 * @phpstan-import-type BridgeShape from \BeeperDesktop\Accounts\Account\Bridge
 * @phpstan-import-type UserShape from \BeeperDesktop\User
 *
 * @phpstan-type AccountShape = array{
 *   accountID: string,
 *   bridge: Bridge|BridgeShape,
 *   user: User|UserShape,
 *   network?: string|null,
 * }
 */
final class Account implements BaseModel
{
    /** @use SdkModel<AccountShape> */
    use SdkModel;

    /**
     * Chat account added to Beeper. Use this to route account-scoped actions.
     */
    #[Required]
    public string $accountID;

    /**
     * Bridge metadata for the account. Available in Beeper Desktop v4.2.799+.
     */
    #[Required]
    public Bridge $bridge;

    /**
     * User the account belongs to.
     */
    #[Required]
    public User $user;

    /**
     * Human-friendly network name for the account. Omitted when the network is unknown.
     */
    #[Optional]
    public ?string $network;

    /**
     * `new Account()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Account::with(accountID: ..., bridge: ..., user: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Account)->withAccountID(...)->withBridge(...)->withUser(...)
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
     * @param Bridge|BridgeShape $bridge
     * @param User|UserShape $user
     */
    public static function with(
        string $accountID,
        Bridge|array $bridge,
        User|array $user,
        ?string $network = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['bridge'] = $bridge;
        $self['user'] = $user;

        null !== $network && $self['network'] = $network;

        return $self;
    }

    /**
     * Chat account added to Beeper. Use this to route account-scoped actions.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Bridge metadata for the account. Available in Beeper Desktop v4.2.799+.
     *
     * @param Bridge|BridgeShape $bridge
     */
    public function withBridge(Bridge|array $bridge): self
    {
        $self = clone $this;
        $self['bridge'] = $bridge;

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

    /**
     * Human-friendly network name for the account. Omitted when the network is unknown.
     */
    public function withNetwork(string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }
}
