<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130908191044 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers ADD active BOOLEAN NOT NULL DEFAULT true");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers DROP active");
    }
}
