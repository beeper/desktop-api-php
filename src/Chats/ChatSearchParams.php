<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\ChatSearchParams\Direction;
use BeeperDesktop\Chats\ChatSearchParams\Inbox;
use BeeperDesktop\Chats\ChatSearchParams\Scope;
use BeeperDesktop\Chats\ChatSearchParams\Type;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Search chats by title, network, or participant names.
 *
 * @see BeeperDesktop\Services\ChatsService::search()
 *
 * @phpstan-type ChatSearchParamsShape = array{
 *   accountIDs?: list<string>|null,
 *   cursor?: string|null,
 *   direction?: null|Direction|value-of<Direction>,
 *   inbox?: null|Inbox|value-of<Inbox>,
 *   includeMuted?: bool|null,
 *   lastActivityAfter?: \DateTimeInterface|null,
 *   lastActivityBefore?: \DateTimeInterface|null,
 *   limit?: int|null,
 *   query?: string|null,
 *   scope?: null|Scope|value-of<Scope>,
 *   type?: null|Type|value-of<Type>,
 *   unreadOnly?: bool|null,
 * }
 */
final class ChatSearchParams implements BaseModel
{
    /** @use SdkModel<ChatSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Provide an array of account IDs to filter chats from specific messaging accounts only.
     *
     * @var list<string>|null $accountIDs
     */
    #[Optional(list: 'string')]
    public ?array $accountIDs;

    /**
     * Opaque pagination cursor; do not inspect. Use together with 'direction'.
     */
    #[Optional]
    public ?string $cursor;

    /**
     * Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
     *
     * @var value-of<Direction>|null $direction
     */
    #[Optional(enum: Direction::class)]
    public ?string $direction;

    /**
     * Filter by inbox type: "primary" (non-archived, non-low-priority), "low-priority", or "archive". If not specified, shows all chats.
     *
     * @var value-of<Inbox>|null $inbox
     */
    #[Optional(enum: Inbox::class)]
    public ?string $inbox;

    /**
     * Include chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     */
    #[Optional(nullable: true)]
    public ?bool $includeMuted;

    /**
     * Provide an ISO datetime string to only retrieve chats with last activity after this time.
     */
    #[Optional]
    public ?\DateTimeInterface $lastActivityAfter;

    /**
     * Provide an ISO datetime string to only retrieve chats with last activity before this time.
     */
    #[Optional]
    public ?\DateTimeInterface $lastActivityBefore;

    /**
     * Set the maximum number of chats to retrieve. Valid range: 1-200, default is 50.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Literal token search (non-semantic). Use single words users type (e.g., "dinner"). When multiple words provided, ALL must match. Case-insensitive.
     */
    #[Optional]
    public ?string $query;

    /**
     * Search scope: 'titles' matches title + network; 'participants' matches participant names.
     *
     * @var value-of<Scope>|null $scope
     */
    #[Optional(enum: Scope::class)]
    public ?string $scope;

    /**
     * Specify the type of chats to retrieve: use "single" for direct messages, "group" for group chats, or "any" to get all types.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Set to true to only retrieve chats that have unread messages.
     */
    #[Optional(nullable: true)]
    public ?bool $unreadOnly;

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
     * @param Direction|value-of<Direction>|null $direction
     * @param Inbox|value-of<Inbox>|null $inbox
     * @param Scope|value-of<Scope>|null $scope
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?array $accountIDs = null,
        ?string $cursor = null,
        Direction|string|null $direction = null,
        Inbox|string|null $inbox = null,
        ?bool $includeMuted = null,
        ?\DateTimeInterface $lastActivityAfter = null,
        ?\DateTimeInterface $lastActivityBefore = null,
        ?int $limit = null,
        ?string $query = null,
        Scope|string|null $scope = null,
        Type|string|null $type = null,
        ?bool $unreadOnly = null,
    ): self {
        $self = new self;

        null !== $accountIDs && $self['accountIDs'] = $accountIDs;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $direction && $self['direction'] = $direction;
        null !== $inbox && $self['inbox'] = $inbox;
        null !== $includeMuted && $self['includeMuted'] = $includeMuted;
        null !== $lastActivityAfter && $self['lastActivityAfter'] = $lastActivityAfter;
        null !== $lastActivityBefore && $self['lastActivityBefore'] = $lastActivityBefore;
        null !== $limit && $self['limit'] = $limit;
        null !== $query && $self['query'] = $query;
        null !== $scope && $self['scope'] = $scope;
        null !== $type && $self['type'] = $type;
        null !== $unreadOnly && $self['unreadOnly'] = $unreadOnly;

        return $self;
    }

    /**
     * Provide an array of account IDs to filter chats from specific messaging accounts only.
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
     * Opaque pagination cursor; do not inspect. Use together with 'direction'.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

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
     * Filter by inbox type: "primary" (non-archived, non-low-priority), "low-priority", or "archive". If not specified, shows all chats.
     *
     * @param Inbox|value-of<Inbox> $inbox
     */
    public function withInbox(Inbox|string $inbox): self
    {
        $self = clone $this;
        $self['inbox'] = $inbox;

        return $self;
    }

    /**
     * Include chats marked as Muted by the user, which are usually less important. Default: true. Set to false if the user wants a more refined search.
     */
    public function withIncludeMuted(?bool $includeMuted): self
    {
        $self = clone $this;
        $self['includeMuted'] = $includeMuted;

        return $self;
    }

    /**
     * Provide an ISO datetime string to only retrieve chats with last activity after this time.
     */
    public function withLastActivityAfter(
        \DateTimeInterface $lastActivityAfter
    ): self {
        $self = clone $this;
        $self['lastActivityAfter'] = $lastActivityAfter;

        return $self;
    }

    /**
     * Provide an ISO datetime string to only retrieve chats with last activity before this time.
     */
    public function withLastActivityBefore(
        \DateTimeInterface $lastActivityBefore
    ): self {
        $self = clone $this;
        $self['lastActivityBefore'] = $lastActivityBefore;

        return $self;
    }

    /**
     * Set the maximum number of chats to retrieve. Valid range: 1-200, default is 50.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Literal token search (non-semantic). Use single words users type (e.g., "dinner"). When multiple words provided, ALL must match. Case-insensitive.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * Search scope: 'titles' matches title + network; 'participants' matches participant names.
     *
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }

    /**
     * Specify the type of chats to retrieve: use "single" for direct messages, "group" for group chats, or "any" to get all types.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Set to true to only retrieve chats that have unread messages.
     */
    public function withUnreadOnly(?bool $unreadOnly): self
    {
        $self = clone $this;
        $self['unreadOnly'] = $unreadOnly;

        return $self;
    }
}
