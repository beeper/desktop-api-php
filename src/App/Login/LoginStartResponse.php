<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type LoginStartResponseShape = array{
 *   setupRequestID: string, signInMethods: list<string>
 * }
 */
final class LoginStartResponse implements BaseModel
{
    /** @use SdkModel<LoginStartResponseShape> */
    use SdkModel;

    /**
     * Setup request ID to use in the next sign-in step.
     */
    #[Required]
    public string $setupRequestID;

    /**
     * Available sign-in methods for this setup request.
     *
     * @var list<string> $signInMethods
     */
    #[Required(list: 'string')]
    public array $signInMethods;

    /**
     * `new LoginStartResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginStartResponse::with(setupRequestID: ..., signInMethods: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginStartResponse)->withSetupRequestID(...)->withSignInMethods(...)
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
     * @param list<string> $signInMethods
     */
    public static function with(
        string $setupRequestID,
        array $signInMethods
    ): self {
        $self = new self;

        $self['setupRequestID'] = $setupRequestID;
        $self['signInMethods'] = $signInMethods;

        return $self;
    }

    /**
     * Setup request ID to use in the next sign-in step.
     */
    public function withSetupRequestID(string $setupRequestID): self
    {
        $self = clone $this;
        $self['setupRequestID'] = $setupRequestID;

        return $self;
    }

    /**
     * Available sign-in methods for this setup request.
     *
     * @param list<string> $signInMethods
     */
    public function withSignInMethods(array $signInMethods): self
    {
        $self = clone $this;
        $self['signInMethods'] = $signInMethods;

        return $self;
    }
}
