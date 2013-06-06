<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130605222359 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers ADD rectangleImagePath VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE brokers ADD squareImagePath VARCHAR(255) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers DROP rectangleImagePath");
        $this->addSql("ALTER TABLE brokers DROP squareImagePath");
    }
}
