<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep;

use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\EmojiLoginDisplay;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\EmptyLoginDisplay;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\QrCodeLoginDisplay;
use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type QrCodeLoginDisplayShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\QrCodeLoginDisplay
 * @phpstan-import-type EmojiLoginDisplayShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\EmojiLoginDisplay
 * @phpstan-import-type EmptyLoginDisplayShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\EmptyLoginDisplay
 *
 * @phpstan-type DisplayVariants = QrCodeLoginDisplay|EmojiLoginDisplay|EmptyLoginDisplay
 * @phpstan-type DisplayShape = DisplayVariants|QrCodeLoginDisplayShape|EmojiLoginDisplayShape|EmptyLoginDisplayShape
 */
final class Display implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            QrCodeLoginDisplay::class,
            EmojiLoginDisplay::class,
            EmptyLoginDisplay::class,
        ];
    }
}
