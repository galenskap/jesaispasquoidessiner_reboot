<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321120130 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, text VARCHAR(255) NOT NULL, is_female TINYINT(1) NOT NULL, is_plural TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE situation (id INT AUTO_INCREMENT NOT NULL, male_singular_text VARCHAR(255) NOT NULL, female_singular_text VARCHAR(255) DEFAULT NULL, male_plural_text VARCHAR(255) DEFAULT NULL, female_plural_form VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE submission (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, subject_id INT NOT NULL, situation_id INT NOT NULL, status TINYINT(1) NOT NULL, imagefile VARCHAR(80) NOT NULL, date DATETIME NOT NULL, INDEX IDX_DB055AF3F675F31B (author_id), INDEX IDX_DB055AF323EDC87 (subject_id), INDEX IDX_DB055AF33408E8AF (situation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF3F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF323EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE submission ADD CONSTRAINT FK_DB055AF33408E8AF FOREIGN KEY (situation_id) REFERENCES situation (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF323EDC87');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF33408E8AF');
        $this->addSql('ALTER TABLE submission DROP FOREIGN KEY FK_DB055AF3F675F31B');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE situation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE submission');
    }
}
