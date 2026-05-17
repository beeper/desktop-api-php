<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSessions\Steps\StepSubmitParams;

/**
 * How the step was completed. Omit unless the client needs to distinguish an embedded webview or browser extension.
 */
enum Source: string
{
    case API = 'api';

    case WEBVIEW = 'webview';

    case BROWSER_EXTENSION = 'browser_extension';
}
