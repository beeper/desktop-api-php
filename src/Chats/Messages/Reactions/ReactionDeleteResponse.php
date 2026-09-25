<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Messages\Reactions;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type ReactionDeleteResponseShape = array{
 *   chatID: string, messageID: string, reactionKey: string, success: bool
 * }
 */
final class ReactionDeleteResponse implements BaseModel
{
    /** @use SdkModel<ReactionDeleteResponseShape> */
    use SdkModel;

    /**
     * Always true. Indicates the reaction removal was queued; failures return an error response.
     */
    #[Required]
    public bool $success = true;

    /**
     * Chat ID. Input routes also accept the local chat ID from this installation when available.
     */
    #[Required]
    public string $chatID;

    /**
     * Message ID.
     */
    #[Required]
    public string $messageID;

    /**
     * Reaction key that was removed.
     */
    #[Required]
    public string $reactionKey;

    /**
     * `new ReactionDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReactionDeleteResponse::with(chatID: ..., messageID: ..., reactionKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReactionDeleteResponse)
     *   ->withChatID(...)
     *   ->withMessageID(...)
     *   ->withReactionKey(...)
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
        string $reactionKey
    ): self {
        $self = new self;

        $self['chatID'] = $chatID;
        $self['messageID'] = $messageID;
        $self['reactionKey'] = $reactionKey;

        return $self;
    }

    /**
     * Chat ID. Input routes also accept the local chat ID from this installation when available.
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
     * Reaction key that was removed.
     */
    public function withReactionKey(string $reactionKey): self
    {
        $self = clone $this;
        $self['reactionKey'] = $reactionKey;

        return $self;
    }

    /**
     * Always true. Indicates the reaction removal was queued; failures return an error response.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
