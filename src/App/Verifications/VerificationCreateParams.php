<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications;

use BeeperDesktop\App\Verifications\VerificationCreateParams\Purpose;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Start verifying this device from another signed-in device.
 *
 * @see BeeperDesktop\Services\App\VerificationsService::create()
 *
 * @phpstan-type VerificationCreateParamsShape = array{
 *   purpose?: null|Purpose|value-of<Purpose>, userID?: string|null
 * }
 */
final class VerificationCreateParams implements BaseModel
{
    /** @use SdkModel<VerificationCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Why this verification is being started.
     *
     * @var value-of<Purpose>|null $purpose
     */
    #[Optional(enum: Purpose::class)]
    public ?string $purpose;

    /**
     * Beeper user ID to verify. Defaults to the signed-in user.
     */
    #[Optional]
    public ?string $userID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Purpose|value-of<Purpose>|null $purpose
     */
    public static function with(
        Purpose|string|null $purpose = null,
        ?string $userID = null
    ): self {
        $self = new self;

        null !== $purpose && $self['purpose'] = $purpose;
        null !== $userID && $self['userID'] = $userID;

        return $self;
    }

    /**
     * Why this verification is being started.
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
     * Beeper user ID to verify. Defaults to the signed-in user.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
