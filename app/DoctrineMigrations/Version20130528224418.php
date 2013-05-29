<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130528224418 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE users ADD referrer_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE users ADD CONSTRAINT FK_USERS_REF_USERS_REFERRER_ID FOREIGN KEY (referrer_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_USERS_REFERRER_ID ON users (referrer_id)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE users DROP referrer_id");
        $this->addSql("ALTER TABLE users DROP CONSTRAINT FK_USERS_REF_USERS_REFERRER_ID");
        $this->addSql("DROP INDEX UNIQ_USERS_REFERRER_ID");
    }
}
