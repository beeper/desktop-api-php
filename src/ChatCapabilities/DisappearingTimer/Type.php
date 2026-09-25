<?php

declare(strict_types=1);

namespace BeeperDesktop\ChatCapabilities\DisappearingTimer;

enum Type: string
{
    case AFTER_READ = 'afterRead';

    case AFTER_READ_BY_RECIPIENT = 'afterReadByRecipient';

    case AFTER_SEND = 'afterSend';
}
