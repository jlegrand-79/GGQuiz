<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230204101440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE question_quiz (question_id INT NOT NULL, quiz_id INT NOT NULL, INDEX IDX_FAFC177D1E27F6BF (question_id), INDEX IDX_FAFC177D853CD175 (quiz_id), PRIMARY KEY(question_id, quiz_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cover VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_A412FA9261220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question_quiz ADD CONSTRAINT FK_FAFC177D1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_quiz ADD CONSTRAINT FK_FAFC177D853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA9261220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question_quiz DROP FOREIGN KEY FK_FAFC177D1E27F6BF');
        $this->addSql('ALTER TABLE question_quiz DROP FOREIGN KEY FK_FAFC177D853CD175');
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA9261220EA6');
        $this->addSql('DROP TABLE question_quiz');
        $this->addSql('DROP TABLE quiz');
    }
}
