<?php

declare(strict_types=1);

namespace BeeperDesktop\App\LoginResponse;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Account credentials for first-party app setup.
 *
 * @phpstan-type MatrixShape = array{
 *   accessToken: string, deviceID: string, homeserver: string, userID: string
 * }
 */
final class Matrix implements BaseModel
{
    /** @use SdkModel<MatrixShape> */
    use SdkModel;

    /**
     * Account access token. Returned once for first-party app setup.
     */
    #[Required]
    public string $accessToken;

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
     * Matrix::with(accessToken: ..., deviceID: ..., homeserver: ..., userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Matrix)
     *   ->withAccessToken(...)
     *   ->withDeviceID(...)
     *   ->withHomeserver(...)
     *   ->withUserID(...)
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
        string $accessToken,
        string $deviceID,
        string $homeserver,
        string $userID
    ): self {
        $self = new self;

        $self['accessToken'] = $accessToken;
        $self['deviceID'] = $deviceID;
        $self['homeserver'] = $homeserver;
        $self['userID'] = $userID;

        return $self;
    }

    /**
     * Account access token. Returned once for first-party app setup.
     */
    public function withAccessToken(string $accessToken): self
    {
        $self = clone $this;
        $self['accessToken'] = $accessToken;

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
