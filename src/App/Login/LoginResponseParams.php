<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Finish setup sign-in with the code sent to the user email address. If the user needs a new account, the response includes account creation copy and username suggestions.
 *
 * @see BeeperDesktop\Services\App\LoginService::response()
 *
 * @phpstan-type LoginResponseParamsShape = array{
 *   response: string, setupRequestID: string
 * }
 */
final class LoginResponseParams implements BaseModel
{
    /** @use SdkModel<LoginResponseParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Sign-in code from the user email.
     */
    #[Required]
    public string $response;

    /**
     * Setup request ID returned by the start step.
     */
    #[Required]
    public string $setupRequestID;

    /**
     * `new LoginResponseParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginResponseParams::with(response: ..., setupRequestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginResponseParams)->withResponse(...)->withSetupRequestID(...)
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
    public static function with(string $response, string $setupRequestID): self
    {
        $self = new self;

        $self['response'] = $response;
        $self['setupRequestID'] = $setupRequestID;

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

    /**
     * Setup request ID returned by the start step.
     */
    public function withSetupRequestID(string $setupRequestID): self
    {
        $self = clone $this;
        $self['setupRequestID'] = $setupRequestID;

        return $self;
    }
}
