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
 *   chatID: string, reactionKey: string
 * }
 */
final class ReactionDeleteParams implements BaseModel
{
    /** @use SdkModel<ReactionDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Unique identifier of the chat.
     */
    #[Required]
    public string $chatID;

    /**
     * Reaction key to remove.
     */
    #[Required]
    public string $reactionKey;

    /**
     * `new ReactionDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReactionDeleteParams::with(chatID: ..., reactionKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReactionDeleteParams)->withChatID(...)->withReactionKey(...)
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
    public static function with(string $chatID, string $reactionKey): self
    {
        $self = new self;

        $self['chatID'] = $chatID;
        $self['reactionKey'] = $reactionKey;

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
     * Reaction key to remove.
     */
    public function withReactionKey(string $reactionKey): self
    {
        $self = clone $this;
        $self['reactionKey'] = $reactionKey;

        return $self;
    }
}
