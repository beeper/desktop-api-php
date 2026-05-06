<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Retrieve a message by final message ID, pendingMessageID, or Matrix event ID. Chat ID may be a Beeper chat ID or local chat ID.
 *
 * @see BeeperDesktop\Services\MessagesService::retrieve()
 *
 * @phpstan-type MessageRetrieveParamsShape = array{chatID: string}
 */
final class MessageRetrieveParams implements BaseModel
{
    /** @use SdkModel<MessageRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     */
    #[Required]
    public string $chatID;

    /**
     * `new MessageRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageRetrieveParams::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageRetrieveParams)->withChatID(...)
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
    public static function with(string $chatID): self
    {
        $self = new self;

        $self['chatID'] = $chatID;

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
}
