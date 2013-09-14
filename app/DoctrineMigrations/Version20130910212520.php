<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130910212520 extends AbstractMigration
{
    const CREATE_BROKER_ACCOUNT_TYPES_SQL = <<<EOF
INSERT INTO broker_account_types
SELECT
    NEXTVAL('broker_account_types_id_seq') as id
  , b.id as broker_id
  , 'Standard' as name
  , b.basePercentage as basePercentage
  , b.mindeposit as minDeposit
  , b.maxLeverage as maxLeverage
  , b.rate as rate
FROM brokers b
EOF;
    public function up(Schema $schema)
    {
        $this->addSql("CREATE SEQUENCE broker_account_types_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE broker_account_types (id INT NOT NULL, broker_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, basePercentage DOUBLE PRECISION NOT NULL, minDeposit DOUBLE PRECISION NOT NULL, maxLeverage DOUBLE PRECISION NOT NULL, rate VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_BROKER_ACCOUNT_TYPES_BROKER_ID ON broker_account_types (broker_id);");
        $this->addSql("ALTER TABLE broker_account_types ADD CONSTRAINT FK_BROKER_ACCOUNT_TYPES_REF_BROKERS_BROKER_ID FOREIGN KEY (broker_id) REFERENCES brokers (id) NOT DEFERRABLE INITIALLY IMMEDIATE;");
        $this->addSql(self::CREATE_BROKER_ACCOUNT_TYPES_SQL);

        // Update the brokers table
        $this->addSql("ALTER TABLE brokers DROP mindeposit");
        $this->addSql("ALTER TABLE brokers DROP maxleverage");

        // Alter the payments table
        $this->addSql("ALTER TABLE payments ADD brokerAccountType_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE payments ADD CONSTRAINT FK_PAYMENTS_REF_BROKER_ACCOUNT_TYPES_BROKER_ACCOUNT_TYPE_ID FOREIGN KEY (brokerAccountType_id) REFERENCES broker_account_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX IDX_PAYMENTS_BROKER_ACCOUNT_TYPE_ID ON payments (brokerAccountType_id)");

        // Alter the accounts table
        $this->addSql("ALTER TABLE accounts ADD brokerAccountType_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE accounts ADD CONSTRAINT FK_ACCOUNTS_REF_BROKER_ACCOUNT_TYPES_BROKER_ACCOUNT_TYPE_ID FOREIGN KEY (brokerAccountType_id) REFERENCES broker_account_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX IDX_ACCOUNTS_BROKER_ACCOUNT_TYPE_ID ON accounts (brokerAccountType_id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE payments DROP CONSTRAINT FK_PAYMENTS_REF_BROKER_ACCOUNT_TYPES_BROKER_ACCOUNT_TYPE_ID");
        $this->addSql("ALTER TABLE accounts DROP CONSTRAINT FK_ACCOUNTS_REF_BROKER_ACCOUNT_TYPES_BROKER_ACCOUNT_TYPE_ID");
        $this->addSql("DROP SEQUENCE broker_account_types_id_seq CASCADE");
        $this->addSql("DROP TABLE broker_account_types");
        $this->addSql("ALTER TABLE brokers ADD mindeposit DOUBLE PRECISION");
        $this->addSql("ALTER TABLE brokers ADD maxleverage DOUBLE PRECISION");
        $this->addSql("ALTER TABLE payments DROP brokerAccountType_id");
        $this->addSql("ALTER TABLE accounts DROP brokerAccountType_id");
    }
}
