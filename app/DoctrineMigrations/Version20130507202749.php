<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130507202749 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE SEQUENCE brokers_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE accounts_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE brokers (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE TABLE accounts (id INT NOT NULL, user_id INT DEFAULT NULL, broker_id INT DEFAULT NULL, accountNumber VARCHAR(255) NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_ACCOUNTS_USER_ID ON accounts (user_id)");
        $this->addSql("CREATE INDEX IDX_ACCOUNTS_BROKER_ID ON accounts (broker_id)");
        $this->addSql("ALTER TABLE accounts ADD CONSTRAINT FK_ACCOUNTS_REF_USERS_USER_ID FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE accounts ADD CONSTRAINT FK_ACCOUNTS_REF_BROKERS_BROKER_ID FOREIGN KEY (broker_id) REFERENCES brokers (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE accounts DROP CONSTRAINT FK_ACCOUNTS_REF_USERS_USER_ID");
        $this->addSql("DROP SEQUENCE brokers_id_seq");
        $this->addSql("DROP SEQUENCE accounts_id_seq");
        $this->addSql("DROP TABLE brokers");
        $this->addSql("DROP TABLE accounts");
    }
}
