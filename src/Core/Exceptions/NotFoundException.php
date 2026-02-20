<?php

namespace BeeperDesktop\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Not Found Exception';
}
