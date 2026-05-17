<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep;

use BeeperDesktop\Bridges\CookieField;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CookieFieldShape from \BeeperDesktop\Bridges\CookieField
 *
 * @phpstan-type CookiesLoginStepShape = array{
 *   fields: list<CookieField|CookieFieldShape>,
 *   stepID: string,
 *   type: 'cookies',
 *   url: string,
 *   expectedFinalURLRegex?: string|null,
 *   extractJs?: string|null,
 *   instructions?: string|null,
 *   userAgent?: string|null,
 * }
 */
final class CookiesLoginStep implements BaseModel
{
    /** @use SdkModel<CookiesLoginStepShape> */
    use SdkModel;

    /** @var 'cookies' $type */
    #[Required]
    public string $type = 'cookies';

    /** @var list<CookieField> $fields */
    #[Required(list: CookieField::class)]
    public array $fields;

    #[Required]
    public string $stepID;

    /**
     * URL to open for the user.
     */
    #[Required]
    public string $url;

    /**
     * Regular expression that identifies the final URL after sign-in.
     */
    #[Optional]
    public ?string $expectedFinalURLRegex;

    /**
     * Optional extraction script for browser-based sign-in helpers. Treat as an opaque helper value.
     */
    #[Optional('extractJS')]
    public ?string $extractJs;

    /**
     * User-facing instructions for this browser step.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * Suggested user agent for the browser session.
     */
    #[Optional]
    public ?string $userAgent;

    /**
     * `new CookiesLoginStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CookiesLoginStep::with(fields: ..., stepID: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CookiesLoginStep)->withFields(...)->withStepID(...)->withURL(...)
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
     * @param list<CookieField|CookieFieldShape> $fields
     */
    public static function with(
        array $fields,
        string $stepID,
        string $url,
        ?string $expectedFinalURLRegex = null,
        ?string $extractJs = null,
        ?string $instructions = null,
        ?string $userAgent = null,
    ): self {
        $self = new self;

        $self['fields'] = $fields;
        $self['stepID'] = $stepID;
        $self['url'] = $url;

        null !== $expectedFinalURLRegex && $self['expectedFinalURLRegex'] = $expectedFinalURLRegex;
        null !== $extractJs && $self['extractJs'] = $extractJs;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $userAgent && $self['userAgent'] = $userAgent;

        return $self;
    }

    /**
     * @param list<CookieField|CookieFieldShape> $fields
     */
    public function withFields(array $fields): self
    {
        $self = clone $this;
        $self['fields'] = $fields;

        return $self;
    }

    public function withStepID(string $stepID): self
    {
        $self = clone $this;
        $self['stepID'] = $stepID;

        return $self;
    }

    /**
     * @param 'cookies' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * URL to open for the user.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Regular expression that identifies the final URL after sign-in.
     */
    public function withExpectedFinalURLRegex(
        string $expectedFinalURLRegex
    ): self {
        $self = clone $this;
        $self['expectedFinalURLRegex'] = $expectedFinalURLRegex;

        return $self;
    }

    /**
     * Optional extraction script for browser-based sign-in helpers. Treat as an opaque helper value.
     */
    public function withExtractJs(string $extractJs): self
    {
        $self = clone $this;
        $self['extractJs'] = $extractJs;

        return $self;
    }

    /**
     * User-facing instructions for this browser step.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Suggested user agent for the browser session.
     */
    public function withUserAgent(string $userAgent): self
    {
        $self = clone $this;
        $self['userAgent'] = $userAgent;

        return $self;
    }
}
