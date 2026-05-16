<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthListFlowsResponse\Flow;

/**
 * @phpstan-import-type FlowShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthListFlowsResponse\Flow
 *
 * @phpstan-type AuthListFlowsResponseShape = array{
 *   flows?: list<Flow|FlowShape>|null
 * }
 */
final class AuthListFlowsResponse implements BaseModel
{
    /** @use SdkModel<AuthListFlowsResponseShape> */
    use SdkModel;

    /** @var list<Flow>|null $flows */
    #[Optional(list: Flow::class)]
    public ?array $flows;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Flow|FlowShape>|null $flows
     */
    public static function with(?array $flows = null): self
    {
        $self = new self;

        null !== $flows && $self['flows'] = $flows;

        return $self;
    }

    /**
     * @param list<Flow|FlowShape> $flows
     */
    public function withFlows(array $flows): self
    {
        $self = clone $this;
        $self['flows'] = $flows;

        return $self;
    }
}
