<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20131106004446 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE email_messages ADD replyTo VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE email_messages ADD ccEmail VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE email_messages ADD bccEmail VARCHAR(255) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE email_messages DROP replyTo");
        $this->addSql("ALTER TABLE email_messages DROP ccEmail");
        $this->addSql("ALTER TABLE email_messages DROP bccEmail");
    }
}
