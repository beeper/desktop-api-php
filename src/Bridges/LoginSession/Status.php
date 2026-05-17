<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession;

enum Status: string
{
    case WAITING_FOR_INPUT = 'waiting_for_input';

    case WAITING_FOR_COOKIES = 'waiting_for_cookies';

    case WAITING_FOR_DISPLAY = 'waiting_for_display';

    case COMPLETE = 'complete';

    case CANCELLED = 'cancelled';

    case FAILED = 'failed';
}
