<?php

declare(strict_types=1);

namespace Ksfraser\FrontAccounting\CRM\Helpdesk\App;

use ksfraser\FrontAccounting\Common\App\AbstractFrontController;

class HelpdeskFrontController extends AbstractFrontController
{
    public function __construct(
        HelpdeskAppShell $appShell,
        string $fallbackSecurityArea,
        string $path_to_root
    ) {
        parent::__construct($appShell, $fallbackSecurityArea, $path_to_root);
    }
}
