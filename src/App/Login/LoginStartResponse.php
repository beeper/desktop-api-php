<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type LoginStartResponseShape = array{
 *   request: string, type: list<string>
 * }
 */
final class LoginStartResponse implements BaseModel
{
    /** @use SdkModel<LoginStartResponseShape> */
    use SdkModel;

    /**
     * Login request ID to use in the next sign-in step.
     */
    #[Required]
    public string $request;

    /**
     * Available sign-in methods for this request.
     *
     * @var list<string> $type
     */
    #[Required(list: 'string')]
    public array $type;

    /**
     * `new LoginStartResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginStartResponse::with(request: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginStartResponse)->withRequest(...)->withType(...)
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
     * @param list<string> $type
     */
    public static function with(string $request, array $type): self
    {
        $self = new self;

        $self['request'] = $request;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Login request ID to use in the next sign-in step.
     */
    public function withRequest(string $request): self
    {
        $self = clone $this;
        $self['request'] = $request;

        return $self;
    }

    /**
     * Available sign-in methods for this request.
     *
     * @param list<string> $type
     */
    public function withType(array $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
