<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228113317 extends AbstractMigration
{
    public static $description = "Table ePass.transactions";
    public static $author = "Renzo Tejada";
    

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `transactions` (
                `id` INT NOT NULL,
                `payment_method_id` INT NULL,
                `transaction_type_id` INT NULL,
                `user_plan_id` INT NULL,
                `mount` VARCHAR(45) NULL,
                `card_number` VARCHAR(45) NULL,
                `responce_code` VARCHAR(45) NULL,
                `status` VARCHAR(45) NULL COMMENT '0:eticket generado\n1: enviado a la pasarela\n3: pago correcto\n4: pago erroneo',
                `respuesta` LONGTEXT NULL,
                `migrate` TINYINT NOT NULL DEFAULT 0,
                `internal_id` VARCHAR(33) NULL,
                `external_id` VARCHAR(33) NULL,
                `pay_date` TIMESTAMP NULL,
                `transaction_detail_id` INT NOT NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT now(),
                `updated_at` TIMESTAMP NOT NULL DEFAULT now(),
                PRIMARY KEY (`id`),
                INDEX `fk_tipoTransaccion_idx` (`transaction_type_id` ASC),
                INDEX `fk_medioPago_idx` (`payment_method_id` ASC),
                INDEX `fk_transactions_transaction_detail1_idx` (`transaction_detail_id` ASC),
                INDEX `fk_user_plan_idx` (`user_plan_id` ASC),
                CONSTRAINT `fk_tipoTransaccion`
                  FOREIGN KEY (`transaction_type_id`)
                  REFERENCES `transaction_types` (`id`)
                  ON DELETE NO ACTION
                  ON UPDATE NO ACTION,
                CONSTRAINT `fk_medioPago`
                  FOREIGN KEY (`payment_method_id`)
                  REFERENCES `payment_methods` (`id`)
                  ON DELETE NO ACTION
                  ON UPDATE NO ACTION,
                CONSTRAINT `fk_user_plan`
                  FOREIGN KEY (`user_plan_id`)
                  REFERENCES `user_plans` (`id`)
                  ON DELETE NO ACTION
                  ON UPDATE NO ACTION,
                CONSTRAINT `fk_transactions_transaction_detail1`
                  FOREIGN KEY (`transaction_detail_id`)
                  REFERENCES `transaction_detail` (`id`)
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
