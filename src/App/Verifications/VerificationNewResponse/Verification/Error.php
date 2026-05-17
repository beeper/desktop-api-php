<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\VerificationNewResponse\Verification;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Verification error details, if verification stopped.
 *
 * @phpstan-type ErrorShape = array{code: string, reason: string}
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * Verification error code.
     */
    #[Required]
    public string $code;

    /**
     * User-facing verification error message.
     */
    #[Required]
    public string $reason;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(code: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withCode(...)->withReason(...)
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
    public static function with(string $code, string $reason): self
    {
        $self = new self;

        $self['code'] = $code;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Verification error code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * User-facing verification error message.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
