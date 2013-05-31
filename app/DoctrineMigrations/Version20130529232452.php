<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130529232452 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE partial_payouts DROP account_id");
        $this->addSql("ALTER TABLE partial_payouts DROP CONSTRAINT IF EXISTS fk_partial_payouts_ref_accounts_account_id");
        $this->addSql("DROP INDEX IF EXISTS idx_partial_payouts_account_id");
        $this->addSql("DROP INDEX uniq_partial_payouts_payment_id");
        $this->addSql("CREATE INDEX IDX_PARTIAL_PAYOUTS_PAYMENT_ID ON partial_payouts (payment_id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE partial_payouts ADD account_id INT DEFAULT NULL");
        $this->addSql("DROP INDEX IDX_PARTIAL_PAYOUTS_PAYMENT_ID");
        $this->addSql("ALTER TABLE partial_payouts ADD CONSTRAINT fk_partial_payouts_ref_accounts_account_id FOREIGN KEY (account_id) REFERENCES accounts (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX idx_partial_payouts_account_id ON partial_payouts (account_id)");
        $this->addSql("CREATE UNIQUE INDEX uniq_partial_payouts_payment_id ON partial_payouts (payment_id)");
    }
}
