<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\Verification\Qr;

use BeeperDesktop\App\E2ee\Verification\Qr\QrConfirmScannedResponse\AppState;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AppStateShape from \BeeperDesktop\App\E2ee\Verification\Qr\QrConfirmScannedResponse\AppState
 *
 * @phpstan-type QrConfirmScannedResponseShape = array{
 *   appState: AppState|AppStateShape
 * }
 */
final class QrConfirmScannedResponse implements BaseModel
{
    /** @use SdkModel<QrConfirmScannedResponseShape> */
    use SdkModel;

    /**
     * Current onboarding state after the requested step.
     */
    #[Required]
    public AppState $appState;

    /**
     * `new QrConfirmScannedResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QrConfirmScannedResponse::with(appState: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QrConfirmScannedResponse)->withAppState(...)
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
