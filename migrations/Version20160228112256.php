<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228112256 extends AbstractMigration
{
    public static $description = "Table ePass.users";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `users` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `password` VARCHAR(32) NULL,
                `name` VARCHAR(45) NULL DEFAULT NULL,
                `lastname` VARCHAR(45) NULL DEFAULT NULL,
                `email` VARCHAR(100) NULL DEFAULT NULL,
                `terms_check` TINYINT(4) NOT NULL DEFAULT '1',
                `news_check` TINYINT(4) NOT NULL DEFAULT '1',
                `enable` TINYINT NOT NULL DEFAULT 1,
                `zendesk_id` INT NULL,
                `role_id` INT NOT NULL,
                `migrate` TINYINT NOT NULL DEFAULT 0,
                `created_at` TIMESTAMP NOT NULL DEFAULT now(),
                `updated_at` TIMESTAMP NOT NULL DEFAULT now(),
                PRIMARY KEY (`id`),
                INDEX `fk_rol_id_idx` (`role_id` ASC),
                CONSTRAINT `fk_rol_id`
                  FOREIGN KEY (`role_id`)
                  REFERENCES `roles` (`id`)
                  ON DELETE NO ACTION
                  ON UPDATE NO ACTION)
              ENGINE = InnoDB
              DEFAULT CHARACTER SET = utf8;
                ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
