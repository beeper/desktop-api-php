<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\VerificationAcceptResponse\Verification;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Emoji or number comparison data for verification.
 *
 * @phpstan-type SASShape = array{emojis: string, decimals?: string|null}
 */
final class SAS implements BaseModel
{
    /** @use SdkModel<SASShape> */
    use SdkModel;

    /**
     * Emoji sequence to compare on both devices.
     */
    #[Required]
    public string $emojis;

    /**
     * Number sequence to compare on both devices.
     */
    #[Optional]
    public ?string $decimals;

    /**
     * `new SAS()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SAS::with(emojis: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SAS)->withEmojis(...)
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
    public static function with(string $emojis, ?string $decimals = null): self
    {
        $self = new self;

        $self['emojis'] = $emojis;

        null !== $decimals && $self['decimals'] = $decimals;

        return $self;
    }

    /**
     * Emoji sequence to compare on both devices.
     */
    public function withEmojis(string $emojis): self
    {
        $self = clone $this;
        $self['emojis'] = $emojis;

        return $self;
    }

    /**
     * Number sequence to compare on both devices.
     */
    public function withDecimals(string $decimals): self
    {
        $self = clone $this;
        $self['decimals'] = $decimals;

        return $self;
    }
}
