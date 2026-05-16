<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\Verification\VerificationNewResponse\AppState\E2ee;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Encrypted messaging keys available on this device.
 *
 * @phpstan-type SecretsShape = array{
 *   masterKey: bool,
 *   megolmBackupKey: bool,
 *   recoveryCode: bool,
 *   selfSigningKey: bool,
 *   userSigningKey: bool,
 * }
 */
final class Secrets implements BaseModel
{
    /** @use SdkModel<SecretsShape> */
    use SdkModel;

    /**
     * Whether the account identity key is available.
     */
    #[Required]
    public bool $masterKey;

    /**
     * Whether the encrypted message backup key is available.
     */
    #[Required]
    public bool $megolmBackupKey;

    /**
     * Whether a recovery key is available.
     */
    #[Required]
    public bool $recoveryCode;

    /**
     * Whether the device trust key is available.
     */
    #[Required]
    public bool $selfSigningKey;

    /**
     * Whether the user trust key is available.
     */
    #[Required]
    public bool $userSigningKey;

    /**
     * `new Secrets()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Secrets::with(
     *   masterKey: ...,
     *   megolmBackupKey: ...,
     *   recoveryCode: ...,
     *   selfSigningKey: ...,
     *   userSigningKey: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Secrets)
     *   ->withMasterKey(...)
     *   ->withMegolmBackupKey(...)
     *   ->withRecoveryCode(...)
     *   ->withSelfSigningKey(...)
     *   ->withUserSigningKey(...)
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
        bool $masterKey,
        bool $megolmBackupKey,
        bool $recoveryCode,
        bool $selfSigningKey,
        bool $userSigningKey,
    ): self {
        $self = new self;

        $self['masterKey'] = $masterKey;
        $self['megolmBackupKey'] = $megolmBackupKey;
        $self['recoveryCode'] = $recoveryCode;
        $self['selfSigningKey'] = $selfSigningKey;
        $self['userSigningKey'] = $userSigningKey;

        return $self;
    }

    /**
     * Whether the account identity key is available.
     */
    public function withMasterKey(bool $masterKey): self
    {
        $self = clone $this;
        $self['masterKey'] = $masterKey;

        return $self;
    }

    /**
     * Whether the encrypted message backup key is available.
     */
    public function withMegolmBackupKey(bool $megolmBackupKey): self
    {
        $self = clone $this;
        $self['megolmBackupKey'] = $megolmBackupKey;

        return $self;
    }

    /**
     * Whether a recovery key is available.
     */
    public function withRecoveryCode(bool $recoveryCode): self
    {
        $self = clone $this;
        $self['recoveryCode'] = $recoveryCode;

        return $self;
    }

    /**
     * Whether the device trust key is available.
     */
    public function withSelfSigningKey(bool $selfSigningKey): self
    {
        $self = clone $this;
        $self['selfSigningKey'] = $selfSigningKey;

        return $self;
    }

    /**
     * Whether the user trust key is available.
     */
    public function withUserSigningKey(bool $userSigningKey): self
    {
        $self = clone $this;
        $self['userSigningKey'] = $userSigningKey;

        return $self;
    }
}
