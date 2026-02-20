<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Returns matching chats, participant name matches in groups, and the first page of messages in one call. Paginate messages via search-messages. Paginate chats via search-chats.
 *
 * @see BeeperDesktop\Services\BeeperDesktopClientService::search()
 *
 * @phpstan-type BeeperDesktopSearchParamsShape = array{query: string}
 */
final class BeeperDesktopSearchParams implements BaseModel
{
    /** @use SdkModel<BeeperDesktopSearchParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * User-typed search text. Literal word matching (non-semantic).
     */
    #[Required]
    public string $query;

    /**
     * `new BeeperDesktopSearchParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BeeperDesktopSearchParams::with(query: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BeeperDesktopSearchParams)->withQuery(...)
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
     */
    public static function with(string $query): self
    {
        $self = new self;

        $self['query'] = $query;

        return $self;
    }

    /**
     * User-typed search text. Literal word matching (non-semantic).
     */
    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }
}
