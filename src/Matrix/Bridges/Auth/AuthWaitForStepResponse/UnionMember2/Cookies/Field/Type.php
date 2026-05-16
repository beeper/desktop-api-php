<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember2\Cookies\Field;

/**
 * The type of data to extract.
 */
enum Type: string
{
    case COOKIE = 'cookie';

    case LOCAL_STORAGE = 'local_storage';

    case REQUEST_HEADER = 'request_header';

    case REQUEST_BODY = 'request_body';

    case SPECIAL = 'special';
}
