<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\CookieField;

/**
 * Browser storage source for this value.
 */
enum Type: string
{
    case COOKIE = 'cookie';

    case HEADER = 'header';

    case LOCAL_STORAGE = 'local_storage';
}
