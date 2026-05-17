<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession;

use BeeperDesktop\Bridges\LoginSession\CurrentStep\CompleteLoginStep;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\CookiesLoginStep;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\UserInputLoginStep;
use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Step the client should show or complete next. Omitted when the session is complete, cancelled, or failed.
 *
 * @phpstan-import-type UserInputLoginStepShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\UserInputLoginStep
 * @phpstan-import-type CookiesLoginStepShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\CookiesLoginStep
 * @phpstan-import-type DisplayAndWaitLoginStepShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep
 * @phpstan-import-type CompleteLoginStepShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\CompleteLoginStep
 *
 * @phpstan-type CurrentStepVariants = UserInputLoginStep|CookiesLoginStep|DisplayAndWaitLoginStep|CompleteLoginStep
 * @phpstan-type CurrentStepShape = CurrentStepVariants|UserInputLoginStepShape|CookiesLoginStepShape|DisplayAndWaitLoginStepShape|CompleteLoginStepShape
 */
final class CurrentStep implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            UserInputLoginStep::class,
            CookiesLoginStep::class,
            DisplayAndWaitLoginStep::class,
            CompleteLoginStep::class,
        ];
    }
}
