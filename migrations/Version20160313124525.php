<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160313124525 extends AbstractMigration
{
    public static $description = "Crear tabla de solicitudes";
    public static $author = "Martin Cruz";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `solicitudes` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `subject` VARCHAR(45) NULL,
                `body` TEXT NULL,
                `status` VARCHAR(45) NULL,
                `theme` VARCHAR(30) NULL,
                `subtheme` VARCHAR(60) NULL,
                `user_id` INT NOT NULL,
                `ticket_id` INT NOT NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT now(),
                `updated_at` TIMESTAMP NOT NULL DEFAULT now(),
                PRIMARY KEY (`id`),
                INDEX `fk_usuario_idx` (`user_id` ASC),
                CONSTRAINT `fk_user_solicitudes`
                  FOREIGN KEY (`user_id`)
                  REFERENCES `users` (`id`)
                  ON DELETE NO ACTION
                  ON UPDATE NO ACTION)
              ENGINE = InnoDB;
                ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
