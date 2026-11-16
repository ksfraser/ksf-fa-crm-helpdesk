<?php
declare(strict_types=1);

use Ksfraser\FrontAccounting\CRM\Helpdesk\Controller\HelpdeskTabController;

$path_to_root = '../..';

require_once($path_to_root . '/includes/session.inc');

if (!function_exists('page_security')) {
    define('page_security', 'SA_HELPDESK_VIEW');
}

$controller = new HelpdeskTabController(null, array());
$controller->render();
