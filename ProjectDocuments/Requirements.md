# ksf_FA_CRM_Helpdesk — Requirements

## Purpose
Manage helpdesk cases/tickets: case registry, priorities, statuses, assignments and resolution tracking.

## Business Rules (CRM-05)
- A case has a title, description, optional contact, assignee, priority and status.
- Priority: low | normal | high | urgent.
- Status transitions: open → in_progress → resolved → closed.

## Functional Requirements
- FR-HD-01: Create a helpdesk case.
- FR-HD-02: List all helpdesk cases (summary table).
- FR-HD-03: Resolve a single case by id (related-record linking).
- FR-HD-04: Update case priority/status/resolution.
- FR-HD-05: Expose helpdesk case fields via RELATED_TO_FIELDS.

## Non-Functional Requirements
- NF-HD-01: All database access uses native FA db_* calls.
- NF-HD-02: PHP 7.3 compatible runtime.
- NF-HD-03: Unit tests cover DTO round-trip and label resolution.
