<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSessions;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Start a temporary bridge login session to connect a new chat account or reconnect an existing bridge login. Omit loginID and accountID to connect a new account.
 *
 * @see BeeperDesktop\Services\Bridges\LoginSessionsService::create()
 *
 * @phpstan-type LoginSessionCreateParamsShape = array{
 *   accountID?: string|null, flowID?: string|null, loginID?: string|null
 * }
 */
final class LoginSessionCreateParams implements BaseModel
{
    /** @use SdkModel<LoginSessionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Existing chat account ID to reconnect. Omit to connect a new account.
     */
    #[Optional]
    public ?string $accountID;

    /**
     * Optional flow ID returned by the list login flows endpoint. If omitted, Beeper chooses the default flow.
     */
    #[Optional]
    public ?string $flowID;

    /**
     * Existing bridge login ID to reconnect. Omit to connect a new account.
     */
    #[Optional]
    public ?string $loginID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $accountID = null,
        ?string $flowID = null,
        ?string $loginID = null
    ): self {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;
        null !== $flowID && $self['flowID'] = $flowID;
        null !== $loginID && $self['loginID'] = $loginID;

        return $self;
    }

    /**
     * Existing chat account ID to reconnect. Omit to connect a new account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Optional flow ID returned by the list login flows endpoint. If omitted, Beeper chooses the default flow.
     */
    public function withFlowID(string $flowID): self
    {
        $self = clone $this;
        $self['flowID'] = $flowID;

        return $self;
    }

    /**
     * Existing bridge login ID to reconnect. Omit to connect a new account.
     */
    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

        return $self;
    }
}
