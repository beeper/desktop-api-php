<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Messages\MessageSearchParams\ChatType;
use BeeperDesktop\Messages\MessageSearchParams\Direction;
use BeeperDesktop\Messages\MessageSearchParams\MediaType;

/**
 * Search messages across chats using Beeper's message index.
 *
 * @see BeeperDesktop\Services\MessagesService::search()
 *
 * @phpstan-type MessageSearchParamsShape = array{
 *   accountIDs?: list<string>|null,
 *   chatIDs?: list<string>|null,
 *   chatType?: null|ChatType|value-of<ChatType>,
 *   cursor?: string|null,
 *   dateAfter?: \DateTimeInterface|null,
 *   dateBefore?: \DateTimeInterface|null,
 *   direction?: null|Direction|value-of<Direction>,
 *   excludeLowPriority?: bool|null,
 *   includeMuted?: bool|null,
 *   limit?: int|null,
 *   mediaTypes?: list<MediaType|value-of<MediaType>>|null,
 *   query?: string|null,
 *   sender?: string|null,
 * }
 */
final class MessageSearchParams implements BaseModel
{
    /** @use SdkModel<MessageSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Limit search to specific account IDs.
     *
     * @var list<string>|null $accountIDs
     */
    #[Optional(list: 'string')]
    public ?array $accountIDs;

    /**
     * Limit search to specific chat IDs.
     *
     * @var list<string>|null $chatIDs
     */
    #[Optional(list: 'string')]
    public ?array $chatIDs;

    /**
     * Filter by chat type: 'group' for group chats, 'single' for 1:1 chats.
     *
     * @var value-of<ChatType>|null $chatType
     */
    #[Optional(enum: ChatType::class)]
    public ?string $chatType;

    /**
     * Opaque pagination cursor; do not inspect. Use together with 'direction'.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Only include messages with timestamp strictly after this ISO 8601 datetime (e.g., '2024-07-01T00:00:00Z' or '2024-07-01T00:00:00+02:00').
     */
    #[Optional]
    public ?\DateTimeInterface $dateAfter;

    /**
     * Only include messages with timestamp strictly before this ISO 8601 datetime (e.g., '2024-07-31T23:59:59Z' or '2024-07-31T23:59:59+02:00').
     */
    #[Optional]
    public ?\DateTimeInterface $dateBefore;

    /**
     * Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
     *
     * @var value-of<Direction>|null $direction
     */
    #[Optional(enum: Direction::class)]
    public ?string $direction;

    /**
     * Exclude messages marked Low Priority by the user. Default: true. Set to false to include all.
     */
    #[Optional(nullable: true)]
    public ?bool $excludeLowPriority;

    /**
     * Include messages in chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     */
    #[Optional(nullable: true)]
    public ?bool $includeMuted;

    /**
     * Maximum number of messages to return.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter messages by media types. Use ['any'] for any media type, or specify exact types like ['video', 'image']. Omit for no media filtering.
     *
     * @var list<value-of<MediaType>>|null $mediaTypes
     */
    #[Optional(list: MediaType::class)]
    public ?array $mediaTypes;

    /**
     * Literal word search (non-semantic). Finds messages containing these EXACT words in any order. Use single words users actually type, not concepts or phrases. Example: use "dinner" not "dinner plans", use "sick" not "health issues". If omitted, returns results filtered only by other parameters.
     */
    #[Optional]
    public ?string $query;

    /**
     * Filter by sender: 'me' (messages sent by the authenticated user), 'others' (messages sent by others), or a specific user ID string (user.id).
     */
    #[Optional]
    public ?string $sender;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $accountIDs
     * @param list<string>|null $chatIDs
     * @param ChatType|value-of<ChatType>|null $chatType
     * @param Direction|value-of<Direction>|null $direction
     * @param list<MediaType|value-of<MediaType>>|null $mediaTypes
     */
    public static function with(
        ?array $accountIDs = null,
        ?array $chatIDs = null,
        ChatType|string|null $chatType = null,
        ?string $cursor = null,
        ?\DateTimeInterface $dateAfter = null,
        ?\DateTimeInterface $dateBefore = null,
        Direction|string|null $direction = null,
        ?bool $excludeLowPriority = null,
        ?bool $includeMuted = null,
        ?int $limit = null,
        ?array $mediaTypes = null,
        ?string $query = null,
        ?string $sender = null,
    ): self {
        $self = new self;

        null !== $accountIDs && $self['accountIDs'] = $accountIDs;
        null !== $chatIDs && $self['chatIDs'] = $chatIDs;
        null !== $chatType && $self['chatType'] = $chatType;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $dateAfter && $self['dateAfter'] = $dateAfter;
        null !== $dateBefore && $self['dateBefore'] = $dateBefore;
        null !== $direction && $self['direction'] = $direction;
        null !== $excludeLowPriority && $self['excludeLowPriority'] = $excludeLowPriority;
        null !== $includeMuted && $self['includeMuted'] = $includeMuted;
        null !== $limit && $self['limit'] = $limit;
        null !== $mediaTypes && $self['mediaTypes'] = $mediaTypes;
        null !== $query && $self['query'] = $query;
        null !== $sender && $self['sender'] = $sender;

        return $self;
    }

    /**
     * Limit search to specific account IDs.
     *
     * @param list<string> $accountIDs
     */
    public function withAccountIDs(array $accountIDs): self
    {
        $self = clone $this;
        $self['accountIDs'] = $accountIDs;

        return $self;
    }

    /**
     * Limit search to specific chat IDs.
     *
     * @param list<string> $chatIDs
     */
    public function withChatIDs(array $chatIDs): self
    {
        $self = clone $this;
        $self['chatIDs'] = $chatIDs;

        return $self;
    }

    /**
     * Filter by chat type: 'group' for group chats, 'single' for 1:1 chats.
     *
     * @param ChatType|value-of<ChatType> $chatType
     */
    public function withChatType(ChatType|string $chatType): self
    {
        $self = clone $this;
        $self['chatType'] = $chatType;

        return $self;
    }

    /**
     * Opaque pagination cursor; do not inspect. Use together with 'direction'.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * Only include messages with timestamp strictly after this ISO 8601 datetime (e.g., '2024-07-01T00:00:00Z' or '2024-07-01T00:00:00+02:00').
     */
    public function withDateAfter(\DateTimeInterface $dateAfter): self
    {
        $self = clone $this;
        $self['dateAfter'] = $dateAfter;

        return $self;
    }

    /**
     * Only include messages with timestamp strictly before this ISO 8601 datetime (e.g., '2024-07-31T23:59:59Z' or '2024-07-31T23:59:59+02:00').
     */
    public function withDateBefore(\DateTimeInterface $dateBefore): self
    {
        $self = clone $this;
        $self['dateBefore'] = $dateBefore;

        return $self;
    }

    /**
     * Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
     *
     * @param Direction|value-of<Direction> $direction
     */
    public function withDirection(Direction|string $direction): self
    {
        $self = clone $this;
        $self['direction'] = $direction;

        return $self;
    }

    /**
     * Exclude messages marked Low Priority by the user. Default: true. Set to false to include all.
     */
    public function withExcludeLowPriority(?bool $excludeLowPriority): self
    {
        $self = clone $this;
        $self['excludeLowPriority'] = $excludeLowPriority;

        return $self;
    }

    /**
     * Include messages in chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     */
    public function withIncludeMuted(?bool $includeMuted): self
    {
        $self = clone $this;
        $self['includeMuted'] = $includeMuted;

        return $self;
    }

    /**
     * Maximum number of messages to return.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter messages by media types. Use ['any'] for any media type, or specify exact types like ['video', 'image']. Omit for no media filtering.
     *
     * @param list<MediaType|value-of<MediaType>> $mediaTypes
     */
    public function withMediaTypes(array $mediaTypes): self
    {
        $self = clone $this;
        $self['mediaTypes'] = $mediaTypes;

        return $self;
    }

    /**
     * Literal word search (non-semantic). Finds messages containing these EXACT words in any order. Use single words users actually type, not concepts or phrases. Example: use "dinner" not "dinner plans", use "sick" not "health issues". If omitted, returns results filtered only by other parameters.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Filter by sender: 'me' (messages sent by the authenticated user), 'others' (messages sent by others), or a specific user ID string (user.id).
     */
    public function withSender(string $sender): self
    {
        $self = clone $this;
        $self['sender'] = $sender;

        return $self;
    }
}
