<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Messages\Reactions;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type ReactionAddResponseShape = array{
 *   chatID: string,
 *   messageID: string,
 *   reactionKey: string,
 *   success: bool,
 *   transactionID: string,
 * }
 */
final class ReactionAddResponse implements BaseModel
{
    /** @use SdkModel<ReactionAddResponseShape> */
    use SdkModel;

    /**
     * Whether the reaction was successfully added.
     */
    #[Required]
    public bool $success = true;

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
     * Reaction key that was added.
     */
    #[Required]
    public string $reactionKey;

    /**
     * Transaction ID used for the reaction event.
     */
    #[Required]
    public string $transactionID;

    /**
     * `new ReactionAddResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReactionAddResponse::with(
     *   chatID: ..., messageID: ..., reactionKey: ..., transactionID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReactionAddResponse)
     *   ->withChatID(...)
     *   ->withMessageID(...)
     *   ->withReactionKey(...)
     *   ->withTransactionID(...)
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
        string $reactionKey,
        string $transactionID,
    ): self {
        $self = new self;

        $self['chatID'] = $chatID;
        $self['messageID'] = $messageID;
        $self['reactionKey'] = $reactionKey;
        $self['transactionID'] = $transactionID;

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
     * Reaction key that was added.
     */
    public function withReactionKey(string $reactionKey): self
    {
        $self = clone $this;
        $self['reactionKey'] = $reactionKey;

        return $self;
    }

    /**
     * Whether the reaction was successfully added.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Transaction ID used for the reaction event.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }
}
