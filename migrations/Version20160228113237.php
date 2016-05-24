<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228113237 extends AbstractMigration
{
    public static $description = "Table ePass.transaction_detail";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `transaction_detail` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `package_id` INT NOT NULL,
                `cost_tag` DOUBLE NULL,
                `recharge_amount` DOUBLE NOT NULL,
                `recharge_rate` INT NOT NULL,
                `use_balance` DOUBLE NOT NULL,
                `total_vehicles` VARCHAR(45) NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT now(),
                `updated_at` TIMESTAMP NOT NULL DEFAULT now(),
                PRIMARY KEY (`id`))
              ENGINE = InnoDB;
            ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
