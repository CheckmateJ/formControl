<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815202410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE form_panel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, nip BIGINT DEFAULT NULL, pesel BIGINT DEFAULT NULL, phone_number BIGINT NOT NULL, email VARCHAR(255) NOT NULL, street_address VARCHAR(400) NOT NULL, local_number VARCHAR(10) NOT NULL, zip_code VARCHAR(6) NOT NULL, correspondence_address VARCHAR(400) NOT NULL, correspondence_local_number VARCHAR(10) NOT NULL, correspondence_zip_code VARCHAR(6) NOT NULL, contact_hours VARCHAR(50) NOT NULL, topic VARCHAR(400) NOT NULL, pdf_file_name VARCHAR(255) DEFAULT NULL, ip_address VARCHAR(255) NOT NULL, browser_name VARCHAR(500) NOT NULL, UNIQUE INDEX UNIQ_21EA77CCE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE form_panel');
    }
}
