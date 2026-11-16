<?php
declare(strict_types=1);

if (!function_exists('hook_invoke_all')) {
    return;
}

function helpdesk_case_state_changed($caseId, $fromState, $toState, $meta = array()) {
    hook_invoke_all('HELPDESK_STATE_CHANGED', array(
        'case_id' => $caseId,
        'from_state' => $fromState,
        'to_state' => $toState,
        'meta' => $meta,
    ));
}
