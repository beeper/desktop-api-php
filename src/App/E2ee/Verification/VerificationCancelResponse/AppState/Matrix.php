<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\Verification\VerificationCancelResponse\AppState;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Signed-in account details. Omitted until sign-in is complete.
 *
 * @phpstan-type MatrixShape = array{
 *   deviceID: string, homeserver: string, userID: string
 * }
 */
final class Matrix implements BaseModel
{
    /** @use SdkModel<MatrixShape> */
    use SdkModel;

    /**
     * Current device ID.
     */
    #[Required]
    public string $deviceID;

    /**
     * Beeper server URL for this account.
     */
    #[Required]
    public string $homeserver;

    /**
     * Signed-in Beeper user ID.
     */
    #[Required]
    public string $userID;

    /**
     * `new Matrix()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Matrix::with(deviceID: ..., homeserver: ..., userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Matrix)->withDeviceID(...)->withHomeserver(...)->withUserID(...)
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
    public static function with(
        string $deviceID,
        string $homeserver,
        string $userID
    ): self {
        $self = new self;

        $self['deviceID'] = $deviceID;
        $self['homeserver'] = $homeserver;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * Current device ID.
     */
    public function withDeviceID(string $deviceID): self
    {
        $self = clone $this;
        $self['deviceID'] = $deviceID;

        return $self;
    }

    /**
     * Beeper server URL for this account.
     */
    public function withHomeserver(string $homeserver): self
    {
        $self = clone $this;
        $self['homeserver'] = $homeserver;

        return $self;
    }

    /**
     * Signed-in Beeper user ID.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
