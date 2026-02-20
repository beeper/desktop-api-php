<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Message\Type;

/**
 * @phpstan-import-type AttachmentShape from \BeeperDesktop\Attachment
 * @phpstan-import-type ReactionShape from \BeeperDesktop\Reaction
 *
 * @phpstan-type MessageShape = array{
 *   id: string,
 *   accountID: string,
 *   chatID: string,
 *   senderID: string,
 *   sortKey: string,
 *   timestamp: \DateTimeInterface,
 *   attachments?: list<Attachment|AttachmentShape>|null,
 *   isSender?: bool|null,
 *   isUnread?: bool|null,
 *   linkedMessageID?: string|null,
 *   reactions?: list<Reaction|ReactionShape>|null,
 *   senderName?: string|null,
 *   text?: string|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class Message implements BaseModel
{
    /** @use SdkModel<MessageShape> */
    use SdkModel;

    /**
     * Message ID.
     */
    #[Required]
    public string $id;

    /**
     * Beeper account ID the message belongs to.
     */
    #[Required]
    public string $accountID;

    /**
     * Unique identifier of the chat.
     */
    #[Required]
    public string $chatID;

    /**
     * Sender user ID.
     */
    #[Required]
    public string $senderID;

    /**
     * A unique, sortable key used to sort messages.
     */
    #[Required]
    public string $sortKey;

    /**
     * Message timestamp.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * Attachments included with this message, if any.
     *
     * @var list<Attachment>|null $attachments
     */
    #[Optional(list: Attachment::class)]
    public ?array $attachments;

    /**
     * True if the authenticated user sent the message.
     */
    #[Optional]
    public ?bool $isSender;

    /**
     * True if the message is unread for the authenticated user. May be omitted.
     */
    #[Optional]
    public ?bool $isUnread;

    /**
     * ID of the message this is a reply to, if any.
     */
    #[Optional]
    public ?string $linkedMessageID;

    /**
     * Reactions to the message, if any.
     *
     * @var list<Reaction>|null $reactions
     */
    #[Optional(list: Reaction::class)]
    public ?array $reactions;

    /**
     * Resolved sender display name (impersonator/full name/username/participant name).
     */
    #[Optional]
    public ?string $senderName;

    /**
     * Plain-text body if present. May include a JSON fallback with text entities for rich messages.
     */
    #[Optional]
    public ?string $text;

    /**
     * Message content type. Useful for distinguishing reactions, media messages, and state events from regular text messages.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new Message()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Message::with(
     *   id: ...,
     *   accountID: ...,
     *   chatID: ...,
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
     *   ->withSenderID(...)
     *   ->withSortKey(...)
     *   ->withTimestamp(...)
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
     *
     * @param list<Attachment|AttachmentShape>|null $attachments
     * @param list<Reaction|ReactionShape>|null $reactions
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $chatID,
        string $senderID,
        string $sortKey,
        \DateTimeInterface $timestamp,
        ?array $attachments = null,
        ?bool $isSender = null,
        ?bool $isUnread = null,
        ?string $linkedMessageID = null,
        ?array $reactions = null,
        ?string $senderName = null,
        ?string $text = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['chatID'] = $chatID;
        $self['senderID'] = $senderID;
        $self['sortKey'] = $sortKey;
        $self['timestamp'] = $timestamp;

        null !== $attachments && $self['attachments'] = $attachments;
        null !== $isSender && $self['isSender'] = $isSender;
        null !== $isUnread && $self['isUnread'] = $isUnread;
        null !== $linkedMessageID && $self['linkedMessageID'] = $linkedMessageID;
        null !== $reactions && $self['reactions'] = $reactions;
        null !== $senderName && $self['senderName'] = $senderName;
        null !== $text && $self['text'] = $text;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Message ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Beeper account ID the message belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

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
     * Sender user ID.
     */
    public function withSenderID(string $senderID): self
    {
        $self = clone $this;
        $self['senderID'] = $senderID;

        return $self;
    }

    /**
     * A unique, sortable key used to sort messages.
     */
    public function withSortKey(string $sortKey): self
    {
        $self = clone $this;
        $self['sortKey'] = $sortKey;

        return $self;
    }

    /**
     * Message timestamp.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * Attachments included with this message, if any.
     *
     * @param list<Attachment|AttachmentShape> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $self = clone $this;
        $self['attachments'] = $attachments;

        return $self;
    }

    /**
     * True if the authenticated user sent the message.
     */
    public function withIsSender(bool $isSender): self
    {
        $self = clone $this;
        $self['isSender'] = $isSender;

        return $self;
    }

    /**
     * True if the message is unread for the authenticated user. May be omitted.
     */
    public function withIsUnread(bool $isUnread): self
    {
        $self = clone $this;
        $self['isUnread'] = $isUnread;

        return $self;
    }

    /**
     * ID of the message this is a reply to, if any.
     */
    public function withLinkedMessageID(string $linkedMessageID): self
    {
        $self = clone $this;
        $self['linkedMessageID'] = $linkedMessageID;

        return $self;
    }

    /**
     * Reactions to the message, if any.
     *
     * @param list<Reaction|ReactionShape> $reactions
     */
    public function withReactions(array $reactions): self
    {
        $self = clone $this;
        $self['reactions'] = $reactions;

        return $self;
    }

    /**
     * Resolved sender display name (impersonator/full name/username/participant name).
     */
    public function withSenderName(string $senderName): self
    {
        $self = clone $this;
        $self['senderName'] = $senderName;

        return $self;
    }

    /**
     * Plain-text body if present. May include a JSON fallback with text entities for rich messages.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Message content type. Useful for distinguishing reactions, media messages, and state events from regular text messages.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
