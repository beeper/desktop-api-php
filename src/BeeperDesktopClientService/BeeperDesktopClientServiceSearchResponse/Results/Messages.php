<?php

declare(strict_types=1);

namespace BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse\Results;

use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Message;

/**
 * @phpstan-import-type ChatShape from \BeeperDesktop\Chats\Chat
 * @phpstan-import-type MessageShape from \BeeperDesktop\Message
 *
 * @phpstan-type MessagesShape = array{
 *   chats: array<string,Chat|ChatShape>,
 *   hasMore: bool,
 *   items: list<Message|MessageShape>,
 *   newestCursor: string|null,
 *   oldestCursor: string|null,
 * }
 */
final class Messages implements BaseModel
{
    /** @use SdkModel<MessagesShape> */
    use SdkModel;

    /**
     * Map of chatID -> chat details for chats referenced in items.
     *
     * @var array<string,Chat> $chats
     */
    #[Required(map: Chat::class)]
    public array $chats;

    /**
     * True if additional results can be fetched using the provided cursors.
     */
    #[Required]
    public bool $hasMore;

    /**
     * Messages matching the query and filters.
     *
     * @var list<Message> $items
     */
    #[Required(list: Message::class)]
    public array $items;

    /**
     * Cursor for fetching newer results (use with direction='after'). Opaque string; do not inspect.
     */
    #[Required]
    public ?string $newestCursor;

    /**
     * Cursor for fetching older results (use with direction='before'). Opaque string; do not inspect.
     */
    #[Required]
    public ?string $oldestCursor;

    /**
     * `new Messages()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Messages::with(
     *   chats: ..., hasMore: ..., items: ..., newestCursor: ..., oldestCursor: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Messages)
     *   ->withChats(...)
     *   ->withHasMore(...)
     *   ->withItems(...)
     *   ->withNewestCursor(...)
     *   ->withOldestCursor(...)
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
     * @param array<string,Chat|ChatShape> $chats
     * @param list<Message|MessageShape> $items
     */
    public static function with(
        array $chats,
        bool $hasMore,
        array $items,
        ?string $newestCursor,
        ?string $oldestCursor,
    ): self {
        $self = new self;

        $self['chats'] = $chats;
        $self['hasMore'] = $hasMore;
        $self['items'] = $items;
        $self['newestCursor'] = $newestCursor;
        $self['oldestCursor'] = $oldestCursor;

        return $self;
    }

    /**
     * Map of chatID -> chat details for chats referenced in items.
     *
     * @param array<string,Chat|ChatShape> $chats
     */
    public function withChats(array $chats): self
    {
        $self = clone $this;
        $self['chats'] = $chats;

        return $self;
    }

    /**
     * True if additional results can be fetched using the provided cursors.
     */
    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    /**
     * Messages matching the query and filters.
     *
     * @param list<Message|MessageShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * Cursor for fetching newer results (use with direction='after'). Opaque string; do not inspect.
     */
    public function withNewestCursor(?string $newestCursor): self
    {
        $self = clone $this;
        $self['newestCursor'] = $newestCursor;

        return $self;
    }

    /**
     * Cursor for fetching older results (use with direction='before'). Opaque string; do not inspect.
     */
    public function withOldestCursor(?string $oldestCursor): self
    {
        $self = clone $this;
        $self['oldestCursor'] = $oldestCursor;

        return $self;
    }
}
