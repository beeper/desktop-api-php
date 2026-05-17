<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse;

use BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\AvailableAction;
use BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\Direction;
use BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\Error;
use BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\Method;
use BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\OtherDevice;
use BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\Purpose;
use BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\Qr;
use BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\SAS;
use BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\State;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Trusted device verification progress.
 *
 * @phpstan-import-type ErrorShape from \BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\Error
 * @phpstan-import-type OtherDeviceShape from \BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\OtherDevice
 * @phpstan-import-type QrShape from \BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\Qr
 * @phpstan-import-type SASShape from \BeeperDesktop\App\Verifications\Qr\QrConfirmScannedResponse\Verification\SAS
 *
 * @phpstan-type VerificationShape = array{
 *   id: string,
 *   availableActions: list<AvailableAction|value-of<AvailableAction>>,
 *   direction: Direction|value-of<Direction>,
 *   methods: list<Method|value-of<Method>>,
 *   purpose: Purpose|value-of<Purpose>,
 *   state: State|value-of<State>,
 *   error?: null|Error|ErrorShape,
 *   otherDevice?: null|OtherDevice|OtherDeviceShape,
 *   otherUserID?: string|null,
 *   qr?: null|Qr|QrShape,
 *   sas?: null|SAS|SASShape,
 * }
 */
final class Verification implements BaseModel
{
    /** @use SdkModel<VerificationShape> */
    use SdkModel;

    /**
     * Verification ID to pass in verification action paths.
     */
    #[Required]
    public string $id;

    /**
     * Verification actions that are valid for the current state.
     *
     * @var list<value-of<AvailableAction>> $availableActions
     */
    #[Required(list: AvailableAction::class)]
    public array $availableActions;

    /**
     * Whether this device started or received the verification.
     *
     * @var value-of<Direction> $direction
     */
    #[Required(enum: Direction::class)]
    public string $direction;

    /**
     * Verification methods supported for this transaction.
     *
     * @var list<value-of<Method>> $methods
     */
    #[Required(list: Method::class)]
    public array $methods;

    /**
     * Why this verification exists.
     *
     * @var value-of<Purpose> $purpose
     */
    #[Required(enum: Purpose::class)]
    public string $purpose;

    /**
     * Current trusted-device verification state.
     *
     * @var value-of<State> $state
     */
    #[Required(enum: State::class)]
    public string $state;

    /**
     * Verification error details, if verification stopped.
     */
    #[Optional]
    public ?Error $error;

    /**
     * Other device participating in verification.
     */
    #[Optional]
    public ?OtherDevice $otherDevice;

    /**
     * Other Beeper user participating in verification.
     */
    #[Optional]
    public ?string $otherUserID;

    /**
     * QR verification data.
     */
    #[Optional]
    public ?Qr $qr;

    /**
     * Emoji or number comparison data for verification.
     */
    #[Optional]
    public ?SAS $sas;

    /**
     * `new Verification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Verification::with(
     *   id: ...,
     *   availableActions: ...,
     *   direction: ...,
     *   methods: ...,
     *   purpose: ...,
     *   state: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Verification)
     *   ->withID(...)
     *   ->withAvailableActions(...)
     *   ->withDirection(...)
     *   ->withMethods(...)
     *   ->withPurpose(...)
     *   ->withState(...)
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
     * @param Direction|value-of<Direction> $direction
     * @param list<Method|value-of<Method>> $methods
     * @param Purpose|value-of<Purpose> $purpose
     * @param State|value-of<State> $state
     * @param Error|ErrorShape|null $error
     * @param OtherDevice|OtherDeviceShape|null $otherDevice
     * @param Qr|QrShape|null $qr
     * @param SAS|SASShape|null $sas
     */
    public static function with(
        string $id,
        array $availableActions,
        Direction|string $direction,
        array $methods,
        Purpose|string $purpose,
        State|string $state,
        Error|array|null $error = null,
        OtherDevice|array|null $otherDevice = null,
        ?string $otherUserID = null,
        Qr|array|null $qr = null,
        SAS|array|null $sas = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['availableActions'] = $availableActions;
        $self['direction'] = $direction;
        $self['methods'] = $methods;
        $self['purpose'] = $purpose;
        $self['state'] = $state;

        null !== $error && $self['error'] = $error;
        null !== $otherDevice && $self['otherDevice'] = $otherDevice;
        null !== $otherUserID && $self['otherUserID'] = $otherUserID;
        null !== $qr && $self['qr'] = $qr;
        null !== $sas && $self['sas'] = $sas;

        return $self;
    }

    /**
     * Verification ID to pass in verification action paths.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
     * Whether this device started or received the verification.
     *
     * @param Direction|value-of<Direction> $direction
     */
    public function withDirection(Direction|string $direction): self
    {
        $self = clone $this;
        $self['direction'] = $direction;

        return $self;
    }

    /**
     * Verification methods supported for this transaction.
     *
     * @param list<Method|value-of<Method>> $methods
     */
    public function withMethods(array $methods): self
    {
        $self = clone $this;
        $self['methods'] = $methods;

        return $self;
    }

    /**
     * Why this verification exists.
     *
     * @param Purpose|value-of<Purpose> $purpose
     */
    public function withPurpose(Purpose|string $purpose): self
    {
        $self = clone $this;
        $self['purpose'] = $purpose;

        return $self;
    }

    /**
     * Current trusted-device verification state.
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
     * Other device participating in verification.
     *
     * @param OtherDevice|OtherDeviceShape $otherDevice
     */
    public function withOtherDevice(OtherDevice|array $otherDevice): self
    {
        $self = clone $this;
        $self['otherDevice'] = $otherDevice;

        return $self;
    }

    /**
     * Other Beeper user participating in verification.
     */
    public function withOtherUserID(string $otherUserID): self
    {
        $self = clone $this;
        $self['otherUserID'] = $otherUserID;

        return $self;
    }

    /**
     * QR verification data.
     *
     * @param Qr|QrShape $qr
     */
    public function withQr(Qr|array $qr): self
    {
        $self = clone $this;
        $self['qr'] = $qr;

        return $self;
    }

    /**
     * Emoji or number comparison data for verification.
     *
     * @param SAS|SASShape $sas
     */
    public function withSAS(SAS|array $sas): self
    {
        $self = clone $this;
        $self['sas'] = $sas;

        return $self;
    }
}
