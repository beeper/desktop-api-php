<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\LoginRegisterResponse\DesktopAPI;

/**
 * Access token type.
 */
enum TokenType: string
{
    case BEARER = 'Bearer';
}
