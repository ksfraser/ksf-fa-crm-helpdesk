<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Helpdesk\DTO;
final class HelpdeskDTO {
    public $case_id;
    public $title;
    public $description;
    public $person_id;
    public $person_name;
    public $assigned_to;
    public $assigned_name;
    public $priority;
    public $status;
    public $created_at;
    public $updated_at;
    public $resolved_at;
    public function __construct(
        int $case_id,
        string $title = '',
        string $description = '',
        int $person_id = 0,
        string $person_name = '',
        int $assigned_to = 0,
        string $assigned_name = '',
        string $priority = 'normal',
        string $status = 'open',
        string $created_at = '',
        string $updated_at = '',
        string $resolved_at = ''
    ) {
        $this->case_id = $case_id;
        $this->title = $title;
        $this->description = $description;
        $this->person_id = $person_id;
        $this->person_name = $person_name;
        $this->assigned_to = $assigned_to;
        $this->assigned_name = $assigned_name;
        $this->priority = $priority;
        $this->status = $status;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->resolved_at = $resolved_at;
    }
    public function getDisplayLabel(): string {
        if ($this->title !== '') {
            return sprintf(_('%s [%s]'), $this->title, $this->status);
        }
        return _('Helpdesk Case #') . (string) $this->case_id;
    }
    public function toArray(): array {
        return array(
            'case_id' => $this->case_id,
            'title' => $this->title,
            'description' => $this->description,
            'person_id' => $this->person_id,
            'person_name' => $this->person_name,
            'assigned_to' => $this->assigned_to,
            'assigned_name' => $this->assigned_name,
            'priority' => $this->priority,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'resolved_at' => $this->resolved_at,
        );
    }
    public static function fromArray(array $data): self {
        return new self(
            (int) ($data['case_id'] ?? 0),
            (string) ($data['title'] ?? ''),
            (string) ($data['description'] ?? ''),
            (int) ($data['person_id'] ?? 0),
            (string) ($data['person_name'] ?? ''),
            (int) ($data['assigned_to'] ?? 0),
            (string) ($data['assigned_name'] ?? ''),
            (string) ($data['priority'] ?? 'normal'),
            (string) ($data['status'] ?? 'open'),
            (string) ($data['created_at'] ?? ''),
            (string) ($data['updated_at'] ?? ''),
            (string) ($data['resolved_at'] ?? '')
        );
    }
}
