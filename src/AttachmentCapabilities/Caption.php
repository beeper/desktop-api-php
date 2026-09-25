<?php

declare(strict_types=1);

namespace BeeperDesktop\AttachmentCapabilities;

/**
 * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
 */
enum Caption: int
{
    case MINUS2 = -2;

    case MINUS1 = -1;

    case _0 = 0;

    case _1 = 1;

    case _2 = 2;
}
