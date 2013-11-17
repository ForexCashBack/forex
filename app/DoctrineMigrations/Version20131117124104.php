<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20131117124104 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('CREATE TABLE execution_types (abbr VARCHAR(10) NOT NULL, description VARCHAR(100) NOT NULL, PRIMARY KEY(abbr))');
        $this->addSql('CREATE TABLE broker_execution_types (accountType INT NOT NULL, executionType VARCHAR(10) NOT NULL, PRIMARY KEY(accountType, executionType))');
        $this->addSql('CREATE INDEX IDX_BROKER_EXECUTION_TYPES_ACCOUNT_TYPE ON broker_execution_types (accountType)');
        $this->addSql('CREATE INDEX IDX_BROKER_EXECUTION_TYPES_EXEUCTION_TYPE ON broker_execution_types (executionType)');
        $this->addSql('ALTER TABLE broker_execution_types ADD CONSTRAINT FK_BROKER_EXECUTION_TYPES_REF_BROKER_ACCOUNT_TYPES_ACCOUNT_TYPE FOREIGN KEY (accountType) REFERENCES broker_account_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE broker_execution_types ADD CONSTRAINT FK_BROKER_EXECUTION_TYPES_REF_EXECUTION_TYPES_EXECUTION_TYPE FOREIGN KEY (executionType) REFERENCES execution_types (abbr) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE broker_execution_types');
        $this->addSql('DROP TABLE execution_types');
    }
}
