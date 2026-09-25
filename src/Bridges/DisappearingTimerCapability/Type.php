<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\DisappearingTimerCapability;

enum Type: string
{
    case EMPTY = '';

    case AFTER_READ = 'after_read';

    case AFTER_READ_BY_RECIPIENT = 'after_read_by_recipient';

    case AFTER_SEND = 'after_send';
}
