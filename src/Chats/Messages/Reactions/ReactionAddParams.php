<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Messages\Reactions;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Add a reaction to an existing message.
 *
 * @see BeeperDesktop\Services\Chats\Messages\ReactionsService::add()
 *
 * @phpstan-type ReactionAddParamsShape = array{
 *   chatID: string, reactionKey: string, transactionID?: string|null
 * }
 */
final class ReactionAddParams implements BaseModel
{
    /** @use SdkModel<ReactionAddParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     */
    #[Required]
    public string $chatID;

    /**
     * Reaction key to add (emoji, shortcode, or custom emoji key).
     */
    #[Required]
    public string $reactionKey;

    /**
     * Optional transaction ID for deduplication and send tracking.
     */
    #[Optional]
    public ?string $transactionID;

    /**
     * `new ReactionAddParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReactionAddParams::with(chatID: ..., reactionKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReactionAddParams)->withChatID(...)->withReactionKey(...)
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
        string $reactionKey,
        ?string $transactionID = null
    ): self {
        $self = new self;

        $self['chatID'] = $chatID;
        $self['reactionKey'] = $reactionKey;

        null !== $transactionID && $self['transactionID'] = $transactionID;

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
     * Reaction key to add (emoji, shortcode, or custom emoji key).
     */
    public function withReactionKey(string $reactionKey): self
    {
        $self = clone $this;
        $self['reactionKey'] = $reactionKey;

        return $self;
    }

    /**
     * Optional transaction ID for deduplication and send tracking.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}
