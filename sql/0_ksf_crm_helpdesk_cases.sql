-- ksf_FA_CRM_Helpdesk: helpdesk case tables

CREATE TABLE IF NOT EXISTS `0_ksf_crm_helpdesk_cases` (
  `case_id`       INT(11) NOT NULL AUTO_INCREMENT,
  `title`         VARCHAR(255) NOT NULL,
  `description`   TEXT DEFAULT NULL,
  `person_id`     INT(11) DEFAULT NULL COMMENT 'FK to crm_persons.id (contact)',
  `assigned_to`   INT(11) DEFAULT NULL COMMENT 'FK to crm_persons.id (agent)',
  `priority`      VARCHAR(16) NOT NULL DEFAULT 'normal' COMMENT 'low|normal|high|urgent',
  `status`        VARCHAR(24) NOT NULL DEFAULT 'open' COMMENT 'open|in_progress|resolved|closed',
  `created_at`    DATETIME NOT NULL,
  `updated_at`    DATETIME NOT NULL,
  `resolved_at`   DATETIME DEFAULT NULL,
  PRIMARY KEY (`case_id`),
  KEY `idx_person` (`person_id`),
  KEY `idx_assigned` (`assigned_to`),
  KEY `idx_priority` (`priority`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
