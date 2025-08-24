<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Response payload for listing connected Beeper accounts.
 */
final class AccountsResponse implements BaseModel
{
    use SdkModel;

    /**
     * Connected accounts the user can act through. Includes accountID, network, and user identity.
     *
     * @var list<Account> $accounts
     */
    #[Api(list: Account::class)]
    public array $accounts;

    /**
     * `new AccountsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountsResponse::with(accounts: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountsResponse)->withAccounts(...)
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
     *
     * @param list<Account> $accounts
     */
    public static function with(array $accounts): self
    {
        $obj = new self;

        $obj->accounts = $accounts;

        return $obj;
    }

    /**
     * Connected accounts the user can act through. Includes accountID, network, and user identity.
     *
     * @param list<Account> $accounts
     */
    public function withAccounts(array $accounts): self
    {
        $obj = clone $this;
        $obj->accounts = $accounts;

        return $obj;
    }
}
