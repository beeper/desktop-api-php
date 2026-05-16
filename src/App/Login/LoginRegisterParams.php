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
 *   acceptTerms: bool, leadToken: string, request: string, username: string
 * }
 */
final class LoginRegisterParams implements BaseModel
{
    /** @use SdkModel<LoginRegisterParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Confirms that the user accepted the Terms of Use and acknowledged the Privacy Policy.
     */
    #[Required]
    public bool $acceptTerms;

    /**
     * Registration token returned by Beeper.
     */
    #[Required]
    public string $leadToken;

    /**
     * Login request ID returned by the start step.
     */
    #[Required]
    public string $request;

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
     * LoginRegisterParams::with(
     *   acceptTerms: ..., leadToken: ..., request: ..., username: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginRegisterParams)
     *   ->withAcceptTerms(...)
     *   ->withLeadToken(...)
     *   ->withRequest(...)
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
        bool $acceptTerms,
        string $leadToken,
        string $request,
        string $username
    ): self {
        $self = new self;

        $self['acceptTerms'] = $acceptTerms;
        $self['leadToken'] = $leadToken;
        $self['request'] = $request;
        $self['username'] = $username;

        return $self;
    }

    /**
     * Confirms that the user accepted the Terms of Use and acknowledged the Privacy Policy.
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
     * Login request ID returned by the start step.
     */
    public function withRequest(string $request): self
    {
        $self = clone $this;
        $self['request'] = $request;

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
