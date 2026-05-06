<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat\Capabilities\DisappearingTimer;

enum Type: string
{
    case AFTER_READ = 'afterRead';

    case AFTER_SEND = 'afterSend';
}
