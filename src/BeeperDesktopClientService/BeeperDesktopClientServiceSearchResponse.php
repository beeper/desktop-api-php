<?php

declare(strict_types=1);

namespace BeeperDesktop\BeeperDesktopClientService;

use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse\Results;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ResultsShape from \BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse\Results
 *
 * @phpstan-type BeeperDesktopClientServiceSearchResponseShape = array{
 *   results: Results|ResultsShape
 * }
 */
final class BeeperDesktopClientServiceSearchResponse implements BaseModel
{
    /** @use SdkModel<BeeperDesktopClientServiceSearchResponseShape> */
    use SdkModel;

    #[Required]
    public Results $results;

    /**
     * `new BeeperDesktopClientServiceSearchResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BeeperDesktopClientServiceSearchResponse::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BeeperDesktopClientServiceSearchResponse)->withResults(...)
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
     * @param Results|ResultsShape $results
     */
    public static function with(Results|array $results): self
    {
        $self = new self;

        $self['results'] = $results;

        return $self;
    }

    /**
     * @param Results|ResultsShape $results
     */
    public function withResults(Results|array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
