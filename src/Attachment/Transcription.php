<?php

declare(strict_types=1);

namespace BeeperDesktop\Attachment;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Attachment transcription if available.
 *
 * @phpstan-type TranscriptionShape = array{
 *   engine: string, transcription: string, language?: string|null
 * }
 */
final class Transcription implements BaseModel
{
    /** @use SdkModel<TranscriptionShape> */
    use SdkModel;

    /**
     * Transcription engine.
     */
    #[Required]
    public string $engine;

    /**
     * Transcribed text.
     */
    #[Required]
    public string $transcription;

    /**
     * Detected or selected language.
     */
    #[Optional]
    public ?string $language;

    /**
     * `new Transcription()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Transcription::with(engine: ..., transcription: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Transcription)->withEngine(...)->withTranscription(...)
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
    public static function with(
        string $engine,
        string $transcription,
        ?string $language = null
    ): self {
        $self = new self;

        $self['engine'] = $engine;
        $self['transcription'] = $transcription;

        null !== $language && $self['language'] = $language;

        return $self;
    }

    /**
     * Transcription engine.
     */
    public function withEngine(string $engine): self
    {
        $self = clone $this;
        $self['engine'] = $engine;

        return $self;
    }

    /**
     * Transcribed text.
     */
    public function withTranscription(string $transcription): self
    {
        $self = clone $this;
        $self['transcription'] = $transcription;

        return $self;
    }

    /**
     * Detected or selected language.
     */
    public function withLanguage(string $language): self
    {
        $self = clone $this;
        $self['language'] = $language;

        return $self;
    }
}
