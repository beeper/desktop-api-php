<?php

declare(strict_types=1);

namespace BeeperDesktop\Message;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Message\Link\ImgSize;

/**
 * Link preview included with a message.
 *
 * @phpstan-import-type ImgSizeShape from \BeeperDesktop\Message\Link\ImgSize
 *
 * @phpstan-type LinkShape = array{
 *   title: string,
 *   url: string,
 *   favicon?: string|null,
 *   img?: string|null,
 *   imgSize?: null|ImgSize|ImgSizeShape,
 *   originalURL?: string|null,
 *   summary?: string|null,
 * }
 */
final class Link implements BaseModel
{
    /** @use SdkModel<LinkShape> */
    use SdkModel;

    /**
     * Link preview title.
     */
    #[Required]
    public string $title;

    /**
     * Resolved link URL.
     */
    #[Required]
    public string $url;

    /**
     * Favicon URL if available. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    #[Optional]
    public ?string $favicon;

    /**
     * Preview image URL if available. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    #[Optional]
    public ?string $img;

    /**
     * Preview image dimensions.
     */
    #[Optional]
    public ?ImgSize $imgSize;

    /**
     * Original URL when the displayed URL is shortened or redirected.
     */
    #[Optional]
    public ?string $originalURL;

    /**
     * Link preview summary.
     */
    #[Optional]
    public ?string $summary;

    /**
     * `new Link()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Link::with(title: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Link)->withTitle(...)->withURL(...)
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
     * @param ImgSize|ImgSizeShape|null $imgSize
     */
    public static function with(
        string $title,
        string $url,
        ?string $favicon = null,
        ?string $img = null,
        ImgSize|array|null $imgSize = null,
        ?string $originalURL = null,
        ?string $summary = null,
    ): self {
        $self = new self;

        $self['title'] = $title;
        $self['url'] = $url;

        null !== $favicon && $self['favicon'] = $favicon;
        null !== $img && $self['img'] = $img;
        null !== $imgSize && $self['imgSize'] = $imgSize;
        null !== $originalURL && $self['originalURL'] = $originalURL;
        null !== $summary && $self['summary'] = $summary;

        return $self;
    }

    /**
     * Link preview title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Resolved link URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Favicon URL if available. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    public function withFavicon(string $favicon): self
    {
        $self = clone $this;
        $self['favicon'] = $favicon;

        return $self;
    }

    /**
     * Preview image URL if available. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    public function withImg(string $img): self
    {
        $self = clone $this;
        $self['img'] = $img;

        return $self;
    }

    /**
     * Preview image dimensions.
     *
     * @param ImgSize|ImgSizeShape $imgSize
     */
    public function withImgSize(ImgSize|array $imgSize): self
    {
        $self = clone $this;
        $self['imgSize'] = $imgSize;

        return $self;
    }

    /**
     * Original URL when the displayed URL is shortened or redirected.
     */
    public function withOriginalURL(string $originalURL): self
    {
        $self = clone $this;
        $self['originalURL'] = $originalURL;

        return $self;
    }

    /**
     * Link preview summary.
     */
    public function withSummary(string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
