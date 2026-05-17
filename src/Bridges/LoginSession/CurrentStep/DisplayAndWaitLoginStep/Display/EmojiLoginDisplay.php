<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type EmojiLoginDisplayShape = array{imageURL: string, type: 'emoji'}
 */
final class EmojiLoginDisplay implements BaseModel
{
    /** @use SdkModel<EmojiLoginDisplayShape> */
    use SdkModel;

    /** @var 'emoji' $type */
    #[Required]
    public string $type = 'emoji';

    #[Required]
    public string $imageURL;

    /**
     * `new EmojiLoginDisplay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EmojiLoginDisplay::with(imageURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EmojiLoginDisplay)->withImageURL(...)
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
    public static function with(string $imageURL): self
    {
        $self = new self;

        $self['imageURL'] = $imageURL;

        return $self;
    }

    public function withImageURL(string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * @param 'emoji' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
