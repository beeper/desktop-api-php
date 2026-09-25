<?php

declare(strict_types=1);

namespace BeeperDesktop\App;

use BeeperDesktop\App\SetupResponseOutput\AppSetupCompleteResponse;
use BeeperDesktop\App\SetupResponseOutput\AppSetupRegistrationRequiredResponse;
use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type AppSetupCompleteResponseShape from \BeeperDesktop\App\SetupResponseOutput\AppSetupCompleteResponse
 * @phpstan-import-type AppSetupRegistrationRequiredResponseShape from \BeeperDesktop\App\SetupResponseOutput\AppSetupRegistrationRequiredResponse
 *
 * @phpstan-type SetupResponseOutputVariants = AppSetupCompleteResponse|AppSetupRegistrationRequiredResponse
 * @phpstan-type SetupResponseOutputShape = SetupResponseOutputVariants|AppSetupCompleteResponseShape|AppSetupRegistrationRequiredResponseShape
 */
final class SetupResponseOutput implements ConverterSource
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
