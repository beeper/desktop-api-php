<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Shared\User;

/**
 * A chat account added to Beeper.
 */
final class Account implements BaseModel
{
    use SdkModel;

    /**
     * Chat account added to Beeper. Use this to route account-scoped actions.
     */
    #[Api]
    public string $accountID;

    /**
     * Display-only human-readable network name (e.g., 'WhatsApp', 'Messenger'). You MUST use 'accountID' to perform actions.
     */
    #[Api]
    public string $network;

    /**
     * A person on or reachable through Beeper. Values are best-effort and can vary by network.
     */
    #[Api]
    public User $user;

    /**
     * `new Account()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Account::with(accountID: ..., network: ..., user: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Account)->withAccountID(...)->withNetwork(...)->withUser(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $accountID,
        string $network,
        User $user
    ): self {
        $obj = new self;

        $obj->accountID = $accountID;
        $obj->network = $network;
        $obj->user = $user;

        return $obj;
    }

    /**
     * Chat account added to Beeper. Use this to route account-scoped actions.
     */
    public function withAccountID(string $accountID): self
    {
        $obj = clone $this;
        $obj->accountID = $accountID;

        return $obj;
    }

    /**
     * Display-only human-readable network name (e.g., 'WhatsApp', 'Messenger'). You MUST use 'accountID' to perform actions.
     */
    public function withNetwork(string $network): self
    {
        $obj = clone $this;
        $obj->network = $network;

        return $obj;
    }

    /**
     * A person on or reachable through Beeper. Values are best-effort and can vary by network.
     */
    public function withUser(User $user): self
    {
        $obj = clone $this;
        $obj->user = $user;

        return $obj;
    }
}
