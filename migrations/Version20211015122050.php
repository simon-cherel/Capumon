<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211015122050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_9474526C54177093');
        $this->addSql('DROP INDEX IDX_9474526C19EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, client_id, room_id, comment_id, content, created, author, reservation_id_comment FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, room_id INTEGER DEFAULT NULL, comment_id INTEGER NOT NULL, content CLOB NOT NULL COLLATE BINARY, created DATETIME NOT NULL, author VARCHAR(255) NOT NULL COLLATE BINARY, reservation_id_comment INTEGER NOT NULL, CONSTRAINT FK_9474526C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9474526C54177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comment (id, client_id, room_id, comment_id, content, created, author, reservation_id_comment) SELECT id, client_id, room_id, comment_id, content, created, author, reservation_id_comment FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C54177093 ON comment (room_id)');
        $this->addSql('CREATE INDEX IDX_9474526C19EB6921 ON comment (client_id)');
        $this->addSql('DROP INDEX IDX_42C8495519EB6921');
        $this->addSql('DROP INDEX IDX_42C849558FE5EBA7');
        $this->addSql('DROP INDEX IDX_42C8495554177093');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reservation AS SELECT id, room_id, unavailable_period_id, client_id, reservation_id, reservation_adress, number_guests, start_date, end_date, host_name, guest_name, number_nights, payment_total FROM reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, room_id INTEGER DEFAULT NULL, unavailable_period_id INTEGER DEFAULT NULL, client_id INTEGER DEFAULT NULL, reservation_id INTEGER NOT NULL, reservation_adress CLOB NOT NULL COLLATE BINARY, number_guests INTEGER NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, host_name VARCHAR(255) NOT NULL COLLATE BINARY, guest_name VARCHAR(255) NOT NULL COLLATE BINARY, number_nights INTEGER NOT NULL, payment_total DOUBLE PRECISION NOT NULL, CONSTRAINT FK_42C8495554177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_42C849558FE5EBA7 FOREIGN KEY (unavailable_period_id) REFERENCES unavailable_period (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reservation (id, room_id, unavailable_period_id, client_id, reservation_id, reservation_adress, number_guests, start_date, end_date, host_name, guest_name, number_nights, payment_total) SELECT id, room_id, unavailable_period_id, client_id, reservation_id, reservation_adress, number_guests, start_date, end_date, host_name, guest_name, number_nights, payment_total FROM __temp__reservation');
        $this->addSql('DROP TABLE __temp__reservation');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('CREATE INDEX IDX_42C849558FE5EBA7 ON reservation (unavailable_period_id)');
        $this->addSql('CREATE INDEX IDX_42C8495554177093 ON reservation (room_id)');
        $this->addSql('DROP INDEX IDX_729F519B98260155');
        $this->addSql('DROP INDEX IDX_729F519B7E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room AS SELECT id, owner_id, region_id, summary, description, capacity, superficy, price, address FROM room');
        $this->addSql('DROP TABLE room');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER DEFAULT NULL, region_id INTEGER DEFAULT NULL, summary CLOB DEFAULT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, capacity INTEGER NOT NULL, superficy INTEGER NOT NULL, price INTEGER NOT NULL, address INTEGER NOT NULL, CONSTRAINT FK_729F519B7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_729F519B98260155 FOREIGN KEY (region_id) REFERENCES region (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO room (id, owner_id, region_id, summary, description, capacity, superficy, price, address) SELECT id, owner_id, region_id, summary, description, capacity, superficy, price, address FROM __temp__room');
        $this->addSql('DROP TABLE __temp__room');
        $this->addSql('CREATE INDEX IDX_729F519B98260155 ON room (region_id)');
        $this->addSql('CREATE INDEX IDX_729F519B7E3C61F9 ON room (owner_id)');
        $this->addSql('DROP INDEX IDX_B9D87FBB54177093');
        $this->addSql('DROP INDEX IDX_B9D87FBB7E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__unavailable_period AS SELECT id, owner_id, room_id, start, ending FROM unavailable_period');
        $this->addSql('DROP TABLE unavailable_period');
        $this->addSql('CREATE TABLE unavailable_period (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER DEFAULT NULL, room_id INTEGER DEFAULT NULL, start DATETIME NOT NULL, ending DATETIME NOT NULL, CONSTRAINT FK_B9D87FBB7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B9D87FBB54177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO unavailable_period (id, owner_id, room_id, start, ending) SELECT id, owner_id, room_id, start, ending FROM __temp__unavailable_period');
        $this->addSql('DROP TABLE __temp__unavailable_period');
        $this->addSql('CREATE INDEX IDX_B9D87FBB54177093 ON unavailable_period (room_id)');
        $this->addSql('CREATE INDEX IDX_B9D87FBB7E3C61F9 ON unavailable_period (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_9474526C19EB6921');
        $this->addSql('DROP INDEX IDX_9474526C54177093');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment AS SELECT id, client_id, room_id, comment_id, content, created, author, reservation_id_comment FROM comment');
        $this->addSql('DROP TABLE comment');
        $this->addSql('CREATE TABLE comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, room_id INTEGER DEFAULT NULL, comment_id INTEGER NOT NULL, content CLOB NOT NULL, created DATETIME NOT NULL, author VARCHAR(255) NOT NULL, reservation_id_comment INTEGER NOT NULL)');
        $this->addSql('INSERT INTO comment (id, client_id, room_id, comment_id, content, created, author, reservation_id_comment) SELECT id, client_id, room_id, comment_id, content, created, author, reservation_id_comment FROM __temp__comment');
        $this->addSql('DROP TABLE __temp__comment');
        $this->addSql('CREATE INDEX IDX_9474526C19EB6921 ON comment (client_id)');
        $this->addSql('CREATE INDEX IDX_9474526C54177093 ON comment (room_id)');
        $this->addSql('DROP INDEX IDX_42C8495554177093');
        $this->addSql('DROP INDEX IDX_42C849558FE5EBA7');
        $this->addSql('DROP INDEX IDX_42C8495519EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reservation AS SELECT id, room_id, unavailable_period_id, client_id, reservation_id, reservation_adress, number_guests, start_date, end_date, host_name, guest_name, number_nights, payment_total FROM reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, room_id INTEGER DEFAULT NULL, unavailable_period_id INTEGER DEFAULT NULL, client_id INTEGER DEFAULT NULL, reservation_id INTEGER NOT NULL, reservation_adress CLOB NOT NULL, number_guests INTEGER NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, host_name VARCHAR(255) NOT NULL, guest_name VARCHAR(255) NOT NULL, number_nights INTEGER NOT NULL, payment_total DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO reservation (id, room_id, unavailable_period_id, client_id, reservation_id, reservation_adress, number_guests, start_date, end_date, host_name, guest_name, number_nights, payment_total) SELECT id, room_id, unavailable_period_id, client_id, reservation_id, reservation_adress, number_guests, start_date, end_date, host_name, guest_name, number_nights, payment_total FROM __temp__reservation');
        $this->addSql('DROP TABLE __temp__reservation');
        $this->addSql('CREATE INDEX IDX_42C8495554177093 ON reservation (room_id)');
        $this->addSql('CREATE INDEX IDX_42C849558FE5EBA7 ON reservation (unavailable_period_id)');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('DROP INDEX IDX_729F519B7E3C61F9');
        $this->addSql('DROP INDEX IDX_729F519B98260155');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room AS SELECT id, owner_id, region_id, summary, description, capacity, superficy, price, address FROM room');
        $this->addSql('DROP TABLE room');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER DEFAULT NULL, region_id INTEGER DEFAULT NULL, summary CLOB DEFAULT NULL, description CLOB DEFAULT NULL, capacity INTEGER NOT NULL, superficy INTEGER NOT NULL, price INTEGER NOT NULL, address INTEGER NOT NULL)');
        $this->addSql('INSERT INTO room (id, owner_id, region_id, summary, description, capacity, superficy, price, address) SELECT id, owner_id, region_id, summary, description, capacity, superficy, price, address FROM __temp__room');
        $this->addSql('DROP TABLE __temp__room');
        $this->addSql('CREATE INDEX IDX_729F519B7E3C61F9 ON room (owner_id)');
        $this->addSql('CREATE INDEX IDX_729F519B98260155 ON room (region_id)');
        $this->addSql('DROP INDEX IDX_B9D87FBB7E3C61F9');
        $this->addSql('DROP INDEX IDX_B9D87FBB54177093');
        $this->addSql('CREATE TEMPORARY TABLE __temp__unavailable_period AS SELECT id, owner_id, room_id, start, ending FROM unavailable_period');
        $this->addSql('DROP TABLE unavailable_period');
        $this->addSql('CREATE TABLE unavailable_period (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER DEFAULT NULL, room_id INTEGER DEFAULT NULL, start DATETIME NOT NULL, ending DATETIME NOT NULL)');
        $this->addSql('INSERT INTO unavailable_period (id, owner_id, room_id, start, ending) SELECT id, owner_id, room_id, start, ending FROM __temp__unavailable_period');
        $this->addSql('DROP TABLE __temp__unavailable_period');
        $this->addSql('CREATE INDEX IDX_B9D87FBB7E3C61F9 ON unavailable_period (owner_id)');
        $this->addSql('CREATE INDEX IDX_B9D87FBB54177093 ON unavailable_period (room_id)');
    }
}
