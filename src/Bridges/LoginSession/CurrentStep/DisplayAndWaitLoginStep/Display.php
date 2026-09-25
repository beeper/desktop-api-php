<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep;

use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\CodeLoginDisplay;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\EmojiLoginDisplay;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\EmptyLoginDisplay;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\QRCodeLoginDisplay;
use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type QRCodeLoginDisplayShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\QRCodeLoginDisplay
 * @phpstan-import-type EmojiLoginDisplayShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\EmojiLoginDisplay
 * @phpstan-import-type CodeLoginDisplayShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\CodeLoginDisplay
 * @phpstan-import-type EmptyLoginDisplayShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display\EmptyLoginDisplay
 *
 * @phpstan-type DisplayVariants = QRCodeLoginDisplay|EmojiLoginDisplay|CodeLoginDisplay|EmptyLoginDisplay
 * @phpstan-type DisplayShape = DisplayVariants|QRCodeLoginDisplayShape|EmojiLoginDisplayShape|CodeLoginDisplayShape|EmptyLoginDisplayShape
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
            QRCodeLoginDisplay::class,
            EmojiLoginDisplay::class,
            CodeLoginDisplay::class,
            EmptyLoginDisplay::class,
        ];
    }
}
