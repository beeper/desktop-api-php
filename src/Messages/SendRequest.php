<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class SendRequest implements BaseModel
{
    use SdkModel;

    /**
     * The identifier of the chat where the message will send.
     */
    #[Api]
    public string $chatID;

    /**
     * Provide a message ID to send this as a reply to an existing message.
     */
    #[Api(optional: true)]
    public ?string $replyToMessageID;

    /**
     * Text content of the message you want to send. You may use markdown.
     */
    #[Api(optional: true)]
    public ?string $text;

    /**
     * `new SendRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendRequest::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendRequest)->withChatID(...)
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
        ?string $replyToMessageID = null,
        ?string $text = null
    ): self {
        $obj = new self;

        $obj->chatID = $chatID;

        null !== $replyToMessageID && $obj->replyToMessageID = $replyToMessageID;
        null !== $text && $obj->text = $text;

        return $obj;
    }

    /**
     * The identifier of the chat where the message will send.
     */
    public function withChatID(string $chatID): self
    {
        $obj = clone $this;
        $obj->chatID = $chatID;

        return $obj;
    }

    /**
     * Provide a message ID to send this as a reply to an existing message.
     */
    public function withReplyToMessageID(string $replyToMessageID): self
    {
        $obj = clone $this;
        $obj->replyToMessageID = $replyToMessageID;

        return $obj;
    }

    /**
     * Text content of the message you want to send. You may use markdown.
     */
    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj->text = $text;

        return $obj;
    }
}
