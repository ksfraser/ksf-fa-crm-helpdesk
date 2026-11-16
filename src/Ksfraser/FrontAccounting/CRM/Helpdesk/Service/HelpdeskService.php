<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Helpdesk\Service;
use Ksfraser\FrontAccounting\CRM\Helpdesk\DTO\HelpdeskDTO;
use Ksfraser\FrontAccounting\CRM\Helpdesk\Repository\HelpdeskRepository;
use ksfraser\RelatedTo\DTO\RelatedRecordDto;
final class HelpdeskService {
    private $repo;
    public function __construct(?HelpdeskRepository $repo = null) { $this->repo = $repo ?? new HelpdeskRepository(); }
    public function resolveById(int $id, ?RelatedRecordDto $dto = null): array {
        $row = $this->repo->findById($id);
        if ($row === null) {
            return array('dto' => new RelatedRecordDto('ksf_crm_helpdesk_case', '0', 'ksf_crm_helpdesk_case', '0', null), 'fields' => $this->fieldMap(), 'labels' => $this->labelMap(), 'url' => '#', 'label' => _('Helpdesk Case #') . (string) $id);
        }
        $r = HelpdeskDTO::fromArray($row);
        $dto = $dto ?? new RelatedRecordDto('ksf_crm_helpdesk_case', (string) $r->case_id, 'ksf_crm_helpdesk_case', (string) $r->case_id, null);
        return array(
            'dto' => $dto,
            'fields' => array(
                'case_id' => (string) $r->case_id,
                'title' => $r->title,
                'person_id' => $r->person_name,
                'assigned_to' => $r->assigned_name,
                'priority' => $r->priority,
                'status' => $r->status,
            ),
            'labels' => $this->labelMap(),
            'url' => '/modules/ksf_FA_CRM_Helpdesk/pages/helpdesk_case_form.php?action=edit&case_id=' . $r->case_id,
            'label' => $r->getDisplayLabel(),
        );
    }
    public function listAll(): array {
        $rows = $this->repo->findAll();
        $results = array();
        foreach ($rows as $row) {
            $r = HelpdeskDTO::fromArray($row);
            $results[] = array(
                'id' => $r->case_id,
                'dto' => new RelatedRecordDto('ksf_crm_helpdesk_case', (string) $r->case_id, 'ksf_crm_helpdesk_case', (string) $r->case_id, null),
                'fields' => array(
                    'case_id' => (string) $r->case_id,
                    'title' => $r->title,
                    'person_name' => $r->person_name,
                    'assigned_name' => $r->assigned_name,
                    'priority' => $r->priority,
                    'status' => $r->status,
                ),
                'labels' => $this->labelMap(),
                'url' => '/modules/ksf_FA_CRM_Helpdesk/pages/helpdesk_case_form.php?action=edit&case_id=' . $r->case_id,
                'label' => $r->getDisplayLabel(),
            );
        }
        return $results;
    }
    public function insertCase(array $data): int {
        return $this->repo->insertCase($data);
    }
    public function updateState(int $caseId, string $status, string $resolvedAt = null): void {
        $this->repo->updateState($caseId, $status, $resolvedAt);
        helpdesk_case_state_changed((string) $caseId, '', $status, array());
    }
    public function fieldMap(): array { return $this->labelMap(); }
    public function labelMap(): array {
        return array(
            'case_id' => _('Case ID'),
            'title' => _('Title'),
            'person_id' => _('Contact'),
            'assigned_to' => _('Assigned To'),
            'priority' => _('Priority'),
            'status' => _('Status'),
        );
    }
    public function getStateTransitions(string $currentState): array {
        $transitions = array(
            'open' => array('in_progress' => _('Start Work'), 'resolved' => _('Resolve'), 'closed' => _('Close')),
            'in_progress' => array('resolved' => _('Resolve'), 'closed' => _('Close')),
            'resolved' => array('closed' => _('Close')),
        );
        return isset($transitions[$currentState]) ? $transitions[$currentState] : array();
    }
    public function isAllowedTransition(string $fromState, string $toState): bool {
        $transitions = $this->getStateTransitions($fromState);
        return isset($transitions[$toState]);
    }
}
