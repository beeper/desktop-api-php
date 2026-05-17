<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type EmptyLoginDisplayShape = array{type: 'nothing'}
 */
final class EmptyLoginDisplay implements BaseModel
{
    /** @use SdkModel<EmptyLoginDisplayShape> */
    use SdkModel;

    /** @var 'nothing' $type */
    #[Required]
    public string $type = 'nothing';

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }

    /**
     * @param 'nothing' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
