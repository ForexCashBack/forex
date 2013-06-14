<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130614013322 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE deposit_methods (abbr VARCHAR(10) NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(abbr))");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE deposit_methods");
    }
}
