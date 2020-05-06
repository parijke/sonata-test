<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305112625 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_1DDE477B3256915B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_item AS SELECT id, relation_id, description FROM invoice_item');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, invoice_id INTEGER NOT NULL, description VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_1DDE477B2989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO invoice_item (id, invoice_id, description) SELECT id, relation_id, description FROM __temp__invoice_item');
        $this->addSql('DROP TABLE __temp__invoice_item');
        $this->addSql('CREATE INDEX IDX_1DDE477B2989F1FD ON invoice_item (invoice_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_1DDE477B2989F1FD');
        $this->addSql('CREATE TEMPORARY TABLE __temp__invoice_item AS SELECT id, invoice_id, description FROM invoice_item');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('CREATE TABLE invoice_item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description VARCHAR(255) NOT NULL, relation_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO invoice_item (id, relation_id, description) SELECT id, invoice_id, description FROM __temp__invoice_item');
        $this->addSql('DROP TABLE __temp__invoice_item');
        $this->addSql('CREATE INDEX IDX_1DDE477B3256915B ON invoice_item (relation_id)');
    }
}
