<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20131009004651 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE accounts ADD status VARCHAR(10) NOT NULL DEFAULT 'unverified'");
    }

    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE accounts DROP status');
    }
}
