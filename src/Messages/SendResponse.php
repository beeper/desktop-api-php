<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class SendResponse implements BaseModel
{
    use SdkModel;

    /**
     * Link to the chat where the message was sent. This should always be shown to the user.
     */
    #[Api]
    public string $deeplink;

    /**
     * Stable message ID.
     */
    #[Api]
    public string $messageID;

    /**
     * `new SendResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendResponse::with(deeplink: ..., messageID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendResponse)->withDeeplink(...)->withMessageID(...)
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
    public static function with(string $deeplink, string $messageID): self
    {
        $obj = new self;

        $obj->deeplink = $deeplink;
        $obj->messageID = $messageID;

        return $obj;
    }

    /**
     * Link to the chat where the message was sent. This should always be shown to the user.
     */
    public function withDeeplink(string $deeplink): self
    {
        $obj = clone $this;
        $obj->deeplink = $deeplink;

        return $obj;
    }

    /**
     * Stable message ID.
     */
    public function withMessageID(string $messageID): self
    {
        $obj = clone $this;
        $obj->messageID = $messageID;

        return $obj;
    }
}
