<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember2;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember2\Cookies\Field;

/**
 * Parameters for the cookie login step.
 *
 * @phpstan-import-type FieldShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember2\Cookies\Field
 *
 * @phpstan-type CookiesShape = array{
 *   fields: list<Field|FieldShape>,
 *   url: string,
 *   extractJs?: string|null,
 *   userAgent?: string|null,
 *   waitForURLPattern?: string|null,
 * }
 */
final class Cookies implements BaseModel
{
    /** @use SdkModel<CookiesShape> */
    use SdkModel;

    /**
     * The list of cookies or other stored data that must be extracted.
     *
     * @var list<Field> $fields
     */
    #[Required(list: Field::class)]
    public array $fields;

    /**
     * The URL to open when using a webview to extract cookies.
     */
    #[Required]
    public string $url;

    /**
     * A JavaScript snippet that can extract some or all of the fields.
     * The snippet will evaluate to a promise that resolves when the relevant fields are found.
     * Fields that are not present in the promise result must be extracted another way.
     */
    #[Optional('extract_js')]
    public ?string $extractJs;

    /**
     * An optional user agent that the webview should use.
     */
    #[Optional('user_agent')]
    public ?string $userAgent;

    /**
     * A regex pattern that the URL should match before the client closes the webview.
     *
     * The client may submit the login if the user closes the webview after all cookies are collected
     * even if this URL is not reached, but it should only automatically close the webview after
     * both cookies and the URL match.
     */
    #[Optional('wait_for_url_pattern')]
    public ?string $waitForURLPattern;

    /**
     * `new Cookies()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Cookies::with(fields: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Cookies)->withFields(...)->withURL(...)
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
     * @param list<Field|FieldShape> $fields
     */
    public static function with(
        array $fields,
        string $url,
        ?string $extractJs = null,
        ?string $userAgent = null,
        ?string $waitForURLPattern = null,
    ): self {
        $self = new self;

        $self['fields'] = $fields;
        $self['url'] = $url;

        null !== $extractJs && $self['extractJs'] = $extractJs;
        null !== $userAgent && $self['userAgent'] = $userAgent;
        null !== $waitForURLPattern && $self['waitForURLPattern'] = $waitForURLPattern;

        return $self;
    }

    /**
     * The list of cookies or other stored data that must be extracted.
     *
     * @param list<Field|FieldShape> $fields
     */
    public function withFields(array $fields): self
    {
        $self = clone $this;
        $self['fields'] = $fields;

        return $self;
    }

    /**
     * The URL to open when using a webview to extract cookies.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * A JavaScript snippet that can extract some or all of the fields.
     * The snippet will evaluate to a promise that resolves when the relevant fields are found.
     * Fields that are not present in the promise result must be extracted another way.
     */
    public function withExtractJs(string $extractJs): self
    {
        $self = clone $this;
        $self['extractJs'] = $extractJs;

        return $self;
    }

    /**
     * An optional user agent that the webview should use.
     */
    public function withUserAgent(string $userAgent): self
    {
        $self = clone $this;
        $self['userAgent'] = $userAgent;

        return $self;
    }

    /**
     * A regex pattern that the URL should match before the client closes the webview.
     *
     * The client may submit the login if the user closes the webview after all cookies are collected
     * even if this URL is not reached, but it should only automatically close the webview after
     * both cookies and the URL match.
     */
    public function withWaitForURLPattern(string $waitForURLPattern): self
    {
        $self = clone $this;
        $self['waitForURLPattern'] = $waitForURLPattern;

        return $self;
    }
}
