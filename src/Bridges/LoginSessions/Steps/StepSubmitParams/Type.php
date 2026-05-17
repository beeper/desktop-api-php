<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSessions\Steps\StepSubmitParams;

enum Type: string
{
    case USER_INPUT = 'user_input';

    case COOKIES = 'cookies';

    case DISPLAY_AND_WAIT = 'display_and_wait';
}
