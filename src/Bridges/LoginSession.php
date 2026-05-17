<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Accounts\Account;
use BeeperDesktop\APIError;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\CompleteLoginStep;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\CookiesLoginStep;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\UserInputLoginStep;
use BeeperDesktop\Bridges\LoginSession\Login;
use BeeperDesktop\Bridges\LoginSession\Status;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CurrentStepVariants from \BeeperDesktop\Bridges\LoginSession\CurrentStep
 * @phpstan-import-type AccountShape from \BeeperDesktop\Accounts\Account
 * @phpstan-import-type CurrentStepShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep
 * @phpstan-import-type APIErrorShape from \BeeperDesktop\APIError
 * @phpstan-import-type LoginShape from \BeeperDesktop\Bridges\LoginSession\Login
 *
 * @phpstan-type LoginSessionShape = array{
 *   bridgeID: string,
 *   loginSessionID: string,
 *   status: Status|value-of<Status>,
 *   account?: null|Account|AccountShape,
 *   accountID?: string|null,
 *   currentStep?: CurrentStepShape|null,
 *   error?: null|APIError|APIErrorShape,
 *   login?: null|Login|LoginShape,
 *   loginID?: string|null,
 * }
 */
final class LoginSession implements BaseModel
{
    /** @use SdkModel<LoginSessionShape> */
    use SdkModel;

    /**
     * Bridge ID.
     */
    #[Required]
    public string $bridgeID;

    /**
     * Temporary bridge login session ID.
     */
    #[Required]
    public string $loginSessionID;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * A chat account added to Beeper.
     */
    #[Optional]
    public ?Account $account;

    /**
     * Chat account ID for reconnect flows, when known.
     */
    #[Optional]
    public ?string $accountID;

    /**
     * Step the client should show or complete next. Omitted when the session is complete, cancelled, or failed.
     *
     * @var CurrentStepVariants|null $currentStep
     */
    #[Optional]
    public UserInputLoginStep|CookiesLoginStep|DisplayAndWaitLoginStep|CompleteLoginStep|null $currentStep;

    #[Optional]
    public ?APIError $error;

    /**
     * Signed-in identity for a bridge. One bridge login can contain multiple chat accounts.
     */
    #[Optional]
    public ?Login $login;

    /**
     * Bridge login ID for reconnect flows, when known.
     */
    #[Optional]
    public ?string $loginID;

    /**
     * `new LoginSession()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginSession::with(bridgeID: ..., loginSessionID: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginSession)->withBridgeID(...)->withLoginSessionID(...)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     * @param Account|AccountShape|null $account
     * @param CurrentStepShape|null $currentStep
     * @param APIError|APIErrorShape|null $error
     * @param Login|LoginShape|null $login
     */
    public static function with(
        string $bridgeID,
        string $loginSessionID,
        Status|string $status,
        Account|array|null $account = null,
        ?string $accountID = null,
        UserInputLoginStep|array|CookiesLoginStep|DisplayAndWaitLoginStep|CompleteLoginStep|null $currentStep = null,
        APIError|array|null $error = null,
        Login|array|null $login = null,
        ?string $loginID = null,
    ): self {
        $self = new self;

        $self['bridgeID'] = $bridgeID;
        $self['loginSessionID'] = $loginSessionID;
        $self['status'] = $status;

        null !== $account && $self['account'] = $account;
        null !== $accountID && $self['accountID'] = $accountID;
        null !== $currentStep && $self['currentStep'] = $currentStep;
        null !== $error && $self['error'] = $error;
        null !== $login && $self['login'] = $login;
        null !== $loginID && $self['loginID'] = $loginID;

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
     * Temporary bridge login session ID.
     */
    public function withLoginSessionID(string $loginSessionID): self
    {
        $self = clone $this;
        $self['loginSessionID'] = $loginSessionID;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A chat account added to Beeper.
     *
     * @param Account|AccountShape $account
     */
    public function withAccount(Account|array $account): self
    {
        $self = clone $this;
        $self['account'] = $account;

        return $self;
    }

    /**
     * Chat account ID for reconnect flows, when known.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Step the client should show or complete next. Omitted when the session is complete, cancelled, or failed.
     *
     * @param CurrentStepShape $currentStep
     */
    public function withCurrentStep(
        UserInputLoginStep|array|CookiesLoginStep|DisplayAndWaitLoginStep|CompleteLoginStep $currentStep,
    ): self {
        $self = clone $this;
        $self['currentStep'] = $currentStep;

        return $self;
    }

    /**
     * @param APIError|APIErrorShape $error
     */
    public function withError(APIError|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Signed-in identity for a bridge. One bridge login can contain multiple chat accounts.
     *
     * @param Login|LoginShape $login
     */
    public function withLogin(Login|array $login): self
    {
        $self = clone $this;
        $self['login'] = $login;

        return $self;
    }

    /**
     * Bridge login ID for reconnect flows, when known.
     */
    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

        return $self;
    }
}
