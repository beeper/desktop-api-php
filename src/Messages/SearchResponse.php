<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class SearchResponse implements BaseModel
{
    use SdkModel;

    /**
     * Map of chatID -> chat details for chats referenced in data.
     *
     * @var array<string, Chat> $chats
     */
    #[Api(map: Chat::class)]
    public array $chats;

    /**
     * Messages matching the query and filters.
     *
     * @var list<Message> $data
     */
    #[Api(list: Message::class)]
    public array $data;

    /**
     * Whether there are more items available after this set.
     */
    #[Api('has_more')]
    public bool $hasMore;

    /**
     * `new SearchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SearchResponse::with(chats: ..., data: ..., hasMore: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SearchResponse)->withChats(...)->withData(...)->withHasMore(...)
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
     * @param array<string, Chat> $chats
     * @param list<Message> $data
     */
    public static function with(array $chats, array $data, bool $hasMore): self
    {
        $obj = new self;

        $obj->chats = $chats;
        $obj->data = $data;
        $obj->hasMore = $hasMore;

        return $obj;
    }

    /**
     * Map of chatID -> chat details for chats referenced in data.
     *
     * @param array<string, Chat> $chats
     */
    public function withChats(array $chats): self
    {
        $obj = clone $this;
        $obj->chats = $chats;

        return $obj;
    }

    /**
     * Messages matching the query and filters.
     *
     * @param list<Message> $data
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
