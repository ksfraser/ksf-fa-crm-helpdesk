<?php

declare(strict_types=1);

namespace Ksfraser\FrontAccounting\CRM\Helpdesk\App;

use ksfraser\FrontAccounting\Common\App\AbstractAppShell;
use ksfraser\FrontAccounting\Common\Menu\FAModuleMenu;
use Ksfraser\FrontAccounting\CRM\Helpdesk\Controller\HelpdeskTabController;

class HelpdeskAppShell extends AbstractAppShell
{
    public function __construct()
    {
        parent::__construct('helpdesk', 'index.php', 'view', 'helpdesk_cases');

        $this->add_module(_("Helpdesk"));

        $menu = new FAModuleMenu(
            'modules/ksf_FA_CRM_Helpdesk/index.php',
            'view',
            ''
        );

        $menu->addItem('helpdesk_cases', _("Helpdesk Cases"), MENU_INQUIRY)
             ->registerWithApp($this, 'SA_HELPDESK_VIEW');

        $this->add_extensions();
    }
}
