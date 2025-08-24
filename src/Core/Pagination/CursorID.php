<?php

namespace BeeperDesktop\Core\Pagination;

use BeeperDesktop\Core\BaseClient;
use Psr\Http\Message\ResponseInterface;

/**
 * @template TItem
 *
 * @extends AbstractPage<TItem>
 */
final class CursorID extends AbstractPage
{
    /** @var list<TItem> */
    public array $data;

    public ?bool $hasMore;

    /** @param array{data?: list<TItem>, hasMore?: bool} $body */
    public function __construct(
        protected BaseClient $client,
        protected PageRequestOptions $options,
        protected ResponseInterface $response,
        protected mixed $body,
    ) {
        $this->data = $body['data'] ?? [];
        $this->hasMore = $body['hasMore'] ?? false;
    }

    public function nextPageRequestOptions(): ?PageRequestOptions
    {
        $itemId = $this->getPaginatedItems()[0] ?? null;
        if (!$itemId) {
            return null;
        }

        return $this->options->withQuery('starting_after', $itemId);
    }

    /** @return list<TItem> */
    public function getPaginatedItems(): array
    {
        return $this->data;
    }
}
