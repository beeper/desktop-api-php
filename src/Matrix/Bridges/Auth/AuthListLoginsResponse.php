<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type AuthListLoginsResponseShape = array{loginIDs?: list<string>|null}
 */
final class AuthListLoginsResponse implements BaseModel
{
    /** @use SdkModel<AuthListLoginsResponseShape> */
    use SdkModel;

    /** @var list<string>|null $loginIDs */
    #[Optional('login_ids', list: 'string')]
    public ?array $loginIDs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $loginIDs
     */
    public static function with(?array $loginIDs = null): self
    {
        $self = new self;

        null !== $loginIDs && $self['loginIDs'] = $loginIDs;

        return $self;
    }

    /**
     * @param list<string> $loginIDs
     */
    public function withLoginIDs(array $loginIDs): self
    {
        $self = clone $this;
        $self['loginIDs'] = $loginIDs;

        return $self;
    }
}
