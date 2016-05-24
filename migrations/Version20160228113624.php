<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228113624 extends AbstractMigration
{
    public static $description = "Table ePass.claims";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `claims` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `type` VARCHAR(45) NULL,
                `subject` VARCHAR(45) NULL,
                `body` TEXT NULL,
                `status` VARCHAR(45) NULL,
                `user_id` INT NOT NULL,
                `theme` VARCHAR(30) NULL,
                `sub_theme` VARCHAR(60) NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT now(),
                `updated_at` TIMESTAMP NOT NULL DEFAULT now(),
                PRIMARY KEY (`id`),
                INDEX `fk_usuario_idx` (`user_id` ASC),
                CONSTRAINT `fk_user_claim`
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
