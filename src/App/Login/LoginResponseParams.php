<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Finish sign-in with the code sent to the user email address. If the user needs a new account, the response includes account creation copy and username suggestions.
 *
 * @see BeeperDesktop\Services\App\LoginService::response()
 *
 * @phpstan-type LoginResponseParamsShape = array{
 *   request: string, response: string
 * }
 */
final class LoginResponseParams implements BaseModel
{
    /** @use SdkModel<LoginResponseParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Login request ID returned by the start step.
     */
    #[Required]
    public string $request;

    /**
     * Sign-in code from the user email.
     */
    #[Required]
    public string $response;

    /**
     * `new LoginResponseParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginResponseParams::with(request: ..., response: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginResponseParams)->withRequest(...)->withResponse(...)
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
    public static function with(string $request, string $response): self
    {
        $self = new self;

        $self['request'] = $request;
        $self['response'] = $response;

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
     * Sign-in code from the user email.
     */
    public function withResponse(string $response): self
    {
        $self = clone $this;
        $self['response'] = $response;

        return $self;
    }
}
