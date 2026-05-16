<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms\State\StateRetrieveParams;

/**
 * The format to use for the returned data. `content` (the default) will
 * return only the content of the state event. `event` will return the entire
 * event in the usual format suitable for clients, including fields like event
 * ID, sender and timestamp.
 */
enum Format: string
{
    case CONTENT = 'content';

    case EVENT = 'event';
}
