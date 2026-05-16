<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Users\AccountData;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Get some account data for the client. This config is only visible to the user
 * that set the account data.
 *
 * @see BeeperDesktop\Services\Matrix\Users\AccountDataService::retrieve()
 *
 * @phpstan-type AccountDataRetrieveParamsShape = array{userID: string}
 */
final class AccountDataRetrieveParams implements BaseModel
{
    /** @use SdkModel<AccountDataRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $userID;

    /**
     * `new AccountDataRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountDataRetrieveParams::with(userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountDataRetrieveParams)->withUserID(...)
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
    public static function with(string $userID): self
    {
        $self = new self;

        $self['userID'] = $userID;

        return $self;
    }

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
