<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type MessageSendResponseShape = array{
 *   chatID: string, pendingMessageID: string
 * }
 */
final class MessageSendResponse implements BaseModel
{
    /** @use SdkModel<MessageSendResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the chat.
     */
    #[Required]
    public string $chatID;

    /**
     * Pending message ID.
     */
    #[Required]
    public string $pendingMessageID;

    /**
     * `new MessageSendResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageSendResponse::with(chatID: ..., pendingMessageID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageSendResponse)->withChatID(...)->withPendingMessageID(...)
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
    public static function with(string $chatID, string $pendingMessageID): self
    {
        $self = new self;

        $self['chatID'] = $chatID;
        $self['pendingMessageID'] = $pendingMessageID;

        return $self;
    }

    /**
     * Unique identifier of the chat.
     */
    public function withChatID(string $chatID): self
    {
        $self = clone $this;
        $self['chatID'] = $chatID;

        return $self;
    }

    /**
     * Pending message ID.
     */
    public function withPendingMessageID(string $pendingMessageID): self
    {
        $self = clone $this;
        $self['pendingMessageID'] = $pendingMessageID;

        return $self;
    }
}
