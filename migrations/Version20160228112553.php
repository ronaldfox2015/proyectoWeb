<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228112553 extends AbstractMigration
{
    public static $description = "Table ePass.user_plans";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `user_plans` (
                `id` INT NOT NULL,
                `account_id` CHAR(8) NULL,
                `user_id` INT NOT NULL,
                `document_type_id` INT(11) NULL DEFAULT NULL,
                `document_number` VARCHAR(10) NULL DEFAULT NULL,
                `ruc` CHAR(11) NULL,
                `telephone` VARCHAR(100) NULL DEFAULT NULL,
                `flagDelivery` TINYINT NOT NULL DEFAULT 0 COMMENT '0: Retiro en punto de Venta, 1: Envío a Domicilio',
                `additional_phone` VARCHAR(100) NULL DEFAULT NULL,
                `address` VARCHAR(150) NULL DEFAULT NULL,
                `address_number` VARCHAR(10) NULL DEFAULT NULL,
                `inside_address` VARCHAR(10) NULL DEFAULT NULL,
                `urbanization` VARCHAR(150) NULL DEFAULT NULL,
                `observations` TEXT NULL DEFAULT NULL,
                `billing_doc_number` VARCHAR(20) NULL,
                `billing_designation` VARCHAR(120) NULL,
                `billing_street` TEXT NULL,
                `billing_referencia` TEXT NULL,
                `billing_code_distrito` VARCHAR(32) NULL,
                `billing_code_provincia` VARCHAR(32) NULL,
                `billing_code_departamento` VARCHAR(32) NULL,
                `district_id` VARCHAR(32) NULL,
                `province_id` VARCHAR(32) NULL,
                `department_id` VARCHAR(32) NULL,
                `plan_id` VARCHAR(10) NOT NULL,
                `plan_name` VARCHAR(45) NULL,
                `total_balance` DOUBLE NOT NULL DEFAULT 0,
                `total_vehicles` INT NOT NULL DEFAULT 0,
                `vehicles_available` INT NOT NULL DEFAULT 0,
                `created_at` TIMESTAMP NOT NULL DEFAULT now(),
                `updated_at` TIMESTAMP NOT NULL DEFAULT now(),
                `migrate` TINYINT NOT NULL DEFAULT 0,
                PRIMARY KEY (`id`),
                INDEX `fk_usuario_idx` (`user_id` ASC),
                CONSTRAINT `fk_usuario`
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
