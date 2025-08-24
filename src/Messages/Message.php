<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Shared\Attachment;
use BeeperDesktop\Shared\Reaction;

final class Message implements BaseModel
{
    use SdkModel;

    /**
     * Stable message ID for cursor pagination.
     */
    #[Api]
    public string $id;

    /**
     * Beeper account ID the message belongs to.
     */
    #[Api]
    public string $accountID;

    /**
     * Beeper chat/thread/room ID.
     */
    #[Api]
    public string $chatID;

    /**
     * Stable message ID (same as id).
     */
    #[Api]
    public string $messageID;

    /**
     * Sender user ID.
     */
    #[Api]
    public string $senderID;

    /**
     * A unique key used to sort messages.
     */
    #[Api]
    public string|float $sortKey;

    /**
     * Message timestamp.
     */
    #[Api]
    public \DateTimeInterface $timestamp;

    /**
     * Attachments included with this message, if any.
     *
     * @var list<Attachment>|null $attachments
     */
    #[Api(list: Attachment::class, optional: true)]
    public ?array $attachments;

    /**
     * True if the authenticated user sent the message.
     */
    #[Api(optional: true)]
    public ?bool $isSender;

    /**
     * True if the message is unread for the authenticated user. May be omitted.
     */
    #[Api(optional: true)]
    public ?bool $isUnread;

    /**
     * Reactions to the message, if any.
     *
     * @var list<Reaction>|null $reactions
     */
    #[Api(list: Reaction::class, optional: true)]
    public ?array $reactions;

    /**
     * Resolved sender display name (impersonator/full name/username/participant name).
     */
    #[Api(optional: true)]
    public ?string $senderName;

    /**
     * Plain-text body if present. May include a JSON fallback with text entities for rich messages.
     */
    #[Api(optional: true)]
    public ?string $text;

    /**
     * `new Message()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Message::with(
     *   id: ...,
     *   accountID: ...,
     *   chatID: ...,
     *   messageID: ...,
     *   senderID: ...,
     *   sortKey: ...,
     *   timestamp: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Message)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withChatID(...)
     *   ->withMessageID(...)
     *   ->withSenderID(...)
     *   ->withSortKey(...)
     *   ->withTimestamp(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Attachment> $attachments
     * @param list<Reaction> $reactions
     */
    public static function with(
        string $id,
        string $accountID,
        string $chatID,
        string $messageID,
        string $senderID,
        string|float $sortKey,
        \DateTimeInterface $timestamp,
        ?array $attachments = null,
        ?bool $isSender = null,
        ?bool $isUnread = null,
        ?array $reactions = null,
        ?string $senderName = null,
        ?string $text = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->accountID = $accountID;
        $obj->chatID = $chatID;
        $obj->messageID = $messageID;
        $obj->senderID = $senderID;
        $obj->sortKey = $sortKey;
        $obj->timestamp = $timestamp;

        null !== $attachments && $obj->attachments = $attachments;
        null !== $isSender && $obj->isSender = $isSender;
        null !== $isUnread && $obj->isUnread = $isUnread;
        null !== $reactions && $obj->reactions = $reactions;
        null !== $senderName && $obj->senderName = $senderName;
        null !== $text && $obj->text = $text;

        return $obj;
    }

    /**
     * Stable message ID for cursor pagination.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Beeper account ID the message belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $obj = clone $this;
        $obj->accountID = $accountID;

        return $obj;
    }

    /**
     * Beeper chat/thread/room ID.
     */
    public function withChatID(string $chatID): self
    {
        $obj = clone $this;
        $obj->chatID = $chatID;

        return $obj;
    }

    /**
     * Stable message ID (same as id).
     */
    public function withMessageID(string $messageID): self
    {
        $obj = clone $this;
        $obj->messageID = $messageID;

        return $obj;
    }

    /**
     * Sender user ID.
     */
    public function withSenderID(string $senderID): self
    {
        $obj = clone $this;
        $obj->senderID = $senderID;

        return $obj;
    }

    /**
     * A unique key used to sort messages.
     */
    public function withSortKey(string|float $sortKey): self
    {
        $obj = clone $this;
        $obj->sortKey = $sortKey;

        return $obj;
    }

    /**
     * Message timestamp.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $obj = clone $this;
        $obj->timestamp = $timestamp;

        return $obj;
    }

    /**
     * Attachments included with this message, if any.
     *
     * @param list<Attachment> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $obj = clone $this;
        $obj->attachments = $attachments;

        return $obj;
    }

    /**
     * True if the authenticated user sent the message.
     */
    public function withIsSender(bool $isSender): self
    {
        $obj = clone $this;
        $obj->isSender = $isSender;

        return $obj;
    }

    /**
     * True if the message is unread for the authenticated user. May be omitted.
     */
    public function withIsUnread(bool $isUnread): self
    {
        $obj = clone $this;
        $obj->isUnread = $isUnread;

        return $obj;
    }

    /**
     * Reactions to the message, if any.
     *
     * @param list<Reaction> $reactions
     */
    public function withReactions(array $reactions): self
    {
        $obj = clone $this;
        $obj->reactions = $reactions;

        return $obj;
    }

    /**
     * Resolved sender display name (impersonator/full name/username/participant name).
     */
    public function withSenderName(string $senderName): self
    {
        $obj = clone $this;
        $obj->senderName = $senderName;

        return $obj;
    }

    /**
     * Plain-text body if present. May include a JSON fallback with text entities for rich messages.
     */
    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj->text = $text;

        return $obj;
    }
}
