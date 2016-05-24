<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228112640 extends AbstractMigration
{
    public static $description = "Table ePass.user_plan_vehicle";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `user_plan_vehicle` (
                `user_plan_id` INT NOT NULL,
                `vehicle_id` INT NOT NULL,
                PRIMARY KEY (`user_plan_id`, `vehicle_id`),
                INDEX `fk_vehiculo_idx` (`vehicle_id` ASC),
                CONSTRAINT `fk_epass`
                  FOREIGN KEY (`user_plan_id`)
                  REFERENCES `user_plans` (`id`)
                  ON DELETE NO ACTION
                  ON UPDATE NO ACTION,
                CONSTRAINT `fk_vehiculo`
                  FOREIGN KEY (`vehicle_id`)
                  REFERENCES `vehicles` (`id`)
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
