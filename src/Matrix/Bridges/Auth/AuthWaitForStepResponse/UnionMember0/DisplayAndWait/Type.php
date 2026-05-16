<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember0\DisplayAndWait;

/**
 * The type of thing to display.
 */
enum Type: string
{
    case QR = 'qr';

    case EMOJI = 'emoji';

    case CODE = 'code';

    case NOTHING = 'nothing';
}
