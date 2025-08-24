<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Generate a deep link to a specific chat or message. This link can be used to open the chat directly in the Beeper app.
 */
final class ChatGetLinkParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * The ID of the chat to link to.
     */
    #[Api]
    public string $chatID;

    /**
     * Optional message sort key. Jumps to that message in the chat.
     */
    #[Api(optional: true)]
    public ?string $messageSortKey;

    /**
     * `new ChatGetLinkParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatGetLinkParams::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatGetLinkParams)->withChatID(...)
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
    public static function with(
        string $chatID,
        ?string $messageSortKey = null
    ): self {
        $obj = new self;

        $obj->chatID = $chatID;

        null !== $messageSortKey && $obj->messageSortKey = $messageSortKey;

        return $obj;
    }

    /**
     * The ID of the chat to link to.
     */
    public function withChatID(string $chatID): self
    {
        $obj = clone $this;
        $obj->chatID = $chatID;

        return $obj;
    }

    /**
     * Optional message sort key. Jumps to that message in the chat.
     */
    public function withMessageSortKey(string $messageSortKey): self
    {
        $obj = clone $this;
        $obj->messageSortKey = $messageSortKey;

        return $obj;
    }
}
