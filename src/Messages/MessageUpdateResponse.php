<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type MessageUpdateResponseShape = array{
 *   chatID: string, messageID: string, success: bool
 * }
 */
final class MessageUpdateResponse implements BaseModel
{
    /** @use SdkModel<MessageUpdateResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the chat.
     */
    #[Required]
    public string $chatID;

    /**
     * Message ID.
     */
    #[Required]
    public string $messageID;

    /**
     * Whether the message was successfully edited.
     */
    #[Required]
    public bool $success;

    /**
     * `new MessageUpdateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageUpdateResponse::with(chatID: ..., messageID: ..., success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageUpdateResponse)
     *   ->withChatID(...)
     *   ->withMessageID(...)
     *   ->withSuccess(...)
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
    public static function with(
        string $chatID,
        string $messageID,
        bool $success
    ): self {
        $self = new self;

        $self['chatID'] = $chatID;
        $self['messageID'] = $messageID;
        $self['success'] = $success;

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
     * Message ID.
     */
    public function withMessageID(string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }

    /**
     * Whether the message was successfully edited.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
