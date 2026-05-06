<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Edit the text content of an existing message. Messages with attachments cannot be edited.
 *
 * @see BeeperDesktop\Services\MessagesService::update()
 *
 * @phpstan-type MessageUpdateParamsShape = array{chatID: string, text: string}
 */
final class MessageUpdateParams implements BaseModel
{
    /** @use SdkModel<MessageUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     */
    #[Required]
    public string $chatID;

    /**
     * New text content for the message.
     */
    #[Required]
    public string $text;

    /**
     * `new MessageUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageUpdateParams::with(chatID: ..., text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageUpdateParams)->withChatID(...)->withText(...)
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
    public static function with(string $chatID, string $text): self
    {
        $self = new self;

        $self['chatID'] = $chatID;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     */
    public function withChatID(string $chatID): self
    {
        $self = clone $this;
        $self['chatID'] = $chatID;

        return $self;
    }

    /**
     * New text content for the message.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
