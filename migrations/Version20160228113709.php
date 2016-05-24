<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228113709 extends AbstractMigration
{
    public static $description = "Table ePass.oauth_clients";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `oauth_clients` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `client_id` VARCHAR(80) NOT NULL,
                `user_id` INT NOT NULL,
                `client_secret` VARCHAR(80) NOT NULL,
                `redirect_uri` VARCHAR(2000) NOT NULL,
                `grant_types` VARCHAR(80) NULL,
                `scope` VARCHAR(2000) NULL,
                INDEX `fk_oauth_user_idx` (`user_id` ASC),
                PRIMARY KEY (`id`),
                UNIQUE INDEX `client_id_UNIQUE` (`client_id` ASC),
                CONSTRAINT `fk_oauth_user`
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
