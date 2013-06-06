<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130605215746 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers ADD companyName VARCHAR(100) NOT NULL");
        $this->addSql("ALTER TABLE brokers ADD minDeposit DOUBLE PRECISION NOT NULL");
        $this->addSql("ALTER TABLE brokers ADD maxLeverage DOUBLE PRECISION NOT NULL");
        $this->addSql("ALTER TABLE brokers ADD website VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE brokers ADD yearFounded INT NOT NULL");
        $this->addSql("ALTER TABLE brokers ALTER name TYPE VARCHAR(100)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("ALTER TABLE brokers DROP companyName");
        $this->addSql("ALTER TABLE brokers DROP minDeposit");
        $this->addSql("ALTER TABLE brokers DROP maxLeverage");
        $this->addSql("ALTER TABLE brokers DROP website");
        $this->addSql("ALTER TABLE brokers DROP yearFounded");
        $this->addSql("ALTER TABLE brokers ALTER name TYPE VARCHAR(255)");
    }
}
