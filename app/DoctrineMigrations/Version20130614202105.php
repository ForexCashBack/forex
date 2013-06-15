<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130614202105 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers ADD slug VARCHAR(25) NOT NULL");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_BROKERS_SLUG ON brokers (slug)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers DROP slug");
    }
}
