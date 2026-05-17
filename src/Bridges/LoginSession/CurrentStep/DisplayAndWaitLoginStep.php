<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep;

use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\EmojiLoginDisplay;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\EmptyLoginDisplay;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\QrCodeLoginDisplay;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DisplayVariants from \BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display
 * @phpstan-import-type DisplayShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display
 *
 * @phpstan-type DisplayAndWaitLoginStepShape = array{
 *   display: DisplayShape,
 *   stepID: string,
 *   type: 'display_and_wait',
 *   instructions?: string|null,
 * }
 */
final class DisplayAndWaitLoginStep implements BaseModel
{
    /** @use SdkModel<DisplayAndWaitLoginStepShape> */
    use SdkModel;

    /** @var 'display_and_wait' $type */
    #[Required]
    public string $type = 'display_and_wait';

    /** @var DisplayVariants $display */
    #[Required]
    public QrCodeLoginDisplay|EmojiLoginDisplay|EmptyLoginDisplay $display;

    #[Required]
    public string $stepID;

    /**
     * User-facing instructions for this step.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * `new DisplayAndWaitLoginStep()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DisplayAndWaitLoginStep::with(display: ..., stepID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DisplayAndWaitLoginStep)->withDisplay(...)->withStepID(...)
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
     * @param DisplayShape $display
     */
    public static function with(
        QrCodeLoginDisplay|array|EmojiLoginDisplay|EmptyLoginDisplay $display,
        string $stepID,
        ?string $instructions = null,
    ): self {
        $self = new self;

        $self['display'] = $display;
        $self['stepID'] = $stepID;

        null !== $instructions && $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * @param DisplayShape $display
     */
    public function withDisplay(
        QrCodeLoginDisplay|array|EmojiLoginDisplay|EmptyLoginDisplay $display
    ): self {
        $self = clone $this;
        $self['display'] = $display;

        return $self;
    }

    public function withStepID(string $stepID): self
    {
        $self = clone $this;
        $self['stepID'] = $stepID;

        return $self;
    }

    /**
     * @param 'display_and_wait' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * User-facing instructions for this step.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }
}
