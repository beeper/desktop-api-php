<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms\RoomCreateParams;

/**
 * Convenience parameter for setting various default state events
 * based on a preset.
 *
 * If unspecified, the server should use the `visibility` to determine
 * which preset to use. A visibility of `public` equates to a preset of
 * `public_chat` and `private` visibility equates to a preset of
 * `private_chat`.
 */
enum Preset: string
{
    case PRIVATE_CHAT = 'private_chat';

    case PUBLIC_CHAT = 'public_chat';

    case TRUSTED_PRIVATE_CHAT = 'trusted_private_chat';
}
