<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160318011600 extends AbstractMigration
{
    public static $description = "Transito";  

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
                    CREATE TABLE `transito` (
                    `TOLLCOMPANY` VARCHAR(3) NOT NULL,
                    `PAYMENTMEANS` VARCHAR(3) NOT NULL,
                    `ISSUER` VARCHAR(3) NOT NULL,
                    `TAG` VARCHAR(100) NOT NULL,
                    `PASSAGETIME` VARCHAR(20) NOT NULL,
                    `PLAZA` VARCHAR(3) NOT NULL,
                    `LANE` VARCHAR(3) NOT NULL,
                    `CLASS` VARCHAR(2) NOT NULL,
                    `AMOUNT` VARCHAR(45) NOT NULL,
                    `CREATOR` VARCHAR(2) NOT NULL,
                    `ACCOUNT` VARCHAR(6) NOT NULL,
                    `PLATE` VARCHAR(6) NOT NULL,
                    `BILLINGRUC` VARCHAR(11) NOT NULL,
                    `BILLINGRAZONSOCIAL` VARCHAR(100) NOT NULL,
                    `ROWVERSION` VARCHAR(16) NOT NULL,
                     PRIMARY KEY (`ACCOUNT`,`TAG`,`PASSAGETIME`)
                    ) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                    CREATE TABLE `transito_version` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `version` VARCHAR(20) NOT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
