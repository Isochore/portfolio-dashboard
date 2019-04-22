<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190131130554 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE projet_technology (projet_id INT NOT NULL, technology_id INT NOT NULL, INDEX IDX_75FEBA67C18272 (projet_id), INDEX IDX_75FEBA674235D463 (technology_id), PRIMARY KEY(projet_id, technology_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet_technology ADD CONSTRAINT FK_75FEBA67C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_technology ADD CONSTRAINT FK_75FEBA674235D463 FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE technology_projet');
        $this->addSql('ALTER TABLE projet CHANGE git git VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE technology_projet (technology_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_1A2A4A02C18272 (projet_id), INDEX IDX_1A2A4A024235D463 (technology_id), PRIMARY KEY(technology_id, projet_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE technology_projet ADD CONSTRAINT FK_1A2A4A024235D463 FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE technology_projet ADD CONSTRAINT FK_1A2A4A02C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE projet_technology');
        $this->addSql('ALTER TABLE projet CHANGE git git VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
