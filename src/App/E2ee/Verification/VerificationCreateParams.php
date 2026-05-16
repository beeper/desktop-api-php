<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\Verification;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Start verifying this device from another signed-in device.
 *
 * @see BeeperDesktop\Services\App\E2ee\VerificationService::create()
 *
 * @phpstan-type VerificationCreateParamsShape = array{userID?: string|null}
 */
final class VerificationCreateParams implements BaseModel
{
    /** @use SdkModel<VerificationCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * User ID to verify. Defaults to the signed-in user.
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
     */
    public static function with(?string $userID = null): self
    {
        $self = new self;

        null !== $userID && $self['userID'] = $userID;

        return $self;
    }

    /**
     * User ID to verify. Defaults to the signed-in user.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
