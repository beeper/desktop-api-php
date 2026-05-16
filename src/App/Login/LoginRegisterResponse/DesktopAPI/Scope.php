<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\LoginRegisterResponse\DesktopAPI;

/**
 * Granted Desktop API scopes.
 */
enum Scope: string
{
    case READ_WRITE = 'read write';
}
