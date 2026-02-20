<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Messages\MessageListParams\Direction;

/**
 * List all messages in a chat with cursor-based pagination. Sorted by timestamp.
 *
 * @see BeeperDesktop\Services\MessagesService::list()
 *
 * @phpstan-type MessageListParamsShape = array{
 *   cursor?: string|null, direction?: null|Direction|value-of<Direction>
 * }
 */
final class MessageListParams implements BaseModel
{
    /** @use SdkModel<MessageListParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * @param Direction|value-of<Direction>|null $direction
     */
    public static function with(
        ?string $cursor = null,
        Direction|string|null $direction = null
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $direction && $self['direction'] = $direction;

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
