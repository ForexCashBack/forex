<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130902130659 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE promotions ADD title VARCHAR(50) NOT NULL");
        $this->addSql("ALTER TABLE promotions ADD slug VARCHAR(25) NOT NULL");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_PROMOTIONS_SLUG ON promotions (slug)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE promotions DROP title");
        $this->addSql("ALTER TABLE promotions DROP slug");
    }
}
