<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\Verification;

use BeeperDesktop\App\E2ee\Verification\VerificationAcceptResponse\AppState;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AppStateShape from \BeeperDesktop\App\E2ee\Verification\VerificationAcceptResponse\AppState
 *
 * @phpstan-type VerificationAcceptResponseShape = array{
 *   appState: AppState|AppStateShape
 * }
 */
final class VerificationAcceptResponse implements BaseModel
{
    /** @use SdkModel<VerificationAcceptResponseShape> */
    use SdkModel;

    /**
     * Current onboarding state after the requested step.
     */
    #[Required]
    public AppState $appState;

    /**
     * `new VerificationAcceptResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * VerificationAcceptResponse::with(appState: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new VerificationAcceptResponse)->withAppState(...)
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
     * @param AppState|AppStateShape $appState
     */
    public static function with(AppState|array $appState): self
    {
        $self = new self;

        $self['appState'] = $appState;

        return $self;
    }

    /**
     * Current onboarding state after the requested step.
     *
     * @param AppState|AppStateShape $appState
     */
    public function withAppState(AppState|array $appState): self
    {
        $self = clone $this;
        $self['appState'] = $appState;

        return $self;
    }
}
