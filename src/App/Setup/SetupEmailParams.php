<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Setup;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Send a sign-in code to the user email address for app setup.
 *
 * @see BeeperDesktop\Services\App\SetupService::email()
 *
 * @phpstan-type SetupEmailParamsShape = array{
 *   email: string, setupRequestID: string
 * }
 */
final class SetupEmailParams implements BaseModel
{
    /** @use SdkModel<SetupEmailParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Email address to send the sign-in code to.
     */
    #[Required]
    public string $email;

    /**
     * Setup request ID returned by the start step.
     */
    #[Required]
    public string $setupRequestID;

    /**
     * `new SetupEmailParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SetupEmailParams::with(email: ..., setupRequestID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SetupEmailParams)->withEmail(...)->withSetupRequestID(...)
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
    public static function with(string $email, string $setupRequestID): self
    {
        $self = new self;

        $self['email'] = $email;
        $self['setupRequestID'] = $setupRequestID;

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
     * Setup request ID returned by the start step.
     */
    public function withSetupRequestID(string $setupRequestID): self
    {
        $self = clone $this;
        $self['setupRequestID'] = $setupRequestID;

        return $self;
    }
}
