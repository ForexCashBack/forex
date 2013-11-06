<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20131105210507 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers ADD accountConfirmationEmail VARCHAR(255) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers DROP accountConfirmationEmail");
    }
}
