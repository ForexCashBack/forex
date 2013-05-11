<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130510144803 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // Payments
        $this->addSql("CREATE SEQUENCE payouts_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE payouts (id INT NOT NULL, account_id INT DEFAULT NULL, amount BIGINT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_PAYOUTS_ACCOUNT_ID ON payouts (account_id)");
        $this->addSql("ALTER TABLE payouts ADD CONSTRAINT FK_PAYOUTS_REF_ACCOUNTS_ACCOUNT_ID FOREIGN KEY (account_id) REFERENCES accounts (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE brokers ADD basePercentage DOUBLE PRECISION");

        // Partial Payments
        $this->addSql("CREATE SEQUENCE partial_payouts_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE partial_payouts (id INT NOT NULL, account_id INT DEFAULT NULL, payout_id INT DEFAULT NULL, payment_id INT DEFAULT NULL, amount BIGINT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE INDEX IDX_PARTIAL_PAYOUTS_ACCOUNT_ID ON partial_payouts (account_id)");
        $this->addSql("CREATE INDEX IDX_PARTIAL_PAYOUTS_PAYOUT_ID ON partial_payouts (payout_id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_PARTIAL_PAYOUTS_PAYMENT_ID ON partial_payouts (payment_id)");
        $this->addSql("ALTER TABLE partial_payouts ADD CONSTRAINT FK_PARTIAL_PAYOUTS_REF_ACCOUNTS_ACCOUNT_ID FOREIGN KEY (account_id) REFERENCES accounts (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE partial_payouts ADD CONSTRAINT FK_PARTIAL_PAYOUTS_REF_PAYMENTS_PAYMENT_ID FOREIGN KEY (payment_id) REFERENCES payments (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE partial_payouts ADD CONSTRAINT FK_PARTIAL_PAYOUTS_REF_PAYOUTS_PAYOUT_ID FOREIGN KEY (payout_id) REFERENCES payouts (id) NOT DEFERRABLE INITIALLY IMMEDIATE");

        // Percentages
        $this->addSql("UPDATE brokers SET basePercentage = 0");
        $this->addSql("ALTER TABLE brokers ALTER COLUMN basePercentage SET NOT NULL");
        $this->addSql("ALTER TABLE accounts ADD payoutPercentage DOUBLE PRECISION");
        $this->addSql("UPDATE accounts SET payoutPercentage = 0");
        $this->addSql("ALTER TABLE accounts ALTER COLUMN payoutPercentage SET NOT NULL");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP SEQUENCE partial_payouts_id_seq");
        $this->addSql("DROP TABLE partial_payouts");
        $this->addSql("DROP SEQUENCE payouts_id_seq");
        $this->addSql("DROP TABLE payouts");
        $this->addSql("ALTER TABLE brokers DROP basePercentage");
        $this->addSql("ALTER TABLE accounts DROP payoutPercentage");
    }
}
