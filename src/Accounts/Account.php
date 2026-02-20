<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\User;

/**
 * A chat account added to Beeper.
 *
 * @phpstan-import-type UserShape from \BeeperDesktop\User
 *
 * @phpstan-type AccountShape = array{accountID: string, user: User|UserShape}
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
     * User the account belongs to.
     */
    #[Required]
    public User $user;

    /**
     * `new Account()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Account::with(accountID: ..., user: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Account)->withAccountID(...)->withUser(...)
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
     * @param User|UserShape $user
     */
    public static function with(string $accountID, User|array $user): self
    {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['user'] = $user;

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
