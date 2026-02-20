<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts\Contacts;

use BeeperDesktop\Accounts\Contacts\ContactListParams\Direction;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * List merged contacts for a specific account with cursor-based pagination.
 *
 * @see BeeperDesktop\Services\Accounts\ContactsService::list()
 *
 * @phpstan-type ContactListParamsShape = array{
 *   cursor?: string|null,
 *   direction?: null|Direction|value-of<Direction>,
 *   limit?: int|null,
 *   query?: string|null,
 * }
 */
final class ContactListParams implements BaseModel
{
    /** @use SdkModel<ContactListParamsShape> */
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

    /**
     * Maximum contacts to return per page.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Optional search query for blended contact lookup.
     */
    #[Optional]
    public ?string $query;

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
        Direction|string|null $direction = null,
        ?int $limit = null,
        ?string $query = null,
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $direction && $self['direction'] = $direction;
        null !== $limit && $self['limit'] = $limit;
        null !== $query && $self['query'] = $query;

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

    /**
     * Maximum contacts to return per page.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Optional search query for blended contact lookup.
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
