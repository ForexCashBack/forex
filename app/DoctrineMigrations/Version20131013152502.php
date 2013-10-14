<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20131013152502 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE SEQUENCE email_clicks_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE email_opens_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE email_messages_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE email_links (id VARCHAR(255) NOT NULL, message_id INT DEFAULT NULL, toUrl VARCHAR(255) NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_4CCFE097537A1329 ON email_links (message_id)");
        $this->addSql("CREATE TABLE email_clicks (id INT NOT NULL, link_id VARCHAR(255) DEFAULT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_5D40CAF1ADA40271 ON email_clicks (link_id)");
        $this->addSql("CREATE TABLE email_opens (id INT NOT NULL, message_id INT DEFAULT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_575C99F6537A1329 ON email_opens (message_id)");
        $this->addSql("CREATE TABLE email_messages (id INT NOT NULL, email VARCHAR(255) NOT NULL, user_id INT DEFAULT NULL, subjectLine VARCHAR(255) NOT NULL, template VARCHAR(255) NOT NULL, data TEXT NOT NULL, status VARCHAR(10) DEFAULT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_D06401DFA76ED395 ON email_messages (user_id)");
        $this->addSql("ALTER TABLE email_links ADD CONSTRAINT FK_4CCFE097537A1329 FOREIGN KEY (message_id) REFERENCES email_messages (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE email_clicks ADD CONSTRAINT FK_5D40CAF1ADA40271 FOREIGN KEY (link_id) REFERENCES email_links (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE email_opens ADD CONSTRAINT FK_575C99F6537A1329 FOREIGN KEY (message_id) REFERENCES email_messages (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE email_messages ADD CONSTRAINT FK_D06401DFA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE email_clicks DROP CONSTRAINT FK_5D40CAF1ADA40271");
        $this->addSql("ALTER TABLE email_links DROP CONSTRAINT FK_4CCFE097537A1329");
        $this->addSql("ALTER TABLE email_opens DROP CONSTRAINT FK_575C99F6537A1329");
        $this->addSql("DROP SEQUENCE email_clicks_id_seq CASCADE");
        $this->addSql("DROP SEQUENCE email_opens_id_seq CASCADE");
        $this->addSql("DROP SEQUENCE email_messages_id_seq CASCADE");
        $this->addSql("DROP TABLE email_links");
        $this->addSql("DROP TABLE email_clicks");
        $this->addSql("DROP TABLE email_opens");
        $this->addSql("DROP TABLE email_messages");
    }
}
