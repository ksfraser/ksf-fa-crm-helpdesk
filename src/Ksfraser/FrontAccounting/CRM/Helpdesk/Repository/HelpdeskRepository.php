<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Helpdesk\Repository;
final class HelpdeskRepository {
    private string $table = 'ksf_crm_helpdesk_cases';
    public function findAll(): array {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return array(); }
        $sql = "SELECT c.*, p.name AS person_name, a.name AS assigned_name FROM " . TB_PREF . $this->table . " c"
            . " LEFT JOIN " . TB_PREF . "crm_persons p ON c.person_id = p.id"
            . " LEFT JOIN " . TB_PREF . "crm_persons a ON c.assigned_to = a.id"
            . " ORDER BY c.created_at DESC, c.case_id DESC";
        $result = db_query($sql, 'Could not load helpdesk cases');
        if ($result === false) { return array(); }
        $rows = array();
        while (($row = db_fetch_assoc($result)) !== false && $row !== null) { $rows[] = $row; }
        return $rows;
    }
    public function findById(int $id): ?array {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return null; }
        $sql = "SELECT c.*, p.name AS person_name, a.name AS assigned_name FROM " . TB_PREF . $this->table . " c"
            . " LEFT JOIN " . TB_PREF . "crm_persons p ON c.person_id = p.id"
            . " LEFT JOIN " . TB_PREF . "crm_persons a ON c.assigned_to = a.id"
            . " WHERE c.case_id = " . (int) $id;
        $result = db_query($sql, 'Could not load helpdesk case');
        if ($result === false) { return null; }
        $row = db_fetch_assoc($result);
        return $row === false ? null : $row;
    }
    public function insertCase(array $data): int {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return 0; }
        $sql = "INSERT INTO " . TB_PREF . $this->table . " (
                title, description, person_id, assigned_to, priority, status, created_at, updated_at, resolved_at)
            VALUES ("
            . $this->escape($data['title'] ?? '') . ", "
            . $this->escape($data['description'] ?? '') . ", "
            . $this->intVal($data['person_id'] ?? null) . ", "
            . $this->intVal($data['assigned_to'] ?? null) . ", "
            . $this->escape($data['priority'] ?? 'normal') . ", "
            . $this->escape($data['status'] ?? 'open') . ", "
            . $this->escape(date('Y-m-d H:i:s')) . ", "
            . $this->escape(date('Y-m-d H:i:s')) . ", "
            . $this->escape($data['resolved_at'] ?? null) . ")";
        $this->dbQuery($sql);
        return $this->dbInsertId();
    }
    public function updateState(int $caseId, string $status, string $resolvedAt = null): void {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return; }
        $sets = ["status = " . $this->escape($status)];
        $sets[] = "resolved_at = " . $this->escape($resolvedAt);
        $sets[] = "updated_at = " . $this->escape(date('Y-m-d H:i:s'));
        $sql = "UPDATE " . TB_PREF . $this->table . " SET " . implode(', ', $sets)
            . " WHERE case_id = " . $this->intVal($caseId);
        $this->dbQuery($sql);
    }
    private function dbQuery($sql, $errorMsg = null) {
        return db_query($sql, $errorMsg);
    }
    private function dbInsertId() {
        return db_insert_id();
    }
    private function escape($value): string {
        if ($value === null) { return 'NULL'; }
        return function_exists('db_escape') ? db_escape($value) : addslashes((string) $value);
    }
    private function intVal($value): int {
        return $value !== null ? (int) $value : 0;
    }
}
