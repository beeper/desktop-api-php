<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Setup;

use BeeperDesktop\App\Setup\SetupResponseResponse\AppSetupCompleteResponse;
use BeeperDesktop\App\Setup\SetupResponseResponse\AppSetupRegistrationRequiredResponse;
use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type AppSetupCompleteResponseShape from \BeeperDesktop\App\Setup\SetupResponseResponse\AppSetupCompleteResponse
 * @phpstan-import-type AppSetupRegistrationRequiredResponseShape from \BeeperDesktop\App\Setup\SetupResponseResponse\AppSetupRegistrationRequiredResponse
 *
 * @phpstan-type SetupResponseResponseVariants = AppSetupCompleteResponse|AppSetupRegistrationRequiredResponse
 * @phpstan-type SetupResponseResponseShape = SetupResponseResponseVariants|AppSetupCompleteResponseShape|AppSetupRegistrationRequiredResponseShape
 */
final class SetupResponseResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            AppSetupCompleteResponse::class,
            AppSetupRegistrationRequiredResponse::class,
        ];
    }
}
