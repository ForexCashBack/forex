<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130822233821 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE SEQUENCE complaints_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE complaints (id INT NOT NULL, user_id INT DEFAULT NULL, broker_id INT DEFAULT NULL, complaint TEXT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_COMPLAINTS_USER_ID ON complaints (user_id)");
        $this->addSql("CREATE INDEX IDX_COMPLAINTS_BROKER_ID ON complaints (broker_id)");
        $this->addSql("ALTER TABLE complaints ADD CONSTRAINT FK_CONSTRAINTS_REF_USERS_USER_ID FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE complaints ADD CONSTRAINT FK_CONSTRAINTS_REF_BROKERS_BROKER_ID FOREIGN KEY (broker_id) REFERENCES brokers (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP SEQUENCE complaints_id_seq CASCADE");
        $this->addSql("DROP TABLE complaints");
    }
}
