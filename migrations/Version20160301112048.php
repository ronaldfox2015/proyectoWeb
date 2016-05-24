<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160301112048 extends AbstractMigration
{
    public static $description = "Insert tables roles, resources y roles_resources";

    public function up(MetadataInterface $schema)
    {
        $sql = "INSERT  INTO `roles`(`name`)
                VALUES 
                ('publico'),
                ('admin'),
                ('usuario');

                INSERT  INTO `resources`(`name`) 
                VALUES 
                ('home'),('auth'),('personas'),('que-es-epass'),('beneficios'),
                ('empresas'),('donde'),('como'),('afiliacion'),('preguntas-frecuentes'),
                ('afiliate'),('recarga'),('descargar-comprobante'),('reclamaciones'),('dashboard'),
                ('auth/actions');
                

                INSERT  INTO `roles_resources`(`role_id`,`resource_id`, `permission`)
                VALUES 
                (1,1,'allow'),(1,2,'allow'),(1,3,'allow'),(1,4,'allow'),(1,5,'allow'),
                (1,6,'allow'),(1,7,'allow'),(1,8, 'allow'),(1,9,'allow'),(1,10,'allow'),
                (1,11,'allow'),(1,12,'allow'),(1,13, 'allow'),(1,14,'allow'),(1,15,'deny'),(3,16,'deny'),

                (2,1, 'allow'),(2,2, 'allow'),(2,3, 'allow'),(2,4, 'allow'),(2,5, 'allow'),(2,6, 'allow'),
                (2,7, 'allow'),(2,8, 'allow'),(2,9, 'allow'),(2,10, 'allow'),(2,11, 'allow'),(2,12, 'allow'),
                (2,13, 'allow'),(2,14, 'allow'),(2,15, 'allow'), (3,16,'allow'),

                (3,1, 'allow'),(3,2, 'allow'),(3,3, 'allow'),(3,4, 'allow'),(3,5, 'allow'),(3,6, 'allow'),
                (3,7, 'allow'),(3,8, 'allow'),(3,9, 'allow'),(3,10, 'allow'),(3,11, 'allow'),(3,12, 'allow'),
                (3,13, 'allow'),(3,14, 'allow'),(3,15, 'allow'), (3,16, 'allow');
              ";
        $this->addSql($sql);
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
