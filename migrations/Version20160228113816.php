<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228113816 extends AbstractMigration
{
    public static $description = "Table ePass.oauth_authorization_codes";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `oauth_authorization_codes` (
                `authorization_code` VARCHAR(40) NOT NULL,
                `client_id` VARCHAR(80) NOT NULL,
                `user_id` INT NULL,
                `redirect_uri` VARCHAR(2000) NULL,
                `expires` TIMESTAMP NOT NULL,
                `scope` VARCHAR(2000) NULL,
                `id_token` VARCHAR(2000) NULL,
                PRIMARY KEY (`authorization_code`),
                INDEX `fk_client_id_idx` (`client_id` ASC),
                CONSTRAINT `fk_oac_client_id`
                  FOREIGN KEY (`client_id`)
                  REFERENCES `oauth_clients` (`client_id`)
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
