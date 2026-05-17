<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Create a Beeper account after the user chooses a username and accepts the Terms of Use.
 *
 * @see BeeperDesktop\Services\App\LoginService::register()
 *
 * @phpstan-type LoginRegisterParamsShape = array{
 *   acceptTerms: bool, leadToken: string, setupRequestID: string, username: string
 * }
 */
final class LoginRegisterParams implements BaseModel
{
    /** @use SdkModel<LoginRegisterParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Confirms that the user agreed to our [terms of use](https://www.beeper.com/terms-onboarding) and has read our [privacy policy](https://www.beeper.com/privacy).
     */
    #[Required]
    public bool $acceptTerms = true;

    /**
     * Registration token returned by Beeper.
     */
    #[Required]
    public string $leadToken;

    /**
     * Setup request ID returned by the start step.
     */
    #[Required]
    public string $setupRequestID;

    /**
     * Username selected by the user.
     */
    #[Required]
    public string $username;

    /**
     * `new LoginRegisterParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginRegisterParams::with(leadToken: ..., setupRequestID: ..., username: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginRegisterParams)
     *   ->withLeadToken(...)
     *   ->withSetupRequestID(...)
     *   ->withUsername(...)
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
    public static function with(
        string $leadToken,
        string $setupRequestID,
        string $username
    ): self {
        $self = new self;

        $self['leadToken'] = $leadToken;
        $self['setupRequestID'] = $setupRequestID;
        $self['username'] = $username;

        return $self;
    }

    /**
     * Confirms that the user agreed to our [terms of use](https://www.beeper.com/terms-onboarding) and has read our [privacy policy](https://www.beeper.com/privacy).
     */
    public function withAcceptTerms(bool $acceptTerms): self
    {
        $self = clone $this;
        $self['acceptTerms'] = $acceptTerms;

        return $self;
    }

    /**
     * Registration token returned by Beeper.
     */
    public function withLeadToken(string $leadToken): self
    {
        $self = clone $this;
        $self['leadToken'] = $leadToken;

        return $self;
    }

    /**
     * Setup request ID returned by the start step.
     */
    public function withSetupRequestID(string $setupRequestID): self
    {
        $self = clone $this;
        $self['setupRequestID'] = $setupRequestID;

        return $self;
    }

    /**
     * Username selected by the user.
     */
    public function withUsername(string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
