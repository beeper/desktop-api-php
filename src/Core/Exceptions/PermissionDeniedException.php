<?php

namespace BeeperDesktop\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Permission Denied Exception';
}
