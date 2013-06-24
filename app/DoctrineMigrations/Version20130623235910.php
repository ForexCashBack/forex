<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130623235910 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE SEQUENCE broker_suggestions_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE broker_suggestions (id INT NOT NULL, user_id INT DEFAULT NULL, suggestion VARCHAR(50) NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_BROKER_SUGGESTIONS_USER_ID ON broker_suggestions (user_id)");
        $this->addSql("ALTER TABLE broker_suggestions ADD CONSTRAINT FK_BROKER_SUGGESTIONS_REF_USERS_USER_ID FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP SEQUENCE broker_suggestions_id_seq CASCADE");
        $this->addSql("DROP TABLE broker_suggestions");
    }
}
