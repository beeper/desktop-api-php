<?php

declare(strict_types=1);

namespace BeeperDesktop\Labels;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * A user-created label that organizes chats across accounts.
 *
 * @phpstan-type LabelShape = array{id: string, name: string}
 */
final class Label implements BaseModel
{
    /** @use SdkModel<LabelShape> */
    use SdkModel;

    /**
     * Unique identifier of the label.
     */
    #[Required]
    public string $id;

    /**
     * Display name of the label.
     */
    #[Required]
    public string $name;

    /**
     * `new Label()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Label::with(id: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Label)->withID(...)->withName(...)
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
    public static function with(string $id, string $name): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Unique identifier of the label.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Display name of the label.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
