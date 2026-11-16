<?php

declare(strict_types=1);

namespace Ksfraser\FrontAccounting\CRM\Helpdesk\App;

use ksfraser\FrontAccounting\Common\App\AbstractAppShell;
use ksfraser\FrontAccounting\Common\App\TabRegistration;

class HelpdeskAppShell extends AbstractAppShell
{
    public function __construct()
    {
        parent::__construct('helpdesk', 'index.php', 'view', 'helpdesk_cases');

        $this->registerTab(new TabRegistration(
            'helpdesk_cases',
            'Helpdesk Cases',
            'SA_HELPDESK_VIEW',
            null,
            10,
            0,
            null,
            null,
            array()
        ));
    }
}
