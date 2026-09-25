<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginFlows;

use BeeperDesktop\Bridges\LoginFlow;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type LoginFlowShape from \BeeperDesktop\Bridges\LoginFlow
 *
 * @phpstan-type LoginFlowListResponseShape = array{
 *   items: list<LoginFlow|LoginFlowShape>
 * }
 */
final class LoginFlowListResponse implements BaseModel
{
    /** @use SdkModel<LoginFlowListResponseShape> */
    use SdkModel;

    /** @var list<LoginFlow> $items */
    #[Required(list: LoginFlow::class)]
    public array $items;

    /**
     * `new LoginFlowListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginFlowListResponse::with(items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginFlowListResponse)->withItems(...)
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
     * @param list<LoginFlow|LoginFlowShape> $items
     */
    public static function with(array $items): self
    {
        $self = new self;

        $self['items'] = $items;

        return $self;
    }

    /**
     * @param list<LoginFlow|LoginFlowShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
