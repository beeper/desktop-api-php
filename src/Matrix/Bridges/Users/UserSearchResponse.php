<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Users;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Users\UserSearchResponse\Result;

/**
 * @phpstan-import-type ResultShape from \BeeperDesktop\Matrix\Bridges\Users\UserSearchResponse\Result
 *
 * @phpstan-type UserSearchResponseShape = array{
 *   results?: list<Result|ResultShape>|null
 * }
 */
final class UserSearchResponse implements BaseModel
{
    /** @use SdkModel<UserSearchResponseShape> */
    use SdkModel;

    /** @var list<Result>|null $results */
    #[Optional(list: Result::class)]
    public ?array $results;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Result|ResultShape>|null $results
     */
    public static function with(?array $results = null): self
    {
        $self = new self;

        null !== $results && $self['results'] = $results;

        return $self;
    }

    /**
     * @param list<Result|ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
