<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class FindChatsResponse implements BaseModel
{
    use SdkModel;

    /**
     * Chats matching the filters.
     *
     * @var list<Chat> $data
     */
    #[Api(list: Chat::class)]
    public array $data;

    /**
     * Whether there are more items available after this set.
     */
    #[Api('has_more')]
    public bool $hasMore;

    /**
     * `new FindChatsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FindChatsResponse::with(data: ..., hasMore: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FindChatsResponse)->withData(...)->withHasMore(...)
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
     * @param list<Chat> $data
     */
    public static function with(array $data, bool $hasMore): self
    {
        $obj = new self;

        $obj->data = $data;
        $obj->hasMore = $hasMore;

        return $obj;
    }

    /**
     * Chats matching the filters.
     *
     * @param list<Chat> $data
     */
    public function withData(array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    /**
     * Whether there are more items available after this set.
     */
    public function withHasMore(bool $hasMore): self
    {
        $obj = clone $this;
        $obj->hasMore = $hasMore;

        return $obj;
    }
}
