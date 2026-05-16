<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\Verification;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Cancel an active device verification request.
 *
 * @see BeeperDesktop\Services\App\E2ee\VerificationService::cancel()
 *
 * @phpstan-type VerificationCancelParamsShape = array{
 *   code?: string|null, reason?: string|null
 * }
 */
final class VerificationCancelParams implements BaseModel
{
    /** @use SdkModel<VerificationCancelParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional cancellation code.
     */
    #[Optional]
    public ?string $code;

    /**
     * Optional user-facing cancellation reason.
     */
    #[Optional]
    public ?string $reason;

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
        ?string $code = null,
        ?string $reason = null
    ): self {
        $self = new self;

        null !== $code && $self['code'] = $code;
        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * Optional cancellation code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Optional user-facing cancellation reason.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
