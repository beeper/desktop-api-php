<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Delete a message by final message ID. Pending message IDs are not accepted because messages cannot be deleted while sending.
 *
 * @see BeeperDesktop\Services\MessagesService::delete()
 *
 * @phpstan-type MessageDeleteParamsShape = array{
 *   chatID: string, forEveryone?: bool|null
 * }
 */
final class MessageDeleteParams implements BaseModel
{
    /** @use SdkModel<MessageDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     */
    #[Required]
    public string $chatID;

    /**
     * True to request deletion for everyone when the network supports it; false to delete only for the authenticated user when supported.
     */
    #[Optional(nullable: true)]
    public ?bool $forEveryone;

    /**
     * `new MessageDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageDeleteParams::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageDeleteParams)->withChatID(...)
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
    public static function with(string $chatID, ?bool $forEveryone = null): self
    {
        $self = new self;

        $self['chatID'] = $chatID;

        null !== $forEveryone && $self['forEveryone'] = $forEveryone;

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
     * True to request deletion for everyone when the network supports it; false to delete only for the authenticated user when supported.
     */
    public function withForEveryone(?bool $forEveryone): self
    {
        $self = clone $this;
        $self['forEveryone'] = $forEveryone;

        return $self;
    }
}
