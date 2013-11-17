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
        $this->addSql('CREATE INDEX IDX_BB4B470F217CB8B3 ON broker_execution_types (accountType)');
        $this->addSql('CREATE INDEX IDX_BB4B470F7BB51EA2 ON broker_execution_types (executionType)');
        $this->addSql('ALTER TABLE broker_execution_types ADD CONSTRAINT FK_BB4B470F217CB8B3 FOREIGN KEY (accountType) REFERENCES broker_account_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE broker_execution_types ADD CONSTRAINT FK_BB4B470F7BB51EA2 FOREIGN KEY (executionType) REFERENCES execution_types (abbr) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE broker_execution_types');
        $this->addSql('DROP TABLE execution_types');
    }
}
