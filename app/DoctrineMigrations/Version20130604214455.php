<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130604214455 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE users ADD createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT 'now'");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE users DROP createdAt");
    }
}
