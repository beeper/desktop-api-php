<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login;

use BeeperDesktop\App\Login\LoginResponseResponse\AppSetupCompleteResponse;
use BeeperDesktop\App\Login\LoginResponseResponse\AppSetupRegistrationRequiredResponse;
use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type AppSetupCompleteResponseShape from \BeeperDesktop\App\Login\LoginResponseResponse\AppSetupCompleteResponse
 * @phpstan-import-type AppSetupRegistrationRequiredResponseShape from \BeeperDesktop\App\Login\LoginResponseResponse\AppSetupRegistrationRequiredResponse
 *
 * @phpstan-type LoginResponseResponseVariants = AppSetupCompleteResponse|AppSetupRegistrationRequiredResponse
 * @phpstan-type LoginResponseResponseShape = LoginResponseResponseVariants|AppSetupCompleteResponseShape|AppSetupRegistrationRequiredResponseShape
 */
final class LoginResponseResponse implements ConverterSource
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
