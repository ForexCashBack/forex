<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130602005432 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("DROP INDEX uniq_users_referrer_id");
        $this->addSql("CREATE INDEX IDX_USERS_REFERRER_ID ON users (referrer_id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP INDEX IDX_USERS_REFERRER_ID");
        $this->addSql("CREATE UNIQUE INDEX uniq_users_referrer_id ON users (referrer_id)");
    }
}
