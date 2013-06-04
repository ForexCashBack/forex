<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130603234631 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE payouts RENAME COLUMN account_id TO user_id");
        $this->addSql("ALTER TABLE payouts DROP CONSTRAINT fk_payouts_ref_accounts_account_id");
        $this->addSql("DROP INDEX idx_payouts_account_id");
        $this->addSql("ALTER TABLE payouts ADD CONSTRAINT FK_PAYOUTS_REF_USERS_USER_ID FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX IDX_PAYOUTS_USER_ID ON payouts (user_id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE payouts RENAME COLUMN user_id TO account_id");
        $this->addSql("ALTER TABLE payouts DROP CONSTRAINT FKPAYOUTS_REF_USERS_USER_ID");
        $this->addSql("DROP INDEX IDX_PAYOUTS_USER_ID");
        $this->addSql("ALTER TABLE payouts ADD CONSTRAINT fk_payouts_ref_accounts_account_id FOREIGN KEY (account_id) REFERENCES accounts (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX idx_payouts_account_id ON payouts (account_id)");
    }
}
