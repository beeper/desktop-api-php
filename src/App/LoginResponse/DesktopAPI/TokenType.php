<?php

declare(strict_types=1);

namespace BeeperDesktop\App\LoginResponse\DesktopAPI;

/**
 * Access token type.
 */
enum TokenType: string
{
    case BEARER = 'Bearer';
}
