<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Messages\Reactions;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Remove the reaction added by the authenticated user from an existing message.
 *
 * @see BeeperDesktop\Services\Chats\Messages\ReactionsService::delete()
 *
 * @phpstan-type ReactionDeleteParamsShape = array{
 *   chatID: string, messageID: string
 * }
 */
final class ReactionDeleteParams implements BaseModel
{
    /** @use SdkModel<ReactionDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     */
    #[Required]
    public string $chatID;

    /**
     * Message ID.
     */
    #[Required]
    public string $messageID;

    /**
     * `new ReactionDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReactionDeleteParams::with(chatID: ..., messageID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReactionDeleteParams)->withChatID(...)->withMessageID(...)
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
    public static function with(string $chatID, string $messageID): self
    {
        $self = new self;

        $self['chatID'] = $chatID;
        $self['messageID'] = $messageID;

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
     * Message ID.
     */
    public function withMessageID(string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }
}
