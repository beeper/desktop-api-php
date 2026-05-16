<?php

declare(strict_types=1);

namespace BeeperDesktop\App;

use BeeperDesktop\App\StartVerificationResponse\AppState;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AppStateShape from \BeeperDesktop\App\StartVerificationResponse\AppState
 *
 * @phpstan-type StartVerificationResponseShape = array{
 *   appState: AppState|AppStateShape, verificationID: string
 * }
 */
final class StartVerificationResponse implements BaseModel
{
    /** @use SdkModel<StartVerificationResponseShape> */
    use SdkModel;

    /**
     * Current onboarding state after starting verification.
     */
    #[Required]
    public AppState $appState;

    /**
     * Verification ID to pass in verification action paths.
     */
    #[Required]
    public string $verificationID;

    /**
     * `new StartVerificationResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StartVerificationResponse::with(appState: ..., verificationID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StartVerificationResponse)->withAppState(...)->withVerificationID(...)
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
    public static function with(
        AppState|array $appState,
        string $verificationID
    ): self {
        $self = new self;

        $self['appState'] = $appState;
        $self['verificationID'] = $verificationID;

        return $self;
    }

    /**
     * Current onboarding state after starting verification.
     *
     * @param AppState|AppStateShape $appState
     */
    public function withAppState(AppState|array $appState): self
    {
        $self = clone $this;
        $self['appState'] = $appState;

        return $self;
    }

    /**
     * Verification ID to pass in verification action paths.
     */
    public function withVerificationID(string $verificationID): self
    {
        $self = clone $this;
        $self['verificationID'] = $verificationID;

        return $self;
    }
}
