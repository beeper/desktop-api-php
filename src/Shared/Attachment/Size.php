<?php

declare(strict_types=1);

namespace BeeperDesktop\Shared\Attachment;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Pixel dimensions of the attachment: width/height in px.
 */
final class Size implements BaseModel
{
    use SdkModel;

    #[Api(optional: true)]
    public ?float $height;

    #[Api(optional: true)]
    public ?float $width;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?float $height = null, ?float $width = null): self
    {
        $obj = new self;

        null !== $height && $obj->height = $height;
        null !== $width && $obj->width = $width;

        return $obj;
    }

    public function withHeight(float $height): self
    {
        $obj = clone $this;
        $obj->height = $height;

        return $obj;
    }

    public function withWidth(float $width): self
    {
        $obj = clone $this;
        $obj->width = $width;

        return $obj;
    }
}
