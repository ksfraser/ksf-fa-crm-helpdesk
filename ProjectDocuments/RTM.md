# ksf_FA_CRM_Helpdesk — Requirements Traceability Matrix

| Req ID | Requirement | Source | Implemented In | Verified By |
|--------|-------------|--------|----------------|-------------|
| CRM-05 | Helpdesk/cases/tickets | HR-CRM_gaps.md C5 | HelpdeskService | unit tests |
| FR-HD-01 | Create case | CRM-05 | HelpdeskRepository::insertCase | HelpdeskDtoTest |
| FR-HD-02 | List cases | CRM-05 | HelpdeskService::listAll | (tab controller) |
| FR-HD-03 | Resolve case by id | CRM-05 | HelpdeskService::resolveById | (capability hook) |
| FR-HD-04 | Update case | CRM-05 | HelpdeskService::updateState | (state transitions) |
| FR-HD-05 | RELATED_TO_FIELDS | CRM-05 | hooks.php RELATED_TO_FIELDS | (capability) |
| NF-HD-01 | Native db_* calls | AGENTS_ARCH | repository | code review |
| NF-HD-02 | PHP 7.3 compatible | AGENTS_ARCH | all src | code review |
| NF-HD-03 | Unit tests | AGENTS_ARCH | tests/Unit | phpunit |
