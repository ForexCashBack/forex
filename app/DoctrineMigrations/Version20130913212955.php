<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130913212955 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE broker_account_types ADD rank INT NOT NULL DEFAULT 1");
        $this->addSql("CREATE UNIQUE INDEX unique_broker_account_type_rank ON broker_account_types (broker_id, rank)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE broker_account_types DROP rank");
        $this->addSql("DROP INDEX unique_broker_account_type_rank");
    }
}
