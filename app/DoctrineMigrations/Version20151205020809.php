<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151205020809 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE API_AccessToken (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_2F3E90C85F37A13B (token), INDEX IDX_2F3E90C819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE API_AuthCode (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, token VARCHAR(255) NOT NULL, redirect_uri LONGTEXT NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_F31C4C075F37A13B (token), INDEX IDX_F31C4C0719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE API_Client (id INT AUTO_INCREMENT NOT NULL, random_id VARCHAR(255) NOT NULL, redirect_uris LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', secret VARCHAR(255) NOT NULL, allowed_grant_types LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', name VARCHAR(255) NOT NULL, skip_auth TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE API_RefreshToken (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, token VARCHAR(255) NOT NULL, expires_at INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_29B6D3085F37A13B (token), INDEX IDX_29B6D30819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, birthday DATETIME NOT NULL, genere VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Book (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, Name VARCHAR(255) NOT NULL, genere VARCHAR(255) NOT NULL, INDEX IDX_6BD70C0FF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE API_AccessToken ADD CONSTRAINT FK_2F3E90C819EB6921 FOREIGN KEY (client_id) REFERENCES API_Client (id)');
        $this->addSql('ALTER TABLE API_AuthCode ADD CONSTRAINT FK_F31C4C0719EB6921 FOREIGN KEY (client_id) REFERENCES API_Client (id)');
        $this->addSql('ALTER TABLE API_RefreshToken ADD CONSTRAINT FK_29B6D30819EB6921 FOREIGN KEY (client_id) REFERENCES API_Client (id)');
        $this->addSql('ALTER TABLE Book ADD CONSTRAINT FK_6BD70C0FF675F31B FOREIGN KEY (author_id) REFERENCES Author (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE API_AccessToken DROP FOREIGN KEY FK_2F3E90C819EB6921');
        $this->addSql('ALTER TABLE API_AuthCode DROP FOREIGN KEY FK_F31C4C0719EB6921');
        $this->addSql('ALTER TABLE API_RefreshToken DROP FOREIGN KEY FK_29B6D30819EB6921');
        $this->addSql('ALTER TABLE Book DROP FOREIGN KEY FK_6BD70C0FF675F31B');
        $this->addSql('DROP TABLE API_AccessToken');
        $this->addSql('DROP TABLE API_AuthCode');
        $this->addSql('DROP TABLE API_Client');
        $this->addSql('DROP TABLE API_RefreshToken');
        $this->addSql('DROP TABLE Author');
        $this->addSql('DROP TABLE Book');
    }
}
