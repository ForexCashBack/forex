<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20131117150329 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE broker_trading_platforms (platform VARCHAR(10) NOT NULL, accountType INT NOT NULL, PRIMARY KEY(accountType, platform))");
        $this->addSql("CREATE INDEX IDX_BROKER_TRADING_PLATFORMS_ACCOUNT_TYPE ON broker_trading_platforms (accountType)");
        $this->addSql("CREATE INDEX IDX_BROKER_TRADING_PLATFORMS_PLATFORM ON broker_trading_platforms (platform)");
        $this->addSql("CREATE TABLE trading_platforms (abbr VARCHAR(10) NOT NULL, description VARCHAR(100) NOT NULL, PRIMARY KEY(abbr))");
        $this->addSql("ALTER TABLE broker_trading_platforms ADD CONSTRAINT FK_BROKER_TRADING_PLATFORMS_REF_BROKER_ACCOUNT_TYPES_ACCOUNT_TYPE FOREIGN KEY (accountType) REFERENCES broker_account_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE broker_trading_platforms ADD CONSTRAINT FK_BROKER_TRADING_PLATFORMS_REF_TRADING_PLATFORMS_PLATFORM FOREIGN KEY (platform) REFERENCES trading_platforms (abbr) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE broker_trading_platforms");
        $this->addSql("DROP TABLE trading_platforms");
    }
}
