<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\ChatListParams\Direction;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * List all chats sorted by last activity (most recent first). Combines all accounts into a single paginated list.
 *
 * @see BeeperDesktop\Services\ChatsService::list()
 *
 * @phpstan-type ChatListParamsShape = array{
 *   accountIDs?: list<string>|null,
 *   cursor?: string|null,
 *   direction?: null|Direction|value-of<Direction>,
 * }
 */
final class ChatListParams implements BaseModel
{
    /** @use SdkModel<ChatListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Limit to specific account IDs. If omitted, fetches from all accounts.
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
     */
    public static function with(
        ?array $accountIDs = null,
        ?string $cursor = null,
        Direction|string|null $direction = null,
    ): self {
        $self = new self;

        null !== $accountIDs && $self['accountIDs'] = $accountIDs;
        null !== $cursor && $self['cursor'] = $cursor;
        null !== $direction && $self['direction'] = $direction;

        return $self;
    }

    /**
     * Limit to specific account IDs. If omitted, fetches from all accounts.
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
}
