<?php

namespace BeeperDesktop;

use BeeperDesktop\Core\Conversion;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkPage;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Core\Contracts\BasePage;
use BeeperDesktop\Core\Conversion\ListOf;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;
use Psr\Http\Message\ResponseInterface;

/**
  *
  * @phpstan-type CursorNoLimitShape = array{
  *   items?: list<array<string,mixed>>|null,
  *   hasMore?: bool|null,
  *   oldestCursor?: string|null,
  *   newestCursor?: string|null,
  * }
  * @template TItem
  * @implements BasePage<TItem>
  *
 */
final class CursorNoLimit implements BaseModel, BasePage
{
  /** @use SdkModel<CursorNoLimitShape> */
  use SdkModel;

  /** @use SdkPage<TItem> */
  use SdkPage;

  /** @var list<TItem>|null $items */
  #[Optional(list: 'mixed')]
  public ?array $items;

  /** @var bool|null $hasMore */
  #[Optional]
  public ?bool $hasMore;

  /** @var string|null $oldestCursor */
  #[Optional(nullable: true)]
  public ?string $oldestCursor;

  /** @var string|null $newestCursor */
  #[Optional(nullable: true)]
  public ?string $newestCursor;

  /** @return list<TItem> */
  function getItems(): array {
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
  *     headers: array<string,string|null|list<string>>,
  *     body: mixed,
  *   },
  *   RequestOptions,
  * }|null
 */
  function nextRequest(): ?array {
    if (!($this->hasMore ?? null)||!count($this->getItems())) {
      return null;

    }

    if (!($prev = $this->newestCursor ?? null)&&!($next = $this
      ->oldestCursor ?? null)) {
      return null;

    }

    $nextRequest = array_merge_recursive(
      $this->requestInfo,
      ['query' => empty($prev) ? ['cursor' => $next] : [=> $prev]],
    );

    // @phpstan-ignore-next-line return.type
    return [$nextRequest, $this->options];
  }

  /**
  * @internal
  *
  * @param string|Converter|ConverterSource $convert
  * @param Client $client
  * @param array{
  *   method: string,
  *   path: string,
  *   query: array<string,mixed>,
  *   headers: array<string,string|null|list<string>>,
  *   body: mixed,
  * } $requestInfo
  * @param RequestOptions $options
  * @param mixed $parsedBody
 */
  function __construct(
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
}