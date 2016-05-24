<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228114056 extends AbstractMigration
{
    public static $description = "Table ePass.autorecharge_affiliation";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `autorecharge_affiliation` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `user_id` INT NOT NULL,
                `account_id` CHAR(8) NULL,
                `operation` ENUM('AFFILIATION', 'MODIFICATION', 'DISAFFILIATION') NOT NULL,
                `entity` VARCHAR(20) NULL,
                `account_number` VARCHAR(34) NOT NULL,
                `account_type` ENUM('C', 'S') NOT NULL,
                `card_number` VARCHAR(45) NOT NULL,
                `expire_month` INT NOT NULL,
                `expire_year` INT NOT NULL,
                `recharge_day` INT NOT NULL,
                `recharge_mount` DOUBLE NOT NULL,
                `migrate` TINYINT NOT NULL DEFAULT 0,
                `created_at` TIMESTAMP NOT NULL DEFAULT now(),
                `updated_at` TIMESTAMP NOT NULL DEFAULT now(),
                PRIMARY KEY (`id`),
                INDEX `fk_account_idx` (`user_id` ASC),
                CONSTRAINT `fk_account`
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
