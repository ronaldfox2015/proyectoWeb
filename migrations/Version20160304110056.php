<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160304110056 extends AbstractMigration
{
    public static $description = "Table ePass.aclass";
    public static $author = "Antonio Espinoza";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
CREATE TABLE aclass (
	TOLLCOMPANY VARCHAR(2) NOT NULL,
	CLASS VARCHAR(2) NOT NULL,
	TYPE VARCHAR(2) NOT NULL,
	DESCRIPTION VARCHAR(50),
	CLASSINDEX INT NOT NULL,
	PRIMARY KEY (TOLLCOMPANY,CLASS)
)ENGINE = INNODB;
INSERT INTO aclass VALUES ('01','01','0','Liviano',2);
INSERT INTO aclass VALUES ('01','02','2','Pesado 2 ejes',3);
INSERT INTO aclass VALUES ('01','03','2','Pesado 3 ejes',4);
INSERT INTO aclass VALUES ('01','04','2','Pesado 4 ejes',5);
INSERT INTO aclass VALUES ('01','05','2','Pesado 5 ejes',6);
INSERT INTO aclass VALUES ('01','06','2','Pesado 6 ejes',7);
INSERT INTO aclass VALUES ('01','07','2','Pesado 7+ ejes',8);
INSERT INTO aclass VALUES ('01','10','0','Moto',0);
INSERT INTO aclass VALUES ('01','12','1','Pesado 2 ejes',9);
INSERT INTO aclass VALUES ('01','13','1','Pesado 3 ejes',10);
INSERT INTO aclass VALUES ('01','14','1','Pesado 4 ejes',11);
INSERT INTO aclass VALUES ('01','LP','0','Liviano público',1);
INSERT INTO aclass VALUES ('99','01','0','Liviano',2);
INSERT INTO aclass VALUES ('99','02','2','Pesado 2 ejes',3);
INSERT INTO aclass VALUES ('99','03','2','Pesado 3 ejes',4);
INSERT INTO aclass VALUES ('99','04','2','Pesado 4 ejes',5);
INSERT INTO aclass VALUES ('99','05','2','Pesado 5 ejes',6);
INSERT INTO aclass VALUES ('99','06','2','Pesado 6 ejes',7);
INSERT INTO aclass VALUES ('99','07','2','Pesado 7+ ejes',8);
INSERT INTO aclass VALUES ('99','12','1','Bus 2 ejes',9);
INSERT INTO aclass VALUES ('99','13','1','Bus 3 ejes',10);
INSERT INTO aclass VALUES ('99','14','1','Bus 4 ejes',11);
INSERT INTO aclass VALUES ('99','LP','0','Liviano público',12);  
UPDATE aclass SET TYPE = '6' WHERE TYPE = '0';
UPDATE aclass SET TYPE = '8' WHERE TYPE = '1';
UPDATE aclass SET TYPE = '10' WHERE TYPE = '2';
");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
