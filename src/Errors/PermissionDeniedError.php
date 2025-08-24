<?php

namespace BeeperDesktop\Errors;

class PermissionDeniedError extends APIStatusError
{
    /** @var string */
    protected const DESC = 'BeeperDesktop Permission Denied Error';
}
