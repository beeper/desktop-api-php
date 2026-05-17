<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications;

use BeeperDesktop\App\Verifications\VerificationGetResponse\Session;
use BeeperDesktop\App\Verifications\VerificationGetResponse\Verification;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SessionShape from \BeeperDesktop\App\Verifications\VerificationGetResponse\Session
 * @phpstan-import-type VerificationShape from \BeeperDesktop\App\Verifications\VerificationGetResponse\Verification
 *
 * @phpstan-type VerificationGetResponseShape = array{
 *   session: Session|SessionShape,
 *   verification?: null|Verification|VerificationShape,
 * }
 */
final class VerificationGetResponse implements BaseModel
{
    /** @use SdkModel<VerificationGetResponseShape> */
    use SdkModel;

    /**
     * Current app sign-in and encrypted messaging setup state.
     */
    #[Required]
    public Session $session;

    /**
     * Trusted device verification progress.
     */
    #[Optional]
    public ?Verification $verification;

    /**
     * `new VerificationGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VerificationGetResponse::with(session: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VerificationGetResponse)->withSession(...)
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
     * @param Session|SessionShape $session
     * @param Verification|VerificationShape|null $verification
     */
    public static function with(
        Session|array $session,
        Verification|array|null $verification = null
    ): self {
        $self = new self;

        $self['session'] = $session;

        null !== $verification && $self['verification'] = $verification;

        return $self;
    }

    /**
     * Current app sign-in and encrypted messaging setup state.
     *
     * @param Session|SessionShape $session
     */
    public function withSession(Session|array $session): self
    {
        $self = clone $this;
        $self['session'] = $session;

        return $self;
    }

    /**
     * Trusted device verification progress.
     *
     * @param Verification|VerificationShape $verification
     */
    public function withVerification(Verification|array $verification): self
    {
        $self = clone $this;
        $self['verification'] = $verification;

        return $self;
    }
}
