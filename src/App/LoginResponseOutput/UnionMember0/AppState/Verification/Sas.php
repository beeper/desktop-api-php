<?php

declare(strict_types=1);

namespace BeeperDesktop\App\LoginResponseOutput\UnionMember0\AppState\Verification;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Emoji or number comparison data for verification.
 *
 * @phpstan-type SasShape = array{decimals: string, emojis: string}
 */
final class Sas implements BaseModel
{
    /** @use SdkModel<SasShape> */
    use SdkModel;

    /**
     * Number sequence to compare on both devices.
     */
    #[Required]
    public string $decimals;

    /**
     * Emoji sequence to compare on both devices.
     */
    #[Required]
    public string $emojis;

    /**
     * `new Sas()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Sas::with(decimals: ..., emojis: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Sas)->withDecimals(...)->withEmojis(...)
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
    public static function with(string $decimals, string $emojis): self
    {
        $self = new self;

        $self['decimals'] = $decimals;
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

    /**
     * Emoji sequence to compare on both devices.
     */
    public function withEmojis(string $emojis): self
    {
        $self = clone $this;
        $self['emojis'] = $emojis;

        return $self;
    }
}
