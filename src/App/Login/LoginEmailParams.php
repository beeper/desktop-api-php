<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Send a sign-in code to the user email address.
 *
 * @see BeeperDesktop\Services\App\LoginService::email()
 *
 * @phpstan-type LoginEmailParamsShape = array{email: string, request: string}
 */
final class LoginEmailParams implements BaseModel
{
    /** @use SdkModel<LoginEmailParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Email address to send the sign-in code to.
     */
    #[Required]
    public string $email;

    /**
     * Login request ID returned by the start step.
     */
    #[Required]
    public string $request;

    /**
     * `new LoginEmailParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginEmailParams::with(email: ..., request: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginEmailParams)->withEmail(...)->withRequest(...)
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
    public static function with(string $email, string $request): self
    {
        $self = new self;

        $self['email'] = $email;
        $self['request'] = $request;

        return $self;
    }

    /**
     * Email address to send the sign-in code to.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

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
}
