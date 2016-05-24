<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160302093859 extends AbstractMigration
{
    public static $description = "Eliminada tabla de reclamaciones y la vuelva a crear con nuevos campos";
    public static $author = "Martin Cruz";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("DROP TABLE claims;");

        $this->addSql("CREATE TABLE claims (
            id INT NOT NULL AUTO_INCREMENT,
            consumer_type VARCHAR(15) NULL,
            first_name VARCHAR(45) NULL,
            last_name VARCHAR(45) NULL,
            document_type VARCHAR(25) NULL,
            document_number VARCHAR(15) NULL,
            company VARCHAR(45) NULL,
            business_name VARCHAR(45) NULL,
            ruc VARCHAR(15) NULL,
            home_phone VARCHAR(15) NULL,
            mobile_phone VARCHAR(15) NULL,
            email VARCHAR(45) NOT NULL,
            address_1 VARCHAR(45) NULL,
            address_2 VARCHAR(45) NULL,
            address_3 VARCHAR(45) NULL,
            address_4 VARCHAR(45) NULL,
            address_5 VARCHAR(45) NULL,
            address_6 VARCHAR(45) NULL,
            address_7 VARCHAR(45) NULL,
            address_8 VARCHAR(45) NULL,
            description TEXT NOT NULL,
            detail TEXT NOT NULL,
            accept_terms TINYINT NOT NULL,
            is_not_robot TINYINT NOT NULL,
            PRIMARY KEY (id))
            ENGINE = InnoDB;"
        );

    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
