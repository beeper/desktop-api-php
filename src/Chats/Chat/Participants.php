<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat;

use BeeperDesktop\Chats\Chat\Participants\Item;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Chat participants information.
 *
 * @phpstan-import-type ItemShape from \BeeperDesktop\Chats\Chat\Participants\Item
 *
 * @phpstan-type ParticipantsShape = array{
 *   hasMore: bool, items: list<Item|ItemShape>, total: int
 * }
 */
final class Participants implements BaseModel
{
    /** @use SdkModel<ParticipantsShape> */
    use SdkModel;

    /**
     * True if there are more participants than included in items.
     */
    #[Required]
    public bool $hasMore;

    /**
     * Participants returned for this chat (limited by the request; may be a subset).
     *
     * @var list<Item> $items
     */
    #[Required(list: Item::class)]
    public array $items;

    /**
     * Total number of participants in the chat.
     */
    #[Required]
    public int $total;

    /**
     * `new Participants()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Participants::with(hasMore: ..., items: ..., total: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Participants)->withHasMore(...)->withItems(...)->withTotal(...)
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
     * @param list<Item|ItemShape> $items
     */
    public static function with(bool $hasMore, array $items, int $total): self
    {
        $self = new self;

        $self['hasMore'] = $hasMore;
        $self['items'] = $items;
        $self['total'] = $total;

        return $self;
    }

    /**
     * True if there are more participants than included in items.
     */
    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    /**
     * Participants returned for this chat (limited by the request; may be a subset).
     *
     * @param list<Item|ItemShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * Total number of participants in the chat.
     */
    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }
}
