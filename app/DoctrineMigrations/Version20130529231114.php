<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130529231114 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE partial_payouts ADD user_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE partial_payouts ADD CONSTRAINT FK_PARTIAL_PAYOUTS_REF_USERS_USER_ID FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE INDEX IDX_PARTIAL_PAYOUTS_USER_ID ON partial_payouts (user_id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE partial_payouts DROP user_id");
        $this->addSql("ALTER TABLE partial_payouts DROP CONSTRAINT FK_PARTIAL_PAYOUTS_REF_USERS_USER_ID");
        $this->addSql("DROP INDEX IDX_PARTIAL_PAYOUTS_USER_ID");
    }
}
