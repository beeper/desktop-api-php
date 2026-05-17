<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\VerificationCancelResponse;

use BeeperDesktop\App\Verifications\VerificationCancelResponse\Session\E2EE;
use BeeperDesktop\App\Verifications\VerificationCancelResponse\Session\Matrix;
use BeeperDesktop\App\Verifications\VerificationCancelResponse\Session\State;
use BeeperDesktop\App\Verifications\VerificationCancelResponse\Session\Verification;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Current app sign-in and encrypted messaging setup state.
 *
 * @phpstan-import-type E2EEShape from \BeeperDesktop\App\Verifications\VerificationCancelResponse\Session\E2EE
 * @phpstan-import-type MatrixShape from \BeeperDesktop\App\Verifications\VerificationCancelResponse\Session\Matrix
 * @phpstan-import-type VerificationShape from \BeeperDesktop\App\Verifications\VerificationCancelResponse\Session\Verification
 *
 * @phpstan-type SessionShape = array{
 *   e2ee: E2EE|E2EEShape,
 *   state: State|value-of<State>,
 *   matrix?: null|Matrix|MatrixShape,
 *   verification?: null|\BeeperDesktop\App\Verifications\VerificationCancelResponse\Session\Verification|VerificationShape,
 * }
 */
final class Session implements BaseModel
{
    /** @use SdkModel<SessionShape> */
    use SdkModel;

    /**
     * Encrypted messaging setup status.
     */
    #[Required]
    public E2EE $e2ee;

    /**
     * Current sign-in and encrypted messaging setup state for Beeper Desktop or Beeper Server.
     *
     * @var value-of<State> $state
     */
    #[Required(enum: State::class)]
    public string $state;

    /**
     * Signed-in account details. Omitted until sign-in is complete.
     */
    #[Optional]
    public ?Matrix $matrix;

    /**
     * Trusted device verification progress.
     */
    #[Optional]
    public ?Verification $verification;

    /**
     * `new Session()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Session::with(e2ee: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Session)->withE2EE(...)->withState(...)
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
     * @param E2EE|E2EEShape $e2ee
     * @param State|value-of<State> $state
     * @param Matrix|MatrixShape|null $matrix
     * @param Verification|VerificationShape|null $verification
     */
    public static function with(
        E2EE|array $e2ee,
        State|string $state,
        Matrix|array|null $matrix = null,
        Verification|array|null $verification = null,
    ): self {
        $self = new self;

        $self['e2ee'] = $e2ee;
        $self['state'] = $state;

        null !== $matrix && $self['matrix'] = $matrix;
        null !== $verification && $self['verification'] = $verification;

        return $self;
    }

    /**
     * Encrypted messaging setup status.
     *
     * @param E2EE|E2EEShape $e2ee
     */
    public function withE2EE(E2EE|array $e2ee): self
    {
        $self = clone $this;
        $self['e2ee'] = $e2ee;

        return $self;
    }

    /**
     * Current sign-in and encrypted messaging setup state for Beeper Desktop or Beeper Server.
     *
     * @param State|value-of<State> $state
     */
    public function withState(State|string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * Signed-in account details. Omitted until sign-in is complete.
     *
     * @param Matrix|MatrixShape $matrix
     */
    public function withMatrix(Matrix|array $matrix): self
    {
        $self = clone $this;
        $self['matrix'] = $matrix;

        return $self;
    }

    /**
     * Trusted device verification progress.
     *
     * @param Verification|VerificationShape $verification
     */
    public function withVerification(
        Verification|array $verification,
    ): self {
        $self = clone $this;
        $self['verification'] = $verification;

        return $self;
    }
}
