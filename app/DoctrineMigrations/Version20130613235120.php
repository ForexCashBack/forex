<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130613235120 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers ADD rate VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE brokers ADD spread VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE brokers ADD spreadLink VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE brokers ADD usClients BOOLEAN NOT NULL");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers DROP rate");
        $this->addSql("ALTER TABLE brokers DROP spread");
        $this->addSql("ALTER TABLE brokers DROP spreadLink");
        $this->addSql("ALTER TABLE brokers DROP usClients");
    }
}
