<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * URL to open a specific chat or message.
 */
final class LinkResponse implements BaseModel
{
    use SdkModel;

    /**
     * Deep link URL to the specified chat or message.
     */
    #[Api]
    public string $url;

    /**
     * `new LinkResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LinkResponse::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LinkResponse)->withURL(...)
     * ```
     */
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
    public static function with(string $url): self
    {
        $obj = new self;

        $obj->url = $url;

        return $obj;
    }

    /**
     * Deep link URL to the specified chat or message.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
