<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216064210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE investments DROP FOREIGN KEY FK_74FD72E0827FAFD8');
        $this->addSql('ALTER TABLE investments DROP FOREIGN KEY FK_74FD72E090CA0036');
        $this->addSql('ALTER TABLE investments DROP FOREIGN KEY FK_74FD72E0E3C9CD8D');
        $this->addSql('ALTER TABLE investments DROP FOREIGN KEY FK_74FD72E0F17C6263');
        $this->addSql('DROP INDEX IDX_74FD72E090CA0036 ON investments');
        $this->addSql('DROP INDEX IDX_74FD72E0F17C6263 ON investments');
        $this->addSql('DROP INDEX IDX_74FD72E0827FAFD8 ON investments');
        $this->addSql('DROP INDEX IDX_74FD72E0E3C9CD8D ON investments');
        $this->addSql('ALTER TABLE investments DROP eispurchase_year1_id, DROP eispurchase_year2_id, DROP eissale_year1_id, DROP eissale_year2_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE investments ADD eispurchase_year1_id INT DEFAULT NULL, ADD eispurchase_year2_id INT DEFAULT NULL, ADD eissale_year1_id INT DEFAULT NULL, ADD eissale_year2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE investments ADD CONSTRAINT FK_74FD72E0827FAFD8 FOREIGN KEY (eissale_year1_id) REFERENCES tax_documents (id)');
        $this->addSql('ALTER TABLE investments ADD CONSTRAINT FK_74FD72E090CA0036 FOREIGN KEY (eissale_year2_id) REFERENCES tax_documents (id)');
        $this->addSql('ALTER TABLE investments ADD CONSTRAINT FK_74FD72E0E3C9CD8D FOREIGN KEY (eispurchase_year1_id) REFERENCES tax_documents (id)');
        $this->addSql('ALTER TABLE investments ADD CONSTRAINT FK_74FD72E0F17C6263 FOREIGN KEY (eispurchase_year2_id) REFERENCES tax_documents (id)');
        $this->addSql('CREATE INDEX IDX_74FD72E090CA0036 ON investments (eissale_year2_id)');
        $this->addSql('CREATE INDEX IDX_74FD72E0F17C6263 ON investments (eispurchase_year2_id)');
        $this->addSql('CREATE INDEX IDX_74FD72E0827FAFD8 ON investments (eissale_year1_id)');
        $this->addSql('CREATE INDEX IDX_74FD72E0E3C9CD8D ON investments (eispurchase_year1_id)');
    }
}
