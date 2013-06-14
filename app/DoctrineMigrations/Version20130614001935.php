<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130614001935 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE currency (abbr VARCHAR(5) NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(abbr))");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE currency");
    }
}
