<?php

namespace BeeperDesktop;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkPage;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Core\Contracts\BasePage;
use BeeperDesktop\Core\Conversion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;
use BeeperDesktop\Core\Conversion\ListOf;
use BeeperDesktop\CursorSortKey\Item;
use Psr\Http\Message\ResponseInterface;

/**
 * @phpstan-type CursorSortKeyShape = array{
 *   items?: list<Item>|null, hasMore?: bool|null
 * }
 *
 * @template TItem
 *
 * @implements BasePage<TItem>
 */
final class CursorSortKey implements BaseModel, BasePage
{
    /** @use SdkModel<CursorSortKeyShape> */
    use SdkModel;

    /** @use SdkPage<TItem> */
    use SdkPage;

    /** @var list<TItem>|null $items */
    #[Optional(list: 'mixed')]
    public ?array $items;

    #[Optional]
    public ?bool $hasMore;

    /**
     * @internal
     *
     * @param array{
     *   method: string,
     *   path: string,
     *   query: array<string,mixed>,
     *   headers: array<string,string|list<string>|null>,
     *   body: mixed,
     * } $requestInfo
     */
    public function __construct(
        private string|Converter|ConverterSource $convert,
        private Client $client,
        private array $requestInfo,
        private RequestOptions $options,
        private ResponseInterface $response,
        private mixed $parsedBody,
    ) {
        $this->initialize();

        if (!is_array($this->parsedBody)) {
            return;
        }

        // @phpstan-ignore-next-line argument.type
        self::__unserialize($this->parsedBody);

        if (is_array($items = $this->offsetGet('items'))) {
            $parsed = Conversion::coerce(new ListOf($convert), value: $items);
            // @phpstan-ignore-next-line
            $this->offsetSet('items', value: $parsed);
        }
    }

    /** @return list<TItem> */
    public function getItems(): array
    {
        // @phpstan-ignore-next-line return.type
        return $this->offsetGet('items') ?? [];
    }

    /**
     * @internal
     *
     * @return array{
     *   array{
     *     method: string,
     *     path: string,
     *     query: array<string,mixed>,
     *     headers: array<string,string|list<string>|null>,
     *     body: mixed,
     *   },
     *   RequestOptions,
     * }|null
     */
    public function nextRequest(): ?array
    {
        $items = $this->getItems();
        if (!($this
            ->hasMore ?? null) || !count($items) || !($key = array_key_last($items))) {
            return null;
        }

        $nextRequest = array_merge_recursive(
            $this->requestInfo,
            ['query' => ['sortKey' => $items[$key]]]
        );

        // @phpstan-ignore-next-line return.type
        return [$nextRequest, $this->options];
    }
}
