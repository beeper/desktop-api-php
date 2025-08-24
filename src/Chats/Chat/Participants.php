<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Shared\User;

/**
 * Chat participants information.
 */
final class Participants implements BaseModel
{
    use SdkModel;

    /**
     * True if there are more participants than included in items.
     */
    #[Api]
    public bool $hasMore;

    /**
     * Participants returned for this chat (limited by the request; may be a subset).
     *
     * @var list<User> $items
     */
    #[Api(list: User::class)]
    public array $items;

    /**
     * Total number of participants in the chat.
     */
    #[Api]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<User> $items
     */
    public static function with(bool $hasMore, array $items, int $total): self
    {
        $obj = new self;

        $obj->hasMore = $hasMore;
        $obj->items = $items;
        $obj->total = $total;

        return $obj;
    }

    /**
     * True if there are more participants than included in items.
     */
    public function withHasMore(bool $hasMore): self
    {
        $obj = clone $this;
        $obj->hasMore = $hasMore;

        return $obj;
    }

    /**
     * Participants returned for this chat (limited by the request; may be a subset).
     *
     * @param list<User> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }

    /**
     * Total number of participants in the chat.
     */
    public function withTotal(int $total): self
    {
        $obj = clone $this;
        $obj->total = $total;

        return $obj;
    }
}
