<?php

namespace BeeperDesktop\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Internal Server Exception';
}
