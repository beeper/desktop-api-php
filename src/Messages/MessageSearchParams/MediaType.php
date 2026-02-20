<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages\MessageSearchParams;

enum MediaType: string
{
    case ANY = 'any';

    case VIDEO = 'video';

    case IMAGE = 'image';

    case LINK = 'link';

    case FILE = 'file';
}
