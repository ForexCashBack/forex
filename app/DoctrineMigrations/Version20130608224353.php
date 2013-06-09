<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130608224353 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE SEQUENCE promotions_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE promotions (id INT NOT NULL, name varchar(50) NOT NULL, broker_id INT DEFAULT NULL, startTime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, endTime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, text TEXT NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_PROMOTIONS_BROKER_ID ON promotions (broker_id)");
        $this->addSql("ALTER TABLE promotions ADD CONSTRAINT FK_PROMOTIONS_REF_BROKERS_BROKER_ID FOREIGN KEY (broker_id) REFERENCES brokers (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP SEQUENCE promotions_id_seq CASCADE");
        $this->addSql("DROP TABLE promotions");
    }
}
