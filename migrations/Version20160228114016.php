<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228114016 extends AbstractMigration
{
    public static $description = "Table ePass.roles_resources";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `roles_resources` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `role_id` INT NOT NULL,
                `resource_id` INT NOT NULL,
                `permission` ENUM('allow','deny') NOT NULL,
                PRIMARY KEY (`id`),
                INDEX `fk_role_idx` (`role_id` ASC),
                INDEX `fk_resources_idx` (`resource_id` ASC),
                CONSTRAINT `fk_role`
                  FOREIGN KEY (`role_id`)
                  REFERENCES `roles` (`id`)
                  ON DELETE NO ACTION
                  ON UPDATE NO ACTION,
                CONSTRAINT `fk_resources`
                  FOREIGN KEY (`resource_id`)
                  REFERENCES `resources` (`id`)
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
