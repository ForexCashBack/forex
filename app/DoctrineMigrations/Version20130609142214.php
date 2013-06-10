<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130609142214 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE SEQUENCE regulations_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE regulators (abbr VARCHAR(10) NOT NULL, name VARCHAR(100) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(abbr))");
        $this->addSql("CREATE TABLE regulations (id INT NOT NULL, broker_id INT DEFAULT NULL, regulator_id VARCHAR(10) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_REGULATIONS_BROKER_ID ON regulations (broker_id)");
        $this->addSql("CREATE INDEX IDX_REGULATIONS_REGULATOR_ID ON regulations (regulator_id)");
        $this->addSql("ALTER TABLE regulations ADD CONSTRAINT FK_REGULATIONS_REF_BROKERS_BROKER_ID FOREIGN KEY (broker_id) REFERENCES brokers (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE regulations ADD CONSTRAINT FK_REGULATIONS_REF_REGULATORS_REGULATOR_ID FOREIGN KEY (regulator_id) REFERENCES regulators (abbr) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE brokers ADD referralLink VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE brokers ADD highlight TEXT NOT NULL");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP SEQUENCE regulations_id_seq CASCADE");
        $this->addSql("ALTER TABLE regulations DROP CONSTRAINT FK_REGULATIONS_REF_REGULATORS_REGULATOR_ID");
        $this->addSql("DROP TABLE regulators");
        $this->addSql("DROP TABLE regulations");
        $this->addSql("ALTER TABLE brokers DROP referralLink");
        $this->addSql("ALTER TABLE brokers DROP highlight");
    }
}
