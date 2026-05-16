<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms\RoomCreateParams;

/**
 * The room's visibility in the server's
 * [published room directory](https://spec.matrix.org/v1.18/client-server-api#published-room-directory).
 * Defaults to `private`.
 */
enum Visibility: string
{
    case PUBLIC = 'public';

    case PRIVATE = 'private';
}
