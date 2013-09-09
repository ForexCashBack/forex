<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130908172613 extends AbstractMigration
{
    const UPDATE_BROKER_RANK_SQL = <<<EOF
UPDATE brokers b
SET RANK = b.id
EOF;

    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers ADD rank INT NOT NULL DEFAULT 0");
        $this->addSql(self::UPDATE_BROKER_RANK_SQL);
        $this->addSql("CREATE UNIQUE INDEX UNIQ_BROKERS_RANK ON brokers (rank)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers DROP rank");
        $this->addSql("DROP INDEX UNIQ_BROKERS_RANK");
    }
}
