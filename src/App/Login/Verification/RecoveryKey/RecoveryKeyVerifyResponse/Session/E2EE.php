<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\Verification\RecoveryKey\RecoveryKeyVerifyResponse\Session;

use BeeperDesktop\App\Login\Verification\RecoveryKey\RecoveryKeyVerifyResponse\Session\E2EE\Secrets;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Encrypted messaging setup status.
 *
 * @phpstan-import-type SecretsShape from \BeeperDesktop\App\Login\Verification\RecoveryKey\RecoveryKeyVerifyResponse\Session\E2EE\Secrets
 *
 * @phpstan-type E2EEShape = array{
 *   crossSigning: bool,
 *   firstSyncDone: bool,
 *   hasBackedUpRecoveryKey: bool,
 *   initialized: bool,
 *   keyBackup: bool,
 *   secrets: Secrets|SecretsShape,
 *   secretStorage: bool,
 *   verified: bool,
 *   recoveryKeyGeneratedAt?: float|null,
 * }
 */
final class E2EE implements BaseModel
{
    /** @use SdkModel<E2EEShape> */
    use SdkModel;

    /**
     * Whether this account can verify trusted devices.
     */
    #[Required]
    public bool $crossSigning;

    /**
     * Whether the first encrypted message sync is complete.
     */
    #[Required]
    public bool $firstSyncDone;

    /**
     * Whether the user confirmed that they saved their recovery key.
     */
    #[Required]
    public bool $hasBackedUpRecoveryKey;

    /**
     * Whether encrypted messaging setup has started.
     */
    #[Required]
    public bool $initialized;

    /**
     * Whether encrypted message backup is available.
     */
    #[Required]
    public bool $keyBackup;

    /**
     * Encrypted messaging keys available on this device.
     */
    #[Required]
    public Secrets $secrets;

    /**
     * Whether secure key storage is available.
     */
    #[Required]
    public bool $secretStorage;

    /**
     * Whether this device is trusted for encrypted messages.
     */
    #[Required]
    public bool $verified;

    /**
     * Unix timestamp for when the recovery key was created.
     */
    #[Optional]
    public ?float $recoveryKeyGeneratedAt;

    /**
     * `new E2EE()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * E2EE::with(
     *   crossSigning: ...,
     *   firstSyncDone: ...,
     *   hasBackedUpRecoveryKey: ...,
     *   initialized: ...,
     *   keyBackup: ...,
     *   secrets: ...,
     *   secretStorage: ...,
     *   verified: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new E2EE)
     *   ->withCrossSigning(...)
     *   ->withFirstSyncDone(...)
     *   ->withHasBackedUpRecoveryKey(...)
     *   ->withInitialized(...)
     *   ->withKeyBackup(...)
     *   ->withSecrets(...)
     *   ->withSecretStorage(...)
     *   ->withVerified(...)
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
     * @param Secrets|SecretsShape $secrets
     */
    public static function with(
        bool $crossSigning,
        bool $firstSyncDone,
        bool $hasBackedUpRecoveryKey,
        bool $initialized,
        bool $keyBackup,
        Secrets|array $secrets,
        bool $secretStorage,
        bool $verified,
        ?float $recoveryKeyGeneratedAt = null,
    ): self {
        $self = new self;

        $self['crossSigning'] = $crossSigning;
        $self['firstSyncDone'] = $firstSyncDone;
        $self['hasBackedUpRecoveryKey'] = $hasBackedUpRecoveryKey;
        $self['initialized'] = $initialized;
        $self['keyBackup'] = $keyBackup;
        $self['secrets'] = $secrets;
        $self['secretStorage'] = $secretStorage;
        $self['verified'] = $verified;

        null !== $recoveryKeyGeneratedAt && $self['recoveryKeyGeneratedAt'] = $recoveryKeyGeneratedAt;

        return $self;
    }

    /**
     * Whether this account can verify trusted devices.
     */
    public function withCrossSigning(bool $crossSigning): self
    {
        $self = clone $this;
        $self['crossSigning'] = $crossSigning;

        return $self;
    }

    /**
     * Whether the first encrypted message sync is complete.
     */
    public function withFirstSyncDone(bool $firstSyncDone): self
    {
        $self = clone $this;
        $self['firstSyncDone'] = $firstSyncDone;

        return $self;
    }

    /**
     * Whether the user confirmed that they saved their recovery key.
     */
    public function withHasBackedUpRecoveryKey(
        bool $hasBackedUpRecoveryKey
    ): self {
        $self = clone $this;
        $self['hasBackedUpRecoveryKey'] = $hasBackedUpRecoveryKey;

        return $self;
    }

    /**
     * Whether encrypted messaging setup has started.
     */
    public function withInitialized(bool $initialized): self
    {
        $self = clone $this;
        $self['initialized'] = $initialized;

        return $self;
    }

    /**
     * Whether encrypted message backup is available.
     */
    public function withKeyBackup(bool $keyBackup): self
    {
        $self = clone $this;
        $self['keyBackup'] = $keyBackup;

        return $self;
    }

    /**
     * Encrypted messaging keys available on this device.
     *
     * @param Secrets|SecretsShape $secrets
     */
    public function withSecrets(Secrets|array $secrets): self
    {
        $self = clone $this;
        $self['secrets'] = $secrets;

        return $self;
    }

    /**
     * Whether secure key storage is available.
     */
    public function withSecretStorage(bool $secretStorage): self
    {
        $self = clone $this;
        $self['secretStorage'] = $secretStorage;

        return $self;
    }

    /**
     * Whether this device is trusted for encrypted messages.
     */
    public function withVerified(bool $verified): self
    {
        $self = clone $this;
        $self['verified'] = $verified;

        return $self;
    }

    /**
     * Unix timestamp for when the recovery key was created.
     */
    public function withRecoveryKeyGeneratedAt(
        float $recoveryKeyGeneratedAt
    ): self {
        $self = clone $this;
        $self['recoveryKeyGeneratedAt'] = $recoveryKeyGeneratedAt;

        return $self;
    }
}
