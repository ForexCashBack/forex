<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130507235504 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE SEQUENCE payments_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE payments (id INT NOT NULL, broker_id INT DEFAULT NULL, account_id INT DEFAULT NULL, amount BIGINT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_PAYMENTS_BROKER_ID ON payments (broker_id)");
        $this->addSql("CREATE INDEX IDX_PAYMENTS_ACCOUNT_ID ON payments (account_id)");
        $this->addSql("ALTER TABLE payments ADD CONSTRAINT FK_PAYMENTS_REF_BROKERS_BROKER_ID FOREIGN KEY (broker_id) REFERENCES brokers (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE payments ADD CONSTRAINT FK_PAYMENTS_REF_ACCOUNTS_ACCOUNT_ID FOREIGN KEY (account_id) REFERENCES accounts (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP SEQUENCE payments_id_seq");
        $this->addSql("DROP TABLE payments");
    }
}
