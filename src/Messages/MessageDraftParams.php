<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Draft a message in a specific chat. This will be placed in the message input field without sending.
 */
final class MessageDraftParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * Provide the unique identifier of the chat where you want to draft a message.
     */
    #[Api]
    public string $chatID;

    /**
     * Set to true to bring Beeper application to the foreground, or false to draft silently in background.
     */
    #[Api(optional: true)]
    public ?bool $focusApp;

    /**
     * Provide the text content you want to draft. This will be placed in the message input field without sending.
     */
    #[Api(optional: true)]
    public ?string $text;

    /**
     * `new MessageDraftParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageDraftParams::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageDraftParams)->withChatID(...)
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
        ?bool $focusApp = null,
        ?string $text = null
    ): self {
        $obj = new self;

        $obj->chatID = $chatID;

        null !== $focusApp && $obj->focusApp = $focusApp;
        null !== $text && $obj->text = $text;

        return $obj;
    }

    /**
     * Provide the unique identifier of the chat where you want to draft a message.
     */
    public function withChatID(string $chatID): self
    {
        $obj = clone $this;
        $obj->chatID = $chatID;

        return $obj;
    }

    /**
     * Set to true to bring Beeper application to the foreground, or false to draft silently in background.
     */
    public function withFocusApp(bool $focusApp): self
    {
        $obj = clone $this;
        $obj->focusApp = $focusApp;

        return $obj;
    }

    /**
     * Provide the text content you want to draft. This will be placed in the message input field without sending.
     */
    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj->text = $text;

        return $obj;
    }
}
