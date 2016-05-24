<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160313124616 extends AbstractMigration
{
    public static $description = "Crear tabla de temas para solicitudes";
    public static $author = "Martin Cruz";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `solicitudes_theme` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(45) NOT NULL,
                PRIMARY KEY (`id`))
              ENGINE = InnoDB;

            INSERT INTO solicitudes_theme (name) values('Consulta');
            INSERT INTO solicitudes_theme (name) values('Reclamo');
            INSERT INTO solicitudes_theme (name) values('Reconocimiento');
            INSERT INTO solicitudes_theme (name) values('Solicitud');
            INSERT INTO solicitudes_theme (name) values('Sugerencia');

                ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
