<?php

declare(strict_types=1);

namespace BeeperDesktop\App\LoginResponse;

use BeeperDesktop\App\LoginResponse\AppState\E2ee;
use BeeperDesktop\App\LoginResponse\AppState\Matrix;
use BeeperDesktop\App\LoginResponse\AppState\State;
use BeeperDesktop\App\LoginResponse\AppState\Verification;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Current onboarding state after sign-in.
 *
 * @phpstan-import-type E2eeShape from \BeeperDesktop\App\LoginResponse\AppState\E2ee
 * @phpstan-import-type MatrixShape from \BeeperDesktop\App\LoginResponse\AppState\Matrix
 * @phpstan-import-type VerificationShape from \BeeperDesktop\App\LoginResponse\AppState\Verification
 *
 * @phpstan-type AppStateShape = array{
 *   e2ee: E2ee|E2eeShape,
 *   state: State|value-of<State>,
 *   matrix?: null|\BeeperDesktop\App\LoginResponse\AppState\Matrix|MatrixShape,
 *   verification?: null|Verification|VerificationShape,
 * }
 */
final class AppState implements BaseModel
{
    /** @use SdkModel<AppStateShape> */
    use SdkModel;

    /**
     * Encrypted messaging setup status.
     */
    #[Required]
    public E2ee $e2ee;

    /**
     * Current onboarding state for Beeper Desktop.
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
     * Trusted-device verification progress.
     */
    #[Optional]
    public ?Verification $verification;

    /**
     * `new AppState()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AppState::with(e2ee: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AppState)->withE2ee(...)->withState(...)
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
     * @param E2ee|E2eeShape $e2ee
     * @param State|value-of<State> $state
     * @param Matrix|MatrixShape|null $matrix
     * @param Verification|VerificationShape|null $verification
     */
    public static function with(
        E2ee|array $e2ee,
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
     * @param E2ee|E2eeShape $e2ee
     */
    public function withE2ee(E2ee|array $e2ee): self
    {
        $self = clone $this;
        $self['e2ee'] = $e2ee;

        return $self;
    }

    /**
     * Current onboarding state for Beeper Desktop.
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
    public function withMatrix(
        Matrix|array $matrix
    ): self {
        $self = clone $this;
        $self['matrix'] = $matrix;

        return $self;
    }

    /**
     * Trusted-device verification progress.
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
