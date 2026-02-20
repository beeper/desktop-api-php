<?php

declare(strict_types=1);

namespace BeeperDesktop\Error\Details;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Error\Details\Issues\Issue;

/**
 * Validation error details.
 *
 * @phpstan-import-type IssueShape from \BeeperDesktop\Error\Details\Issues\Issue
 *
 * @phpstan-type IssuesShape = array{issues: list<Issue|IssueShape>}
 */
final class Issues implements BaseModel
{
    /** @use SdkModel<IssuesShape> */
    use SdkModel;

    /**
     * List of validation issues.
     *
     * @var list<Issue> $issues
     */
    #[Required(list: Issue::class)]
    public array $issues;

    /**
     * `new Issues()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Issues::with(issues: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Issues)->withIssues(...)
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
     * @param list<Issue|IssueShape> $issues
     */
    public static function with(array $issues): self
    {
        $self = new self;

        $self['issues'] = $issues;

        return $self;
    }

    /**
     * List of validation issues.
     *
     * @param list<Issue|IssueShape> $issues
     */
    public function withIssues(array $issues): self
    {
        $self = clone $this;
        $self['issues'] = $issues;

        return $self;
    }
}
