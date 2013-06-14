<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130614005153 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE broker_equity_holdings (currency INT NOT NULL, broker VARCHAR(5) NOT NULL, PRIMARY KEY(currency, broker))");
        $this->addSql("CREATE INDEX IDX_BROKER_EQUITY_HOLDINGS_CURRENCY ON broker_equity_holdings (currency)");
        $this->addSql("CREATE INDEX IDX_BROKER_EQUITY_HOLDINGS_BROKER ON broker_equity_holdings (broker)");
        $this->addSql("ALTER TABLE broker_equity_holdings ADD CONSTRAINT FK_BROKER_EQUITY_HOLDINGS_REF_BROKERS_ID FOREIGN KEY (currency) REFERENCES brokers (id) NOT DEFERRABLE INITIALLY IMMEDIATE");
        $this->addSql("ALTER TABLE broker_equity_holdings ADD CONSTRAINT FK_BROKER_EQUITY_HOLDINGS_REF_CURRENCY_ABBR FOREIGN KEY (broker) REFERENCES currency (abbr) NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE broker_equity_holdings");
    }
}
