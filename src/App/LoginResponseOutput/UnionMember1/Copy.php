<?php

declare(strict_types=1);

namespace BeeperDesktop\App\LoginResponseOutput\UnionMember1;

use BeeperDesktop\App\LoginResponseOutput\UnionMember1\Copy\Submit;
use BeeperDesktop\App\LoginResponseOutput\UnionMember1\Copy\Terms;
use BeeperDesktop\App\LoginResponseOutput\UnionMember1\Copy\Title;
use BeeperDesktop\App\LoginResponseOutput\UnionMember1\Copy\UsernamePlaceholder;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Copy to display during account creation.
 *
 * @phpstan-type CopyShape = array{
 *   submit: Submit|value-of<Submit>,
 *   terms: Terms|value-of<Terms>,
 *   title: Title|value-of<Title>,
 *   usernamePlaceholder: UsernamePlaceholder|value-of<UsernamePlaceholder>,
 * }
 */
final class Copy implements BaseModel
{
    /** @use SdkModel<CopyShape> */
    use SdkModel;

    /**
     * Submit button label.
     *
     * @var value-of<Submit> $submit
     */
    #[Required(enum: Submit::class)]
    public string $submit;

    /**
     * Terms and privacy notice to show before account creation.
     *
     * @var value-of<Terms> $terms
     */
    #[Required(enum: Terms::class)]
    public string $terms;

    /**
     * Title for the username step.
     *
     * @var value-of<Title> $title
     */
    #[Required(enum: Title::class)]
    public string $title;

    /**
     * Placeholder for the username field.
     *
     * @var value-of<UsernamePlaceholder> $usernamePlaceholder
     */
    #[Required(enum: UsernamePlaceholder::class)]
    public string $usernamePlaceholder;

    /**
     * `new Copy()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Copy::with(submit: ..., terms: ..., title: ..., usernamePlaceholder: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Copy)
     *   ->withSubmit(...)
     *   ->withTerms(...)
     *   ->withTitle(...)
     *   ->withUsernamePlaceholder(...)
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
     * @param Submit|value-of<Submit> $submit
     * @param Terms|value-of<Terms> $terms
     * @param Title|value-of<Title> $title
     * @param UsernamePlaceholder|value-of<UsernamePlaceholder> $usernamePlaceholder
     */
    public static function with(
        Submit|string $submit,
        Terms|string $terms,
        Title|string $title,
        UsernamePlaceholder|string $usernamePlaceholder,
    ): self {
        $self = new self;

        $self['submit'] = $submit;
        $self['terms'] = $terms;
        $self['title'] = $title;
        $self['usernamePlaceholder'] = $usernamePlaceholder;

        return $self;
    }

    /**
     * Submit button label.
     *
     * @param Submit|value-of<Submit> $submit
     */
    public function withSubmit(Submit|string $submit): self
    {
        $self = clone $this;
        $self['submit'] = $submit;

        return $self;
    }

    /**
     * Terms and privacy notice to show before account creation.
     *
     * @param Terms|value-of<Terms> $terms
     */
    public function withTerms(Terms|string $terms): self
    {
        $self = clone $this;
        $self['terms'] = $terms;

        return $self;
    }

    /**
     * Title for the username step.
     *
     * @param Title|value-of<Title> $title
     */
    public function withTitle(Title|string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Placeholder for the username field.
     *
     * @param UsernamePlaceholder|value-of<UsernamePlaceholder> $usernamePlaceholder
     */
    public function withUsernamePlaceholder(
        UsernamePlaceholder|string $usernamePlaceholder
    ): self {
        $self = clone $this;
        $self['usernamePlaceholder'] = $usernamePlaceholder;

        return $self;
    }
}
