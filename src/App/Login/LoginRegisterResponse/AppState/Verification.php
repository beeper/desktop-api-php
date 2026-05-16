<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\LoginRegisterResponse\AppState;

use BeeperDesktop\App\Login\LoginRegisterResponse\AppState\Verification\AvailableAction;
use BeeperDesktop\App\Login\LoginRegisterResponse\AppState\Verification\Error;
use BeeperDesktop\App\Login\LoginRegisterResponse\AppState\Verification\Sas;
use BeeperDesktop\App\Login\LoginRegisterResponse\AppState\Verification\State;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Trusted-device verification progress.
 *
 * @phpstan-import-type ErrorShape from \BeeperDesktop\App\Login\LoginRegisterResponse\AppState\Verification\Error
 * @phpstan-import-type SasShape from \BeeperDesktop\App\Login\LoginRegisterResponse\AppState\Verification\Sas
 *
 * @phpstan-type VerificationShape = array{
 *   availableActions: list<AvailableAction|value-of<AvailableAction>>,
 *   state: \BeeperDesktop\App\Login\LoginRegisterResponse\AppState\Verification\State|value-of<\BeeperDesktop\App\Login\LoginRegisterResponse\AppState\Verification\State>,
 *   error?: null|Error|ErrorShape,
 *   from?: string|null,
 *   fromDevice?: string|null,
 *   otherDevice?: string|null,
 *   qrData?: string|null,
 *   sas?: null|Sas|SasShape,
 *   supportsSas?: bool|null,
 *   supportsScanQrCode?: bool|null,
 *   verificationID?: string|null,
 * }
 */
final class Verification implements BaseModel
{
    /** @use SdkModel<VerificationShape> */
    use SdkModel;

    /**
     * Verification actions that are valid for the current state.
     *
     * @var list<value-of<AvailableAction>> $availableActions
     */
    #[Required(list: AvailableAction::class)]
    public array $availableActions;

    /**
     * Current trusted-device verification state.
     *
     * @var value-of<State> $state
     */
    #[Required(
        enum: State::class,
    )]
    public string $state;

    /**
     * Verification error details, if verification stopped.
     */
    #[Optional]
    public ?Error $error;

    /**
     * User ID that started verification.
     */
    #[Optional]
    public ?string $from;

    /**
     * Device that started verification.
     */
    #[Optional]
    public ?string $fromDevice;

    /**
     * Other device participating in verification.
     */
    #[Optional]
    public ?string $otherDevice;

    /**
     * QR code payload to display for verification.
     */
    #[Optional]
    public ?string $qrData;

    /**
     * Emoji or number comparison data for verification.
     */
    #[Optional]
    public ?Sas $sas;

    /**
     * Whether emoji comparison is available.
     */
    #[Optional('supportsSAS')]
    public ?bool $supportsSas;

    /**
     * Whether QR code verification is available.
     */
    #[Optional('supportsScanQRCode')]
    public ?bool $supportsScanQrCode;

    /**
     * Verification ID to pass in verification action paths.
     */
    #[Optional]
    public ?string $verificationID;

    /**
     * `new Verification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Verification::with(availableActions: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Verification)->withAvailableActions(...)->withState(...)
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
     * @param list<AvailableAction|value-of<AvailableAction>> $availableActions
     * @param State|value-of<State> $state
     * @param Error|ErrorShape|null $error
     * @param Sas|SasShape|null $sas
     */
    public static function with(
        array $availableActions,
        State|string $state,
        Error|array|null $error = null,
        ?string $from = null,
        ?string $fromDevice = null,
        ?string $otherDevice = null,
        ?string $qrData = null,
        Sas|array|null $sas = null,
        ?bool $supportsSas = null,
        ?bool $supportsScanQrCode = null,
        ?string $verificationID = null,
    ): self {
        $self = new self;

        $self['availableActions'] = $availableActions;
        $self['state'] = $state;

        null !== $error && $self['error'] = $error;
        null !== $from && $self['from'] = $from;
        null !== $fromDevice && $self['fromDevice'] = $fromDevice;
        null !== $otherDevice && $self['otherDevice'] = $otherDevice;
        null !== $qrData && $self['qrData'] = $qrData;
        null !== $sas && $self['sas'] = $sas;
        null !== $supportsSas && $self['supportsSas'] = $supportsSas;
        null !== $supportsScanQrCode && $self['supportsScanQrCode'] = $supportsScanQrCode;
        null !== $verificationID && $self['verificationID'] = $verificationID;

        return $self;
    }

    /**
     * Verification actions that are valid for the current state.
     *
     * @param list<AvailableAction|value-of<AvailableAction>> $availableActions
     */
    public function withAvailableActions(array $availableActions): self
    {
        $self = clone $this;
        $self['availableActions'] = $availableActions;

        return $self;
    }

    /**
     * Current trusted-device verification state.
     *
     * @param State|value-of<State> $state
     */
    public function withState(
        State|string $state,
    ): self {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * Verification error details, if verification stopped.
     *
     * @param Error|ErrorShape $error
     */
    public function withError(Error|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * User ID that started verification.
     */
    public function withFrom(string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * Device that started verification.
     */
    public function withFromDevice(string $fromDevice): self
    {
        $self = clone $this;
        $self['fromDevice'] = $fromDevice;

        return $self;
    }

    /**
     * Other device participating in verification.
     */
    public function withOtherDevice(string $otherDevice): self
    {
        $self = clone $this;
        $self['otherDevice'] = $otherDevice;

        return $self;
    }

    /**
     * QR code payload to display for verification.
     */
    public function withQrData(string $qrData): self
    {
        $self = clone $this;
        $self['qrData'] = $qrData;

        return $self;
    }

    /**
     * Emoji or number comparison data for verification.
     *
     * @param Sas|SasShape $sas
     */
    public function withSas(Sas|array $sas): self
    {
        $self = clone $this;
        $self['sas'] = $sas;

        return $self;
    }

    /**
     * Whether emoji comparison is available.
     */
    public function withSupportsSas(bool $supportsSas): self
    {
        $self = clone $this;
        $self['supportsSas'] = $supportsSas;

        return $self;
    }

    /**
     * Whether QR code verification is available.
     */
    public function withSupportsScanQrCode(bool $supportsScanQrCode): self
    {
        $self = clone $this;
        $self['supportsScanQrCode'] = $supportsScanQrCode;

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
