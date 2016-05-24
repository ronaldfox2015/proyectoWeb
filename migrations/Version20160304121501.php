<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160304121501 extends AbstractMigration
{
    public static $description = "Table ePass.alinkedlist";
    public static $author = "Antonio Espinoza";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
CREATE TABLE alinkedlist (
	LIST INT NOT NULL,
	`INDEX` INT NOT NULL,
	VALUE VARCHAR(32) NOT NULL,
	TEXT VARCHAR(80) NOT NULL,
	DEPLIST INT DEFAULT NULL,
	DEPINDEX INT DEFAULT NULL,
	EDITABLE INT NOT NULL DEFAULT 1,
	ROW_VERSION TIMESTAMP NOT NULL,
	PRIMARY KEY (LIST,`INDEX`)
)ENGINE = INNODB;
INSERT INTO alinkedlist VALUES (
1,0,'01                              ','Transferencia',NULL,NULL,1,0x000000000013a620);
INSERT INTO alinkedlist VALUES (
1,1,'02                              ','Habilitación',NULL,NULL,1,0x000000000013a621);
INSERT INTO alinkedlist VALUES (
1,2,'03                              ','Cancelación',NULL,NULL,1,0x000000000013a622);
INSERT INTO alinkedlist VALUES (
1,3,'04                              ','Recarga',NULL,NULL,1,0x000000000013a623);
INSERT INTO alinkedlist VALUES (
1,4,'30                              ','Obsequios',NULL,NULL,1,0x000000000013a624);
INSERT INTO alinkedlist VALUES (
1,5,'56                              ','DEVOLUCION',NULL,NULL,1,0x000000000013a625);
INSERT INTO alinkedlist VALUES (
2,0,'01                              ','Impago',NULL,NULL,1,0x0000000000012add);
INSERT INTO alinkedlist VALUES (
2,1,'02                              ','Pendiente de tramitación',NULL,NULL,1,0x0000000000012ade);
INSERT INTO alinkedlist VALUES (
2,3,'04                              ','Otros',NULL,NULL,1,0x000000001065df39);
INSERT INTO alinkedlist VALUES (
2,50,'50                              ','Saldo insucifiente',NULL,NULL,0,0x0000000010729d2c);
INSERT INTO alinkedlist VALUES (
3,1,'01                              ','AMAZONAS',NULL,NULL,0,0x000000001089494b);
INSERT INTO alinkedlist VALUES (
3,2,'02                              ','ANCASH',NULL,NULL,0,0x000000001089494c);
INSERT INTO alinkedlist VALUES (
3,3,'03                              ','APURIMAC',NULL,NULL,0,0x000000001089494d);
INSERT INTO alinkedlist VALUES (
3,4,'04                              ','AREQUIPA',NULL,NULL,0,0x000000001089494e);
INSERT INTO alinkedlist VALUES (
3,5,'05                              ','AYACUCHO',NULL,NULL,0,0x000000001089494f);
INSERT INTO alinkedlist VALUES (
3,6,'06                              ','CAJAMARCA',NULL,NULL,0,0x0000000010894950);
INSERT INTO alinkedlist VALUES (
3,7,'07                              ','CALLAO',NULL,NULL,0,0x0000000010894951);
INSERT INTO alinkedlist VALUES (
3,8,'08                              ','CUSCO',NULL,NULL,0,0x0000000010894952);
INSERT INTO alinkedlist VALUES (
3,9,'09                              ','HUANCAVELICA',NULL,NULL,0,0x0000000010894953);
INSERT INTO alinkedlist VALUES (
3,10,'10                              ','HUANUCO',NULL,NULL,0,0x0000000010894954);
INSERT INTO alinkedlist VALUES (
3,11,'11                              ','ICA',NULL,NULL,0,0x0000000010894955);
INSERT INTO alinkedlist VALUES (
3,12,'12                              ','JUNIN',NULL,NULL,0,0x0000000010894956);
INSERT INTO alinkedlist VALUES (
3,13,'13                              ','LA LIBERTAD',NULL,NULL,0,0x0000000010894957);
INSERT INTO alinkedlist VALUES (
3,14,'14                              ','LAMBAYEQUE',NULL,NULL,0,0x0000000010894958);
INSERT INTO alinkedlist VALUES (
3,15,'15                              ','LIMA',NULL,NULL,0,0x0000000010894959);
INSERT INTO alinkedlist VALUES (
3,16,'16                              ','LORETO',NULL,NULL,0,0x000000001089495a);
INSERT INTO alinkedlist VALUES (
3,17,'17                              ','MADRE DE DIOS',NULL,NULL,0,0x000000001089495b);
INSERT INTO alinkedlist VALUES (
3,18,'18                              ','MOQUEGUA',NULL,NULL,0,0x000000001089495c);
INSERT INTO alinkedlist VALUES (
3,19,'19                              ','PASCO',NULL,NULL,0,0x000000001089495d);
INSERT INTO alinkedlist VALUES (
3,20,'20                              ','PIURA',NULL,NULL,0,0x000000001089495e);
INSERT INTO alinkedlist VALUES (
3,21,'21                              ','PUNO',NULL,NULL,0,0x000000001089495f);
INSERT INTO alinkedlist VALUES (
3,22,'22                              ','SAN MARTIN',NULL,NULL,0,0x0000000010894960);
INSERT INTO alinkedlist VALUES (
3,23,'23                              ','TACNA',NULL,NULL,0,0x0000000010894961);
INSERT INTO alinkedlist VALUES (
3,24,'24                              ','TUMBES',NULL,NULL,0,0x0000000010894962);
INSERT INTO alinkedlist VALUES (
3,25,'25                              ','UCAYALI',NULL,NULL,0,0x0000000010894963);
INSERT INTO alinkedlist VALUES (
4,1,'01                              ','CHACHAPOYAS',3,1,0,0x0000000010894964);
INSERT INTO alinkedlist VALUES (
4,2,'02                              ','BAGUA',3,1,0,0x0000000010894965);
INSERT INTO alinkedlist VALUES (
4,3,'03                              ','BONGARA',3,1,0,0x0000000010894966);
INSERT INTO alinkedlist VALUES (
4,4,'04                              ','LUYA',3,1,0,0x0000000010894967);
INSERT INTO alinkedlist VALUES (
4,5,'05                              ','RODRIGUEZ DE MENDOZA',3,1,0,0x0000000010894968);
INSERT INTO alinkedlist VALUES (
4,6,'06                              ','CONDORCANQUI',3,1,0,0x0000000010894969);
INSERT INTO alinkedlist VALUES (
4,7,'07                              ','UTCUBAMBA',3,1,0,0x000000001089496a);
INSERT INTO alinkedlist VALUES (
4,8,'01                              ','HUARAZ',3,2,0,0x000000001089496b);
INSERT INTO alinkedlist VALUES (
4,9,'02                              ','AIJA',3,2,0,0x000000001089496c);
INSERT INTO alinkedlist VALUES (
4,10,'03                              ','BOLOGNESI',3,2,0,0x000000001089496d);
INSERT INTO alinkedlist VALUES (
4,11,'04                              ','CARHUAZ',3,2,0,0x000000001089496e);
INSERT INTO alinkedlist VALUES (
4,12,'05                              ','CASMA',3,2,0,0x000000001089496f);
INSERT INTO alinkedlist VALUES (
4,13,'06                              ','CORONGO',3,2,0,0x0000000010894970);
INSERT INTO alinkedlist VALUES (
4,14,'07                              ','HUAYLAS',3,2,0,0x0000000010894971);
INSERT INTO alinkedlist VALUES (
4,15,'08                              ','HUARI',3,2,0,0x0000000010894972);
INSERT INTO alinkedlist VALUES (
4,16,'09                              ','MARISCAL LUZURIAGA',3,2,0,0x0000000010894973);
INSERT INTO alinkedlist VALUES (
4,17,'10                              ','PALLASCA',3,2,0,0x0000000010894974);
INSERT INTO alinkedlist VALUES (
4,18,'11                              ','POMABAMBA',3,2,0,0x0000000010894975);
INSERT INTO alinkedlist VALUES (
4,19,'12                              ','RECUAY',3,2,0,0x0000000010894976);
INSERT INTO alinkedlist VALUES (
4,20,'13                              ','SANTA',3,2,0,0x0000000010894977);
INSERT INTO alinkedlist VALUES (
4,21,'14                              ','SIHUAS',3,2,0,0x0000000010894978);
INSERT INTO alinkedlist VALUES (
4,22,'15                              ','YUNGAY',3,2,0,0x0000000010894979);
INSERT INTO alinkedlist VALUES (
4,23,'16                              ','ANTONIO RAIMONDI',3,2,0,0x000000001089497a);
INSERT INTO alinkedlist VALUES (
4,24,'17                              ','CARLOS FERMIN FITZCARRALD',3,2,0,0x000000001089497b);
INSERT INTO alinkedlist VALUES (
4,25,'18                              ','ASUNCION',3,2,0,0x000000001089497c);
INSERT INTO alinkedlist VALUES (
4,26,'20                              ','HUARMEY',3,2,0,0x000000001089497d);
INSERT INTO alinkedlist VALUES (
4,27,'21                              ','OCROS',3,2,0,0x000000001089497e);
INSERT INTO alinkedlist VALUES (
4,28,'01                              ','ABANCAY',3,3,0,0x000000001089497f);
INSERT INTO alinkedlist VALUES (
4,29,'02                              ','AYMARAES',3,3,0,0x0000000010894980);
INSERT INTO alinkedlist VALUES (
4,30,'03                              ','ANDAHUAYLAS',3,3,0,0x0000000010894981);
INSERT INTO alinkedlist VALUES (
4,31,'04                              ','ANTABAMBA',3,3,0,0x0000000010894982);
INSERT INTO alinkedlist VALUES (
4,32,'05                              ','COTABAMBAS',3,3,0,0x0000000010894983);
INSERT INTO alinkedlist VALUES (
4,33,'06                              ','GRAU',3,3,0,0x0000000010894984);
INSERT INTO alinkedlist VALUES (
4,34,'07                              ','CHINCHEROS',3,3,0,0x0000000010894985);
INSERT INTO alinkedlist VALUES (
4,35,'01                              ','AREQUIPA',3,4,0,0x0000000010894986);
INSERT INTO alinkedlist VALUES (
4,36,'02                              ','CAYLLOMA',3,4,0,0x0000000010894987);
INSERT INTO alinkedlist VALUES (
4,37,'03                              ','CAMANA',3,4,0,0x0000000010894988);
INSERT INTO alinkedlist VALUES (
4,38,'04                              ','CARAVELI',3,4,0,0x0000000010894989);
INSERT INTO alinkedlist VALUES (
4,39,'05                              ','CASTILLA',3,4,0,0x000000001089498a);
INSERT INTO alinkedlist VALUES (
4,40,'06                              ','CONDESUYOS',3,4,0,0x000000001089498b);
INSERT INTO alinkedlist VALUES (
4,41,'07                              ','ISLAY',3,4,0,0x000000001089498c);
INSERT INTO alinkedlist VALUES (
4,42,'08                              ','LA UNION',3,4,0,0x000000001089498d);
INSERT INTO alinkedlist VALUES (
4,43,'01                              ','HUAMANGA',3,5,0,0x000000001089498e);
INSERT INTO alinkedlist VALUES (
4,44,'02                              ','CANGALLO',3,5,0,0x000000001089498f);
INSERT INTO alinkedlist VALUES (
4,45,'03                              ','HUANTA',3,5,0,0x0000000010894990);
INSERT INTO alinkedlist VALUES (
4,46,'04                              ','LA MAR',3,5,0,0x0000000010894991);
INSERT INTO alinkedlist VALUES (
4,47,'05                              ','LUCANAS',3,5,0,0x0000000010894992);
INSERT INTO alinkedlist VALUES (
4,48,'06                              ','PARINACOCHAS',3,5,0,0x0000000010894993);
INSERT INTO alinkedlist VALUES (
4,49,'07                              ','VICTOR FAJARDO',3,5,0,0x0000000010894994);
INSERT INTO alinkedlist VALUES (
4,50,'08                              ','HUANCA SANCOS',3,5,0,0x0000000010894995);
INSERT INTO alinkedlist VALUES (
4,51,'09                              ','VILCAS HUAMAN',3,5,0,0x0000000010894996);
INSERT INTO alinkedlist VALUES (
4,52,'10                              ','PAUCAR DEL SARA SARA',3,5,0,0x0000000010894997);
INSERT INTO alinkedlist VALUES (
4,53,'11                              ','SUCRE',3,5,0,0x0000000010894998);
INSERT INTO alinkedlist VALUES (
4,54,'01                              ','CAJAMARCA',3,6,0,0x0000000010894999);
INSERT INTO alinkedlist VALUES (
4,55,'02                              ','CAJABAMBA',3,6,0,0x000000001089499a);
INSERT INTO alinkedlist VALUES (
4,56,'03                              ','CELENDIN',3,6,0,0x000000001089499b);
INSERT INTO alinkedlist VALUES (
4,57,'04                              ','CONTUMAZA',3,6,0,0x000000001089499c);
INSERT INTO alinkedlist VALUES (
4,58,'05                              ','CUTERVO',3,6,0,0x000000001089499d);
INSERT INTO alinkedlist VALUES (
4,59,'06                              ','CHOTA',3,6,0,0x000000001089499e);
INSERT INTO alinkedlist VALUES (
4,60,'07                              ','HUALGAYOC',3,6,0,0x000000001089499f);
INSERT INTO alinkedlist VALUES (
4,61,'08                              ','JAEN',3,6,0,0x00000000108949a0);
INSERT INTO alinkedlist VALUES (
4,62,'09                              ','SANTA CRUZ',3,6,0,0x00000000108949a1);
INSERT INTO alinkedlist VALUES (
4,63,'10                              ','SAN MIGUEL',3,6,0,0x00000000108949a2);
INSERT INTO alinkedlist VALUES (
4,64,'11                              ','SAN IGNACIO',3,6,0,0x00000000108949a3);
INSERT INTO alinkedlist VALUES (
4,65,'12                              ','SAN MARCOS',3,6,0,0x00000000108949a4);
INSERT INTO alinkedlist VALUES (
4,66,'13                              ','SAN PABLO',3,6,0,0x00000000108949a5);
INSERT INTO alinkedlist VALUES (
4,67,'01                              ','CALLAO',3,7,0,0x00000000108949a6);
INSERT INTO alinkedlist VALUES (
4,68,'01                              ','CUSCO',3,8,0,0x00000000108949a7);
INSERT INTO alinkedlist VALUES (
4,69,'02                              ','ACOMAYO',3,8,0,0x00000000108949a8);
INSERT INTO alinkedlist VALUES (
4,70,'03                              ','ANTA',3,8,0,0x00000000108949a9);
INSERT INTO alinkedlist VALUES (
4,71,'04                              ','CALCA',3,8,0,0x00000000108949aa);
INSERT INTO alinkedlist VALUES (
4,72,'05                              ','CANAS',3,8,0,0x00000000108949ab);
INSERT INTO alinkedlist VALUES (
4,73,'06                              ','CANCHIS',3,8,0,0x00000000108949ac);
INSERT INTO alinkedlist VALUES (
4,74,'07                              ','CHUMBIVILCAS',3,8,0,0x00000000108949ad);
INSERT INTO alinkedlist VALUES (
4,75,'08                              ','ESPINAR',3,8,0,0x00000000108949ae);
INSERT INTO alinkedlist VALUES (
4,76,'09                              ','LA CONVENCION',3,8,0,0x00000000108949af);
INSERT INTO alinkedlist VALUES (
4,77,'10                              ','PARURO',3,8,0,0x00000000108949b0);
INSERT INTO alinkedlist VALUES (
4,78,'11                              ','PAUCARTAMBO',3,8,0,0x00000000108949b1);
INSERT INTO alinkedlist VALUES (
4,79,'12                              ','QUISPICANCHI',3,8,0,0x00000000108949b2);
INSERT INTO alinkedlist VALUES (
4,80,'13                              ','URUBAMBA',3,8,0,0x00000000108949b3);
INSERT INTO alinkedlist VALUES (
4,81,'01                              ','HUANCAVELICA',3,9,0,0x00000000108949b4);
INSERT INTO alinkedlist VALUES (
4,82,'02                              ','ACOBAMBA',3,9,0,0x00000000108949b5);
INSERT INTO alinkedlist VALUES (
4,83,'03                              ','ANGARAES',3,9,0,0x00000000108949b6);
INSERT INTO alinkedlist VALUES (
4,84,'04                              ','CASTROVIRREYNA',3,9,0,0x00000000108949b7);
INSERT INTO alinkedlist VALUES (
4,85,'05                              ','TAYACAJA',3,9,0,0x00000000108949b8);
INSERT INTO alinkedlist VALUES (
4,86,'06                              ','HUAYTARA',3,9,0,0x00000000108949b9);
INSERT INTO alinkedlist VALUES (
4,87,'07                              ','CHURCAMPA',3,9,0,0x00000000108949ba);
INSERT INTO alinkedlist VALUES (
4,88,'01                              ','HUANUCO',3,10,0,0x00000000108949bb);
INSERT INTO alinkedlist VALUES (
4,89,'02                              ','AMBO',3,10,0,0x00000000108949bc);
INSERT INTO alinkedlist VALUES (
4,90,'03                              ','DOS DE MAYO',3,10,0,0x00000000108949bd);
INSERT INTO alinkedlist VALUES (
4,91,'04                              ','HUAMALIES',3,10,0,0x00000000108949be);
INSERT INTO alinkedlist VALUES (
4,92,'05                              ','MARAÑON',3,10,0,0x00000000108949bf);
INSERT INTO alinkedlist VALUES (
4,93,'06                              ','LEONCIO PRADO',3,10,0,0x00000000108949c0);
INSERT INTO alinkedlist VALUES (
4,94,'07                              ','PACHITEA',3,10,0,0x00000000108949c1);
INSERT INTO alinkedlist VALUES (
4,95,'08                              ','PUERTO INCA',3,10,0,0x00000000108949c2);
INSERT INTO alinkedlist VALUES (
4,96,'09                              ','HUACAYBAMBA',3,10,0,0x00000000108949c3);
INSERT INTO alinkedlist VALUES (
4,97,'10                              ','LAURICOCHA',3,10,0,0x00000000108949c4);
INSERT INTO alinkedlist VALUES (
4,98,'11                              ','YAROWILCA',3,10,0,0x00000000108949c5);
INSERT INTO alinkedlist VALUES (
4,99,'01                              ','ICA',3,11,0,0x00000000108949c6);
INSERT INTO alinkedlist VALUES (
4,100,'02                              ','CHINCHA',3,11,0,0x00000000108949c7);
INSERT INTO alinkedlist VALUES (
4,101,'03                              ','NAZCA',3,11,0,0x00000000108949c8);
INSERT INTO alinkedlist VALUES (
4,102,'04                              ','PISCO',3,11,0,0x00000000108949c9);
INSERT INTO alinkedlist VALUES (
4,103,'05                              ','PALPA',3,11,0,0x00000000108949ca);
INSERT INTO alinkedlist VALUES (
4,104,'01                              ','HUANCAYO',3,12,0,0x00000000108949cb);
INSERT INTO alinkedlist VALUES (
4,105,'02                              ','CONCEPCION',3,12,0,0x00000000108949cc);
INSERT INTO alinkedlist VALUES (
4,106,'03                              ','JAUJA',3,12,0,0x00000000108949cd);
INSERT INTO alinkedlist VALUES (
4,107,'04                              ','JUNIN',3,12,0,0x00000000108949ce);
INSERT INTO alinkedlist VALUES (
4,108,'05                              ','TARMA',3,12,0,0x00000000108949cf);
INSERT INTO alinkedlist VALUES (
4,109,'06                              ','YAULI',3,12,0,0x00000000108949d0);
INSERT INTO alinkedlist VALUES (
4,110,'07                              ','SATIPO',3,12,0,0x00000000108949d1);
INSERT INTO alinkedlist VALUES (
4,111,'08                              ','CHANCHAMAYO',3,12,0,0x00000000108949d2);
INSERT INTO alinkedlist VALUES (
4,112,'09                              ','CHUPACA',3,12,0,0x00000000108949d3);
INSERT INTO alinkedlist VALUES (
4,113,'01                              ','TRUJILLO',3,13,0,0x00000000108949d4);
INSERT INTO alinkedlist VALUES (
4,114,'02                              ','BOLIVAR',3,13,0,0x00000000108949d5);
INSERT INTO alinkedlist VALUES (
4,115,'03                              ','SANCHEZ CARRION',3,13,0,0x00000000108949d6);
INSERT INTO alinkedlist VALUES (
4,116,'04                              ','OTUZCO',3,13,0,0x00000000108949d7);
INSERT INTO alinkedlist VALUES (
4,117,'05                              ','PACASMAYO',3,13,0,0x00000000108949d8);
INSERT INTO alinkedlist VALUES (
4,118,'06                              ','PATAZ',3,13,0,0x00000000108949d9);
INSERT INTO alinkedlist VALUES (
4,119,'07                              ','SANTIAGO DE CHUCO',3,13,0,0x00000000108949da);
INSERT INTO alinkedlist VALUES (
4,120,'08                              ','ASCOPE',3,13,0,0x00000000108949db);
INSERT INTO alinkedlist VALUES (
4,121,'09                              ','CHEPEN',3,13,0,0x00000000108949dc);
INSERT INTO alinkedlist VALUES (
4,122,'10                              ','JULCAN',3,13,0,0x00000000108949dd);
INSERT INTO alinkedlist VALUES (
4,123,'11                              ','GRAN CHIMU',3,13,0,0x00000000108949de);
INSERT INTO alinkedlist VALUES (
4,124,'12                              ','VIRU',3,13,0,0x00000000108949df);
INSERT INTO alinkedlist VALUES (
4,125,'01                              ','CHICLAYO',3,14,0,0x00000000108949e0);
INSERT INTO alinkedlist VALUES (
4,126,'02                              ','FERREÑAFE',3,14,0,0x00000000108949e1);
INSERT INTO alinkedlist VALUES (
4,127,'03                              ','LAMBAYEQUE',3,14,0,0x00000000108949e2);
INSERT INTO alinkedlist VALUES (
4,128,'01                              ','LIMA',3,15,0,0x00000000108949e3);
INSERT INTO alinkedlist VALUES (
4,129,'02                              ','CAJATAMBO',3,15,0,0x00000000108949e4);
INSERT INTO alinkedlist VALUES (
4,130,'03                              ','CANTA',3,15,0,0x00000000108949e5);
INSERT INTO alinkedlist VALUES (
4,131,'04                              ','CAÑETE',3,15,0,0x00000000108949e6);
INSERT INTO alinkedlist VALUES (
4,132,'05                              ','HUAURA',3,15,0,0x00000000108949e7);
INSERT INTO alinkedlist VALUES (
4,133,'06                              ','HUAROCHIRI',3,15,0,0x00000000108949e8);
INSERT INTO alinkedlist VALUES (
4,134,'07                              ','YAUYOS',3,15,0,0x00000000108949e9);
INSERT INTO alinkedlist VALUES (
4,135,'08                              ','HUARAL',3,15,0,0x00000000108949ea);
INSERT INTO alinkedlist VALUES (
4,136,'09                              ','BARRANCA',3,15,0,0x00000000108949eb);
INSERT INTO alinkedlist VALUES (
4,137,'10                              ','OYON',3,15,0,0x00000000108949ec);
INSERT INTO alinkedlist VALUES (
4,138,'01                              ','MAYNAS',3,16,0,0x00000000108949ed);
INSERT INTO alinkedlist VALUES (
4,139,'02                              ','ALTO AMAZONAS',3,16,0,0x00000000108949ee);
INSERT INTO alinkedlist VALUES (
4,140,'03                              ','LORETO',3,16,0,0x00000000108949ef);
INSERT INTO alinkedlist VALUES (
4,141,'04                              ','REQUENA',3,16,0,0x00000000108949f0);
INSERT INTO alinkedlist VALUES (
4,142,'05                              ','UCAYALI',3,16,0,0x00000000108949f1);
INSERT INTO alinkedlist VALUES (
4,143,'06                              ','MARISCAL RAMON CASTILLA',3,16,0,0x00000000108949f2);
INSERT INTO alinkedlist VALUES (
4,144,'07                              ','DATEM DEL MARAÑON',3,16,0,0x00000000108949f3);
INSERT INTO alinkedlist VALUES (
4,145,'01                              ','TAMBOPATA',3,17,0,0x00000000108949f4);
INSERT INTO alinkedlist VALUES (
4,146,'02                              ','MANU',3,17,0,0x00000000108949f5);
INSERT INTO alinkedlist VALUES (
4,147,'03                              ','TAHUAMANU',3,17,0,0x00000000108949f6);
INSERT INTO alinkedlist VALUES (
4,148,'01                              ','MARISCAL NIETO',3,18,0,0x00000000108949f7);
INSERT INTO alinkedlist VALUES (
4,149,'02                              ','GENERAL SANCHEZ CERRO',3,18,0,0x00000000108949f8);
INSERT INTO alinkedlist VALUES (
4,150,'03                              ','ILO',3,18,0,0x00000000108949f9);
INSERT INTO alinkedlist VALUES (
4,151,'01                              ','PASCO',3,19,0,0x00000000108949fa);
INSERT INTO alinkedlist VALUES (
4,152,'02                              ','DANIEL ALCIDES CARRION',3,19,0,0x00000000108949fb);
INSERT INTO alinkedlist VALUES (
4,153,'03                              ','OXAPAMPA',3,19,0,0x00000000108949fc);
INSERT INTO alinkedlist VALUES (
4,154,'01                              ','PIURA',3,20,0,0x00000000108949fd);
INSERT INTO alinkedlist VALUES (
4,155,'02                              ','AYABACA',3,20,0,0x00000000108949fe);
INSERT INTO alinkedlist VALUES (
4,156,'03                              ','HUANCABAMBA',3,20,0,0x00000000108949ff);
INSERT INTO alinkedlist VALUES (
4,157,'04                              ','MORROPON',3,20,0,0x0000000010894a01);
INSERT INTO alinkedlist VALUES (
4,158,'05                              ','PAITA',3,20,0,0x0000000010894a02);
INSERT INTO alinkedlist VALUES (
4,159,'06                              ','SULLANA',3,20,0,0x0000000010894a03);
INSERT INTO alinkedlist VALUES (
4,160,'07                              ','TALARA',3,20,0,0x0000000010894a04);
INSERT INTO alinkedlist VALUES (
4,161,'08                              ','SECHURA',3,20,0,0x0000000010894a05);
INSERT INTO alinkedlist VALUES (
4,162,'01                              ','PUNO',3,21,0,0x0000000010894a06);
INSERT INTO alinkedlist VALUES (
4,163,'02                              ','AZANGARO',3,21,0,0x0000000010894a07);
INSERT INTO alinkedlist VALUES (
4,164,'03                              ','CARABAYA',3,21,0,0x0000000010894a08);
INSERT INTO alinkedlist VALUES (
4,165,'04                              ','CHUCUITO',3,21,0,0x0000000010894a09);
INSERT INTO alinkedlist VALUES (
4,166,'05                              ','HUANCANE',3,21,0,0x0000000010894a0a);
INSERT INTO alinkedlist VALUES (
4,167,'06                              ','LAMPA',3,21,0,0x0000000010894a0b);
INSERT INTO alinkedlist VALUES (
4,168,'07                              ','MELGAR',3,21,0,0x0000000010894a0c);
INSERT INTO alinkedlist VALUES (
4,169,'08                              ','SANDIA',3,21,0,0x0000000010894a0d);
INSERT INTO alinkedlist VALUES (
4,170,'09                              ','SAN ROMAN',3,21,0,0x0000000010894a0e);
INSERT INTO alinkedlist VALUES (
4,171,'10                              ','YUNGUYO',3,21,0,0x0000000010894a0f);
INSERT INTO alinkedlist VALUES (
4,172,'11                              ','SAN ANTONIO DE PUTINA',3,21,0,0x0000000010894a10);
INSERT INTO alinkedlist VALUES (
4,173,'12                              ','EL COLLAO',3,21,0,0x0000000010894a11);
INSERT INTO alinkedlist VALUES (
4,174,'13                              ','MOHO',3,21,0,0x0000000010894a12);
INSERT INTO alinkedlist VALUES (
4,175,'01                              ','MOYOBAMBA',3,22,0,0x0000000010894a13);
INSERT INTO alinkedlist VALUES (
4,176,'02                              ','HUALLAGA',3,22,0,0x0000000010894a14);
INSERT INTO alinkedlist VALUES (
4,177,'03                              ','LAMAS',3,22,0,0x0000000010894a15);
INSERT INTO alinkedlist VALUES (
4,178,'04                              ','MARISCAL CACERES',3,22,0,0x0000000010894a16);
INSERT INTO alinkedlist VALUES (
4,179,'05                              ','RIOJA',3,22,0,0x0000000010894a17);
INSERT INTO alinkedlist VALUES (
4,180,'06                              ','SAN MARTIN',3,22,0,0x0000000010894a18);
INSERT INTO alinkedlist VALUES (
4,181,'07                              ','BELLAVISTA',3,22,0,0x0000000010894a19);
INSERT INTO alinkedlist VALUES (
4,182,'08                              ','TOCACHE',3,22,0,0x0000000010894a1a);
INSERT INTO alinkedlist VALUES (
4,183,'09                              ','PICOTA',3,22,0,0x0000000010894a1b);
INSERT INTO alinkedlist VALUES (
4,184,'10                              ','EL DORADO',3,22,0,0x0000000010894a1c);
INSERT INTO alinkedlist VALUES (
4,185,'01                              ','TACNA',3,23,0,0x0000000010894a1d);
INSERT INTO alinkedlist VALUES (
4,186,'02                              ','TARATA',3,23,0,0x0000000010894a1e);
INSERT INTO alinkedlist VALUES (
4,187,'03                              ','JORGE BASADRE',3,23,0,0x0000000010894a1f);
INSERT INTO alinkedlist VALUES (
4,188,'04                              ','CANDARAVE',3,23,0,0x0000000010894a20);
INSERT INTO alinkedlist VALUES (
4,189,'01                              ','TUMBES',3,24,0,0x0000000010894a21);
INSERT INTO alinkedlist VALUES (
4,190,'02                              ','CONTRALMIRANTE VILLAR',3,24,0,0x0000000010894a22);
INSERT INTO alinkedlist VALUES (
4,191,'03                              ','ZARUMILLA',3,24,0,0x0000000010894a23);
INSERT INTO alinkedlist VALUES (
4,192,'01                              ','CORONEL PORTILLO',3,25,0,0x0000000010894a24);
INSERT INTO alinkedlist VALUES (
4,193,'02                              ','PADRE ABAD',3,25,0,0x0000000010894a25);
INSERT INTO alinkedlist VALUES (
4,194,'03                              ','ATALAYA',3,25,0,0x0000000010894a26);
INSERT INTO alinkedlist VALUES (
4,195,'04                              ','PURUS',3,25,0,0x0000000010894a27);
INSERT INTO alinkedlist VALUES (
5,1,'01                              ','CHACHAPOYAS',4,1,0,0x0000000010894a28);
INSERT INTO alinkedlist VALUES (
5,2,'02                              ','ASUNCION',4,1,0,0x0000000010894a29);
INSERT INTO alinkedlist VALUES (
5,3,'03                              ','BALSAS',4,1,0,0x0000000010894a2a);
INSERT INTO alinkedlist VALUES (
5,4,'04                              ','CHETO',4,1,0,0x0000000010894a2b);
INSERT INTO alinkedlist VALUES (
5,5,'05                              ','CHILIQUIN',4,1,0,0x0000000010894a2c);
INSERT INTO alinkedlist VALUES (
5,6,'06                              ','CHUQUIBAMBA',4,1,0,0x0000000010894a2d);
INSERT INTO alinkedlist VALUES (
5,7,'07                              ','GRANADA',4,1,0,0x0000000010894a2e);
INSERT INTO alinkedlist VALUES (
5,8,'08                              ','HUANCAS',4,1,0,0x0000000010894a2f);
INSERT INTO alinkedlist VALUES (
5,9,'09                              ','LA JALCA',4,1,0,0x0000000010894a30);
INSERT INTO alinkedlist VALUES (
5,10,'10                              ','LEIMEBAMBA',4,1,0,0x0000000010894a31);
INSERT INTO alinkedlist VALUES (
5,11,'11                              ','LEVANTO',4,1,0,0x0000000010894a32);
INSERT INTO alinkedlist VALUES (
5,12,'12                              ','MAGDALENA',4,1,0,0x0000000010894a33);
INSERT INTO alinkedlist VALUES (
5,13,'13                              ','MARISCAL CASTILLA',4,1,0,0x0000000010894a34);
INSERT INTO alinkedlist VALUES (
5,14,'14                              ','MOLINOPAMPA',4,1,0,0x0000000010894a35);
INSERT INTO alinkedlist VALUES (
5,15,'15                              ','MONTEVIDEO',4,1,0,0x0000000010894a36);
INSERT INTO alinkedlist VALUES (
5,16,'16                              ','OLLEROS',4,1,0,0x0000000010894a37);
INSERT INTO alinkedlist VALUES (
5,17,'17                              ','QUINJALCA',4,1,0,0x0000000010894a38);
INSERT INTO alinkedlist VALUES (
5,18,'18                              ','SAN FRANCISCO DE DAGUAS',4,1,0,0x0000000010894a39);
INSERT INTO alinkedlist VALUES (
5,19,'20                              ','SAN ISIDRO DE MAINO',4,1,0,0x0000000010894a3a);
INSERT INTO alinkedlist VALUES (
5,20,'21                              ','SOLOCO',4,1,0,0x0000000010894a3b);
INSERT INTO alinkedlist VALUES (
5,21,'22                              ','SONCHE',4,1,0,0x0000000010894a3c);
INSERT INTO alinkedlist VALUES (
5,22,'01                              ','LA PECA',4,2,0,0x0000000010894a3d);
INSERT INTO alinkedlist VALUES (
5,23,'02                              ','ARAMANGO',4,2,0,0x0000000010894a3e);
INSERT INTO alinkedlist VALUES (
5,24,'03                              ','COPALLIN',4,2,0,0x0000000010894a3f);
INSERT INTO alinkedlist VALUES (
5,25,'04                              ','EL PARCO',4,2,0,0x0000000010894a40);
INSERT INTO alinkedlist VALUES (
5,26,'05                              ','BAGUA',4,2,0,0x0000000010894a41);
INSERT INTO alinkedlist VALUES (
5,27,'06                              ','IMAZA',4,2,0,0x0000000010894a42);
INSERT INTO alinkedlist VALUES (
5,28,'01                              ','JUMBILLA',4,3,0,0x0000000010894a43);
INSERT INTO alinkedlist VALUES (
5,29,'02                              ','COROSHA',4,3,0,0x0000000010894a44);
INSERT INTO alinkedlist VALUES (
5,30,'03                              ','CUISPES',4,3,0,0x0000000010894a45);
INSERT INTO alinkedlist VALUES (
5,31,'04                              ','CHISQUILLA',4,3,0,0x0000000010894a46);
INSERT INTO alinkedlist VALUES (
5,32,'05                              ','CHURUJA',4,3,0,0x0000000010894a47);
INSERT INTO alinkedlist VALUES (
5,33,'06                              ','FLORIDA',4,3,0,0x0000000010894a48);
INSERT INTO alinkedlist VALUES (
5,34,'07                              ','RECTA',4,3,0,0x0000000010894a49);
INSERT INTO alinkedlist VALUES (
5,35,'08                              ','SAN CARLOS',4,3,0,0x0000000010894a4a);
INSERT INTO alinkedlist VALUES (
5,36,'09                              ','SHIPASBAMBA',4,3,0,0x0000000010894a4b);
INSERT INTO alinkedlist VALUES (
5,37,'10                              ','VALERA',4,3,0,0x0000000010894a4c);
INSERT INTO alinkedlist VALUES (
5,38,'11                              ','YAMBRASBAMBA',4,3,0,0x0000000010894a4d);
INSERT INTO alinkedlist VALUES (
5,39,'12                              ','JAZAN',4,3,0,0x0000000010894a4e);
INSERT INTO alinkedlist VALUES (
5,40,'01                              ','LAMUD',4,4,0,0x0000000010894a4f);
INSERT INTO alinkedlist VALUES (
5,41,'02                              ','CAMPORREDONDO',4,4,0,0x0000000010894a50);
INSERT INTO alinkedlist VALUES (
5,42,'03                              ','COCABAMBA',4,4,0,0x0000000010894a51);
INSERT INTO alinkedlist VALUES (
5,43,'04                              ','COLCAMAR',4,4,0,0x0000000010894a52);
INSERT INTO alinkedlist VALUES (
5,44,'05                              ','CONILA',4,4,0,0x0000000010894a53);
INSERT INTO alinkedlist VALUES (
5,45,'06                              ','INGUILPATA',4,4,0,0x0000000010894a54);
INSERT INTO alinkedlist VALUES (
5,46,'07                              ','LONGUITA',4,4,0,0x0000000010894a55);
INSERT INTO alinkedlist VALUES (
5,47,'08                              ','LONYA CHICO',4,4,0,0x0000000010894a56);
INSERT INTO alinkedlist VALUES (
5,48,'09                              ','LUYA',4,4,0,0x0000000010894a57);
INSERT INTO alinkedlist VALUES (
5,49,'10                              ','LUYA VIEJO',4,4,0,0x0000000010894a58);
INSERT INTO alinkedlist VALUES (
5,50,'11                              ','MARIA',4,4,0,0x0000000010894a59);
INSERT INTO alinkedlist VALUES (
5,51,'12                              ','OCALLI',4,4,0,0x0000000010894a5a);
INSERT INTO alinkedlist VALUES (
5,52,'13                              ','OCUMAL',4,4,0,0x0000000010894a5b);
INSERT INTO alinkedlist VALUES (
5,53,'14                              ','PISUQUIA',4,4,0,0x0000000010894a5c);
INSERT INTO alinkedlist VALUES (
5,54,'15                              ','SAN CRISTOBAL',4,4,0,0x0000000010894a5d);
INSERT INTO alinkedlist VALUES (
5,55,'16                              ','SAN FRANCISCO DE YESO',4,4,0,0x0000000010894a5e);
INSERT INTO alinkedlist VALUES (
5,56,'17                              ','SAN JERONIMO',4,4,0,0x0000000010894a5f);
INSERT INTO alinkedlist VALUES (
5,57,'18                              ','SAN JUAN DE LOPECANCHA',4,4,0,0x0000000010894a60);
INSERT INTO alinkedlist VALUES (
5,58,'19                              ','SANTA CATALINA',4,4,0,0x0000000010b38fd6);
INSERT INTO alinkedlist VALUES (
5,59,'20                              ','SANTO TOMAS',4,4,0,0x0000000010b38fd7);
INSERT INTO alinkedlist VALUES (
5,60,'21                              ','TINGO',4,4,0,0x0000000010b38fd8);
INSERT INTO alinkedlist VALUES (
5,61,'22                              ','TRITA',4,4,0,0x0000000010b38fd9);
INSERT INTO alinkedlist VALUES (
5,62,'23                              ','PROVIDENCIA',4,4,0,0x0000000010894a65);
INSERT INTO alinkedlist VALUES (
5,63,'01                              ','SAN NICOLAS',4,5,0,0x0000000010894a66);
INSERT INTO alinkedlist VALUES (
5,64,'02                              ','COCHAMAL',4,5,0,0x0000000010894a67);
INSERT INTO alinkedlist VALUES (
5,65,'03                              ','CHIRIMOTO',4,5,0,0x0000000010894a68);
INSERT INTO alinkedlist VALUES (
5,66,'04                              ','HUAMBO',4,5,0,0x0000000010894a69);
INSERT INTO alinkedlist VALUES (
5,67,'05                              ','LIMABAMBA',4,5,0,0x0000000010894a6a);
INSERT INTO alinkedlist VALUES (
5,68,'06                              ','LONGAR',4,5,0,0x0000000010894a6b);
INSERT INTO alinkedlist VALUES (
5,69,'07                              ','MILPUCC',4,5,0,0x0000000010894a6c);
INSERT INTO alinkedlist VALUES (
5,70,'08                              ','MARISCAL BENAVIDES',4,5,0,0x0000000010894a6d);
INSERT INTO alinkedlist VALUES (
5,71,'09                              ','OMIA',4,5,0,0x0000000010894a6e);
INSERT INTO alinkedlist VALUES (
5,72,'10                              ','SANTA ROSA',4,5,0,0x0000000010894a6f);
INSERT INTO alinkedlist VALUES (
5,73,'11                              ','TOTORA',4,5,0,0x0000000010894a70);
INSERT INTO alinkedlist VALUES (
5,74,'12                              ','VISTA ALEGRE',4,5,0,0x0000000010894a71);
INSERT INTO alinkedlist VALUES (
5,75,'01                              ','NIEVA',4,6,0,0x0000000010894a72);
INSERT INTO alinkedlist VALUES (
5,76,'02                              ','RIO SANTIAGO',4,6,0,0x0000000010894a73);
INSERT INTO alinkedlist VALUES (
5,77,'03                              ','EL CENEPA',4,6,0,0x0000000010894a74);
INSERT INTO alinkedlist VALUES (
5,78,'01                              ','BAGUA GRANDE',4,7,0,0x0000000010894a75);
INSERT INTO alinkedlist VALUES (
5,79,'02                              ','CAJARURO',4,7,0,0x0000000010894a76);
INSERT INTO alinkedlist VALUES (
5,80,'03                              ','CUMBA',4,7,0,0x0000000010894a77);
INSERT INTO alinkedlist VALUES (
5,81,'04                              ','EL MILAGRO',4,7,0,0x0000000010894a78);
INSERT INTO alinkedlist VALUES (
5,82,'05                              ','JAMALCA',4,7,0,0x0000000010894a79);
INSERT INTO alinkedlist VALUES (
5,83,'06                              ','LONYA GRANDE',4,7,0,0x0000000010894a7a);
INSERT INTO alinkedlist VALUES (
5,84,'07                              ','YAMON',4,7,0,0x0000000010894a7b);
INSERT INTO alinkedlist VALUES (
5,85,'01                              ','HUARAZ',4,8,0,0x0000000010894a7c);
INSERT INTO alinkedlist VALUES (
5,86,'02                              ','INDEPENDENCIA',4,8,0,0x0000000010894a7d);
INSERT INTO alinkedlist VALUES (
5,87,'03                              ','COCHABAMBA',4,8,0,0x0000000010894a7e);
INSERT INTO alinkedlist VALUES (
5,88,'04                              ','COLCABAMBA',4,8,0,0x0000000010894a7f);
INSERT INTO alinkedlist VALUES (
5,89,'05                              ','HUANCHAY',4,8,0,0x0000000010894a80);
INSERT INTO alinkedlist VALUES (
5,90,'06                              ','JANGAS',4,8,0,0x0000000010894a81);
INSERT INTO alinkedlist VALUES (
5,91,'07                              ','LA LIBERTAD',4,8,0,0x0000000010894a82);
INSERT INTO alinkedlist VALUES (
5,92,'08                              ','OLLEROS',4,8,0,0x0000000010894a83);
INSERT INTO alinkedlist VALUES (
5,93,'09                              ','PAMPAS GRANDE',4,8,0,0x0000000010894a84);
INSERT INTO alinkedlist VALUES (
5,94,'10                              ','PARIACOTO',4,8,0,0x0000000010894a85);
INSERT INTO alinkedlist VALUES (
5,95,'11                              ','PIRA',4,8,0,0x0000000010894a86);
INSERT INTO alinkedlist VALUES (
5,96,'12                              ','TARICA',4,8,0,0x0000000010894a87);
INSERT INTO alinkedlist VALUES (
5,97,'01                              ','AIJA',4,9,0,0x0000000010894a88);
INSERT INTO alinkedlist VALUES (
5,98,'03                              ','CORIS',4,9,0,0x0000000010894a89);
INSERT INTO alinkedlist VALUES (
5,99,'05                              ','HUACLLAN',4,9,0,0x0000000010894a8a);
INSERT INTO alinkedlist VALUES (
5,100,'06                              ','LA MERCED',4,9,0,0x0000000010894a8b);
INSERT INTO alinkedlist VALUES (
5,101,'08                              ','SUCCHA',4,9,0,0x0000000010894a8c);
INSERT INTO alinkedlist VALUES (
5,102,'01                              ','CHIQUIAN',4,10,0,0x0000000010894a8d);
INSERT INTO alinkedlist VALUES (
5,103,'02                              ','ABELARDO PARDO LEZAMETA',4,10,0,0x0000000010894a8e);
INSERT INTO alinkedlist VALUES (
5,104,'04                              ','AQUIA',4,10,0,0x0000000010894a8f);
INSERT INTO alinkedlist VALUES (
5,105,'05                              ','CAJACAY',4,10,0,0x0000000010894a90);
INSERT INTO alinkedlist VALUES (
5,106,'10                              ','HUAYLLACAYAN',4,10,0,0x0000000010894a91);
INSERT INTO alinkedlist VALUES (
5,107,'11                              ','HUASTA',4,10,0,0x0000000010894a92);
INSERT INTO alinkedlist VALUES (
5,108,'13                              ','MANGAS',4,10,0,0x0000000010894a93);
INSERT INTO alinkedlist VALUES (
5,109,'15                              ','PACLLON',4,10,0,0x0000000010894a94);
INSERT INTO alinkedlist VALUES (
5,110,'17                              ','SAN MIGUEL DE CORPANQUI',4,10,0,0x0000000010894a95);
INSERT INTO alinkedlist VALUES (
5,111,'20                              ','TICLLOS',4,10,0,0x0000000010b39053);
INSERT INTO alinkedlist VALUES (
5,112,'21                              ','ANTONIO RAIMONDI',4,10,0,0x0000000010b39054);
INSERT INTO alinkedlist VALUES (
5,113,'22                              ','CANIS',4,10,0,0x0000000010b39055);
INSERT INTO alinkedlist VALUES (
5,114,'23                              ','COLQUIOC',4,10,0,0x0000000010894a99);
INSERT INTO alinkedlist VALUES (
5,115,'24                              ','LA PRIMAVERA',4,10,0,0x0000000010894a9a);
INSERT INTO alinkedlist VALUES (
5,116,'25                              ','HUALLANCA',4,10,0,0x0000000010894a9b);
INSERT INTO alinkedlist VALUES (
5,117,'01                              ','CARHUAZ',4,11,0,0x0000000010894a9c);
INSERT INTO alinkedlist VALUES (
5,118,'02                              ','ACOPAMPA',4,11,0,0x0000000010894a9d);
INSERT INTO alinkedlist VALUES (
5,119,'03                              ','AMASHCA',4,11,0,0x0000000010894a9e);
INSERT INTO alinkedlist VALUES (
5,120,'04                              ','ANTA',4,11,0,0x0000000010894a9f);
INSERT INTO alinkedlist VALUES (
5,121,'05                              ','ATAQUERO',4,11,0,0x0000000010894aa0);
INSERT INTO alinkedlist VALUES (
5,122,'06                              ','MARCARA',4,11,0,0x0000000010894aa1);
INSERT INTO alinkedlist VALUES (
5,123,'07                              ','PARIAHUANCA',4,11,0,0x0000000010894aa2);
INSERT INTO alinkedlist VALUES (
5,124,'08                              ','SAN MIGUEL DE ACO',4,11,0,0x0000000010894aa3);
INSERT INTO alinkedlist VALUES (
5,125,'09                              ','SHILLA',4,11,0,0x0000000010894aa4);
INSERT INTO alinkedlist VALUES (
5,126,'10                              ','TINCO',4,11,0,0x0000000010894aa5);
INSERT INTO alinkedlist VALUES (
5,127,'11                              ','YUNGAR',4,11,0,0x0000000010894aa6);
INSERT INTO alinkedlist VALUES (
5,128,'01                              ','CASMA',4,12,0,0x0000000010894aa7);
INSERT INTO alinkedlist VALUES (
5,129,'02                              ','BUENA VISTA ALTA',4,12,0,0x0000000010894aa8);
INSERT INTO alinkedlist VALUES (
5,130,'03                              ','COMANDANTE NOEL',4,12,0,0x0000000010894aa9);
INSERT INTO alinkedlist VALUES (
5,131,'05                              ','YAUTAN',4,12,0,0x0000000010894aaa);
INSERT INTO alinkedlist VALUES (
5,132,'01                              ','CORONGO',4,13,0,0x0000000010894aab);
INSERT INTO alinkedlist VALUES (
5,133,'02                              ','ACO',4,13,0,0x0000000010894aac);
INSERT INTO alinkedlist VALUES (
5,134,'03                              ','BAMBAS',4,13,0,0x0000000010894aad);
INSERT INTO alinkedlist VALUES (
5,135,'04                              ','CUSCA',4,13,0,0x0000000010894aae);
INSERT INTO alinkedlist VALUES (
5,136,'05                              ','LA PAMPA',4,13,0,0x0000000010894aaf);
INSERT INTO alinkedlist VALUES (
5,137,'06                              ','YANAC',4,13,0,0x0000000010894ab0);
INSERT INTO alinkedlist VALUES (
5,138,'07                              ','YUPAN',4,13,0,0x0000000010894ab1);
INSERT INTO alinkedlist VALUES (
5,139,'01                              ','CARAZ',4,14,0,0x0000000010894ab2);
INSERT INTO alinkedlist VALUES (
5,140,'02                              ','HUALLANCA',4,14,0,0x0000000010894ab3);
INSERT INTO alinkedlist VALUES (
5,141,'03                              ','HUATA',4,14,0,0x0000000010894ab4);
INSERT INTO alinkedlist VALUES (
5,142,'04                              ','HUAYLAS',4,14,0,0x0000000010894ab5);
INSERT INTO alinkedlist VALUES (
5,143,'05                              ','MATO',4,14,0,0x0000000010894ab6);
INSERT INTO alinkedlist VALUES (
5,144,'06                              ','PAMPAROMAS',4,14,0,0x0000000010894ab7);
INSERT INTO alinkedlist VALUES (
5,145,'07                              ','PUEBLO LIBRE',4,14,0,0x0000000010894ab8);
INSERT INTO alinkedlist VALUES (
5,146,'08                              ','SANTA CRUZ',4,14,0,0x0000000010894ab9);
INSERT INTO alinkedlist VALUES (
5,147,'09                              ','YURACMARCA',4,14,0,0x0000000010894aba);
INSERT INTO alinkedlist VALUES (
5,148,'10                              ','SANTO TORIBIO',4,14,0,0x0000000010894abb);
INSERT INTO alinkedlist VALUES (
5,149,'01                              ','HUARI',4,15,0,0x0000000010894abc);
INSERT INTO alinkedlist VALUES (
5,150,'02                              ','CAJAY',4,15,0,0x0000000010894abd);
INSERT INTO alinkedlist VALUES (
5,151,'03                              ','CHAVIN DE HUANTAR',4,15,0,0x0000000010894abe);
INSERT INTO alinkedlist VALUES (
5,152,'04                              ','HUACACHI',4,15,0,0x0000000010894abf);
INSERT INTO alinkedlist VALUES (
5,153,'05                              ','HUACHIS',4,15,0,0x0000000010894ac0);
INSERT INTO alinkedlist VALUES (
5,154,'06                              ','HUACCHIS',4,15,0,0x0000000010894ac1);
INSERT INTO alinkedlist VALUES (
5,155,'07                              ','HUANTAR',4,15,0,0x0000000010894ac2);
INSERT INTO alinkedlist VALUES (
5,156,'08                              ','MASIN',4,15,0,0x0000000010894ac3);
INSERT INTO alinkedlist VALUES (
5,157,'09                              ','PAUCAS',4,15,0,0x0000000010894ac4);
INSERT INTO alinkedlist VALUES (
5,158,'10                              ','PONTO',4,15,0,0x0000000010894ac5);
INSERT INTO alinkedlist VALUES (
5,159,'11                              ','RAHUAPAMPA',4,15,0,0x0000000010894ac6);
INSERT INTO alinkedlist VALUES (
5,160,'12                              ','RAPAYAN',4,15,0,0x0000000010894ac7);
INSERT INTO alinkedlist VALUES (
5,161,'13                              ','SAN MARCOS',4,15,0,0x0000000010894ac8);
INSERT INTO alinkedlist VALUES (
5,162,'14                              ','SAN PEDRO DE CHANA',4,15,0,0x0000000010894ac9);
INSERT INTO alinkedlist VALUES (
5,163,'15                              ','UCO',4,15,0,0x0000000010894aca);
INSERT INTO alinkedlist VALUES (
5,164,'16                              ','ANRA',4,15,0,0x0000000010894acb);
INSERT INTO alinkedlist VALUES (
5,165,'01                              ','PISCOBAMBA',4,16,0,0x0000000010894acc);
INSERT INTO alinkedlist VALUES (
5,166,'02                              ','CASCA',4,16,0,0x0000000010894acd);
INSERT INTO alinkedlist VALUES (
5,167,'03                              ','LUCMA',4,16,0,0x0000000010894ace);
INSERT INTO alinkedlist VALUES (
5,168,'04                              ','FIDEL OLIVAS ESCUDERO',4,16,0,0x0000000010894acf);
INSERT INTO alinkedlist VALUES (
5,169,'05                              ','LLAMA',4,16,0,0x0000000010894ad0);
INSERT INTO alinkedlist VALUES (
5,170,'06                              ','LLUMPA',4,16,0,0x0000000010894ad1);
INSERT INTO alinkedlist VALUES (
5,171,'07                              ','MUSGA',4,16,0,0x0000000010894ad2);
INSERT INTO alinkedlist VALUES (
5,172,'08                              ','ELEAZAR GUZMAN BARRON',4,16,0,0x0000000010894ad3);
INSERT INTO alinkedlist VALUES (
5,173,'01                              ','CABANA',4,17,0,0x0000000010894ad4);
INSERT INTO alinkedlist VALUES (
5,174,'02                              ','BOLOGNESI',4,17,0,0x0000000010894ad5);
INSERT INTO alinkedlist VALUES (
5,175,'03                              ','CONCHUCOS',4,17,0,0x0000000010894ad6);
INSERT INTO alinkedlist VALUES (
5,176,'04                              ','HUACASCHUQUE',4,17,0,0x0000000010894ad7);
INSERT INTO alinkedlist VALUES (
5,177,'05                              ','HUANDOVAL',4,17,0,0x0000000010894ad8);
INSERT INTO alinkedlist VALUES (
5,178,'06                              ','LACABAMBA',4,17,0,0x0000000010894ad9);
INSERT INTO alinkedlist VALUES (
5,179,'07                              ','LLAPO',4,17,0,0x0000000010894ada);
INSERT INTO alinkedlist VALUES (
5,180,'08                              ','PALLASCA',4,17,0,0x0000000010894adb);
INSERT INTO alinkedlist VALUES (
5,181,'09                              ','PAMPAS',4,17,0,0x0000000010894adc);
INSERT INTO alinkedlist VALUES (
5,182,'10                              ','SANTA ROSA',4,17,0,0x0000000010894add);
INSERT INTO alinkedlist VALUES (
5,183,'11                              ','TAUCA',4,17,0,0x0000000010894ade);
INSERT INTO alinkedlist VALUES (
5,184,'01                              ','POMABAMBA',4,18,0,0x0000000010894adf);
INSERT INTO alinkedlist VALUES (
5,185,'02                              ','HUAYLLAN',4,18,0,0x0000000010894ae0);
INSERT INTO alinkedlist VALUES (
5,186,'03                              ','PAROBAMBA',4,18,0,0x0000000010894ae1);
INSERT INTO alinkedlist VALUES (
5,187,'04                              ','QUINUABAMBA',4,18,0,0x0000000010894ae2);
INSERT INTO alinkedlist VALUES (
5,188,'01                              ','RECUAY',4,19,0,0x0000000010894ae3);
INSERT INTO alinkedlist VALUES (
5,189,'02                              ','COTAPARACO',4,19,0,0x0000000010894ae4);
INSERT INTO alinkedlist VALUES (
5,190,'03                              ','HUAYLLAPAMPA',4,19,0,0x0000000010894ae5);
INSERT INTO alinkedlist VALUES (
5,191,'04                              ','MARCA',4,19,0,0x0000000010894ae6);
INSERT INTO alinkedlist VALUES (
5,192,'05                              ','PAMPAS CHICO',4,19,0,0x0000000010894ae7);
INSERT INTO alinkedlist VALUES (
5,193,'06                              ','PARARIN',4,19,0,0x0000000010894ae8);
INSERT INTO alinkedlist VALUES (
5,194,'07                              ','TAPACOCHA',4,19,0,0x0000000010894ae9);
INSERT INTO alinkedlist VALUES (
5,195,'08                              ','TICAPAMPA',4,19,0,0x0000000010894aea);
INSERT INTO alinkedlist VALUES (
5,196,'09                              ','LLACLLIN',4,19,0,0x0000000010894aeb);
INSERT INTO alinkedlist VALUES (
5,197,'10                              ','CATAC',4,19,0,0x0000000010894aec);
INSERT INTO alinkedlist VALUES (
5,198,'01                              ','CHIMBOTE',4,20,0,0x0000000010894aed);
INSERT INTO alinkedlist VALUES (
5,199,'02                              ','CACERES DEL PERU',4,20,0,0x0000000010894aee);
INSERT INTO alinkedlist VALUES (
5,200,'03                              ','MACATE',4,20,0,0x0000000010894aef);
INSERT INTO alinkedlist VALUES (
5,201,'04                              ','MORO',4,20,0,0x0000000010894af0);
INSERT INTO alinkedlist VALUES (
5,202,'05                              ','NEPEÑA',4,20,0,0x0000000010894af1);
INSERT INTO alinkedlist VALUES (
5,203,'06                              ','SAMANCO',4,20,0,0x0000000010894af2);
INSERT INTO alinkedlist VALUES (
5,204,'07                              ','SANTA',4,20,0,0x0000000010894af3);
INSERT INTO alinkedlist VALUES (
5,205,'08                              ','COISHCO',4,20,0,0x0000000010894af4);
INSERT INTO alinkedlist VALUES (
5,206,'09                              ','NUEVO CHIMBOTE',4,20,0,0x0000000010894af5);
INSERT INTO alinkedlist VALUES (
5,207,'01                              ','SIHUAS',4,21,0,0x0000000010894af6);
INSERT INTO alinkedlist VALUES (
5,208,'02                              ','ALFONSO UGARTE',4,21,0,0x0000000010894af7);
INSERT INTO alinkedlist VALUES (
5,209,'03                              ','CHINGALPO',4,21,0,0x0000000010894af8);
INSERT INTO alinkedlist VALUES (
5,210,'04                              ','HUAYLLABAMBA',4,21,0,0x0000000010894af9);
INSERT INTO alinkedlist VALUES (
5,211,'05                              ','QUICHES',4,21,0,0x0000000010894afa);
INSERT INTO alinkedlist VALUES (
5,212,'06                              ','SICSIBAMBA',4,21,0,0x0000000010894afb);
INSERT INTO alinkedlist VALUES (
5,213,'07                              ','ACOBAMBA',4,21,0,0x0000000010894afc);
INSERT INTO alinkedlist VALUES (
5,214,'08                              ','CASHAPAMPA',4,21,0,0x0000000010894afd);
INSERT INTO alinkedlist VALUES (
5,215,'09                              ','RAGASH',4,21,0,0x0000000010894afe);
INSERT INTO alinkedlist VALUES (
5,216,'10                              ','SAN JUAN',4,21,0,0x0000000010894aff);
INSERT INTO alinkedlist VALUES (
5,217,'01                              ','YUNGAY',4,22,0,0x0000000010894b01);
INSERT INTO alinkedlist VALUES (
5,218,'02                              ','CASCAPARA',4,22,0,0x0000000010894b02);
INSERT INTO alinkedlist VALUES (
5,219,'03                              ','MANCOS',4,22,0,0x0000000010894b03);
INSERT INTO alinkedlist VALUES (
5,220,'04                              ','MATACOTO',4,22,0,0x0000000010894b04);
INSERT INTO alinkedlist VALUES (
5,221,'05                              ','QUILLO',4,22,0,0x0000000010894b05);
INSERT INTO alinkedlist VALUES (
5,222,'06                              ','RANRAHIRCA',4,22,0,0x0000000010894b06);
INSERT INTO alinkedlist VALUES (
5,223,'07                              ','SHUPLUY',4,22,0,0x0000000010894b07);
INSERT INTO alinkedlist VALUES (
5,224,'08                              ','YANAMA',4,22,0,0x0000000010894b08);
INSERT INTO alinkedlist VALUES (
5,225,'01                              ','LLAMELLIN',4,23,0,0x0000000010894b09);
INSERT INTO alinkedlist VALUES (
5,226,'02                              ','ACZO',4,23,0,0x0000000010894b0a);
INSERT INTO alinkedlist VALUES (
5,227,'03                              ','CHACCHO',4,23,0,0x0000000010894b0b);
INSERT INTO alinkedlist VALUES (
5,228,'04                              ','CHINGAS',4,23,0,0x0000000010894b0c);
INSERT INTO alinkedlist VALUES (
5,229,'05                              ','MIRGAS',4,23,0,0x0000000010894b0d);
INSERT INTO alinkedlist VALUES (
5,230,'06                              ','SAN JUAN DE RONTOY',4,23,0,0x0000000010894b0e);
INSERT INTO alinkedlist VALUES (
5,231,'01                              ','SAN LUIS',4,24,0,0x0000000010894b0f);
INSERT INTO alinkedlist VALUES (
5,232,'02                              ','YAUYA',4,24,0,0x0000000010894b10);
INSERT INTO alinkedlist VALUES (
5,233,'03                              ','SAN NICOLAS',4,24,0,0x0000000010894b11);
INSERT INTO alinkedlist VALUES (
5,234,'01                              ','CHACAS',4,25,0,0x0000000010894b12);
INSERT INTO alinkedlist VALUES (
5,235,'02                              ','ACOCHACA',4,25,0,0x0000000010894b13);
INSERT INTO alinkedlist VALUES (
5,236,'01                              ','HUARMEY',4,26,0,0x0000000010894b14);
INSERT INTO alinkedlist VALUES (
5,237,'02                              ','COCHAPETI',4,26,0,0x0000000010894b15);
INSERT INTO alinkedlist VALUES (
5,238,'03                              ','HUAYAN',4,26,0,0x0000000010894b16);
INSERT INTO alinkedlist VALUES (
5,239,'04                              ','MALVAS',4,26,0,0x0000000010894b17);
INSERT INTO alinkedlist VALUES (
5,240,'05                              ','CULEBRAS',4,26,0,0x0000000010894b18);
INSERT INTO alinkedlist VALUES (
5,241,'01                              ','ACAS',4,27,0,0x0000000010894b19);
INSERT INTO alinkedlist VALUES (
5,242,'02                              ','CAJAMARQUILLA',4,27,0,0x0000000010894b1a);
INSERT INTO alinkedlist VALUES (
5,243,'03                              ','CARHUAPAMPA',4,27,0,0x0000000010894b1b);
INSERT INTO alinkedlist VALUES (
5,244,'04                              ','COCHAS',4,27,0,0x0000000010894b1c);
INSERT INTO alinkedlist VALUES (
5,245,'05                              ','CONGAS',4,27,0,0x0000000010894b1d);
INSERT INTO alinkedlist VALUES (
5,246,'06                              ','LLIPA',4,27,0,0x0000000010894b1e);
INSERT INTO alinkedlist VALUES (
5,247,'07                              ','OCROS',4,27,0,0x0000000010894b1f);
INSERT INTO alinkedlist VALUES (
5,248,'08                              ','SAN CRISTOBAL DE RAJAN',4,27,0,0x0000000010894b20);
INSERT INTO alinkedlist VALUES (
5,249,'09                              ','SAN PEDRO',4,27,0,0x0000000010894b21);
INSERT INTO alinkedlist VALUES (
5,250,'10                              ','SANTIAGO DE CHILCAS',4,27,0,0x0000000010894b22);
INSERT INTO alinkedlist VALUES (
5,251,'01                              ','ABANCAY',4,28,0,0x0000000010894b23);
INSERT INTO alinkedlist VALUES (
5,252,'02                              ','CIRCA',4,28,0,0x0000000010894b24);
INSERT INTO alinkedlist VALUES (
5,253,'03                              ','CURAHUASI',4,28,0,0x0000000010894b25);
INSERT INTO alinkedlist VALUES (
5,254,'04                              ','CHACOCHE',4,28,0,0x0000000010894b26);
INSERT INTO alinkedlist VALUES (
5,255,'05                              ','HUANIPACA',4,28,0,0x0000000010894b27);
INSERT INTO alinkedlist VALUES (
5,256,'06                              ','LAMBRAMA',4,28,0,0x0000000010894b28);
INSERT INTO alinkedlist VALUES (
5,257,'07                              ','PICHIRHUA',4,28,0,0x0000000010894b29);
INSERT INTO alinkedlist VALUES (
5,258,'08                              ','SAN PEDRO DE CACHORA',4,28,0,0x0000000010894b2a);
INSERT INTO alinkedlist VALUES (
5,259,'09                              ','TAMBURCO',4,28,0,0x0000000010894b2b);
INSERT INTO alinkedlist VALUES (
5,260,'01                              ','CHALHUANCA',4,29,0,0x0000000010894b2c);
INSERT INTO alinkedlist VALUES (
5,261,'02                              ','CAPAYA',4,29,0,0x0000000010894b2d);
INSERT INTO alinkedlist VALUES (
5,262,'03                              ','CARAYBAMBA',4,29,0,0x0000000010894b2e);
INSERT INTO alinkedlist VALUES (
5,263,'04                              ','COLCABAMBA',4,29,0,0x0000000010894b2f);
INSERT INTO alinkedlist VALUES (
5,264,'05                              ','COTARUSE',4,29,0,0x0000000010894b30);
INSERT INTO alinkedlist VALUES (
5,265,'06                              ','CHAPIMARCA',4,29,0,0x0000000010894b31);
INSERT INTO alinkedlist VALUES (
5,266,'07                              ','HUAYLLO',4,29,0,0x0000000010894b32);
INSERT INTO alinkedlist VALUES (
5,267,'08                              ','LUCRE',4,29,0,0x0000000010894b33);
INSERT INTO alinkedlist VALUES (
5,268,'09                              ','POCOHUANCA',4,29,0,0x0000000010894b34);
INSERT INTO alinkedlist VALUES (
5,269,'10                              ','SAÑAYCA',4,29,0,0x0000000010894b35);
INSERT INTO alinkedlist VALUES (
5,270,'11                              ','SORAYA',4,29,0,0x0000000010894b36);
INSERT INTO alinkedlist VALUES (
5,271,'12                              ','TAPAIRIHUA',4,29,0,0x0000000010894b37);
INSERT INTO alinkedlist VALUES (
5,272,'13                              ','TINTAY',4,29,0,0x0000000010894b38);
INSERT INTO alinkedlist VALUES (
5,273,'14                              ','TORAYA',4,29,0,0x0000000010894b39);
INSERT INTO alinkedlist VALUES (
5,274,'15                              ','YANACA',4,29,0,0x0000000010894b3a);
INSERT INTO alinkedlist VALUES (
5,275,'16                              ','SAN JUAN DE CHACÑA',4,29,0,0x0000000010894b3b);
INSERT INTO alinkedlist VALUES (
5,276,'17                              ','JUSTO APU SAHUARAURA',4,29,0,0x0000000010894b3c);
INSERT INTO alinkedlist VALUES (
5,277,'01                              ','ANDAHUAYLAS',4,30,0,0x0000000010894b3d);
INSERT INTO alinkedlist VALUES (
5,278,'02                              ','ANDARAPA',4,30,0,0x0000000010894b3e);
INSERT INTO alinkedlist VALUES (
5,279,'03                              ','CHIARA',4,30,0,0x0000000010894b3f);
INSERT INTO alinkedlist VALUES (
5,280,'04                              ','HUANCARAMA',4,30,0,0x0000000010894b40);
INSERT INTO alinkedlist VALUES (
5,281,'05                              ','HUANCARAY',4,30,0,0x0000000010894b41);
INSERT INTO alinkedlist VALUES (
5,282,'06                              ','KISHUARA',4,30,0,0x0000000010894b42);
INSERT INTO alinkedlist VALUES (
5,283,'07                              ','PACOBAMBA',4,30,0,0x0000000010894b43);
INSERT INTO alinkedlist VALUES (
5,284,'08                              ','PAMPACHIRI',4,30,0,0x0000000010894b44);
INSERT INTO alinkedlist VALUES (
5,285,'09                              ','SAN ANTONIO DE CACHI',4,30,0,0x0000000010894b45);
INSERT INTO alinkedlist VALUES (
5,286,'10                              ','SAN JERONIMO',4,30,0,0x0000000010894b46);
INSERT INTO alinkedlist VALUES (
5,287,'11                              ','TALAVERA',4,30,0,0x0000000010894b47);
INSERT INTO alinkedlist VALUES (
5,288,'12                              ','TURPO',4,30,0,0x0000000010894b48);
INSERT INTO alinkedlist VALUES (
5,289,'13                              ','PACUCHA',4,30,0,0x0000000010894b49);
INSERT INTO alinkedlist VALUES (
5,290,'14                              ','POMACOCHA',4,30,0,0x0000000010894b4a);
INSERT INTO alinkedlist VALUES (
5,291,'15                              ','SANTA MARIA DE CHICMO',4,30,0,0x0000000010894b4b);
INSERT INTO alinkedlist VALUES (
5,292,'16                              ','TUMAY HUARACA',4,30,0,0x0000000010894b4c);
INSERT INTO alinkedlist VALUES (
5,293,'17                              ','HUAYANA',4,30,0,0x0000000010894b4d);
INSERT INTO alinkedlist VALUES (
5,294,'18                              ','SAN MIGUEL DE CHACCRAMPA',4,30,0,0x0000000010894b4e);
INSERT INTO alinkedlist VALUES (
5,295,'20                              ','KAQUIABAMBA',4,30,0,0x0000000010894b4f);
INSERT INTO alinkedlist VALUES (
5,296,'01                              ','ANTABAMBA',4,31,0,0x0000000010894b50);
INSERT INTO alinkedlist VALUES (
5,297,'02                              ','EL ORO',4,31,0,0x0000000010894b51);
INSERT INTO alinkedlist VALUES (
5,298,'03                              ','HUAQUIRCA',4,31,0,0x0000000010894b52);
INSERT INTO alinkedlist VALUES (
5,299,'04                              ','JUAN ESPINOZA MEDRANO',4,31,0,0x0000000010894b53);
INSERT INTO alinkedlist VALUES (
5,300,'05                              ','OROPESA',4,31,0,0x0000000010894b54);
INSERT INTO alinkedlist VALUES (
5,301,'06                              ','PACHACONAS',4,31,0,0x0000000010894b55);
INSERT INTO alinkedlist VALUES (
5,302,'07                              ','SABAINO',4,31,0,0x0000000010894b56);
INSERT INTO alinkedlist VALUES (
5,303,'01                              ','TAMBOBAMBA',4,32,0,0x0000000010894b57);
INSERT INTO alinkedlist VALUES (
5,304,'02                              ','COYLLURQUI',4,32,0,0x0000000010894b58);
INSERT INTO alinkedlist VALUES (
5,305,'03                              ','COTABAMBAS',4,32,0,0x0000000010894b59);
INSERT INTO alinkedlist VALUES (
5,306,'04                              ','HAQUIRA',4,32,0,0x0000000010894b5a);
INSERT INTO alinkedlist VALUES (
5,307,'05                              ','MARA',4,32,0,0x0000000010894b5b);
INSERT INTO alinkedlist VALUES (
5,308,'06                              ','CHALLHUAHUACHO',4,32,0,0x0000000010894b5c);
INSERT INTO alinkedlist VALUES (
5,309,'01                              ','CHUQUIBAMBILLA',4,33,0,0x0000000010894b5d);
INSERT INTO alinkedlist VALUES (
5,310,'02                              ','CURPAHUASI',4,33,0,0x0000000010894b5e);
INSERT INTO alinkedlist VALUES (
5,311,'03                              ','HUAILLATI',4,33,0,0x0000000010894b5f);
INSERT INTO alinkedlist VALUES (
5,312,'04                              ','MAMARA',4,33,0,0x0000000010894b60);
INSERT INTO alinkedlist VALUES (
5,313,'05                              ','MARISCAL GAMARRA',4,33,0,0x0000000010894b61);
INSERT INTO alinkedlist VALUES (
5,314,'06                              ','MICAELA BASTIDAS',4,33,0,0x0000000010894b62);
INSERT INTO alinkedlist VALUES (
5,315,'07                              ','PROGRESO',4,33,0,0x0000000010894b63);
INSERT INTO alinkedlist VALUES (
5,316,'08                              ','PATAYPAMPA',4,33,0,0x0000000010894b64);
INSERT INTO alinkedlist VALUES (
5,317,'09                              ','SAN ANTONIO',4,33,0,0x0000000010894b65);
INSERT INTO alinkedlist VALUES (
5,318,'10                              ','TURPAY',4,33,0,0x0000000010894b66);
INSERT INTO alinkedlist VALUES (
5,319,'11                              ','VILCABAMBA',4,33,0,0x0000000010894b67);
INSERT INTO alinkedlist VALUES (
5,320,'12                              ','VIRUNDO',4,33,0,0x0000000010894b68);
INSERT INTO alinkedlist VALUES (
5,321,'13                              ','SANTA ROSA',4,33,0,0x0000000010894b69);
INSERT INTO alinkedlist VALUES (
5,322,'14                              ','CURASCO',4,33,0,0x0000000010894b6a);
INSERT INTO alinkedlist VALUES (
5,323,'01                              ','CHINCHEROS',4,34,0,0x0000000010894b6b);
INSERT INTO alinkedlist VALUES (
5,324,'02                              ','ONGOY',4,34,0,0x0000000010894b6c);
INSERT INTO alinkedlist VALUES (
5,325,'03                              ','OCOBAMBA',4,34,0,0x0000000010894b6d);
INSERT INTO alinkedlist VALUES (
5,326,'04                              ','COCHARCAS',4,34,0,0x0000000010894b6e);
INSERT INTO alinkedlist VALUES (
5,327,'05                              ','ANCO HUALLO',4,34,0,0x0000000010894b6f);
INSERT INTO alinkedlist VALUES (
5,328,'06                              ','HUACCANA',4,34,0,0x0000000010894b70);
INSERT INTO alinkedlist VALUES (
5,329,'07                              ','URANMARCA',4,34,0,0x0000000010894b71);
INSERT INTO alinkedlist VALUES (
5,330,'08                              ','RANRACANCHA',4,34,0,0x0000000010894b72);
INSERT INTO alinkedlist VALUES (
5,331,'01                              ','AREQUIPA',4,35,0,0x0000000010894b73);
INSERT INTO alinkedlist VALUES (
5,332,'02                              ','CAYMA',4,35,0,0x0000000010894b74);
INSERT INTO alinkedlist VALUES (
5,333,'03                              ','CERRO COLORADO',4,35,0,0x0000000010894b75);
INSERT INTO alinkedlist VALUES (
5,334,'04                              ','CHARACATO',4,35,0,0x0000000010894b76);
INSERT INTO alinkedlist VALUES (
5,335,'05                              ','CHIGUATA',4,35,0,0x0000000010894b77);
INSERT INTO alinkedlist VALUES (
5,336,'06                              ','LA JOYA',4,35,0,0x0000000010894b78);
INSERT INTO alinkedlist VALUES (
5,337,'07                              ','MIRAFLORES',4,35,0,0x0000000010894b79);
INSERT INTO alinkedlist VALUES (
5,338,'08                              ','MOLLEBAYA',4,35,0,0x0000000010894b7a);
INSERT INTO alinkedlist VALUES (
5,339,'09                              ','PAUCARPATA',4,35,0,0x0000000010894b7b);
INSERT INTO alinkedlist VALUES (
5,340,'10                              ','POCSI',4,35,0,0x0000000010894b7c);
INSERT INTO alinkedlist VALUES (
5,341,'11                              ','POLOBAYA',4,35,0,0x0000000010894b7d);
INSERT INTO alinkedlist VALUES (
5,342,'12                              ','QUEQUEÑA',4,35,0,0x0000000010894b7e);
INSERT INTO alinkedlist VALUES (
5,343,'13                              ','SABANDIA',4,35,0,0x0000000010894b7f);
INSERT INTO alinkedlist VALUES (
5,344,'14                              ','SACHACA',4,35,0,0x0000000010894b80);
INSERT INTO alinkedlist VALUES (
5,345,'15                              ','SAN JUAN DE SIGUAS',4,35,0,0x0000000010894b81);
INSERT INTO alinkedlist VALUES (
5,346,'16                              ','SAN JUAN DE TARUCANI',4,35,0,0x0000000010894b82);
INSERT INTO alinkedlist VALUES (
5,347,'17                              ','SANTA ISABEL DE SIGUAS',4,35,0,0x0000000010894b83);
INSERT INTO alinkedlist VALUES (
5,348,'18                              ','SANTA RITA DE SIHUAS',4,35,0,0x0000000010894b84);
INSERT INTO alinkedlist VALUES (
5,349,'19                              ','SOCABAYA',4,35,0,0x0000000010b39058);
INSERT INTO alinkedlist VALUES (
5,350,'20                              ','TIABAYA',4,35,0,0x0000000010b39059);
INSERT INTO alinkedlist VALUES (
5,351,'21                              ','UCHUMAYO',4,35,0,0x0000000010b3905a);
INSERT INTO alinkedlist VALUES (
5,352,'22                              ','VITOR',4,35,0,0x0000000010b3905b);
INSERT INTO alinkedlist VALUES (
5,353,'23                              ','YANAHUARA',4,35,0,0x0000000010894b89);
INSERT INTO alinkedlist VALUES (
5,354,'24                              ','YARABAMBA',4,35,0,0x0000000010894b8a);
INSERT INTO alinkedlist VALUES (
5,355,'25                              ','YURA',4,35,0,0x0000000010894b8b);
INSERT INTO alinkedlist VALUES (
5,356,'26                              ','MARIANO MELGAR',4,35,0,0x0000000010894b8c);
INSERT INTO alinkedlist VALUES (
5,357,'27                              ','JACOBO HUNTER',4,35,0,0x0000000010894b8d);
INSERT INTO alinkedlist VALUES (
5,358,'28                              ','ALTO SELVA ALEGRE',4,35,0,0x0000000010894b8e);
INSERT INTO alinkedlist VALUES (
5,359,'29                              ','JOSE LUIS BUSTAMANTE Y RIVERO',4,35,0,0x0000000010894b8f);
INSERT INTO alinkedlist VALUES (
5,360,'01                              ','CHIVAY',4,36,0,0x0000000010894b90);
INSERT INTO alinkedlist VALUES (
5,361,'02                              ','ACHOMA',4,36,0,0x0000000010894b91);
INSERT INTO alinkedlist VALUES (
5,362,'03                              ','CABANACONDE',4,36,0,0x0000000010894b92);
INSERT INTO alinkedlist VALUES (
5,363,'04                              ','CAYLLOMA',4,36,0,0x0000000010894b93);
INSERT INTO alinkedlist VALUES (
5,364,'05                              ','CALLALLI',4,36,0,0x0000000010894b94);
INSERT INTO alinkedlist VALUES (
5,365,'06                              ','COPORAQUE',4,36,0,0x0000000010894b95);
INSERT INTO alinkedlist VALUES (
5,366,'07                              ','HUAMBO',4,36,0,0x0000000010894b96);
INSERT INTO alinkedlist VALUES (
5,367,'08                              ','HUANCA',4,36,0,0x0000000010894b97);
INSERT INTO alinkedlist VALUES (
5,368,'09                              ','ICHUPAMPA',4,36,0,0x0000000010894b98);
INSERT INTO alinkedlist VALUES (
5,369,'10                              ','LARI',4,36,0,0x0000000010894b99);
INSERT INTO alinkedlist VALUES (
5,370,'11                              ','LLUTA',4,36,0,0x0000000010894b9a);
INSERT INTO alinkedlist VALUES (
5,371,'12                              ','MACA',4,36,0,0x0000000010894b9b);
INSERT INTO alinkedlist VALUES (
5,372,'13                              ','MADRIGAL',4,36,0,0x0000000010894b9c);
INSERT INTO alinkedlist VALUES (
5,373,'14                              ','SAN ANTONIO DE CHUCA',4,36,0,0x0000000010894b9d);
INSERT INTO alinkedlist VALUES (
5,374,'15                              ','SIBAYO',4,36,0,0x0000000010894b9e);
INSERT INTO alinkedlist VALUES (
5,375,'16                              ','TAPAY',4,36,0,0x0000000010894b9f);
INSERT INTO alinkedlist VALUES (
5,376,'17                              ','TISCO',4,36,0,0x0000000010894ba0);
INSERT INTO alinkedlist VALUES (
5,377,'18                              ','TUTI',4,36,0,0x0000000010894ba1);
INSERT INTO alinkedlist VALUES (
5,378,'20                              ','YANQUE',4,36,0,0x0000000010894ba2);
INSERT INTO alinkedlist VALUES (
5,379,'21                              ','MAJES',4,36,0,0x0000000010894ba3);
INSERT INTO alinkedlist VALUES (
5,380,'01                              ','CAMANA',4,37,0,0x0000000010894ba4);
INSERT INTO alinkedlist VALUES (
5,381,'02                              ','JOSE MARIA QUIMPER',4,37,0,0x0000000010894ba5);
INSERT INTO alinkedlist VALUES (
5,382,'03                              ','MARIANO NICOLAS VALCARCEL',4,37,0,0x0000000010894ba6);
INSERT INTO alinkedlist VALUES (
5,383,'04                              ','MARISCAL CACERES',4,37,0,0x0000000010894ba7);
INSERT INTO alinkedlist VALUES (
5,384,'05                              ','NICOLAS DE PIEROLA',4,37,0,0x0000000010894ba8);
INSERT INTO alinkedlist VALUES (
5,385,'06                              ','OCOÑA',4,37,0,0x0000000010894ba9);
INSERT INTO alinkedlist VALUES (
5,386,'07                              ','QUILCA',4,37,0,0x0000000010894baa);
INSERT INTO alinkedlist VALUES (
5,387,'08                              ','SAMUEL PASTOR',4,37,0,0x0000000010894bab);
INSERT INTO alinkedlist VALUES (
5,388,'01                              ','CARAVELI',4,38,0,0x0000000010894bac);
INSERT INTO alinkedlist VALUES (
5,389,'02                              ','ACARI',4,38,0,0x0000000010894bad);
INSERT INTO alinkedlist VALUES (
5,390,'03                              ','ATICO',4,38,0,0x0000000010894bae);
INSERT INTO alinkedlist VALUES (
5,391,'04                              ','ATIQUIPA',4,38,0,0x0000000010894baf);
INSERT INTO alinkedlist VALUES (
5,392,'05                              ','BELLA UNION',4,38,0,0x0000000010894bb0);
INSERT INTO alinkedlist VALUES (
5,393,'06                              ','CAHUACHO',4,38,0,0x0000000010894bb1);
INSERT INTO alinkedlist VALUES (
5,394,'07                              ','CHALA',4,38,0,0x0000000010894bb2);
INSERT INTO alinkedlist VALUES (
5,395,'08                              ','CHAPARRA',4,38,0,0x0000000010894bb3);
INSERT INTO alinkedlist VALUES (
5,396,'09                              ','HUANUHUANU',4,38,0,0x0000000010894bb4);
INSERT INTO alinkedlist VALUES (
5,397,'10                              ','JAQUI',4,38,0,0x0000000010894bb5);
INSERT INTO alinkedlist VALUES (
5,398,'11                              ','LOMAS',4,38,0,0x0000000010894bb6);
INSERT INTO alinkedlist VALUES (
5,399,'12                              ','QUICACHA',4,38,0,0x0000000010894bb7);
INSERT INTO alinkedlist VALUES (
5,400,'13                              ','YAUCA',4,38,0,0x0000000010894bb8);
INSERT INTO alinkedlist VALUES (
5,401,'01                              ','APLAO',4,39,0,0x0000000010894bb9);
INSERT INTO alinkedlist VALUES (
5,402,'02                              ','ANDAGUA',4,39,0,0x0000000010894bba);
INSERT INTO alinkedlist VALUES (
5,403,'03                              ','AYO',4,39,0,0x0000000010894bbb);
INSERT INTO alinkedlist VALUES (
5,404,'04                              ','CHACHAS',4,39,0,0x0000000010894bbc);
INSERT INTO alinkedlist VALUES (
5,405,'05                              ','CHILCAYMARCA',4,39,0,0x0000000010894bbd);
INSERT INTO alinkedlist VALUES (
5,406,'06                              ','CHOCO',4,39,0,0x0000000010894bbe);
INSERT INTO alinkedlist VALUES (
5,407,'07                              ','HUANCARQUI',4,39,0,0x0000000010894bbf);
INSERT INTO alinkedlist VALUES (
5,408,'08                              ','MACHAGUAY',4,39,0,0x0000000010894bc0);
INSERT INTO alinkedlist VALUES (
5,409,'09                              ','ORCOPAMPA',4,39,0,0x0000000010894bc1);
INSERT INTO alinkedlist VALUES (
5,410,'10                              ','PAMPACOLCA',4,39,0,0x0000000010894bc2);
INSERT INTO alinkedlist VALUES (
5,411,'11                              ','TIPAN',4,39,0,0x0000000010894bc3);
INSERT INTO alinkedlist VALUES (
5,412,'12                              ','URACA',4,39,0,0x0000000010894bc4);
INSERT INTO alinkedlist VALUES (
5,413,'13                              ','UÑON',4,39,0,0x0000000010894bc5);
INSERT INTO alinkedlist VALUES (
5,414,'14                              ','VIRACO',4,39,0,0x0000000010894bc6);
INSERT INTO alinkedlist VALUES (
5,415,'01                              ','CHUQUIBAMBA',4,40,0,0x0000000010894bc7);
INSERT INTO alinkedlist VALUES (
5,416,'02                              ','ANDARAY',4,40,0,0x0000000010894bc8);
INSERT INTO alinkedlist VALUES (
5,417,'03                              ','CAYARANI',4,40,0,0x0000000010894bc9);
INSERT INTO alinkedlist VALUES (
5,418,'04                              ','CHICHAS',4,40,0,0x0000000010894bca);
INSERT INTO alinkedlist VALUES (
5,419,'05                              ','IRAY',4,40,0,0x0000000010894bcb);
INSERT INTO alinkedlist VALUES (
5,420,'06                              ','SALAMANCA',4,40,0,0x0000000010894bcc);
INSERT INTO alinkedlist VALUES (
5,421,'07                              ','YANAQUIHUA',4,40,0,0x0000000010894bcd);
INSERT INTO alinkedlist VALUES (
5,422,'08                              ','RIO GRANDE',4,40,0,0x0000000010894bce);
INSERT INTO alinkedlist VALUES (
5,423,'01                              ','MOLLENDO',4,41,0,0x0000000010894bcf);
INSERT INTO alinkedlist VALUES (
5,424,'02                              ','COCACHACRA',4,41,0,0x0000000010894bd0);
INSERT INTO alinkedlist VALUES (
5,425,'03                              ','DEAN VALDIVIA',4,41,0,0x0000000010894bd1);
INSERT INTO alinkedlist VALUES (
5,426,'04                              ','ISLAY',4,41,0,0x0000000010894bd2);
INSERT INTO alinkedlist VALUES (
5,427,'05                              ','MEJIA',4,41,0,0x0000000010894bd3);
INSERT INTO alinkedlist VALUES (
5,428,'06                              ','PUNTA DE BOMBON',4,41,0,0x0000000010894bd4);
INSERT INTO alinkedlist VALUES (
5,429,'01                              ','COTAHUASI',4,42,0,0x0000000010894bd5);
INSERT INTO alinkedlist VALUES (
5,430,'02                              ','ALCA',4,42,0,0x0000000010894bd6);
INSERT INTO alinkedlist VALUES (
5,431,'03                              ','CHARCANA',4,42,0,0x0000000010894bd7);
INSERT INTO alinkedlist VALUES (
5,432,'04                              ','HUAYNACOTAS',4,42,0,0x0000000010894bd8);
INSERT INTO alinkedlist VALUES (
5,433,'05                              ','PAMPAMARCA',4,42,0,0x0000000010894bd9);
INSERT INTO alinkedlist VALUES (
5,434,'06                              ','PUYCA',4,42,0,0x0000000010894bda);
INSERT INTO alinkedlist VALUES (
5,435,'07                              ','QUECHUALLA',4,42,0,0x0000000010894bdb);
INSERT INTO alinkedlist VALUES (
5,436,'08                              ','SAYLA',4,42,0,0x0000000010894bdc);
INSERT INTO alinkedlist VALUES (
5,437,'09                              ','TAURIA',4,42,0,0x0000000010894bdd);
INSERT INTO alinkedlist VALUES (
5,438,'10                              ','TOMEPAMPA',4,42,0,0x0000000010894bde);
INSERT INTO alinkedlist VALUES (
5,439,'11                              ','TORO',4,42,0,0x0000000010894bdf);
INSERT INTO alinkedlist VALUES (
5,440,'01                              ','AYACUCHO',4,43,0,0x0000000010894be0);
INSERT INTO alinkedlist VALUES (
5,441,'02                              ','ACOS VINCHOS',4,43,0,0x0000000010894be1);
INSERT INTO alinkedlist VALUES (
5,442,'03                              ','CARMEN ALTO',4,43,0,0x0000000010894be2);
INSERT INTO alinkedlist VALUES (
5,443,'04                              ','CHIARA',4,43,0,0x0000000010894be3);
INSERT INTO alinkedlist VALUES (
5,444,'05                              ','QUINUA',4,43,0,0x0000000010894be4);
INSERT INTO alinkedlist VALUES (
5,445,'06                              ','SAN JOSE DE TICLLAS',4,43,0,0x0000000010894be5);
INSERT INTO alinkedlist VALUES (
5,446,'07                              ','SAN JUAN BAUTISTA',4,43,0,0x0000000010894be6);
INSERT INTO alinkedlist VALUES (
5,447,'08                              ','SANTIAGO DE PISCHA',4,43,0,0x0000000010894be7);
INSERT INTO alinkedlist VALUES (
5,448,'09                              ','VINCHOS',4,43,0,0x0000000010894be8);
INSERT INTO alinkedlist VALUES (
5,449,'10                              ','TAMBILLO',4,43,0,0x0000000010894be9);
INSERT INTO alinkedlist VALUES (
5,450,'11                              ','ACOCRO',4,43,0,0x0000000010894bea);
INSERT INTO alinkedlist VALUES (
5,451,'12                              ','SOCOS',4,43,0,0x0000000010894beb);
INSERT INTO alinkedlist VALUES (
5,452,'13                              ','OCROS',4,43,0,0x0000000010894bec);
INSERT INTO alinkedlist VALUES (
5,453,'14                              ','PACAYCASA',4,43,0,0x0000000010894bed);
INSERT INTO alinkedlist VALUES (
5,454,'15                              ','JESUS NAZARENO',4,43,0,0x0000000010894bee);
INSERT INTO alinkedlist VALUES (
5,455,'01                              ','CANGALLO',4,44,0,0x0000000010894bef);
INSERT INTO alinkedlist VALUES (
5,456,'04                              ','CHUSCHI',4,44,0,0x0000000010894bf0);
INSERT INTO alinkedlist VALUES (
5,457,'06                              ','LOS MOROCHUCOS',4,44,0,0x0000000010894bf1);
INSERT INTO alinkedlist VALUES (
5,458,'07                              ','PARAS',4,44,0,0x0000000010894bf2);
INSERT INTO alinkedlist VALUES (
5,459,'08                              ','TOTOS',4,44,0,0x0000000010894bf3);
INSERT INTO alinkedlist VALUES (
5,460,'11                              ','MARIA PARADO DE BELLIDO',4,44,0,0x0000000010894bf4);
INSERT INTO alinkedlist VALUES (
5,461,'01                              ','HUANTA',4,45,0,0x0000000010894bf5);
INSERT INTO alinkedlist VALUES (
5,462,'02                              ','AYAHUANCO',4,45,0,0x0000000010894bf6);
INSERT INTO alinkedlist VALUES (
5,463,'03                              ','HUAMANGUILLA',4,45,0,0x0000000010894bf7);
INSERT INTO alinkedlist VALUES (
5,464,'04                              ','IGUAIN',4,45,0,0x0000000010894bf8);
INSERT INTO alinkedlist VALUES (
5,465,'05                              ','LURICOCHA',4,45,0,0x0000000010894bf9);
INSERT INTO alinkedlist VALUES (
5,466,'07                              ','SANTILLANA',4,45,0,0x0000000010894bfa);
INSERT INTO alinkedlist VALUES (
5,467,'08                              ','SIVIA',4,45,0,0x0000000010894bfb);
INSERT INTO alinkedlist VALUES (
5,468,'09                              ','LLOCHEGUA',4,45,0,0x0000000010894bfc);
INSERT INTO alinkedlist VALUES (
5,469,'01                              ','SAN MIGUEL',4,46,0,0x0000000010894bfd);
INSERT INTO alinkedlist VALUES (
5,470,'02                              ','ANCO',4,46,0,0x0000000010894bfe);
INSERT INTO alinkedlist VALUES (
5,471,'03                              ','AYNA',4,46,0,0x0000000010894bff);
INSERT INTO alinkedlist VALUES (
5,472,'04                              ','CHILCAS',4,46,0,0x0000000010894c01);
INSERT INTO alinkedlist VALUES (
5,473,'05                              ','CHUNGUI',4,46,0,0x0000000010894c02);
INSERT INTO alinkedlist VALUES (
5,474,'06                              ','TAMBO',4,46,0,0x0000000010894c03);
INSERT INTO alinkedlist VALUES (
5,475,'07                              ','LUIS CARRANZA',4,46,0,0x0000000010894c04);
INSERT INTO alinkedlist VALUES (
5,476,'08                              ','SANTA ROSA',4,46,0,0x0000000010894c05);
INSERT INTO alinkedlist VALUES (
5,477,'09                              ','SAMUGARI',4,46,0,0x0000000010894c06);
INSERT INTO alinkedlist VALUES (
5,478,'01                              ','PUQUIO',4,47,0,0x0000000010894c07);
INSERT INTO alinkedlist VALUES (
5,479,'02                              ','AUCARA',4,47,0,0x0000000010894c08);
INSERT INTO alinkedlist VALUES (
5,480,'03                              ','CABANA',4,47,0,0x0000000010894c09);
INSERT INTO alinkedlist VALUES (
5,481,'04                              ','CARMEN SALCEDO',4,47,0,0x0000000010894c0a);
INSERT INTO alinkedlist VALUES (
5,482,'06                              ','CHAVIÑA',4,47,0,0x0000000010894c0b);
INSERT INTO alinkedlist VALUES (
5,483,'08                              ','CHIPAO',4,47,0,0x0000000010894c0c);
INSERT INTO alinkedlist VALUES (
5,484,'10                              ','HUAC-HUAS',4,47,0,0x0000000010894c0d);
INSERT INTO alinkedlist VALUES (
5,485,'11                              ','LARAMATE',4,47,0,0x0000000010894c0e);
INSERT INTO alinkedlist VALUES (
5,486,'12                              ','LEONCIO PRADO',4,47,0,0x0000000010894c0f);
INSERT INTO alinkedlist VALUES (
5,487,'13                              ','LUCANAS',4,47,0,0x0000000010894c10);
INSERT INTO alinkedlist VALUES (
5,488,'14                              ','LLAUTA',4,47,0,0x0000000010894c11);
INSERT INTO alinkedlist VALUES (
5,489,'16                              ','OCAÑA',4,47,0,0x0000000010894c12);
INSERT INTO alinkedlist VALUES (
5,490,'17                              ','OTOCA',4,47,0,0x0000000010894c13);
INSERT INTO alinkedlist VALUES (
5,491,'21                              ','SANCOS',4,47,0,0x0000000010894c14);
INSERT INTO alinkedlist VALUES (
5,492,'22                              ','SAN JUAN',4,47,0,0x0000000010894c15);
INSERT INTO alinkedlist VALUES (
5,493,'23                              ','SAN PEDRO',4,47,0,0x0000000010894c16);
INSERT INTO alinkedlist VALUES (
5,494,'24                              ','SANTA ANA DE HUAYCAHUACHO',4,47,0,0x0000000010894c17);
INSERT INTO alinkedlist VALUES (
5,495,'25                              ','SANTA LUCIA',4,47,0,0x0000000010894c18);
INSERT INTO alinkedlist VALUES (
5,496,'29                              ','SAISA',4,47,0,0x0000000010894c19);
INSERT INTO alinkedlist VALUES (
5,497,'31                              ','SAN PEDRO DE PALCO',4,47,0,0x0000000010894c1a);
INSERT INTO alinkedlist VALUES (
5,498,'32                              ','SAN CRISTOBAL',4,47,0,0x0000000010894c1b);
INSERT INTO alinkedlist VALUES (
5,499,'01                              ','CORACORA',4,48,0,0x0000000010894c1c);
INSERT INTO alinkedlist VALUES (
5,500,'04                              ','CORONEL CASTAÑEDA',4,48,0,0x0000000010894c1d);
INSERT INTO alinkedlist VALUES (
5,501,'05                              ','CHUMPI',4,48,0,0x0000000010894c1e);
INSERT INTO alinkedlist VALUES (
5,502,'08                              ','PACAPAUSA',4,48,0,0x0000000010894c1f);
INSERT INTO alinkedlist VALUES (
5,503,'11                              ','PULLO',4,48,0,0x0000000010894c20);
INSERT INTO alinkedlist VALUES (
5,504,'12                              ','PUYUSCA',4,48,0,0x0000000010894c21);
INSERT INTO alinkedlist VALUES (
5,505,'15                              ','SAN FRANCISCO DE RAVACAYCO',4,48,0,0x0000000010894c22);
INSERT INTO alinkedlist VALUES (
5,506,'16                              ','UPAHUACHO',4,48,0,0x0000000010894c23);
INSERT INTO alinkedlist VALUES (
5,507,'01                              ','HUANCAPI',4,49,0,0x0000000010894c24);
INSERT INTO alinkedlist VALUES (
5,508,'02                              ','ALCAMENCA',4,49,0,0x0000000010894c25);
INSERT INTO alinkedlist VALUES (
5,509,'03                              ','APONGO',4,49,0,0x0000000010894c26);
INSERT INTO alinkedlist VALUES (
5,510,'04                              ','CANARIA',4,49,0,0x0000000010894c27);
INSERT INTO alinkedlist VALUES (
5,511,'06                              ','CAYARA',4,49,0,0x0000000010894c28);
INSERT INTO alinkedlist VALUES (
5,512,'07                              ','COLCA',4,49,0,0x0000000010894c29);
INSERT INTO alinkedlist VALUES (
5,513,'08                              ','HUALLA',4,49,0,0x0000000010894c2a);
INSERT INTO alinkedlist VALUES (
5,514,'09                              ','HUAMANQUIQUIA',4,49,0,0x0000000010894c2b);
INSERT INTO alinkedlist VALUES (
5,515,'10                              ','HUANCARAYLLA',4,49,0,0x0000000010894c2c);
INSERT INTO alinkedlist VALUES (
5,516,'13                              ','SARHUA',4,49,0,0x0000000010894c2d);
INSERT INTO alinkedlist VALUES (
5,517,'14                              ','VILCANCHOS',4,49,0,0x0000000010894c2e);
INSERT INTO alinkedlist VALUES (
5,518,'15                              ','ASQUIPATA',4,49,0,0x0000000010894c2f);
INSERT INTO alinkedlist VALUES (
5,519,'01                              ','SANCOS',4,50,0,0x0000000010894c30);
INSERT INTO alinkedlist VALUES (
5,520,'02                              ','SACSAMARCA',4,50,0,0x0000000010894c31);
INSERT INTO alinkedlist VALUES (
5,521,'03                              ','SANTIAGO DE LUCANAMARCA',4,50,0,0x0000000010894c32);
INSERT INTO alinkedlist VALUES (
5,522,'04                              ','CARAPO',4,50,0,0x0000000010894c33);
INSERT INTO alinkedlist VALUES (
5,523,'01                              ','VILCAS HUAMAN',4,51,0,0x0000000010894c34);
INSERT INTO alinkedlist VALUES (
5,524,'02                              ','VISCHONGO',4,51,0,0x0000000010894c35);
INSERT INTO alinkedlist VALUES (
5,525,'03                              ','ACCOMARCA',4,51,0,0x0000000010894c36);
INSERT INTO alinkedlist VALUES (
5,526,'04                              ','CARHUANCA',4,51,0,0x0000000010894c37);
INSERT INTO alinkedlist VALUES (
5,527,'05                              ','CONCEPCION',4,51,0,0x0000000010894c38);
INSERT INTO alinkedlist VALUES (
5,528,'06                              ','HUAMBALPA',4,51,0,0x0000000010894c39);
INSERT INTO alinkedlist VALUES (
5,529,'07                              ','SAURAMA',4,51,0,0x0000000010894c3a);
INSERT INTO alinkedlist VALUES (
5,530,'08                              ','INDEPENDENCIA',4,51,0,0x0000000010894c3b);
INSERT INTO alinkedlist VALUES (
5,531,'01                              ','PAUSA',4,52,0,0x0000000010894c3c);
INSERT INTO alinkedlist VALUES (
5,532,'02                              ','COLTA',4,52,0,0x0000000010894c3d);
INSERT INTO alinkedlist VALUES (
5,533,'03                              ','CORCULLA',4,52,0,0x0000000010894c3e);
INSERT INTO alinkedlist VALUES (
5,534,'04                              ','LAMPA',4,52,0,0x0000000010894c3f);
INSERT INTO alinkedlist VALUES (
5,535,'05                              ','MARCABAMBA',4,52,0,0x0000000010894c40);
INSERT INTO alinkedlist VALUES (
5,536,'06                              ','OYOLO',4,52,0,0x0000000010894c41);
INSERT INTO alinkedlist VALUES (
5,537,'07                              ','PARARCA',4,52,0,0x0000000010894c42);
INSERT INTO alinkedlist VALUES (
5,538,'08                              ','SAN JAVIER DE ALPABAMBA',4,52,0,0x0000000010894c43);
INSERT INTO alinkedlist VALUES (
5,539,'09                              ','SAN JOSE DE USHUA',4,52,0,0x0000000010894c44);
INSERT INTO alinkedlist VALUES (
5,540,'10                              ','SARA SARA',4,52,0,0x0000000010894c45);
INSERT INTO alinkedlist VALUES (
5,541,'01                              ','QUEROBAMBA',4,53,0,0x0000000010894c46);
INSERT INTO alinkedlist VALUES (
5,542,'02                              ','BELEN',4,53,0,0x0000000010894c47);
INSERT INTO alinkedlist VALUES (
5,543,'03                              ','CHALCOS',4,53,0,0x0000000010894c48);
INSERT INTO alinkedlist VALUES (
5,544,'04                              ','SAN SALVADOR DE QUIJE',4,53,0,0x0000000010894c49);
INSERT INTO alinkedlist VALUES (
5,545,'05                              ','PAICO',4,53,0,0x0000000010894c4a);
INSERT INTO alinkedlist VALUES (
5,546,'06                              ','SANTIAGO DE PAUCARAY',4,53,0,0x0000000010894c4b);
INSERT INTO alinkedlist VALUES (
5,547,'07                              ','SAN PEDRO DE LARCAY',4,53,0,0x0000000010894c4c);
INSERT INTO alinkedlist VALUES (
5,548,'08                              ','SORAS',4,53,0,0x0000000010894c4d);
INSERT INTO alinkedlist VALUES (
5,549,'09                              ','HUACAÑA',4,53,0,0x0000000010894c4e);
INSERT INTO alinkedlist VALUES (
5,550,'10                              ','CHILCAYOC',4,53,0,0x0000000010894c4f);
INSERT INTO alinkedlist VALUES (
5,551,'11                              ','MORCOLLA',4,53,0,0x0000000010894c50);
INSERT INTO alinkedlist VALUES (
5,552,'01                              ','CAJAMARCA',4,54,0,0x0000000010894c51);
INSERT INTO alinkedlist VALUES (
5,553,'02                              ','ASUNCION',4,54,0,0x0000000010894c52);
INSERT INTO alinkedlist VALUES (
5,554,'03                              ','COSPAN',4,54,0,0x0000000010894c53);
INSERT INTO alinkedlist VALUES (
5,555,'04                              ','CHETILLA',4,54,0,0x0000000010894c54);
INSERT INTO alinkedlist VALUES (
5,556,'05                              ','ENCAÑADA',4,54,0,0x0000000010894c55);
INSERT INTO alinkedlist VALUES (
5,557,'06                              ','JESUS',4,54,0,0x0000000010894c56);
INSERT INTO alinkedlist VALUES (
5,558,'07                              ','LOS BAÑOS DEL INCA',4,54,0,0x0000000010894c57);
INSERT INTO alinkedlist VALUES (
5,559,'08                              ','LLACANORA',4,54,0,0x0000000010894c58);
INSERT INTO alinkedlist VALUES (
5,560,'09                              ','MAGDALENA',4,54,0,0x0000000010894c59);
INSERT INTO alinkedlist VALUES (
5,561,'10                              ','MATARA',4,54,0,0x0000000010894c5a);
INSERT INTO alinkedlist VALUES (
5,562,'11                              ','NAMORA',4,54,0,0x0000000010894c5b);
INSERT INTO alinkedlist VALUES (
5,563,'12                              ','SAN JUAN',4,54,0,0x0000000010894c5c);
INSERT INTO alinkedlist VALUES (
5,564,'01                              ','CAJABAMBA',4,55,0,0x0000000010894c5d);
INSERT INTO alinkedlist VALUES (
5,565,'02                              ','CACHACHI',4,55,0,0x0000000010894c5e);
INSERT INTO alinkedlist VALUES (
5,566,'03                              ','CONDEBAMBA',4,55,0,0x0000000010894c5f);
INSERT INTO alinkedlist VALUES (
5,567,'05                              ','SITACOCHA',4,55,0,0x0000000010894c60);
INSERT INTO alinkedlist VALUES (
5,568,'01                              ','CELENDIN',4,56,0,0x0000000010894c61);
INSERT INTO alinkedlist VALUES (
5,569,'02                              ','CORTEGANA',4,56,0,0x0000000010894c62);
INSERT INTO alinkedlist VALUES (
5,570,'03                              ','CHUMUCH',4,56,0,0x0000000010894c63);
INSERT INTO alinkedlist VALUES (
5,571,'04                              ','HUASMIN',4,56,0,0x0000000010894c64);
INSERT INTO alinkedlist VALUES (
5,572,'05                              ','JORGE CHAVEZ',4,56,0,0x0000000010894c65);
INSERT INTO alinkedlist VALUES (
5,573,'06                              ','JOSE GALVEZ',4,56,0,0x0000000010894c66);
INSERT INTO alinkedlist VALUES (
5,574,'07                              ','MIGUEL IGLESIAS',4,56,0,0x0000000010894c67);
INSERT INTO alinkedlist VALUES (
5,575,'08                              ','OXAMARCA',4,56,0,0x0000000010894c68);
INSERT INTO alinkedlist VALUES (
5,576,'09                              ','SOROCHUCO',4,56,0,0x0000000010894c69);
INSERT INTO alinkedlist VALUES (
5,577,'10                              ','SUCRE',4,56,0,0x0000000010894c6a);
INSERT INTO alinkedlist VALUES (
5,578,'11                              ','UTCO',4,56,0,0x0000000010894c6b);
INSERT INTO alinkedlist VALUES (
5,579,'12                              ','LA LIBERTAD DE PALLAN',4,56,0,0x0000000010894c6c);
INSERT INTO alinkedlist VALUES (
5,580,'01                              ','CONTUMAZA',4,57,0,0x0000000010894c6d);
INSERT INTO alinkedlist VALUES (
5,581,'03                              ','CHILETE',4,57,0,0x0000000010894c6e);
INSERT INTO alinkedlist VALUES (
5,582,'04                              ','GUZMANGO',4,57,0,0x0000000010894c6f);
INSERT INTO alinkedlist VALUES (
5,583,'05                              ','SAN BENITO',4,57,0,0x0000000010894c70);
INSERT INTO alinkedlist VALUES (
5,584,'06                              ','CUPISNIQUE',4,57,0,0x0000000010894c71);
INSERT INTO alinkedlist VALUES (
5,585,'07                              ','TANTARICA',4,57,0,0x0000000010894c72);
INSERT INTO alinkedlist VALUES (
5,586,'08                              ','YONAN',4,57,0,0x0000000010894c73);
INSERT INTO alinkedlist VALUES (
5,587,'09                              ','SANTA CRUZ DE TOLED',4,57,0,0x0000000010894c74);
INSERT INTO alinkedlist VALUES (
5,588,'01                              ','CUTERVO',4,58,0,0x0000000010894c75);
INSERT INTO alinkedlist VALUES (
5,589,'02                              ','CALLAYUC',4,58,0,0x0000000010894c76);
INSERT INTO alinkedlist VALUES (
5,590,'03                              ','CUJILLO',4,58,0,0x0000000010894c77);
INSERT INTO alinkedlist VALUES (
5,591,'04                              ','CHOROS',4,58,0,0x0000000010894c78);
INSERT INTO alinkedlist VALUES (
5,592,'05                              ','LA RAMADA',4,58,0,0x0000000010894c79);
INSERT INTO alinkedlist VALUES (
5,593,'06                              ','PIMPINGOS',4,58,0,0x0000000010894c7a);
INSERT INTO alinkedlist VALUES (
5,594,'07                              ','QUEROCOTILLO',4,58,0,0x0000000010894c7b);
INSERT INTO alinkedlist VALUES (
5,595,'08                              ','SAN ANDRES DE CUTERVO',4,58,0,0x0000000010894c7c);
INSERT INTO alinkedlist VALUES (
5,596,'09                              ','SAN JUAN DE CUTERVO',4,58,0,0x0000000010894c7d);
INSERT INTO alinkedlist VALUES (
5,597,'10                              ','SAN LUIS DE LUCMA',4,58,0,0x0000000010894c7e);
INSERT INTO alinkedlist VALUES (
5,598,'11                              ','SANTA CRUZ',4,58,0,0x0000000010894c7f);
INSERT INTO alinkedlist VALUES (
5,599,'12                              ','SANTO DOMINGO DE LA CAPILLA',4,58,0,0x0000000010894c80);
INSERT INTO alinkedlist VALUES (
5,600,'13                              ','SANTO TOMAS',4,58,0,0x0000000010894c81);
INSERT INTO alinkedlist VALUES (
5,601,'14                              ','SOCOTA',4,58,0,0x0000000010894c82);
INSERT INTO alinkedlist VALUES (
5,602,'15                              ','TORIBIO CASANOVA',4,58,0,0x0000000010894c83);
INSERT INTO alinkedlist VALUES (
5,603,'01                              ','CHOTA',4,59,0,0x0000000010894c84);
INSERT INTO alinkedlist VALUES (
5,604,'02                              ','ANGUIA',4,59,0,0x0000000010894c85);
INSERT INTO alinkedlist VALUES (
5,605,'03                              ','COCHABAMBA',4,59,0,0x0000000010894c86);
INSERT INTO alinkedlist VALUES (
5,606,'04                              ','CONCHAN',4,59,0,0x0000000010894c87);
INSERT INTO alinkedlist VALUES (
5,607,'05                              ','CHADIN',4,59,0,0x0000000010894c88);
INSERT INTO alinkedlist VALUES (
5,608,'06                              ','CHIGUIRIP',4,59,0,0x0000000010894c89);
INSERT INTO alinkedlist VALUES (
5,609,'07                              ','CHIMBAN',4,59,0,0x0000000010894c8a);
INSERT INTO alinkedlist VALUES (
5,610,'08                              ','HUAMBOS',4,59,0,0x0000000010894c8b);
INSERT INTO alinkedlist VALUES (
5,611,'09                              ','LAJAS',4,59,0,0x0000000010894c8c);
INSERT INTO alinkedlist VALUES (
5,612,'10                              ','LLAMA',4,59,0,0x0000000010894c8d);
INSERT INTO alinkedlist VALUES (
5,613,'11                              ','MIRACOSTA',4,59,0,0x0000000010894c8e);
INSERT INTO alinkedlist VALUES (
5,614,'12                              ','PACCHA',4,59,0,0x0000000010894c8f);
INSERT INTO alinkedlist VALUES (
5,615,'13                              ','PION',4,59,0,0x0000000010894c90);
INSERT INTO alinkedlist VALUES (
5,616,'14                              ','QUEROCOTO',4,59,0,0x0000000010894c91);
INSERT INTO alinkedlist VALUES (
5,617,'15                              ','TACABAMBA',4,59,0,0x0000000010894c92);
INSERT INTO alinkedlist VALUES (
5,618,'16                              ','TOCMOCHE',4,59,0,0x0000000010894c93);
INSERT INTO alinkedlist VALUES (
5,619,'17                              ','SAN JUAN DE LICUPIS',4,59,0,0x0000000010894c94);
INSERT INTO alinkedlist VALUES (
5,620,'18                              ','CHOROPAMPA',4,59,0,0x0000000010894c95);
INSERT INTO alinkedlist VALUES (
5,621,'20                              ','CHALAMARCA',4,59,0,0x0000000010894c96);
INSERT INTO alinkedlist VALUES (
5,622,'01                              ','BAMBAMARCA',4,60,0,0x0000000010894c97);
INSERT INTO alinkedlist VALUES (
5,623,'02                              ','CHUGUR',4,60,0,0x0000000010894c98);
INSERT INTO alinkedlist VALUES (
5,624,'03                              ','HUALGAYOC',4,60,0,0x0000000010894c99);
INSERT INTO alinkedlist VALUES (
5,625,'01                              ','JAEN',4,61,0,0x0000000010894c9a);
INSERT INTO alinkedlist VALUES (
5,626,'02                              ','BELLAVISTA',4,61,0,0x0000000010894c9b);
INSERT INTO alinkedlist VALUES (
5,627,'03                              ','COLASAY',4,61,0,0x0000000010894c9c);
INSERT INTO alinkedlist VALUES (
5,628,'04                              ','CHONTALI',4,61,0,0x0000000010894c9d);
INSERT INTO alinkedlist VALUES (
5,629,'05                              ','POMAHUACA',4,61,0,0x0000000010894c9e);
INSERT INTO alinkedlist VALUES (
5,630,'06                              ','PUCARA',4,61,0,0x0000000010894c9f);
INSERT INTO alinkedlist VALUES (
5,631,'07                              ','SALLIQUE',4,61,0,0x0000000010894ca0);
INSERT INTO alinkedlist VALUES (
5,632,'08                              ','SAN FELIPE',4,61,0,0x0000000010894ca1);
INSERT INTO alinkedlist VALUES (
5,633,'09                              ','SAN JOSE DEL ALTO',4,61,0,0x0000000010894ca2);
INSERT INTO alinkedlist VALUES (
5,634,'10                              ','SANTA ROSA',4,61,0,0x0000000010894ca3);
INSERT INTO alinkedlist VALUES (
5,635,'11                              ','LAS PIRIAS',4,61,0,0x0000000010894ca4);
INSERT INTO alinkedlist VALUES (
5,636,'12                              ','HUABAL',4,61,0,0x0000000010894ca5);
INSERT INTO alinkedlist VALUES (
5,637,'01                              ','SANTA CRUZ',4,62,0,0x0000000010894ca6);
INSERT INTO alinkedlist VALUES (
5,638,'02                              ','CATACHE',4,62,0,0x0000000010894ca7);
INSERT INTO alinkedlist VALUES (
5,639,'03                              ','CHANCAYBAÑOS',4,62,0,0x0000000010894ca8);
INSERT INTO alinkedlist VALUES (
5,640,'04                              ','LA ESPERANZA',4,62,0,0x0000000010894ca9);
INSERT INTO alinkedlist VALUES (
5,641,'05                              ','NINABAMBA',4,62,0,0x0000000010894caa);
INSERT INTO alinkedlist VALUES (
5,642,'06                              ','PULAN',4,62,0,0x0000000010894cab);
INSERT INTO alinkedlist VALUES (
5,643,'07                              ','SEXI',4,62,0,0x0000000010894cac);
INSERT INTO alinkedlist VALUES (
5,644,'08                              ','UTICYACU',4,62,0,0x0000000010894cad);
INSERT INTO alinkedlist VALUES (
5,645,'09                              ','YAUYUCAN',4,62,0,0x0000000010894cae);
INSERT INTO alinkedlist VALUES (
5,646,'10                              ','ANDABAMBA',4,62,0,0x0000000010894caf);
INSERT INTO alinkedlist VALUES (
5,647,'11                              ','SAUCEPAMPA',4,62,0,0x0000000010894cb0);
INSERT INTO alinkedlist VALUES (
5,648,'01                              ','SAN MIGUEL',4,63,0,0x0000000010894cb1);
INSERT INTO alinkedlist VALUES (
5,649,'02                              ','CALQUIS',4,63,0,0x0000000010894cb2);
INSERT INTO alinkedlist VALUES (
5,650,'03                              ','LA FLORIDA',4,63,0,0x0000000010894cb3);
INSERT INTO alinkedlist VALUES (
5,651,'04                              ','LLAPA',4,63,0,0x0000000010894cb4);
INSERT INTO alinkedlist VALUES (
5,652,'05                              ','NANCHOC',4,63,0,0x0000000010894cb5);
INSERT INTO alinkedlist VALUES (
5,653,'06                              ','NIEPOS',4,63,0,0x0000000010894cb6);
INSERT INTO alinkedlist VALUES (
5,654,'07                              ','SAN GREGORIO',4,63,0,0x0000000010894cb7);
INSERT INTO alinkedlist VALUES (
5,655,'08                              ','SAN SILVESTRE DE COCHAN',4,63,0,0x0000000010894cb8);
INSERT INTO alinkedlist VALUES (
5,656,'09                              ','EL PRADO',4,63,0,0x0000000010894cb9);
INSERT INTO alinkedlist VALUES (
5,657,'10                              ','UNION AGUA BLANCA',4,63,0,0x0000000010894cba);
INSERT INTO alinkedlist VALUES (
5,658,'11                              ','TONGOD',4,63,0,0x0000000010894cbb);
INSERT INTO alinkedlist VALUES (
5,659,'12                              ','CATILLUC',4,63,0,0x0000000010894cbc);
INSERT INTO alinkedlist VALUES (
5,660,'13                              ','BOLIVAR',4,63,0,0x0000000010894cbd);
INSERT INTO alinkedlist VALUES (
5,661,'01                              ','SAN IGNACIO',4,64,0,0x0000000010894cbe);
INSERT INTO alinkedlist VALUES (
5,662,'02                              ','CHIRINOS',4,64,0,0x0000000010894cbf);
INSERT INTO alinkedlist VALUES (
5,663,'03                              ','HUARANGO',4,64,0,0x0000000010894cc0);
INSERT INTO alinkedlist VALUES (
5,664,'04                              ','NAMBALLE',4,64,0,0x0000000010894cc1);
INSERT INTO alinkedlist VALUES (
5,665,'05                              ','LA COIPA',4,64,0,0x0000000010894cc2);
INSERT INTO alinkedlist VALUES (
5,666,'06                              ','SAN JOSE DE LOURDES',4,64,0,0x0000000010894cc3);
INSERT INTO alinkedlist VALUES (
5,667,'07                              ','TABACONAS',4,64,0,0x0000000010894cc4);
INSERT INTO alinkedlist VALUES (
5,668,'01                              ','PEDRO GALVEZ',4,65,0,0x0000000010894cc5);
INSERT INTO alinkedlist VALUES (
5,669,'02                              ','ICHOCAN',4,65,0,0x0000000010894cc6);
INSERT INTO alinkedlist VALUES (
5,670,'03                              ','GREGORIO PITA',4,65,0,0x0000000010894cc7);
INSERT INTO alinkedlist VALUES (
5,671,'04                              ','JOSE MANUEL QUIROZ',4,65,0,0x0000000010894cc8);
INSERT INTO alinkedlist VALUES (
5,672,'05                              ','EDUARDO VILLANUEVA',4,65,0,0x0000000010894cc9);
INSERT INTO alinkedlist VALUES (
5,673,'06                              ','JOSE SABOGAL',4,65,0,0x0000000010894cca);
INSERT INTO alinkedlist VALUES (
5,674,'07                              ','CHANCAY',4,65,0,0x0000000010894ccb);
INSERT INTO alinkedlist VALUES (
5,675,'01                              ','SAN PABLO',4,66,0,0x0000000010894ccc);
INSERT INTO alinkedlist VALUES (
5,676,'02                              ','SAN BERNARDINO',4,66,0,0x0000000010894ccd);
INSERT INTO alinkedlist VALUES (
5,677,'03                              ','SAN LUIS',4,66,0,0x0000000010894cce);
INSERT INTO alinkedlist VALUES (
5,678,'04                              ','TUMBADEN',4,66,0,0x0000000010894ccf);
INSERT INTO alinkedlist VALUES (
5,679,'01                              ','CALLAO',4,67,0,0x0000000010894cd0);
INSERT INTO alinkedlist VALUES (
5,680,'02                              ','BELLAVISTA',4,67,0,0x0000000010894cd1);
INSERT INTO alinkedlist VALUES (
5,681,'03                              ','LA PUNTA',4,67,0,0x0000000010894cd2);
INSERT INTO alinkedlist VALUES (
5,682,'04                              ','CARMEN DE LA LEGUA-REYNOSO',4,67,0,0x0000000010894cd3);
INSERT INTO alinkedlist VALUES (
5,683,'05                              ','LA PERLA',4,67,0,0x0000000010894cd4);
INSERT INTO alinkedlist VALUES (
5,684,'06                              ','VENTANILLA',4,67,0,0x0000000010894cd5);
INSERT INTO alinkedlist VALUES (
5,685,'01                              ','CUSCO',4,68,0,0x0000000010894cd6);
INSERT INTO alinkedlist VALUES (
5,686,'02                              ','CCORCA',4,68,0,0x0000000010894cd7);
INSERT INTO alinkedlist VALUES (
5,687,'03                              ','POROY',4,68,0,0x0000000010894cd8);
INSERT INTO alinkedlist VALUES (
5,688,'04                              ','SAN JERONIMO',4,68,0,0x0000000010894cd9);
INSERT INTO alinkedlist VALUES (
5,689,'05                              ','SAN SEBASTIAN',4,68,0,0x0000000010894cda);
INSERT INTO alinkedlist VALUES (
5,690,'06                              ','SANTIAGO',4,68,0,0x0000000010894cdb);
INSERT INTO alinkedlist VALUES (
5,691,'07                              ','SAYLLA',4,68,0,0x0000000010894cdc);
INSERT INTO alinkedlist VALUES (
5,692,'08                              ','WANCHAQ',4,68,0,0x0000000010894cdd);
INSERT INTO alinkedlist VALUES (
5,693,'01                              ','ACOMAYO',4,69,0,0x0000000010894cde);
INSERT INTO alinkedlist VALUES (
5,694,'02                              ','ACOPIA',4,69,0,0x0000000010894cdf);
INSERT INTO alinkedlist VALUES (
5,695,'03                              ','ACOS',4,69,0,0x0000000010894ce0);
INSERT INTO alinkedlist VALUES (
5,696,'04                              ','POMACANCHI',4,69,0,0x0000000010894ce1);
INSERT INTO alinkedlist VALUES (
5,697,'05                              ','RONDOCAN',4,69,0,0x0000000010894ce2);
INSERT INTO alinkedlist VALUES (
5,698,'06                              ','SANGARARA',4,69,0,0x0000000010894ce3);
INSERT INTO alinkedlist VALUES (
5,699,'07                              ','MOSOC LLACTA',4,69,0,0x0000000010894ce4);
INSERT INTO alinkedlist VALUES (
5,700,'01                              ','ANTA',4,70,0,0x0000000010894ce5);
INSERT INTO alinkedlist VALUES (
5,701,'02                              ','CHINCHAYPUJIO',4,70,0,0x0000000010894ce6);
INSERT INTO alinkedlist VALUES (
5,702,'03                              ','HUAROCONDO',4,70,0,0x0000000010894ce7);
INSERT INTO alinkedlist VALUES (
5,703,'04                              ','LIMATAMBO',4,70,0,0x0000000010894ce8);
INSERT INTO alinkedlist VALUES (
5,704,'05                              ','MOLLEPATA',4,70,0,0x0000000010894ce9);
INSERT INTO alinkedlist VALUES (
5,705,'06                              ','PUCYURA',4,70,0,0x0000000010894cea);
INSERT INTO alinkedlist VALUES (
5,706,'07                              ','ZURITE',4,70,0,0x0000000010894ceb);
INSERT INTO alinkedlist VALUES (
5,707,'08                              ','CACHIMAYO',4,70,0,0x0000000010894cec);
INSERT INTO alinkedlist VALUES (
5,708,'09                              ','ANCAHUASI',4,70,0,0x0000000010894ced);
INSERT INTO alinkedlist VALUES (
5,709,'01                              ','CALCA',4,71,0,0x0000000010894cee);
INSERT INTO alinkedlist VALUES (
5,710,'02                              ','COYA',4,71,0,0x0000000010894cef);
INSERT INTO alinkedlist VALUES (
5,711,'03                              ','LAMAY',4,71,0,0x0000000010894cf0);
INSERT INTO alinkedlist VALUES (
5,712,'04                              ','LARES',4,71,0,0x0000000010894cf1);
INSERT INTO alinkedlist VALUES (
5,713,'05                              ','PISAC',4,71,0,0x0000000010894cf2);
INSERT INTO alinkedlist VALUES (
5,714,'06                              ','SAN SALVADOR',4,71,0,0x0000000010894cf3);
INSERT INTO alinkedlist VALUES (
5,715,'07                              ','TARAY',4,71,0,0x0000000010894cf4);
INSERT INTO alinkedlist VALUES (
5,716,'08                              ','YANATILE',4,71,0,0x0000000010894cf5);
INSERT INTO alinkedlist VALUES (
5,717,'01                              ','YANAOCA',4,72,0,0x0000000010894cf6);
INSERT INTO alinkedlist VALUES (
5,718,'02                              ','CHECCA',4,72,0,0x0000000010894cf7);
INSERT INTO alinkedlist VALUES (
5,719,'03                              ','KUNTURKANKI',4,72,0,0x0000000010894cf8);
INSERT INTO alinkedlist VALUES (
5,720,'04                              ','LANGUI',4,72,0,0x0000000010894cf9);
INSERT INTO alinkedlist VALUES (
5,721,'05                              ','LAYO',4,72,0,0x0000000010894cfa);
INSERT INTO alinkedlist VALUES (
5,722,'06                              ','PAMPAMARCA',4,72,0,0x0000000010894cfb);
INSERT INTO alinkedlist VALUES (
5,723,'07                              ','QUEHUE',4,72,0,0x0000000010894cfc);
INSERT INTO alinkedlist VALUES (
5,724,'08                              ','TUPAC AMARU',4,72,0,0x0000000010894cfd);
INSERT INTO alinkedlist VALUES (
5,725,'01                              ','SICUANI',4,73,0,0x0000000010894cfe);
INSERT INTO alinkedlist VALUES (
5,726,'02                              ','COMBAPATA',4,73,0,0x0000000010894cff);
INSERT INTO alinkedlist VALUES (
5,727,'03                              ','CHECACUPE',4,73,0,0x0000000010894d01);
INSERT INTO alinkedlist VALUES (
5,728,'04                              ','MARANGANI',4,73,0,0x0000000010894d02);
INSERT INTO alinkedlist VALUES (
5,729,'05                              ','PITUMARCA',4,73,0,0x0000000010894d03);
INSERT INTO alinkedlist VALUES (
5,730,'06                              ','SAN PABLO',4,73,0,0x0000000010894d04);
INSERT INTO alinkedlist VALUES (
5,731,'07                              ','SAN PEDRO',4,73,0,0x0000000010894d05);
INSERT INTO alinkedlist VALUES (
5,732,'08                              ','TINTA',4,73,0,0x0000000010894d06);
INSERT INTO alinkedlist VALUES (
5,733,'01                              ','SANTO TOMAS',4,74,0,0x0000000010894d07);
INSERT INTO alinkedlist VALUES (
5,734,'02                              ','CAPACMARCA',4,74,0,0x0000000010894d08);
INSERT INTO alinkedlist VALUES (
5,735,'03                              ','COLQUEMARCA',4,74,0,0x0000000010894d09);
INSERT INTO alinkedlist VALUES (
5,736,'04                              ','CHAMACA',4,74,0,0x0000000010894d0a);
INSERT INTO alinkedlist VALUES (
5,737,'05                              ','LIVITACA',4,74,0,0x0000000010894d0b);
INSERT INTO alinkedlist VALUES (
5,738,'06                              ','LLUSCO',4,74,0,0x0000000010894d0c);
INSERT INTO alinkedlist VALUES (
5,739,'07                              ','QUIÑOTA',4,74,0,0x0000000010894d0d);
INSERT INTO alinkedlist VALUES (
5,740,'08                              ','VELILLE',4,74,0,0x0000000010894d0e);
INSERT INTO alinkedlist VALUES (
5,741,'01                              ','ESPINAR',4,75,0,0x0000000010894d0f);
INSERT INTO alinkedlist VALUES (
5,742,'02                              ','CONDOROMA',4,75,0,0x0000000010894d10);
INSERT INTO alinkedlist VALUES (
5,743,'03                              ','COPORAQUE',4,75,0,0x0000000010894d11);
INSERT INTO alinkedlist VALUES (
5,744,'04                              ','OCORURO',4,75,0,0x0000000010894d12);
INSERT INTO alinkedlist VALUES (
5,745,'05                              ','PALLPATA',4,75,0,0x0000000010894d13);
INSERT INTO alinkedlist VALUES (
5,746,'06                              ','PICHIGUA',4,75,0,0x0000000010894d14);
INSERT INTO alinkedlist VALUES (
5,747,'07                              ','SUYCKUTAMBO',4,75,0,0x0000000010894d15);
INSERT INTO alinkedlist VALUES (
5,748,'08                              ','ALTO PICHIGUA',4,75,0,0x0000000010894d16);
INSERT INTO alinkedlist VALUES (
5,749,'01                              ','SANTA ANA',4,76,0,0x0000000010894d17);
INSERT INTO alinkedlist VALUES (
5,750,'02                              ','ECHARATE',4,76,0,0x0000000010894d18);
INSERT INTO alinkedlist VALUES (
5,751,'03                              ','HUAYOPATA',4,76,0,0x0000000010894d19);
INSERT INTO alinkedlist VALUES (
5,752,'04                              ','MARANURA',4,76,0,0x0000000010894d1a);
INSERT INTO alinkedlist VALUES (
5,753,'05                              ','OCOBAMBA',4,76,0,0x0000000010894d1b);
INSERT INTO alinkedlist VALUES (
5,754,'06                              ','SANTA TERESA',4,76,0,0x0000000010894d1c);
INSERT INTO alinkedlist VALUES (
5,755,'07                              ','VILCABAMBA',4,76,0,0x0000000010894d1d);
INSERT INTO alinkedlist VALUES (
5,756,'08                              ','QUELLOUNO',4,76,0,0x0000000010894d1e);
INSERT INTO alinkedlist VALUES (
5,757,'09                              ','KIMBIRI',4,76,0,0x0000000010894d1f);
INSERT INTO alinkedlist VALUES (
5,758,'10                              ','PICHARI',4,76,0,0x0000000010894d20);
INSERT INTO alinkedlist VALUES (
5,759,'01                              ','PARURO',4,77,0,0x0000000010894d21);
INSERT INTO alinkedlist VALUES (
5,760,'02                              ','ACCHA',4,77,0,0x0000000010894d22);
INSERT INTO alinkedlist VALUES (
5,761,'03                              ','CCAPI',4,77,0,0x0000000010894d23);
INSERT INTO alinkedlist VALUES (
5,762,'04                              ','COLCHA',4,77,0,0x0000000010894d24);
INSERT INTO alinkedlist VALUES (
5,763,'05                              ','HUANOQUITE',4,77,0,0x0000000010894d25);
INSERT INTO alinkedlist VALUES (
5,764,'06                              ','OMACHA',4,77,0,0x0000000010894d26);
INSERT INTO alinkedlist VALUES (
5,765,'07                              ','YAURISQUE',4,77,0,0x0000000010894d27);
INSERT INTO alinkedlist VALUES (
5,766,'08                              ','PACCARITAMBO',4,77,0,0x0000000010894d28);
INSERT INTO alinkedlist VALUES (
5,767,'09                              ','PILLPINTO',4,77,0,0x0000000010894d29);
INSERT INTO alinkedlist VALUES (
5,768,'01                              ','PAUCARTAMBO',4,78,0,0x0000000010894d2a);
INSERT INTO alinkedlist VALUES (
5,769,'02                              ','CAICAY',4,78,0,0x0000000010894d2b);
INSERT INTO alinkedlist VALUES (
5,770,'03                              ','COLQUEPATA',4,78,0,0x0000000010894d2c);
INSERT INTO alinkedlist VALUES (
5,771,'04                              ','CHALLABAMBA',4,78,0,0x0000000010894d2d);
INSERT INTO alinkedlist VALUES (
5,772,'05                              ','KOSÑIPATA',4,78,0,0x0000000010894d2e);
INSERT INTO alinkedlist VALUES (
5,773,'06                              ','HUANCARANI',4,78,0,0x0000000010894d2f);
INSERT INTO alinkedlist VALUES (
5,774,'01                              ','URCOS',4,79,0,0x0000000010894d30);
INSERT INTO alinkedlist VALUES (
5,775,'02                              ','ANDAHUAYLILLAS',4,79,0,0x0000000010894d31);
INSERT INTO alinkedlist VALUES (
5,776,'03                              ','CAMANTI',4,79,0,0x0000000010894d32);
INSERT INTO alinkedlist VALUES (
5,777,'04                              ','CCARHUAYO',4,79,0,0x0000000010894d33);
INSERT INTO alinkedlist VALUES (
5,778,'05                              ','CCATCA',4,79,0,0x0000000010894d34);
INSERT INTO alinkedlist VALUES (
5,779,'06                              ','CUSIPATA',4,79,0,0x0000000010894d35);
INSERT INTO alinkedlist VALUES (
5,780,'07                              ','HUARO',4,79,0,0x0000000010894d36);
INSERT INTO alinkedlist VALUES (
5,781,'08                              ','LUCRE',4,79,0,0x0000000010894d37);
INSERT INTO alinkedlist VALUES (
5,782,'09                              ','MARCAPATA',4,79,0,0x0000000010894d38);
INSERT INTO alinkedlist VALUES (
5,783,'10                              ','OCONGATE',4,79,0,0x0000000010894d39);
INSERT INTO alinkedlist VALUES (
5,784,'11                              ','OROPESA',4,79,0,0x0000000010894d3a);
INSERT INTO alinkedlist VALUES (
5,785,'12                              ','QUIQUIJANA',4,79,0,0x0000000010894d3b);
INSERT INTO alinkedlist VALUES (
5,786,'01                              ','URUBAMBA',4,80,0,0x0000000010894d3c);
INSERT INTO alinkedlist VALUES (
5,787,'02                              ','CHINCHERO',4,80,0,0x0000000010894d3d);
INSERT INTO alinkedlist VALUES (
5,788,'03                              ','HUAYLLABAMBA',4,80,0,0x0000000010894d3e);
INSERT INTO alinkedlist VALUES (
5,789,'04                              ','MACHUPICCHU',4,80,0,0x0000000010894d3f);
INSERT INTO alinkedlist VALUES (
5,790,'05                              ','MARAS',4,80,0,0x0000000010894d40);
INSERT INTO alinkedlist VALUES (
5,791,'06                              ','OLLANTAYTAMBO',4,80,0,0x0000000010894d41);
INSERT INTO alinkedlist VALUES (
5,792,'07                              ','YUCAY',4,80,0,0x0000000010894d42);
INSERT INTO alinkedlist VALUES (
5,793,'01                              ','HUANCAVELICA',4,81,0,0x0000000010894d43);
INSERT INTO alinkedlist VALUES (
5,794,'02                              ','ACOBAMBILLA',4,81,0,0x0000000010894d44);
INSERT INTO alinkedlist VALUES (
5,795,'03                              ','ACORIA',4,81,0,0x0000000010894d45);
INSERT INTO alinkedlist VALUES (
5,796,'04                              ','CONAYCA',4,81,0,0x0000000010894d46);
INSERT INTO alinkedlist VALUES (
5,797,'05                              ','CUENCA',4,81,0,0x0000000010894d47);
INSERT INTO alinkedlist VALUES (
5,798,'06                              ','HUACHOCOLPA',4,81,0,0x0000000010894d48);
INSERT INTO alinkedlist VALUES (
5,799,'08                              ','HUAYLLAHUARA',4,81,0,0x0000000010894d49);
INSERT INTO alinkedlist VALUES (
5,800,'09                              ','IZCUCHACA',4,81,0,0x0000000010894d4a);
INSERT INTO alinkedlist VALUES (
5,801,'10                              ','LARIA',4,81,0,0x0000000010894d4b);
INSERT INTO alinkedlist VALUES (
5,802,'11                              ','MANTA',4,81,0,0x0000000010894d4c);
INSERT INTO alinkedlist VALUES (
5,803,'12                              ','MARISCAL CACERES',4,81,0,0x0000000010894d4d);
INSERT INTO alinkedlist VALUES (
5,804,'13                              ','MOYA',4,81,0,0x0000000010894d4e);
INSERT INTO alinkedlist VALUES (
5,805,'14                              ','NUEVO OCCORO',4,81,0,0x0000000010894d4f);
INSERT INTO alinkedlist VALUES (
5,806,'15                              ','PALCA',4,81,0,0x0000000010894d50);
INSERT INTO alinkedlist VALUES (
5,807,'16                              ','PILCHACA',4,81,0,0x0000000010894d51);
INSERT INTO alinkedlist VALUES (
5,808,'17                              ','VILCA',4,81,0,0x0000000010894d52);
INSERT INTO alinkedlist VALUES (
5,809,'18                              ','YAULI',4,81,0,0x0000000010894d53);
INSERT INTO alinkedlist VALUES (
5,810,'20                              ','ASCENSION',4,81,0,0x0000000010894d54);
INSERT INTO alinkedlist VALUES (
5,811,'21                              ','HUANDO',4,81,0,0x0000000010894d55);
INSERT INTO alinkedlist VALUES (
5,812,'01                              ','ACOBAMBA',4,82,0,0x0000000010894d56);
INSERT INTO alinkedlist VALUES (
5,813,'02                              ','ANTA',4,82,0,0x0000000010894d57);
INSERT INTO alinkedlist VALUES (
5,814,'03                              ','ANDABAMBA',4,82,0,0x0000000010894d58);
INSERT INTO alinkedlist VALUES (
5,815,'04                              ','CAJA',4,82,0,0x0000000010894d59);
INSERT INTO alinkedlist VALUES (
5,816,'05                              ','MARCAS',4,82,0,0x0000000010894d5a);
INSERT INTO alinkedlist VALUES (
5,817,'06                              ','PAUCARA',4,82,0,0x0000000010894d5b);
INSERT INTO alinkedlist VALUES (
5,818,'07                              ','POMACOCHA',4,82,0,0x0000000010894d5c);
INSERT INTO alinkedlist VALUES (
5,819,'08                              ','ROSARIO',4,82,0,0x0000000010894d5d);
INSERT INTO alinkedlist VALUES (
5,820,'01                              ','LIRCAY',4,83,0,0x0000000010894d5e);
INSERT INTO alinkedlist VALUES (
5,821,'02                              ','ANCHONGA',4,83,0,0x0000000010894d5f);
INSERT INTO alinkedlist VALUES (
5,822,'03                              ','CALLANMARCA',4,83,0,0x0000000010894d60);
INSERT INTO alinkedlist VALUES (
5,823,'04                              ','CONGALLA',4,83,0,0x0000000010894d61);
INSERT INTO alinkedlist VALUES (
5,824,'05                              ','CHINCHO',4,83,0,0x0000000010894d62);
INSERT INTO alinkedlist VALUES (
5,825,'06                              ','HUALLAY-GRANDE',4,83,0,0x0000000010894d63);
INSERT INTO alinkedlist VALUES (
5,826,'07                              ','HUANCA-HUANCA',4,83,0,0x0000000010894d64);
INSERT INTO alinkedlist VALUES (
5,827,'08                              ','JULCAMARCA',4,83,0,0x0000000010894d65);
INSERT INTO alinkedlist VALUES (
5,828,'09                              ','SAN ANTONIO DE ANTAPARCO',4,83,0,0x0000000010894d66);
INSERT INTO alinkedlist VALUES (
5,829,'10                              ','SANTO TOMAS DE PATA',4,83,0,0x0000000010894d67);
INSERT INTO alinkedlist VALUES (
5,830,'11                              ','SECCLLA',4,83,0,0x0000000010894d68);
INSERT INTO alinkedlist VALUES (
5,831,'12                              ','CCOCHACCASA',4,83,0,0x0000000010894d69);
INSERT INTO alinkedlist VALUES (
5,832,'01                              ','CASTROVIRREYNA',4,84,0,0x0000000010894d6a);
INSERT INTO alinkedlist VALUES (
5,833,'02                              ','ARMA',4,84,0,0x0000000010894d6b);
INSERT INTO alinkedlist VALUES (
5,834,'03                              ','AURAHUA',4,84,0,0x0000000010894d6c);
INSERT INTO alinkedlist VALUES (
5,835,'05                              ','CAPILLAS',4,84,0,0x0000000010894d6d);
INSERT INTO alinkedlist VALUES (
5,836,'06                              ','COCAS',4,84,0,0x0000000010894d6e);
INSERT INTO alinkedlist VALUES (
5,837,'08                              ','CHUPAMARCA',4,84,0,0x0000000010894d6f);
INSERT INTO alinkedlist VALUES (
5,838,'09                              ','HUACHOS',4,84,0,0x0000000010894d70);
INSERT INTO alinkedlist VALUES (
5,839,'10                              ','HUAMATAMBO',4,84,0,0x0000000010894d71);
INSERT INTO alinkedlist VALUES (
5,840,'14                              ','MOLLEPAMPA',4,84,0,0x0000000010894d72);
INSERT INTO alinkedlist VALUES (
5,841,'23                              ','SAN JUAN',4,84,0,0x0000000010894d73);
INSERT INTO alinkedlist VALUES (
5,842,'27                              ','TANTARA',4,84,0,0x0000000010894d74);
INSERT INTO alinkedlist VALUES (
5,843,'28                              ','TICRAPO',4,84,0,0x0000000010894d75);
INSERT INTO alinkedlist VALUES (
5,844,'29                              ','SANTA ANA',4,84,0,0x0000000010894d76);
INSERT INTO alinkedlist VALUES (
5,845,'01                              ','PAMPAS',4,85,0,0x0000000010894d77);
INSERT INTO alinkedlist VALUES (
5,846,'02                              ','ACOSTAMBO',4,85,0,0x0000000010894d78);
INSERT INTO alinkedlist VALUES (
5,847,'03                              ','ACRAQUIA',4,85,0,0x0000000010894d79);
INSERT INTO alinkedlist VALUES (
5,848,'04                              ','AHUAYCHA',4,85,0,0x0000000010894d7a);
INSERT INTO alinkedlist VALUES (
5,849,'06                              ','COLCABAMBA',4,85,0,0x0000000010894d7b);
INSERT INTO alinkedlist VALUES (
5,850,'09                              ','DANIEL HERNANDEZ',4,85,0,0x0000000010894d7c);
INSERT INTO alinkedlist VALUES (
5,851,'11                              ','HUACHOCOLPA',4,85,0,0x0000000010894d7d);
INSERT INTO alinkedlist VALUES (
5,852,'12                              ','HUARIBAMBA',4,85,0,0x0000000010894d7e);
INSERT INTO alinkedlist VALUES (
5,853,'15                              ','ÑAHUIMPUQUIO',4,85,0,0x0000000010894d7f);
INSERT INTO alinkedlist VALUES (
5,854,'17                              ','PAZOS',4,85,0,0x0000000010894d80);
INSERT INTO alinkedlist VALUES (
5,855,'18                              ','QUISHUAR',4,85,0,0x0000000010894d81);
INSERT INTO alinkedlist VALUES (
5,856,'20                              ','SALCABAMBA',4,85,0,0x0000000010894d82);
INSERT INTO alinkedlist VALUES (
5,857,'21                              ','SAN MARCOS DE ROCCHAC',4,85,0,0x0000000010894d83);
INSERT INTO alinkedlist VALUES (
5,858,'23                              ','SURCUBAMBA',4,85,0,0x0000000010894d84);
INSERT INTO alinkedlist VALUES (
5,859,'25                              ','TINTAY PUNCU',4,85,0,0x0000000010894d85);
INSERT INTO alinkedlist VALUES (
5,860,'26                              ','SALCAHUASI',4,85,0,0x0000000010894d86);
INSERT INTO alinkedlist VALUES (
5,861,'01                              ','AYAVI',4,86,0,0x0000000010894d87);
INSERT INTO alinkedlist VALUES (
5,862,'02                              ','CORDOVA',4,86,0,0x0000000010894d88);
INSERT INTO alinkedlist VALUES (
5,863,'03                              ','HUAYACUNDO ARMA',4,86,0,0x0000000010894d89);
INSERT INTO alinkedlist VALUES (
5,864,'04                              ','HUAYTARA',4,86,0,0x0000000010894d8a);
INSERT INTO alinkedlist VALUES (
5,865,'05                              ','LARAMARCA',4,86,0,0x0000000010894d8b);
INSERT INTO alinkedlist VALUES (
5,866,'06                              ','OCOYO',4,86,0,0x0000000010894d8c);
INSERT INTO alinkedlist VALUES (
5,867,'07                              ','PILPICHACA',4,86,0,0x0000000010894d8d);
INSERT INTO alinkedlist VALUES (
5,868,'08                              ','QUERCO',4,86,0,0x0000000010894d8e);
INSERT INTO alinkedlist VALUES (
5,869,'09                              ','QUITO ARMA',4,86,0,0x0000000010894d8f);
INSERT INTO alinkedlist VALUES (
5,870,'10                              ','SAN ANTONIO DE CUSICANCHA',4,86,0,0x0000000010894d90);
INSERT INTO alinkedlist VALUES (
5,871,'11                              ','SAN FRANCISCO DE SANGAYAICO',4,86,0,0x0000000010894d91);
INSERT INTO alinkedlist VALUES (
5,872,'12                              ','SAN ISIDRO',4,86,0,0x0000000010894d92);
INSERT INTO alinkedlist VALUES (
5,873,'13                              ','SANTIAGO DE CHOCORVOS',4,86,0,0x0000000010894d93);
INSERT INTO alinkedlist VALUES (
5,874,'14                              ','SANTIAGO DE QUIRAHUARA',4,86,0,0x0000000010894d94);
INSERT INTO alinkedlist VALUES (
5,875,'15                              ','SANTO DOMINGO DE CAPILLAS',4,86,0,0x0000000010894d95);
INSERT INTO alinkedlist VALUES (
5,876,'16                              ','TAMBO',4,86,0,0x0000000010894d96);
INSERT INTO alinkedlist VALUES (
5,877,'01                              ','CHURCAMPA',4,87,0,0x0000000010894d97);
INSERT INTO alinkedlist VALUES (
5,878,'02                              ','ANCO',4,87,0,0x0000000010894d98);
INSERT INTO alinkedlist VALUES (
5,879,'03                              ','CHINCHIHUASI',4,87,0,0x0000000010894d99);
INSERT INTO alinkedlist VALUES (
5,880,'04                              ','EL CARMEN',4,87,0,0x0000000010894d9a);
INSERT INTO alinkedlist VALUES (
5,881,'05                              ','LA MERCED',4,87,0,0x0000000010894d9b);
INSERT INTO alinkedlist VALUES (
5,882,'06                              ','LOCROJA',4,87,0,0x0000000010894d9c);
INSERT INTO alinkedlist VALUES (
5,883,'07                              ','PAUCARBAMBA',4,87,0,0x0000000010894d9d);
INSERT INTO alinkedlist VALUES (
5,884,'08                              ','SAN MIGUEL DE MAYOCC',4,87,0,0x0000000010894d9e);
INSERT INTO alinkedlist VALUES (
5,885,'09                              ','SAN PEDRO DE CORIS',4,87,0,0x0000000010894d9f);
INSERT INTO alinkedlist VALUES (
5,886,'10                              ','PACHAMARCA',4,87,0,0x0000000010894da0);
INSERT INTO alinkedlist VALUES (
5,887,'11                              ','COSME',4,87,0,0x0000000010894da1);
INSERT INTO alinkedlist VALUES (
5,888,'01                              ','HUANUCO',4,88,0,0x0000000010894da2);
INSERT INTO alinkedlist VALUES (
5,889,'02                              ','CHINCHAO',4,88,0,0x0000000010894da3);
INSERT INTO alinkedlist VALUES (
5,890,'03                              ','CHURUBAMBA',4,88,0,0x0000000010894da4);
INSERT INTO alinkedlist VALUES (
5,891,'04                              ','MARGOS',4,88,0,0x0000000010894da5);
INSERT INTO alinkedlist VALUES (
5,892,'05                              ','QUISQUI',4,88,0,0x0000000010894da6);
INSERT INTO alinkedlist VALUES (
5,893,'06                              ','SAN FRANCISCO DE CAYRAN',4,88,0,0x0000000010894da7);
INSERT INTO alinkedlist VALUES (
5,894,'07                              ','SAN PEDRO DE CHAULAN',4,88,0,0x0000000010894da8);
INSERT INTO alinkedlist VALUES (
5,895,'08                              ','SANTA MARIA DEL VALLE',4,88,0,0x0000000010894da9);
INSERT INTO alinkedlist VALUES (
5,896,'09                              ','YARUMAYO',4,88,0,0x0000000010894daa);
INSERT INTO alinkedlist VALUES (
5,897,'10                              ','AMARILIS',4,88,0,0x0000000010894dab);
INSERT INTO alinkedlist VALUES (
5,898,'11                              ','PILLCO MARCA',4,88,0,0x0000000010894dac);
INSERT INTO alinkedlist VALUES (
5,899,'12                              ','YACUS',4,88,0,0x0000000010894dad);
INSERT INTO alinkedlist VALUES (
5,900,'01                              ','AMBO',4,89,0,0x0000000010894dae);
INSERT INTO alinkedlist VALUES (
5,901,'02                              ','CAYNA',4,89,0,0x0000000010894daf);
INSERT INTO alinkedlist VALUES (
5,902,'03                              ','COLPAS',4,89,0,0x0000000010894db0);
INSERT INTO alinkedlist VALUES (
5,903,'04                              ','CONCHAMARCA',4,89,0,0x0000000010894db1);
INSERT INTO alinkedlist VALUES (
5,904,'05                              ','HUACAR',4,89,0,0x0000000010894db2);
INSERT INTO alinkedlist VALUES (
5,905,'06                              ','SAN FRANCISCO',4,89,0,0x0000000010894db3);
INSERT INTO alinkedlist VALUES (
5,906,'07                              ','SAN RAFAEL',4,89,0,0x0000000010894db4);
INSERT INTO alinkedlist VALUES (
5,907,'08                              ','TOMAY-KICHWA',4,89,0,0x0000000010894db5);
INSERT INTO alinkedlist VALUES (
5,908,'01                              ','LA UNION',4,90,0,0x0000000010894db6);
INSERT INTO alinkedlist VALUES (
5,909,'07                              ','CHUQUIS',4,90,0,0x0000000010894db7);
INSERT INTO alinkedlist VALUES (
5,910,'12                              ','MARIAS',4,90,0,0x0000000010894db8);
INSERT INTO alinkedlist VALUES (
5,911,'14                              ','PACHAS',4,90,0,0x0000000010894db9);
INSERT INTO alinkedlist VALUES (
5,912,'16                              ','QUIVILLA',4,90,0,0x0000000010894dba);
INSERT INTO alinkedlist VALUES (
5,913,'17                              ','RIPAN',4,90,0,0x0000000010894dbb);
INSERT INTO alinkedlist VALUES (
5,914,'21                              ','SHUNQUI',4,90,0,0x0000000010b3905e);
INSERT INTO alinkedlist VALUES (
5,915,'22                              ','SILLAPATA',4,90,0,0x0000000010b3905f);
INSERT INTO alinkedlist VALUES (
5,916,'23                              ','YANAS',4,90,0,0x0000000010894dbe);
INSERT INTO alinkedlist VALUES (
5,917,'01                              ','LLATA',4,91,0,0x0000000010894dbf);
INSERT INTO alinkedlist VALUES (
5,918,'02                              ','ARANCAY',4,91,0,0x0000000010894dc0);
INSERT INTO alinkedlist VALUES (
5,919,'03                              ','CHAVIN DE PARIARCA',4,91,0,0x0000000010894dc1);
INSERT INTO alinkedlist VALUES (
5,920,'04                              ','JACAS GRANDE',4,91,0,0x0000000010894dc2);
INSERT INTO alinkedlist VALUES (
5,921,'05                              ','JIRCAN',4,91,0,0x0000000010894dc3);
INSERT INTO alinkedlist VALUES (
5,922,'06                              ','MIRAFLORES',4,91,0,0x0000000010894dc4);
INSERT INTO alinkedlist VALUES (
5,923,'07                              ','MONZON',4,91,0,0x0000000010894dc5);
INSERT INTO alinkedlist VALUES (
5,924,'08                              ','PUNCHAO',4,91,0,0x0000000010894dc6);
INSERT INTO alinkedlist VALUES (
5,925,'09                              ','PUÑOS',4,91,0,0x0000000010894dc7);
INSERT INTO alinkedlist VALUES (
5,926,'10                              ','SINGA',4,91,0,0x0000000010894dc8);
INSERT INTO alinkedlist VALUES (
5,927,'11                              ','TANTAMAYO',4,91,0,0x0000000010894dc9);
INSERT INTO alinkedlist VALUES (
5,928,'01                              ','HUACRACHUCO',4,92,0,0x0000000010894dca);
INSERT INTO alinkedlist VALUES (
5,929,'02                              ','CHOLON',4,92,0,0x0000000010894dcb);
INSERT INTO alinkedlist VALUES (
5,930,'05                              ','SAN BUENAVENTURA',4,92,0,0x0000000010894dcc);
INSERT INTO alinkedlist VALUES (
5,931,'01                              ','RUPA-RUPA',4,93,0,0x0000000010894dcd);
INSERT INTO alinkedlist VALUES (
5,932,'02                              ','DANIEL ALOMIA ROBLES',4,93,0,0x0000000010894dce);
INSERT INTO alinkedlist VALUES (
5,933,'03                              ','HERMILIO VALDIZAN',4,93,0,0x0000000010894dcf);
INSERT INTO alinkedlist VALUES (
5,934,'04                              ','LUYANDO',4,93,0,0x0000000010894dd0);
INSERT INTO alinkedlist VALUES (
5,935,'05                              ','MARIANO DAMASO BERAUN',4,93,0,0x0000000010894dd1);
INSERT INTO alinkedlist VALUES (
5,936,'06                              ','JOSE CRESPO Y CASTILLO',4,93,0,0x0000000010894dd2);
INSERT INTO alinkedlist VALUES (
5,937,'01                              ','PANAO',4,94,0,0x0000000010894dd3);
INSERT INTO alinkedlist VALUES (
5,938,'02                              ','CHAGLLA',4,94,0,0x0000000010894dd4);
INSERT INTO alinkedlist VALUES (
5,939,'04                              ','MOLINO',4,94,0,0x0000000010894dd5);
INSERT INTO alinkedlist VALUES (
5,940,'06                              ','UMARI',4,94,0,0x0000000010894dd6);
INSERT INTO alinkedlist VALUES (
5,941,'01                              ','HONORIA',4,95,0,0x0000000010894dd7);
INSERT INTO alinkedlist VALUES (
5,942,'02                              ','PUERTO INCA',4,95,0,0x0000000010894dd8);
INSERT INTO alinkedlist VALUES (
5,943,'03                              ','CODO DEL POZUZO',4,95,0,0x0000000010894dd9);
INSERT INTO alinkedlist VALUES (
5,944,'04                              ','TOURNAVISTA',4,95,0,0x0000000010894dda);
INSERT INTO alinkedlist VALUES (
5,945,'05                              ','YUYAPICHIS',4,95,0,0x0000000010894ddb);
INSERT INTO alinkedlist VALUES (
5,946,'01                              ','HUACAYBAMBA',4,96,0,0x0000000010894ddc);
INSERT INTO alinkedlist VALUES (
5,947,'02                              ','PINRA',4,96,0,0x0000000010894ddd);
INSERT INTO alinkedlist VALUES (
5,948,'03                              ','CANCHABAMBA',4,96,0,0x0000000010894dde);
INSERT INTO alinkedlist VALUES (
5,949,'04                              ','COCHABAMBA',4,96,0,0x0000000010894ddf);
INSERT INTO alinkedlist VALUES (
5,950,'01                              ','JESUS',4,97,0,0x0000000010894de0);
INSERT INTO alinkedlist VALUES (
5,951,'02                              ','BAÑOS',4,97,0,0x0000000010894de1);
INSERT INTO alinkedlist VALUES (
5,952,'03                              ','SAN FRANCISCO DE ASIS',4,97,0,0x0000000010894de2);
INSERT INTO alinkedlist VALUES (
5,953,'04                              ','QUEROPALCA',4,97,0,0x0000000010894de3);
INSERT INTO alinkedlist VALUES (
5,954,'05                              ','SAN MIGUEL DE CAURI',4,97,0,0x0000000010894de4);
INSERT INTO alinkedlist VALUES (
5,955,'06                              ','RONDOS',4,97,0,0x0000000010894de5);
INSERT INTO alinkedlist VALUES (
5,956,'07                              ','JIVIA',4,97,0,0x0000000010894de6);
INSERT INTO alinkedlist VALUES (
5,957,'01                              ','CHAVINILLO',4,98,0,0x0000000010894de7);
INSERT INTO alinkedlist VALUES (
5,958,'02                              ','APARICIO POMARES',4,98,0,0x0000000010894de8);
INSERT INTO alinkedlist VALUES (
5,959,'03                              ','CAHUAC',4,98,0,0x0000000010894de9);
INSERT INTO alinkedlist VALUES (
5,960,'04                              ','CHACABAMBA',4,98,0,0x0000000010894dea);
INSERT INTO alinkedlist VALUES (
5,961,'05                              ','JACAS CHICO',4,98,0,0x0000000010894deb);
INSERT INTO alinkedlist VALUES (
5,962,'06                              ','OBAS',4,98,0,0x0000000010894dec);
INSERT INTO alinkedlist VALUES (
5,963,'07                              ','PAMPAMARCA',4,98,0,0x0000000010894ded);
INSERT INTO alinkedlist VALUES (
5,964,'08                              ','CHORAS',4,98,0,0x0000000010894dee);
INSERT INTO alinkedlist VALUES (
5,965,'01                              ','ICA',4,99,0,0x0000000010894def);
INSERT INTO alinkedlist VALUES (
5,966,'02                              ','LA TINGUIÑA',4,99,0,0x0000000010894df0);
INSERT INTO alinkedlist VALUES (
5,967,'03                              ','LOS AQUIJES',4,99,0,0x0000000010894df1);
INSERT INTO alinkedlist VALUES (
5,968,'04                              ','PARCONA',4,99,0,0x0000000010894df2);
INSERT INTO alinkedlist VALUES (
5,969,'05                              ','PUEBLO NUEVO',4,99,0,0x0000000010894df3);
INSERT INTO alinkedlist VALUES (
5,970,'06                              ','SALAS',4,99,0,0x0000000010894df4);
INSERT INTO alinkedlist VALUES (
5,971,'07                              ','SAN JOSE DE LOS MOLINOS',4,99,0,0x0000000010894df5);
INSERT INTO alinkedlist VALUES (
5,972,'08                              ','SAN JUAN BAUTISTA',4,99,0,0x0000000010894df6);
INSERT INTO alinkedlist VALUES (
5,973,'09                              ','SANTIAGO',4,99,0,0x0000000010894df7);
INSERT INTO alinkedlist VALUES (
5,974,'10                              ','SUBTANJALLA',4,99,0,0x0000000010894df8);
INSERT INTO alinkedlist VALUES (
5,975,'11                              ','YAUCA DEL ROSARIO',4,99,0,0x0000000010894df9);
INSERT INTO alinkedlist VALUES (
5,976,'12                              ','TATE',4,99,0,0x0000000010894dfa);
INSERT INTO alinkedlist VALUES (
5,977,'13                              ','PACHACUTEC',4,99,0,0x0000000010894dfb);
INSERT INTO alinkedlist VALUES (
5,978,'14                              ','OCUCAJE',4,99,0,0x0000000010894dfc);
INSERT INTO alinkedlist VALUES (
5,979,'01                              ','CHINCHA ALTA',4,100,0,0x0000000010894dfd);
INSERT INTO alinkedlist VALUES (
5,980,'02                              ','CHAVIN',4,100,0,0x0000000010894dfe);
INSERT INTO alinkedlist VALUES (
5,981,'03                              ','CHINCHA BAJA',4,100,0,0x0000000010894dff);
INSERT INTO alinkedlist VALUES (
5,982,'04                              ','EL CARMEN',4,100,0,0x0000000010894e01);
INSERT INTO alinkedlist VALUES (
5,983,'05                              ','GROCIO PRADO',4,100,0,0x0000000010894e02);
INSERT INTO alinkedlist VALUES (
5,984,'06                              ','SAN PEDRO DE HUACARPANA',4,100,0,0x0000000010894e03);
INSERT INTO alinkedlist VALUES (
5,985,'07                              ','SUNAMPE',4,100,0,0x0000000010894e04);
INSERT INTO alinkedlist VALUES (
5,986,'08                              ','TAMBO DE MORA',4,100,0,0x0000000010894e05);
INSERT INTO alinkedlist VALUES (
5,987,'09                              ','ALTO LARAN',4,100,0,0x0000000010894e06);
INSERT INTO alinkedlist VALUES (
5,988,'10                              ','PUEBLO NUEVO',4,100,0,0x0000000010894e07);
INSERT INTO alinkedlist VALUES (
5,989,'11                              ','SAN JUAN DE YANAC',4,100,0,0x0000000010894e08);
INSERT INTO alinkedlist VALUES (
5,990,'01                              ','NAZCA',4,101,0,0x0000000010894e09);
INSERT INTO alinkedlist VALUES (
5,991,'02                              ','CHANGUILLO',4,101,0,0x0000000010894e0a);
INSERT INTO alinkedlist VALUES (
5,992,'03                              ','EL INGENIO',4,101,0,0x0000000010894e0b);
INSERT INTO alinkedlist VALUES (
5,993,'04                              ','MARCONA',4,101,0,0x0000000010894e0c);
INSERT INTO alinkedlist VALUES (
5,994,'05                              ','VISTA ALEGRE',4,101,0,0x0000000010894e0d);
INSERT INTO alinkedlist VALUES (
5,995,'01                              ','PISCO',4,102,0,0x0000000010894e0e);
INSERT INTO alinkedlist VALUES (
5,996,'02                              ','HUANCANO',4,102,0,0x0000000010894e0f);
INSERT INTO alinkedlist VALUES (
5,997,'03                              ','HUMAY',4,102,0,0x0000000010894e10);
INSERT INTO alinkedlist VALUES (
5,998,'04                              ','INDEPENDENCIA',4,102,0,0x0000000010894e11);
INSERT INTO alinkedlist VALUES (
5,999,'05                              ','PARACAS',4,102,0,0x0000000010894e12);
INSERT INTO alinkedlist VALUES (
5,1000,'06                              ','SAN ANDRES',4,102,0,0x0000000010894e13);
INSERT INTO alinkedlist VALUES (
5,1001,'07                              ','SAN CLEMENTE',4,102,0,0x0000000010894e14);
INSERT INTO alinkedlist VALUES (
5,1002,'08                              ','TUPAC AMARU INCA',4,102,0,0x0000000010894e15);
INSERT INTO alinkedlist VALUES (
5,1003,'01                              ','PALPA',4,103,0,0x0000000010894e16);
INSERT INTO alinkedlist VALUES (
5,1004,'02                              ','LLIPATA',4,103,0,0x0000000010894e17);
INSERT INTO alinkedlist VALUES (
5,1005,'03                              ','RIO GRANDE',4,103,0,0x0000000010894e18);
INSERT INTO alinkedlist VALUES (
5,1006,'04                              ','SANTA CRUZ',4,103,0,0x0000000010894e19);
INSERT INTO alinkedlist VALUES (
5,1007,'05                              ','TIBILLO',4,103,0,0x0000000010894e1a);
INSERT INTO alinkedlist VALUES (
5,1008,'01                              ','HUANCAYO',4,104,0,0x0000000010894e1b);
INSERT INTO alinkedlist VALUES (
5,1009,'03                              ','CARHUACALLANGA',4,104,0,0x0000000010894e1c);
INSERT INTO alinkedlist VALUES (
5,1010,'04                              ','COLCA',4,104,0,0x0000000010894e1d);
INSERT INTO alinkedlist VALUES (
5,1011,'05                              ','CULLHUAS',4,104,0,0x0000000010894e1e);
INSERT INTO alinkedlist VALUES (
5,1012,'06                              ','CHACAPAMPA',4,104,0,0x0000000010894e1f);
INSERT INTO alinkedlist VALUES (
5,1013,'07                              ','CHICCHE',4,104,0,0x0000000010894e20);
INSERT INTO alinkedlist VALUES (
5,1014,'08                              ','CHILCA',4,104,0,0x0000000010894e21);
INSERT INTO alinkedlist VALUES (
5,1015,'09                              ','CHONGOS ALTO',4,104,0,0x0000000010894e22);
INSERT INTO alinkedlist VALUES (
5,1016,'12                              ','CHUPURO',4,104,0,0x0000000010894e23);
INSERT INTO alinkedlist VALUES (
5,1017,'13                              ','EL TAMBO',4,104,0,0x0000000010894e24);
INSERT INTO alinkedlist VALUES (
5,1018,'14                              ','HUACRAPUQUIO',4,104,0,0x0000000010894e25);
INSERT INTO alinkedlist VALUES (
5,1019,'16                              ','HUALHUAS',4,104,0,0x0000000010894e26);
INSERT INTO alinkedlist VALUES (
5,1020,'18                              ','HUANCAN',4,104,0,0x0000000010894e27);
INSERT INTO alinkedlist VALUES (
5,1021,'19                              ','HUASICANCHA',4,104,0,0x0000000010b390b5);
INSERT INTO alinkedlist VALUES (
5,1022,'20                              ','HUAYUCACHI',4,104,0,0x0000000010b390b6);
INSERT INTO alinkedlist VALUES (
5,1023,'21                              ','INGENIO',4,104,0,0x0000000010b390b7);
INSERT INTO alinkedlist VALUES (
5,1024,'22                              ','PARIAHUANCA',4,104,0,0x0000000010b390b8);
INSERT INTO alinkedlist VALUES (
5,1025,'23                              ','PILCOMAYO',4,104,0,0x0000000010894e2c);
INSERT INTO alinkedlist VALUES (
5,1026,'24                              ','PUCARA',4,104,0,0x0000000010894e2d);
INSERT INTO alinkedlist VALUES (
5,1027,'25                              ','QUICHUAY',4,104,0,0x0000000010894e2e);
INSERT INTO alinkedlist VALUES (
5,1028,'26                              ','QUILCAS',4,104,0,0x0000000010894e2f);
INSERT INTO alinkedlist VALUES (
5,1029,'27                              ','SAN AGUSTIN',4,104,0,0x0000000010894e30);
INSERT INTO alinkedlist VALUES (
5,1030,'28                              ','SAN JERONIMO DE TUNAN',4,104,0,0x0000000010894e31);
INSERT INTO alinkedlist VALUES (
5,1031,'31                              ','SANTO DOMINGO DE ACOBAMBA',4,104,0,0x0000000010894e32);
INSERT INTO alinkedlist VALUES (
5,1032,'32                              ','SAÑO',4,104,0,0x0000000010894e33);
INSERT INTO alinkedlist VALUES (
5,1033,'33                              ','SAPALLANGA',4,104,0,0x0000000010894e34);
INSERT INTO alinkedlist VALUES (
5,1034,'34                              ','SICAYA',4,104,0,0x0000000010894e35);
INSERT INTO alinkedlist VALUES (
5,1035,'36                              ','VIQUES',4,104,0,0x0000000010894e36);
INSERT INTO alinkedlist VALUES (
5,1036,'01                              ','CONCEPCION',4,105,0,0x0000000010894e37);
INSERT INTO alinkedlist VALUES (
5,1037,'02                              ','ACO',4,105,0,0x0000000010894e38);
INSERT INTO alinkedlist VALUES (
5,1038,'03                              ','ANDAMARCA',4,105,0,0x0000000010894e39);
INSERT INTO alinkedlist VALUES (
5,1039,'04                              ','COMAS',4,105,0,0x0000000010894e3a);
INSERT INTO alinkedlist VALUES (
5,1040,'05                              ','COCHAS',4,105,0,0x0000000010894e3b);
INSERT INTO alinkedlist VALUES (
5,1041,'06                              ','CHAMBARA',4,105,0,0x0000000010894e3c);
INSERT INTO alinkedlist VALUES (
5,1042,'07                              ','HEROINAS TOLEDO',4,105,0,0x0000000010894e3d);
INSERT INTO alinkedlist VALUES (
5,1043,'08                              ','MANZANARES',4,105,0,0x0000000010894e3e);
INSERT INTO alinkedlist VALUES (
5,1044,'09                              ','MARISCAL CASTILLA',4,105,0,0x0000000010894e3f);
INSERT INTO alinkedlist VALUES (
5,1045,'10                              ','MATAHUASI',4,105,0,0x0000000010894e40);
INSERT INTO alinkedlist VALUES (
5,1046,'11                              ','MITO',4,105,0,0x0000000010894e41);
INSERT INTO alinkedlist VALUES (
5,1047,'12                              ','NUEVE DE JULIO',4,105,0,0x0000000010894e42);
INSERT INTO alinkedlist VALUES (
5,1048,'13                              ','ORCOTUNA',4,105,0,0x0000000010894e43);
INSERT INTO alinkedlist VALUES (
5,1049,'14                              ','SANTA ROSA DE OCOPA',4,105,0,0x0000000010894e44);
INSERT INTO alinkedlist VALUES (
5,1050,'15                              ','SAN JOSE DE QUERO',4,105,0,0x0000000010894e45);
INSERT INTO alinkedlist VALUES (
5,1051,'01                              ','JAUJA',4,106,0,0x0000000010894e46);
INSERT INTO alinkedlist VALUES (
5,1052,'02                              ','ACOLLA',4,106,0,0x0000000010894e47);
INSERT INTO alinkedlist VALUES (
5,1053,'03                              ','APATA',4,106,0,0x0000000010894e48);
INSERT INTO alinkedlist VALUES (
5,1054,'04                              ','ATAURA',4,106,0,0x0000000010894e49);
INSERT INTO alinkedlist VALUES (
5,1055,'05                              ','CANCHAYLLO',4,106,0,0x0000000010894e4a);
INSERT INTO alinkedlist VALUES (
5,1056,'06                              ','EL MANTARO',4,106,0,0x0000000010894e4b);
INSERT INTO alinkedlist VALUES (
5,1057,'07                              ','HUAMALI',4,106,0,0x0000000010894e4c);
INSERT INTO alinkedlist VALUES (
5,1058,'08                              ','HUARIPAMPA',4,106,0,0x0000000010894e4d);
INSERT INTO alinkedlist VALUES (
5,1059,'09                              ','HUERTAS',4,106,0,0x0000000010894e4e);
INSERT INTO alinkedlist VALUES (
5,1060,'10                              ','JANJAILLO',4,106,0,0x0000000010894e4f);
INSERT INTO alinkedlist VALUES (
5,1061,'11                              ','JULCAN',4,106,0,0x0000000010894e50);
INSERT INTO alinkedlist VALUES (
5,1062,'12                              ','LEONOR ORDOÑEZ',4,106,0,0x0000000010894e51);
INSERT INTO alinkedlist VALUES (
5,1063,'13                              ','LLOCLLAPAMPA',4,106,0,0x0000000010894e52);
INSERT INTO alinkedlist VALUES (
5,1064,'14                              ','MARCO',4,106,0,0x0000000010894e53);
INSERT INTO alinkedlist VALUES (
5,1065,'15                              ','MASMA',4,106,0,0x0000000010894e54);
INSERT INTO alinkedlist VALUES (
5,1066,'16                              ','MOLINOS',4,106,0,0x0000000010894e55);
INSERT INTO alinkedlist VALUES (
5,1067,'17                              ','MONOBAMBA',4,106,0,0x0000000010894e56);
INSERT INTO alinkedlist VALUES (
5,1068,'18                              ','MUQUI',4,106,0,0x0000000010894e57);
INSERT INTO alinkedlist VALUES (
5,1069,'19                              ','MUQUIYAUYO',4,106,0,0x0000000010b390ec);
INSERT INTO alinkedlist VALUES (
5,1070,'20                              ','PACA',4,106,0,0x0000000010b390ed);
INSERT INTO alinkedlist VALUES (
5,1071,'21                              ','PACCHA',4,106,0,0x0000000010b390ee);
INSERT INTO alinkedlist VALUES (
5,1072,'22                              ','PANCAN',4,106,0,0x0000000010b390ef);
INSERT INTO alinkedlist VALUES (
5,1073,'23                              ','PARCO',4,106,0,0x0000000010894e5c);
INSERT INTO alinkedlist VALUES (
5,1074,'24                              ','POMACANCHA',4,106,0,0x0000000010894e5d);
INSERT INTO alinkedlist VALUES (
5,1075,'25                              ','RICRAN',4,106,0,0x0000000010894e5e);
INSERT INTO alinkedlist VALUES (
5,1076,'26                              ','SAN LORENZO',4,106,0,0x0000000010894e5f);
INSERT INTO alinkedlist VALUES (
5,1077,'27                              ','SAN PEDRO DE CHUNAN',4,106,0,0x0000000010894e60);
INSERT INTO alinkedlist VALUES (
5,1078,'28                              ','SINCOS',4,106,0,0x0000000010894e61);
INSERT INTO alinkedlist VALUES (
5,1079,'29                              ','TUNAN MARCA',4,106,0,0x0000000010894e62);
INSERT INTO alinkedlist VALUES (
5,1080,'30                              ','YAULI',4,106,0,0x0000000010894e63);
INSERT INTO alinkedlist VALUES (
5,1081,'31                              ','CURICACA',4,106,0,0x0000000010894e64);
INSERT INTO alinkedlist VALUES (
5,1082,'32                              ','MASMA CHICCHE',4,106,0,0x0000000010894e65);
INSERT INTO alinkedlist VALUES (
5,1083,'33                              ','SAUSA',4,106,0,0x0000000010894e66);
INSERT INTO alinkedlist VALUES (
5,1084,'34                              ','YAUYOS',4,106,0,0x0000000010894e67);
INSERT INTO alinkedlist VALUES (
5,1085,'01                              ','JUNIN',4,107,0,0x0000000010894e68);
INSERT INTO alinkedlist VALUES (
5,1086,'02                              ','CARHUAMAYO',4,107,0,0x0000000010894e69);
INSERT INTO alinkedlist VALUES (
5,1087,'03                              ','ONDORES',4,107,0,0x0000000010894e6a);
INSERT INTO alinkedlist VALUES (
5,1088,'04                              ','ULCUMAYO',4,107,0,0x0000000010894e6b);
INSERT INTO alinkedlist VALUES (
5,1089,'01                              ','TARMA',4,108,0,0x0000000010894e6c);
INSERT INTO alinkedlist VALUES (
5,1090,'02                              ','ACOBAMBA',4,108,0,0x0000000010894e6d);
INSERT INTO alinkedlist VALUES (
5,1091,'03                              ','HUARICOLCA',4,108,0,0x0000000010894e6e);
INSERT INTO alinkedlist VALUES (
5,1092,'04                              ','HUASAHUASI',4,108,0,0x0000000010894e6f);
INSERT INTO alinkedlist VALUES (
5,1093,'05                              ','LA UNION',4,108,0,0x0000000010894e70);
INSERT INTO alinkedlist VALUES (
5,1094,'06                              ','PALCA',4,108,0,0x0000000010894e71);
INSERT INTO alinkedlist VALUES (
5,1095,'07                              ','PALCAMAYO',4,108,0,0x0000000010894e72);
INSERT INTO alinkedlist VALUES (
5,1096,'08                              ','SAN PEDRO DE CAJAS',4,108,0,0x0000000010894e73);
INSERT INTO alinkedlist VALUES (
5,1097,'09                              ','TAPO',4,108,0,0x0000000010894e74);
INSERT INTO alinkedlist VALUES (
5,1098,'01                              ','LA OROYA',4,109,0,0x0000000010894e75);
INSERT INTO alinkedlist VALUES (
5,1099,'02                              ','CHACAPALPA',4,109,0,0x0000000010894e76);
INSERT INTO alinkedlist VALUES (
5,1100,'03                              ','HUAY HUAY',4,109,0,0x0000000010894e77);
INSERT INTO alinkedlist VALUES (
5,1101,'04                              ','MARCAPOMACOCHA',4,109,0,0x0000000010894e78);
INSERT INTO alinkedlist VALUES (
5,1102,'05                              ','MOROCOCHA',4,109,0,0x0000000010894e79);
INSERT INTO alinkedlist VALUES (
5,1103,'06                              ','PACCHA',4,109,0,0x0000000010894e7a);
INSERT INTO alinkedlist VALUES (
5,1104,'07                              ','SANTA BARBARA DE CARHUACAYAN',4,109,0,0x0000000010894e7b);
INSERT INTO alinkedlist VALUES (
5,1105,'08                              ','SUITUCANCHA',4,109,0,0x0000000010894e7c);
INSERT INTO alinkedlist VALUES (
5,1106,'09                              ','YAULI',4,109,0,0x0000000010894e7d);
INSERT INTO alinkedlist VALUES (
5,1107,'10                              ','SANTA ROSA DE SACCO',4,109,0,0x0000000010894e7e);
INSERT INTO alinkedlist VALUES (
5,1108,'01                              ','SATIPO',4,110,0,0x0000000010894e7f);
INSERT INTO alinkedlist VALUES (
5,1109,'02                              ','COVIRIALI',4,110,0,0x0000000010894e80);
INSERT INTO alinkedlist VALUES (
5,1110,'03                              ','LLAYLLA',4,110,0,0x0000000010894e81);
INSERT INTO alinkedlist VALUES (
5,1111,'04                              ','MAZAMARI',4,110,0,0x0000000010894e82);
INSERT INTO alinkedlist VALUES (
5,1112,'05                              ','PAMPA HERMOSA',4,110,0,0x0000000010894e83);
INSERT INTO alinkedlist VALUES (
5,1113,'06                              ','PANGOA',4,110,0,0x0000000010894e84);
INSERT INTO alinkedlist VALUES (
5,1114,'07                              ','RIO NEGRO',4,110,0,0x0000000010894e85);
INSERT INTO alinkedlist VALUES (
5,1115,'08                              ','RIO TAMBO',4,110,0,0x0000000010894e86);
INSERT INTO alinkedlist VALUES (
5,1116,'01                              ','CHANCHAMAYO',4,111,0,0x0000000010894e87);
INSERT INTO alinkedlist VALUES (
5,1117,'02                              ','SAN RAMON',4,111,0,0x0000000010894e88);
INSERT INTO alinkedlist VALUES (
5,1118,'03                              ','VITOC',4,111,0,0x0000000010894e89);
INSERT INTO alinkedlist VALUES (
5,1119,'04                              ','SAN LUIS DE SHUARO',4,111,0,0x0000000010894e8a);
INSERT INTO alinkedlist VALUES (
5,1120,'05                              ','PICHANAQUI',4,111,0,0x0000000010894e8b);
INSERT INTO alinkedlist VALUES (
5,1121,'06                              ','PERENE',4,111,0,0x0000000010894e8c);
INSERT INTO alinkedlist VALUES (
5,1122,'01                              ','CHUPACA',4,112,0,0x0000000010894e8d);
INSERT INTO alinkedlist VALUES (
5,1123,'02                              ','AHUAC',4,112,0,0x0000000010894e8e);
INSERT INTO alinkedlist VALUES (
5,1124,'03                              ','CHONGOS BAJO',4,112,0,0x0000000010894e8f);
INSERT INTO alinkedlist VALUES (
5,1125,'04                              ','HUACHAC',4,112,0,0x0000000010894e90);
INSERT INTO alinkedlist VALUES (
5,1126,'05                              ','HUAMANCACA CHICO',4,112,0,0x0000000010894e91);
INSERT INTO alinkedlist VALUES (
5,1127,'06                              ','SAN JUAN DE YSCOS',4,112,0,0x0000000010894e92);
INSERT INTO alinkedlist VALUES (
5,1128,'07                              ','SAN JUAN DE JARPA',4,112,0,0x0000000010894e93);
INSERT INTO alinkedlist VALUES (
5,1129,'08                              ','TRES DE DICIEMBRE',4,112,0,0x0000000010894e94);
INSERT INTO alinkedlist VALUES (
5,1130,'09                              ','YANACANCHA',4,112,0,0x0000000010894e95);
INSERT INTO alinkedlist VALUES (
5,1131,'01                              ','TRUJILLO',4,113,0,0x0000000010894e96);
INSERT INTO alinkedlist VALUES (
5,1132,'02                              ','HUANCHACO',4,113,0,0x0000000010894e97);
INSERT INTO alinkedlist VALUES (
5,1133,'03                              ','LAREDO',4,113,0,0x0000000010894e98);
INSERT INTO alinkedlist VALUES (
5,1134,'04                              ','MOCHE',4,113,0,0x0000000010894e99);
INSERT INTO alinkedlist VALUES (
5,1135,'05                              ','SALAVERRY',4,113,0,0x0000000010894e9a);
INSERT INTO alinkedlist VALUES (
5,1136,'06                              ','SIMBAL',4,113,0,0x0000000010894e9b);
INSERT INTO alinkedlist VALUES (
5,1137,'07                              ','VICTOR LARCO HERRERA',4,113,0,0x0000000010894e9c);
INSERT INTO alinkedlist VALUES (
5,1138,'09                              ','POROTO',4,113,0,0x0000000010894e9d);
INSERT INTO alinkedlist VALUES (
5,1139,'10                              ','EL PORVENIR',4,113,0,0x0000000010894e9e);
INSERT INTO alinkedlist VALUES (
5,1140,'11                              ','LA ESPERANZA',4,113,0,0x0000000010894e9f);
INSERT INTO alinkedlist VALUES (
5,1141,'12                              ','FLORENCIA DE MORA',4,113,0,0x0000000010894ea0);
INSERT INTO alinkedlist VALUES (
5,1142,'01                              ','BOLIVAR',4,114,0,0x0000000010894ea1);
INSERT INTO alinkedlist VALUES (
5,1143,'02                              ','BAMBAMARCA',4,114,0,0x0000000010894ea2);
INSERT INTO alinkedlist VALUES (
5,1144,'03                              ','CONDORMARCA',4,114,0,0x0000000010894ea3);
INSERT INTO alinkedlist VALUES (
5,1145,'04                              ','LONGOTEA',4,114,0,0x0000000010894ea4);
INSERT INTO alinkedlist VALUES (
5,1146,'05                              ','UCUNCHA',4,114,0,0x0000000010894ea5);
INSERT INTO alinkedlist VALUES (
5,1147,'06                              ','UCHUMARCA',4,114,0,0x0000000010894ea6);
INSERT INTO alinkedlist VALUES (
5,1148,'01                              ','HUAMACHUCO',4,115,0,0x0000000010894ea7);
INSERT INTO alinkedlist VALUES (
5,1149,'02                              ','COCHORCO',4,115,0,0x0000000010894ea8);
INSERT INTO alinkedlist VALUES (
5,1150,'03                              ','CURGOS',4,115,0,0x0000000010894ea9);
INSERT INTO alinkedlist VALUES (
5,1151,'04                              ','CHUGAY',4,115,0,0x0000000010894eaa);
INSERT INTO alinkedlist VALUES (
5,1152,'05                              ','MARCABAL',4,115,0,0x0000000010894eab);
INSERT INTO alinkedlist VALUES (
5,1153,'06                              ','SANAGORAN',4,115,0,0x0000000010894eac);
INSERT INTO alinkedlist VALUES (
5,1154,'07                              ','SARIN',4,115,0,0x0000000010894ead);
INSERT INTO alinkedlist VALUES (
5,1155,'08                              ','SARTIMBAMBA',4,115,0,0x0000000010894eae);
INSERT INTO alinkedlist VALUES (
5,1156,'01                              ','OTUZCO',4,116,0,0x0000000010894eaf);
INSERT INTO alinkedlist VALUES (
5,1157,'02                              ','AGALLPAMPA',4,116,0,0x0000000010894eb0);
INSERT INTO alinkedlist VALUES (
5,1158,'03                              ','CHARAT',4,116,0,0x0000000010894eb1);
INSERT INTO alinkedlist VALUES (
5,1159,'04                              ','HUARANCHAL',4,116,0,0x0000000010894eb2);
INSERT INTO alinkedlist VALUES (
5,1160,'05                              ','LA CUESTA',4,116,0,0x0000000010894eb3);
INSERT INTO alinkedlist VALUES (
5,1161,'08                              ','PARANDAY',4,116,0,0x0000000010894eb4);
INSERT INTO alinkedlist VALUES (
5,1162,'09                              ','SALPO',4,116,0,0x0000000010894eb5);
INSERT INTO alinkedlist VALUES (
5,1163,'10                              ','SINSICAP',4,116,0,0x0000000010894eb6);
INSERT INTO alinkedlist VALUES (
5,1164,'11                              ','USQUIL',4,116,0,0x0000000010894eb7);
INSERT INTO alinkedlist VALUES (
5,1165,'13                              ','MACHE',4,116,0,0x0000000010894eb8);
INSERT INTO alinkedlist VALUES (
5,1166,'01                              ','SAN PEDRO DE LLOC',4,117,0,0x0000000010894eb9);
INSERT INTO alinkedlist VALUES (
5,1167,'03                              ','GUADALUPE',4,117,0,0x0000000010894eba);
INSERT INTO alinkedlist VALUES (
5,1168,'04                              ','JEQUETEPEQUE',4,117,0,0x0000000010894ebb);
INSERT INTO alinkedlist VALUES (
5,1169,'06                              ','PACASMAYO',4,117,0,0x0000000010894ebc);
INSERT INTO alinkedlist VALUES (
5,1170,'08                              ','SAN JOSE',4,117,0,0x0000000010894ebd);
INSERT INTO alinkedlist VALUES (
5,1171,'01                              ','TAYABAMBA',4,118,0,0x0000000010894ebe);
INSERT INTO alinkedlist VALUES (
5,1172,'02                              ','BULDIBUYO',4,118,0,0x0000000010894ebf);
INSERT INTO alinkedlist VALUES (
5,1173,'03                              ','CHILLIA',4,118,0,0x0000000010894ec0);
INSERT INTO alinkedlist VALUES (
5,1174,'04                              ','HUAYLILLAS',4,118,0,0x0000000010894ec1);
INSERT INTO alinkedlist VALUES (
5,1175,'05                              ','HUANCASPATA',4,118,0,0x0000000010894ec2);
INSERT INTO alinkedlist VALUES (
5,1176,'06                              ','HUAYO',4,118,0,0x0000000010894ec3);
INSERT INTO alinkedlist VALUES (
5,1177,'07                              ','ONGON',4,118,0,0x0000000010894ec4);
INSERT INTO alinkedlist VALUES (
5,1178,'08                              ','PARCOY',4,118,0,0x0000000010894ec5);
INSERT INTO alinkedlist VALUES (
5,1179,'09                              ','PATAZ',4,118,0,0x0000000010894ec6);
INSERT INTO alinkedlist VALUES (
5,1180,'10                              ','PIAS',4,118,0,0x0000000010894ec7);
INSERT INTO alinkedlist VALUES (
5,1181,'11                              ','TAURIJA',4,118,0,0x0000000010894ec8);
INSERT INTO alinkedlist VALUES (
5,1182,'12                              ','URPAY',4,118,0,0x0000000010894ec9);
INSERT INTO alinkedlist VALUES (
5,1183,'13                              ','SANTIAGO DE CHALLAS',4,118,0,0x0000000010894eca);
INSERT INTO alinkedlist VALUES (
5,1184,'01                              ','SANTIAGO DE CHUCO',4,119,0,0x0000000010894ecb);
INSERT INTO alinkedlist VALUES (
5,1185,'02                              ','CACHICADAN',4,119,0,0x0000000010894ecc);
INSERT INTO alinkedlist VALUES (
5,1186,'03                              ','MOLLEBAMBA',4,119,0,0x0000000010894ecd);
INSERT INTO alinkedlist VALUES (
5,1187,'04                              ','MOLLEPATA',4,119,0,0x0000000010894ece);
INSERT INTO alinkedlist VALUES (
5,1188,'05                              ','QUIRUVILCA',4,119,0,0x0000000010894ecf);
INSERT INTO alinkedlist VALUES (
5,1189,'06                              ','SANTA CRUZ DE CHUCA',4,119,0,0x0000000010894ed0);
INSERT INTO alinkedlist VALUES (
5,1190,'07                              ','SITABAMBA',4,119,0,0x0000000010894ed1);
INSERT INTO alinkedlist VALUES (
5,1191,'08                              ','ANGASMARCA',4,119,0,0x0000000010894ed2);
INSERT INTO alinkedlist VALUES (
5,1192,'01                              ','ASCOPE',4,120,0,0x0000000010894ed3);
INSERT INTO alinkedlist VALUES (
5,1193,'02                              ','CHICAMA',4,120,0,0x0000000010894ed4);
INSERT INTO alinkedlist VALUES (
5,1194,'03                              ','CHOCOPE',4,120,0,0x0000000010894ed5);
INSERT INTO alinkedlist VALUES (
5,1195,'04                              ','SANTIAGO DE CAO',4,120,0,0x0000000010894ed6);
INSERT INTO alinkedlist VALUES (
5,1196,'05                              ','MAGDALENA DE CAO',4,120,0,0x0000000010894ed7);
INSERT INTO alinkedlist VALUES (
5,1197,'06                              ','PAIJAN',4,120,0,0x0000000010894ed8);
INSERT INTO alinkedlist VALUES (
5,1198,'07                              ','RAZURI',4,120,0,0x0000000010894ed9);
INSERT INTO alinkedlist VALUES (
5,1199,'08                              ','CASA GRANDE',4,120,0,0x0000000010894eda);
INSERT INTO alinkedlist VALUES (
5,1200,'01                              ','CHEPEN',4,121,0,0x0000000010894edb);
INSERT INTO alinkedlist VALUES (
5,1201,'02                              ','PACANGA',4,121,0,0x0000000010894edc);
INSERT INTO alinkedlist VALUES (
5,1202,'03                              ','PUEBLO NUEVO',4,121,0,0x0000000010894edd);
INSERT INTO alinkedlist VALUES (
5,1203,'01                              ','JULCAN',4,122,0,0x0000000010894ede);
INSERT INTO alinkedlist VALUES (
5,1204,'02                              ','CARABAMBA',4,122,0,0x0000000010894edf);
INSERT INTO alinkedlist VALUES (
5,1205,'03                              ','CALAMARCA',4,122,0,0x0000000010894ee0);
INSERT INTO alinkedlist VALUES (
5,1206,'04                              ','HUASO',4,122,0,0x0000000010894ee1);
INSERT INTO alinkedlist VALUES (
5,1207,'01                              ','CASCAS',4,123,0,0x0000000010894ee2);
INSERT INTO alinkedlist VALUES (
5,1208,'02                              ','LUCMA',4,123,0,0x0000000010894ee3);
INSERT INTO alinkedlist VALUES (
5,1209,'03                              ','MARMOT',4,123,0,0x0000000010894ee4);
INSERT INTO alinkedlist VALUES (
5,1210,'04                              ','SAYAPULLO',4,123,0,0x0000000010894ee5);
INSERT INTO alinkedlist VALUES (
5,1211,'01                              ','VIRU',4,124,0,0x0000000010894ee6);
INSERT INTO alinkedlist VALUES (
5,1212,'02                              ','CHAO',4,124,0,0x0000000010894ee7);
INSERT INTO alinkedlist VALUES (
5,1213,'03                              ','GUADALUPITO',4,124,0,0x0000000010894ee8);
INSERT INTO alinkedlist VALUES (
5,1214,'01                              ','CHICLAYO',4,125,0,0x0000000010894ee9);
INSERT INTO alinkedlist VALUES (
5,1215,'02                              ','CHONGOYAPE',4,125,0,0x0000000010894eea);
INSERT INTO alinkedlist VALUES (
5,1216,'03                              ','ETEN',4,125,0,0x0000000010894eeb);
INSERT INTO alinkedlist VALUES (
5,1217,'04                              ','ETEN PUERTO',4,125,0,0x0000000010894eec);
INSERT INTO alinkedlist VALUES (
5,1218,'05                              ','LAGUNAS',4,125,0,0x0000000010894eed);
INSERT INTO alinkedlist VALUES (
5,1219,'06                              ','MONSEFU',4,125,0,0x0000000010894eee);
INSERT INTO alinkedlist VALUES (
5,1220,'07                              ','NUEVA ARICA',4,125,0,0x0000000010894eef);
INSERT INTO alinkedlist VALUES (
5,1221,'08                              ','OYOTUN',4,125,0,0x0000000010894ef0);
INSERT INTO alinkedlist VALUES (
5,1222,'09                              ','PICSI',4,125,0,0x0000000010894ef1);
INSERT INTO alinkedlist VALUES (
5,1223,'10                              ','PIMENTEL',4,125,0,0x0000000010894ef2);
INSERT INTO alinkedlist VALUES (
5,1224,'11                              ','REQUE',4,125,0,0x0000000010894ef3);
INSERT INTO alinkedlist VALUES (
5,1225,'12                              ','JOSE LEONARDO ORTIZ',4,125,0,0x0000000010894ef4);
INSERT INTO alinkedlist VALUES (
5,1226,'13                              ','SANTA ROSA',4,125,0,0x0000000010894ef5);
INSERT INTO alinkedlist VALUES (
5,1227,'14                              ','SAÑA',4,125,0,0x0000000010894ef6);
INSERT INTO alinkedlist VALUES (
5,1228,'15                              ','LA VICTORIA',4,125,0,0x0000000010894ef7);
INSERT INTO alinkedlist VALUES (
5,1229,'16                              ','CAYALTI',4,125,0,0x0000000010894ef8);
INSERT INTO alinkedlist VALUES (
5,1230,'17                              ','PATAPO',4,125,0,0x0000000010894ef9);
INSERT INTO alinkedlist VALUES (
5,1231,'18                              ','POMALCA',4,125,0,0x0000000010894efa);
INSERT INTO alinkedlist VALUES (
5,1232,'20                              ','PUCALA',4,125,0,0x0000000010894efb);
INSERT INTO alinkedlist VALUES (
5,1233,'21                              ','TUMAN',4,125,0,0x0000000010894efc);
INSERT INTO alinkedlist VALUES (
5,1234,'01                              ','FERREÑAFE',4,126,0,0x0000000010894efd);
INSERT INTO alinkedlist VALUES (
5,1235,'02                              ','INCAHUASI',4,126,0,0x0000000010894efe);
INSERT INTO alinkedlist VALUES (
5,1236,'03                              ','CAÑARIS',4,126,0,0x0000000010894eff);
INSERT INTO alinkedlist VALUES (
5,1237,'04                              ','PITIPO',4,126,0,0x0000000010894f01);
INSERT INTO alinkedlist VALUES (
5,1238,'05                              ','PUEBLO NUEVO',4,126,0,0x0000000010894f02);
INSERT INTO alinkedlist VALUES (
5,1239,'06                              ','MANUEL ANTONIO MESONES MURO',4,126,0,0x0000000010894f03);
INSERT INTO alinkedlist VALUES (
5,1240,'01                              ','LAMBAYEQUE',4,127,0,0x0000000010894f04);
INSERT INTO alinkedlist VALUES (
5,1241,'02                              ','CHOCHOPE',4,127,0,0x0000000010894f05);
INSERT INTO alinkedlist VALUES (
5,1242,'03                              ','ILLIMO',4,127,0,0x0000000010894f06);
INSERT INTO alinkedlist VALUES (
5,1243,'04                              ','JAYANCA',4,127,0,0x0000000010894f07);
INSERT INTO alinkedlist VALUES (
5,1244,'05                              ','MOCHUMI',4,127,0,0x0000000010894f08);
INSERT INTO alinkedlist VALUES (
5,1245,'06                              ','MORROPE',4,127,0,0x0000000010894f09);
INSERT INTO alinkedlist VALUES (
5,1246,'07                              ','MOTUPE',4,127,0,0x0000000010894f0a);
INSERT INTO alinkedlist VALUES (
5,1247,'08                              ','OLMOS',4,127,0,0x0000000010894f0b);
INSERT INTO alinkedlist VALUES (
5,1248,'09                              ','PACORA',4,127,0,0x0000000010894f0c);
INSERT INTO alinkedlist VALUES (
5,1249,'10                              ','SALAS',4,127,0,0x0000000010894f0d);
INSERT INTO alinkedlist VALUES (
5,1250,'11                              ','SAN JOSE',4,127,0,0x0000000010894f0e);
INSERT INTO alinkedlist VALUES (
5,1251,'12                              ','TUCUME',4,127,0,0x0000000010894f0f);
INSERT INTO alinkedlist VALUES (
5,1252,'01                              ','LIMA',4,128,0,0x0000000010894f10);
INSERT INTO alinkedlist VALUES (
5,1253,'02                              ','ANCON',4,128,0,0x0000000010894f11);
INSERT INTO alinkedlist VALUES (
5,1254,'03                              ','ATE',4,128,0,0x0000000010894f12);
INSERT INTO alinkedlist VALUES (
5,1255,'04                              ','BREÑA',4,128,0,0x0000000010894f13);
INSERT INTO alinkedlist VALUES (
5,1256,'05                              ','CARABAYLLO',4,128,0,0x0000000010894f14);
INSERT INTO alinkedlist VALUES (
5,1257,'06                              ','COMAS',4,128,0,0x0000000010894f15);
INSERT INTO alinkedlist VALUES (
5,1258,'07                              ','CHACLACAYO',4,128,0,0x0000000010894f16);
INSERT INTO alinkedlist VALUES (
5,1259,'08                              ','CHORRILLOS',4,128,0,0x0000000010894f17);
INSERT INTO alinkedlist VALUES (
5,1260,'09                              ','LA VICTORIA',4,128,0,0x0000000010894f18);
INSERT INTO alinkedlist VALUES (
5,1261,'10                              ','LA MOLINA',4,128,0,0x0000000010894f19);
INSERT INTO alinkedlist VALUES (
5,1262,'11                              ','LINCE',4,128,0,0x0000000010894f1a);
INSERT INTO alinkedlist VALUES (
5,1263,'12                              ','LURIGANCHO',4,128,0,0x0000000010894f1b);
INSERT INTO alinkedlist VALUES (
5,1264,'13                              ','LURIN',4,128,0,0x0000000010894f1c);
INSERT INTO alinkedlist VALUES (
5,1265,'14                              ','MAGDALENA DEL MAR',4,128,0,0x0000000010894f1d);
INSERT INTO alinkedlist VALUES (
5,1266,'15                              ','MIRAFLORES',4,128,0,0x0000000010894f1e);
INSERT INTO alinkedlist VALUES (
5,1267,'16                              ','PACHACAMAC',4,128,0,0x0000000010894f1f);
INSERT INTO alinkedlist VALUES (
5,1268,'17                              ','PUEBLO LIBRE',4,128,0,0x0000000010894f20);
INSERT INTO alinkedlist VALUES (
5,1269,'18                              ','PUCUSANA',4,128,0,0x0000000010894f21);
INSERT INTO alinkedlist VALUES (
5,1270,'19                              ','PUENTE PIEDRA',4,128,0,0x0000000010b38f7d);
INSERT INTO alinkedlist VALUES (
5,1271,'20                              ','PUNTA HERMOSA',4,128,0,0x0000000010b38f7e);
INSERT INTO alinkedlist VALUES (
5,1272,'21                              ','PUNTA NEGRA',4,128,0,0x0000000010b38f7f);
INSERT INTO alinkedlist VALUES (
5,1273,'22                              ','RIMAC',4,128,0,0x0000000010b38f80);
INSERT INTO alinkedlist VALUES (
5,1274,'23                              ','SAN BARTOLO',4,128,0,0x0000000010894f26);
INSERT INTO alinkedlist VALUES (
5,1275,'24                              ','SAN ISIDRO',4,128,0,0x0000000010894f27);
INSERT INTO alinkedlist VALUES (
5,1276,'25                              ','BARRANCO',4,128,0,0x0000000010894f28);
INSERT INTO alinkedlist VALUES (
5,1277,'26                              ','SAN MARTIN DE PORRES',4,128,0,0x0000000010894f29);
INSERT INTO alinkedlist VALUES (
5,1278,'27                              ','SAN MIGUEL',4,128,0,0x0000000010894f2a);
INSERT INTO alinkedlist VALUES (
5,1279,'28                              ','SANTA MARIA DEL MAR',4,128,0,0x0000000010894f2b);
INSERT INTO alinkedlist VALUES (
5,1280,'29                              ','SANTA ROSA',4,128,0,0x0000000010894f2c);
INSERT INTO alinkedlist VALUES (
5,1281,'30                              ','SANTIAGO DE SURCO',4,128,0,0x0000000010894f2d);
INSERT INTO alinkedlist VALUES (
5,1282,'31                              ','SURQUILLO',4,128,0,0x0000000010894f2e);
INSERT INTO alinkedlist VALUES (
5,1283,'32                              ','VILLA MARIA DEL TRIUNFO',4,128,0,0x0000000010894f2f);
INSERT INTO alinkedlist VALUES (
5,1284,'33                              ','JESUS MARIA',4,128,0,0x0000000010894f30);
INSERT INTO alinkedlist VALUES (
5,1285,'34                              ','INDEPENDENCIA',4,128,0,0x0000000010894f31);
INSERT INTO alinkedlist VALUES (
5,1286,'35                              ','EL AGUSTINO',4,128,0,0x0000000010894f32);
INSERT INTO alinkedlist VALUES (
5,1287,'36                              ','SAN JUAN DE MIRAFLORES',4,128,0,0x0000000010894f33);
INSERT INTO alinkedlist VALUES (
5,1288,'37                              ','SAN JUAN DE LURIGANCHO',4,128,0,0x0000000010894f34);
INSERT INTO alinkedlist VALUES (
5,1289,'38                              ','SAN LUIS',4,128,0,0x0000000010894f35);
INSERT INTO alinkedlist VALUES (
5,1290,'39                              ','CIENEGUILLA',4,128,0,0x0000000010894f36);
INSERT INTO alinkedlist VALUES (
5,1291,'40                              ','SAN BORJA',4,128,0,0x0000000010894f37);
INSERT INTO alinkedlist VALUES (
5,1292,'41                              ','VILLA EL SALVADOR',4,128,0,0x0000000010894f38);
INSERT INTO alinkedlist VALUES (
5,1293,'42                              ','LOS OLIVOS',4,128,0,0x0000000010894f39);
INSERT INTO alinkedlist VALUES (
5,1294,'43                              ','SANTA ANITA',4,128,0,0x0000000010894f3a);
INSERT INTO alinkedlist VALUES (
5,1295,'01                              ','CAJATAMBO',4,129,0,0x0000000010894f3b);
INSERT INTO alinkedlist VALUES (
5,1296,'05                              ','COPA',4,129,0,0x0000000010894f3c);
INSERT INTO alinkedlist VALUES (
5,1297,'06                              ','GORGOR',4,129,0,0x0000000010894f3d);
INSERT INTO alinkedlist VALUES (
5,1298,'07                              ','HUANCAPON',4,129,0,0x0000000010894f3e);
INSERT INTO alinkedlist VALUES (
5,1299,'08                              ','MANAS',4,129,0,0x0000000010894f3f);
INSERT INTO alinkedlist VALUES (
5,1300,'01                              ','CANTA',4,130,0,0x0000000010894f40);
INSERT INTO alinkedlist VALUES (
5,1301,'02                              ','ARAHUAY',4,130,0,0x0000000010894f41);
INSERT INTO alinkedlist VALUES (
5,1302,'03                              ','HUAMANTANGA',4,130,0,0x0000000010894f42);
INSERT INTO alinkedlist VALUES (
5,1303,'04                              ','HUAROS',4,130,0,0x0000000010894f43);
INSERT INTO alinkedlist VALUES (
5,1304,'05                              ','LACHAQUI',4,130,0,0x0000000010894f44);
INSERT INTO alinkedlist VALUES (
5,1305,'06                              ','SAN BUENAVENTURA',4,130,0,0x0000000010894f45);
INSERT INTO alinkedlist VALUES (
5,1306,'07                              ','SANTA ROSA DE QUIVES',4,130,0,0x0000000010894f46);
INSERT INTO alinkedlist VALUES (
5,1307,'01                              ','SAN VICENTE DE CAÑETE',4,131,0,0x0000000010894f47);
INSERT INTO alinkedlist VALUES (
5,1308,'02                              ','CALANGO',4,131,0,0x0000000010894f48);
INSERT INTO alinkedlist VALUES (
5,1309,'03                              ','CERRO AZUL',4,131,0,0x0000000010894f49);
INSERT INTO alinkedlist VALUES (
5,1310,'04                              ','COAYLLO',4,131,0,0x0000000010894f4a);
INSERT INTO alinkedlist VALUES (
5,1311,'05                              ','CHILCA',4,131,0,0x0000000010894f4b);
INSERT INTO alinkedlist VALUES (
5,1312,'06                              ','IMPERIAL',4,131,0,0x0000000010894f4c);
INSERT INTO alinkedlist VALUES (
5,1313,'07                              ','LUNAHUANA',4,131,0,0x0000000010894f4d);
INSERT INTO alinkedlist VALUES (
5,1314,'08                              ','MALA',4,131,0,0x0000000010894f4e);
INSERT INTO alinkedlist VALUES (
5,1315,'09                              ','NUEVO IMPERIAL',4,131,0,0x0000000010894f4f);
INSERT INTO alinkedlist VALUES (
5,1316,'10                              ','PACARAN',4,131,0,0x0000000010894f50);
INSERT INTO alinkedlist VALUES (
5,1317,'11                              ','QUILMANA',4,131,0,0x0000000010894f51);
INSERT INTO alinkedlist VALUES (
5,1318,'12                              ','SAN ANTONIO',4,131,0,0x0000000010894f52);
INSERT INTO alinkedlist VALUES (
5,1319,'13                              ','SAN LUIS',4,131,0,0x0000000010894f53);
INSERT INTO alinkedlist VALUES (
5,1320,'14                              ','SANTA CRUZ DE FLORES',4,131,0,0x0000000010894f54);
INSERT INTO alinkedlist VALUES (
5,1321,'15                              ','ZUÑIGA',4,131,0,0x0000000010894f55);
INSERT INTO alinkedlist VALUES (
5,1322,'16                              ','ASIA',4,131,0,0x0000000010894f56);
INSERT INTO alinkedlist VALUES (
5,1323,'01                              ','HUACHO',4,132,0,0x0000000010894f57);
INSERT INTO alinkedlist VALUES (
5,1324,'02                              ','AMBAR',4,132,0,0x0000000010894f58);
INSERT INTO alinkedlist VALUES (
5,1325,'04                              ','CALETA DE CARQUIN',4,132,0,0x0000000010894f59);
INSERT INTO alinkedlist VALUES (
5,1326,'05                              ','CHECRAS',4,132,0,0x0000000010894f5a);
INSERT INTO alinkedlist VALUES (
5,1327,'06                              ','HUALMAY',4,132,0,0x0000000010894f5b);
INSERT INTO alinkedlist VALUES (
5,1328,'07                              ','HUAURA',4,132,0,0x0000000010894f5c);
INSERT INTO alinkedlist VALUES (
5,1329,'08                              ','LEONCIO PRADO',4,132,0,0x0000000010894f5d);
INSERT INTO alinkedlist VALUES (
5,1330,'09                              ','PACCHO',4,132,0,0x0000000010894f5e);
INSERT INTO alinkedlist VALUES (
5,1331,'11                              ','SANTA LEONOR',4,132,0,0x0000000010894f5f);
INSERT INTO alinkedlist VALUES (
5,1332,'12                              ','SANTA MARIA',4,132,0,0x0000000010894f60);
INSERT INTO alinkedlist VALUES (
5,1333,'13                              ','SAYAN',4,132,0,0x0000000010894f61);
INSERT INTO alinkedlist VALUES (
5,1334,'16                              ','VEGUETA',4,132,0,0x0000000010894f62);
INSERT INTO alinkedlist VALUES (
5,1335,'01                              ','MATUCANA',4,133,0,0x0000000010894f63);
INSERT INTO alinkedlist VALUES (
5,1336,'02                              ','ANTIOQUIA',4,133,0,0x0000000010894f64);
INSERT INTO alinkedlist VALUES (
5,1337,'03                              ','CALLAHUANCA',4,133,0,0x0000000010894f65);
INSERT INTO alinkedlist VALUES (
5,1338,'04                              ','CARAMPOMA',4,133,0,0x0000000010894f66);
INSERT INTO alinkedlist VALUES (
5,1339,'05                              ','CASTA',4,133,0,0x0000000010894f67);
INSERT INTO alinkedlist VALUES (
5,1340,'06                              ','SAN JOSE DE LOS CHORRILLOS',4,133,0,0x0000000010894f68);
INSERT INTO alinkedlist VALUES (
5,1341,'07                              ','CHICLA',4,133,0,0x0000000010894f69);
INSERT INTO alinkedlist VALUES (
5,1342,'08                              ','HUANZA',4,133,0,0x0000000010894f6a);
INSERT INTO alinkedlist VALUES (
5,1343,'09                              ','HUAROCHIRI',4,133,0,0x0000000010894f6b);
INSERT INTO alinkedlist VALUES (
5,1344,'10                              ','LAHUAYTAMBO',4,133,0,0x0000000010894f6c);
INSERT INTO alinkedlist VALUES (
5,1345,'11                              ','LANGA',4,133,0,0x0000000010894f6d);
INSERT INTO alinkedlist VALUES (
5,1346,'12                              ','MARIATANA',4,133,0,0x0000000010894f6e);
INSERT INTO alinkedlist VALUES (
5,1347,'13                              ','RICARDO PALMA',4,133,0,0x0000000010894f6f);
INSERT INTO alinkedlist VALUES (
5,1348,'14                              ','SAN ANDRES DE TUPICOCHA',4,133,0,0x0000000010894f70);
INSERT INTO alinkedlist VALUES (
5,1349,'15                              ','SAN ANTONIO',4,133,0,0x0000000010894f71);
INSERT INTO alinkedlist VALUES (
5,1350,'16                              ','SAN BARTOLOME',4,133,0,0x0000000010894f72);
INSERT INTO alinkedlist VALUES (
5,1351,'17                              ','SAN DAMIAN',4,133,0,0x0000000010894f73);
INSERT INTO alinkedlist VALUES (
5,1352,'18                              ','SANGALLAYA',4,133,0,0x0000000010894f74);
INSERT INTO alinkedlist VALUES (
5,1353,'19                              ','SAN JUAN DE TANTARANCHE',4,133,0,0x0000000010b390f4);
INSERT INTO alinkedlist VALUES (
5,1354,'20                              ','SAN LORENZO DE QUINTI',4,133,0,0x0000000010b390f5);
INSERT INTO alinkedlist VALUES (
5,1355,'21                              ','SAN MATEO',4,133,0,0x0000000010b390f6);
INSERT INTO alinkedlist VALUES (
5,1356,'22                              ','SAN MATEO DE OTAO',4,133,0,0x0000000010b390f7);
INSERT INTO alinkedlist VALUES (
5,1357,'23                              ','SAN PEDRO DE HUANCAYRE',4,133,0,0x0000000010894f79);
INSERT INTO alinkedlist VALUES (
5,1358,'24                              ','SANTA CRUZ DE COCACHACRA',4,133,0,0x0000000010894f7a);
INSERT INTO alinkedlist VALUES (
5,1359,'25                              ','SANTA EULALIA',4,133,0,0x0000000010894f7b);
INSERT INTO alinkedlist VALUES (
5,1360,'26                              ','SANTIAGO DE ANCHUCAYA',4,133,0,0x0000000010894f7c);
INSERT INTO alinkedlist VALUES (
5,1361,'27                              ','SANTIAGO DE TUNA',4,133,0,0x0000000010894f7d);
INSERT INTO alinkedlist VALUES (
5,1362,'28                              ','SANTO DOMINGO DE LOS OLLEROS',4,133,0,0x0000000010894f7e);
INSERT INTO alinkedlist VALUES (
5,1363,'29                              ','SURCO',4,133,0,0x0000000010894f7f);
INSERT INTO alinkedlist VALUES (
5,1364,'30                              ','HUACHUPAMPA',4,133,0,0x0000000010894f80);
INSERT INTO alinkedlist VALUES (
5,1365,'31                              ','LARAOS',4,133,0,0x0000000010894f81);
INSERT INTO alinkedlist VALUES (
5,1366,'32                              ','SAN JUAN DE IRIS',4,133,0,0x0000000010894f82);
INSERT INTO alinkedlist VALUES (
5,1367,'01                              ','YAUYOS',4,134,0,0x0000000010894f83);
INSERT INTO alinkedlist VALUES (
5,1368,'02                              ','ALIS',4,134,0,0x0000000010894f84);
INSERT INTO alinkedlist VALUES (
5,1369,'03                              ','ALLAUCA',4,134,0,0x0000000010894f85);
INSERT INTO alinkedlist VALUES (
5,1370,'04                              ','AYAVIRI',4,134,0,0x0000000010894f86);
INSERT INTO alinkedlist VALUES (
5,1371,'05                              ','AZANGARO',4,134,0,0x0000000010894f87);
INSERT INTO alinkedlist VALUES (
5,1372,'06                              ','CACRA',4,134,0,0x0000000010894f88);
INSERT INTO alinkedlist VALUES (
5,1373,'07                              ','CARANIA',4,134,0,0x0000000010894f89);
INSERT INTO alinkedlist VALUES (
5,1374,'08                              ','COCHAS',4,134,0,0x0000000010894f8a);
INSERT INTO alinkedlist VALUES (
5,1375,'09                              ','COLONIA',4,134,0,0x0000000010894f8b);
INSERT INTO alinkedlist VALUES (
5,1376,'10                              ','CHOCOS',4,134,0,0x0000000010894f8c);
INSERT INTO alinkedlist VALUES (
5,1377,'11                              ','HUAMPARA',4,134,0,0x0000000010894f8d);
INSERT INTO alinkedlist VALUES (
5,1378,'12                              ','HUANCAYA',4,134,0,0x0000000010894f8e);
INSERT INTO alinkedlist VALUES (
5,1379,'13                              ','HUANGASCAR',4,134,0,0x0000000010894f8f);
INSERT INTO alinkedlist VALUES (
5,1380,'14                              ','HUANTAN',4,134,0,0x0000000010894f90);
INSERT INTO alinkedlist VALUES (
5,1381,'15                              ','HUAÑEC',4,134,0,0x0000000010894f91);
INSERT INTO alinkedlist VALUES (
5,1382,'16                              ','LARAOS',4,134,0,0x0000000010894f92);
INSERT INTO alinkedlist VALUES (
5,1383,'17                              ','LINCHA',4,134,0,0x0000000010894f93);
INSERT INTO alinkedlist VALUES (
5,1384,'18                              ','MIRAFLORES',4,134,0,0x0000000010894f94);
INSERT INTO alinkedlist VALUES (
5,1385,'19                              ','OMAS',4,134,0,0x0000000010b390fa);
INSERT INTO alinkedlist VALUES (
5,1386,'20                              ','QUINCHES',4,134,0,0x0000000010b390fb);
INSERT INTO alinkedlist VALUES (
5,1387,'21                              ','QUINOCAY',4,134,0,0x0000000010b390fc);
INSERT INTO alinkedlist VALUES (
5,1388,'22                              ','SAN JOAQUIN',4,134,0,0x0000000010b390fd);
INSERT INTO alinkedlist VALUES (
5,1389,'23                              ','SAN PEDRO DE PILAS',4,134,0,0x0000000010894f99);
INSERT INTO alinkedlist VALUES (
5,1390,'24                              ','TANTA',4,134,0,0x0000000010894f9a);
INSERT INTO alinkedlist VALUES (
5,1391,'25                              ','TAURIPAMPA',4,134,0,0x0000000010894f9b);
INSERT INTO alinkedlist VALUES (
5,1392,'26                              ','TUPE',4,134,0,0x0000000010894f9c);
INSERT INTO alinkedlist VALUES (
5,1393,'27                              ','TOMAS',4,134,0,0x0000000010894f9d);
INSERT INTO alinkedlist VALUES (
5,1394,'28                              ','VIÑAC',4,134,0,0x0000000010894f9e);
INSERT INTO alinkedlist VALUES (
5,1395,'29                              ','VITIS',4,134,0,0x0000000010894f9f);
INSERT INTO alinkedlist VALUES (
5,1396,'30                              ','HONGOS',4,134,0,0x0000000010894fa0);
INSERT INTO alinkedlist VALUES (
5,1397,'31                              ','MADEAN',4,134,0,0x0000000010894fa1);
INSERT INTO alinkedlist VALUES (
5,1398,'32                              ','PUTINZA',4,134,0,0x0000000010894fa2);
INSERT INTO alinkedlist VALUES (
5,1399,'33                              ','CATAHUASI',4,134,0,0x0000000010894fa3);
INSERT INTO alinkedlist VALUES (
5,1400,'01                              ','HUARAL',4,135,0,0x0000000010894fa4);
INSERT INTO alinkedlist VALUES (
5,1401,'02                              ','ATAVILLOS ALTO',4,135,0,0x0000000010894fa5);
INSERT INTO alinkedlist VALUES (
5,1402,'03                              ','ATAVILLOS BAJO',4,135,0,0x0000000010894fa6);
INSERT INTO alinkedlist VALUES (
5,1403,'04                              ','AUCALLAMA',4,135,0,0x0000000010894fa7);
INSERT INTO alinkedlist VALUES (
5,1404,'05                              ','CHANCAY',4,135,0,0x0000000010894fa8);
INSERT INTO alinkedlist VALUES (
5,1405,'06                              ','IHUARI',4,135,0,0x0000000010894fa9);
INSERT INTO alinkedlist VALUES (
5,1406,'07                              ','LAMPIAN',4,135,0,0x0000000010894faa);
INSERT INTO alinkedlist VALUES (
5,1407,'08                              ','PACARAOS',4,135,0,0x0000000010894fab);
INSERT INTO alinkedlist VALUES (
5,1408,'09                              ','SAN MIGUEL DE ACOS',4,135,0,0x0000000010894fac);
INSERT INTO alinkedlist VALUES (
5,1409,'10                              ','VEINTISIETE DE NOVIEMBRE',4,135,0,0x0000000010894fad);
INSERT INTO alinkedlist VALUES (
5,1410,'11                              ','SANTA CRUZ DE ANDAMARCA',4,135,0,0x0000000010894fae);
INSERT INTO alinkedlist VALUES (
5,1411,'12                              ','SUMBILCA',4,135,0,0x0000000010894faf);
INSERT INTO alinkedlist VALUES (
5,1412,'01                              ','BARRANCA',4,136,0,0x0000000010894fb0);
INSERT INTO alinkedlist VALUES (
5,1413,'02                              ','PARAMONGA',4,136,0,0x0000000010894fb1);
INSERT INTO alinkedlist VALUES (
5,1414,'03                              ','PATIVILCA',4,136,0,0x0000000010894fb2);
INSERT INTO alinkedlist VALUES (
5,1415,'04                              ','SUPE',4,136,0,0x0000000010894fb3);
INSERT INTO alinkedlist VALUES (
5,1416,'05                              ','SUPE PUERTO',4,136,0,0x0000000010894fb4);
INSERT INTO alinkedlist VALUES (
5,1417,'01                              ','OYON',4,137,0,0x0000000010894fb5);
INSERT INTO alinkedlist VALUES (
5,1418,'02                              ','NAVAN',4,137,0,0x0000000010894fb6);
INSERT INTO alinkedlist VALUES (
5,1419,'03                              ','CAUJUL',4,137,0,0x0000000010894fb7);
INSERT INTO alinkedlist VALUES (
5,1420,'04                              ','ANDAJES',4,137,0,0x0000000010894fb8);
INSERT INTO alinkedlist VALUES (
5,1421,'05                              ','PACHANGARA',4,137,0,0x0000000010894fb9);
INSERT INTO alinkedlist VALUES (
5,1422,'06                              ','COCHAMARCA',4,137,0,0x0000000010894fba);
INSERT INTO alinkedlist VALUES (
5,1423,'01                              ','IQUITOS',4,138,0,0x0000000010894fbb);
INSERT INTO alinkedlist VALUES (
5,1424,'02                              ','ALTO NANAY',4,138,0,0x0000000010894fbc);
INSERT INTO alinkedlist VALUES (
5,1425,'03                              ','FERNANDO LORES',4,138,0,0x0000000010894fbd);
INSERT INTO alinkedlist VALUES (
5,1426,'04                              ','LAS AMAZONAS',4,138,0,0x0000000010894fbe);
INSERT INTO alinkedlist VALUES (
5,1427,'05                              ','MAZAN',4,138,0,0x0000000010894fbf);
INSERT INTO alinkedlist VALUES (
5,1428,'06                              ','NAPO',4,138,0,0x0000000010894fc0);
INSERT INTO alinkedlist VALUES (
5,1429,'07                              ','PUTUMAYO',4,138,0,0x0000000010894fc1);
INSERT INTO alinkedlist VALUES (
5,1430,'08                              ','TORRES CAUSANA',4,138,0,0x0000000010894fc2);
INSERT INTO alinkedlist VALUES (
5,1431,'10                              ','INDIANA',4,138,0,0x0000000010894fc3);
INSERT INTO alinkedlist VALUES (
5,1432,'11                              ','PUNCHANA',4,138,0,0x0000000010894fc4);
INSERT INTO alinkedlist VALUES (
5,1433,'12                              ','BELEN',4,138,0,0x0000000010894fc5);
INSERT INTO alinkedlist VALUES (
5,1434,'13                              ','SAN JUAN BAUTISTA',4,138,0,0x0000000010894fc6);
INSERT INTO alinkedlist VALUES (
5,1435,'14                              ','TENIENTE MANUEL CLAVERO',4,138,0,0x0000000010894fc7);
INSERT INTO alinkedlist VALUES (
5,1436,'01                              ','YURIMAGUAS',4,139,0,0x0000000010894fc8);
INSERT INTO alinkedlist VALUES (
5,1437,'02                              ','BALSAPUERTO',4,139,0,0x0000000010894fc9);
INSERT INTO alinkedlist VALUES (
5,1438,'05                              ','JEBEROS',4,139,0,0x0000000010894fca);
INSERT INTO alinkedlist VALUES (
5,1439,'06                              ','LAGUNAS',4,139,0,0x0000000010894fcb);
INSERT INTO alinkedlist VALUES (
5,1440,'10                              ','SANTA CRUZ',4,139,0,0x0000000010894fcc);
INSERT INTO alinkedlist VALUES (
5,1441,'11                              ','TENIENTE CESAR LOPEZ ROJAS',4,139,0,0x0000000010894fcd);
INSERT INTO alinkedlist VALUES (
5,1442,'01                              ','NAUTA',4,140,0,0x0000000010894fce);
INSERT INTO alinkedlist VALUES (
5,1443,'02                              ','PARINARI',4,140,0,0x0000000010894fcf);
INSERT INTO alinkedlist VALUES (
5,1444,'03                              ','TIGRE',4,140,0,0x0000000010894fd0);
INSERT INTO alinkedlist VALUES (
5,1445,'04                              ','URARINAS',4,140,0,0x0000000010894fd1);
INSERT INTO alinkedlist VALUES (
5,1446,'05                              ','TROMPETEROS',4,140,0,0x0000000010894fd2);
INSERT INTO alinkedlist VALUES (
5,1447,'01                              ','REQUENA',4,141,0,0x0000000010894fd3);
INSERT INTO alinkedlist VALUES (
5,1448,'02                              ','ALTO TAPICHE',4,141,0,0x0000000010894fd4);
INSERT INTO alinkedlist VALUES (
5,1449,'03                              ','CAPELO',4,141,0,0x0000000010894fd5);
INSERT INTO alinkedlist VALUES (
5,1450,'04                              ','EMILIO SAN MARTIN',4,141,0,0x0000000010894fd6);
INSERT INTO alinkedlist VALUES (
5,1451,'05                              ','MAQUIA',4,141,0,0x0000000010894fd7);
INSERT INTO alinkedlist VALUES (
5,1452,'06                              ','PUINAHUA',4,141,0,0x0000000010894fd8);
INSERT INTO alinkedlist VALUES (
5,1453,'07                              ','SAQUENA',4,141,0,0x0000000010894fd9);
INSERT INTO alinkedlist VALUES (
5,1454,'08                              ','SOPLIN',4,141,0,0x0000000010894fda);
INSERT INTO alinkedlist VALUES (
5,1455,'09                              ','TAPICHE',4,141,0,0x0000000010894fdb);
INSERT INTO alinkedlist VALUES (
5,1456,'10                              ','JENARO HERRERA',4,141,0,0x0000000010894fdc);
INSERT INTO alinkedlist VALUES (
5,1457,'11                              ','YAQUERANA',4,141,0,0x0000000010894fdd);
INSERT INTO alinkedlist VALUES (
5,1458,'01                              ','CONTAMANA',4,142,0,0x0000000010894fde);
INSERT INTO alinkedlist VALUES (
5,1459,'02                              ','VARGAS GUERRA',4,142,0,0x0000000010894fdf);
INSERT INTO alinkedlist VALUES (
5,1460,'03                              ','PADRE MARQUEZ',4,142,0,0x0000000010894fe0);
INSERT INTO alinkedlist VALUES (
5,1461,'04                              ','PAMPA HERMOSA',4,142,0,0x0000000010894fe1);
INSERT INTO alinkedlist VALUES (
5,1462,'05                              ','SARAYACU',4,142,0,0x0000000010894fe2);
INSERT INTO alinkedlist VALUES (
5,1463,'06                              ','INAHUAYA',4,142,0,0x0000000010894fe3);
INSERT INTO alinkedlist VALUES (
5,1464,'01                              ','RAMON CASTILLA',4,143,0,0x0000000010894fe4);
INSERT INTO alinkedlist VALUES (
5,1465,'02                              ','PEBAS',4,143,0,0x0000000010894fe5);
INSERT INTO alinkedlist VALUES (
5,1466,'03                              ','YAVARI',4,143,0,0x0000000010894fe6);
INSERT INTO alinkedlist VALUES (
5,1467,'04                              ','SAN PABLO',4,143,0,0x0000000010894fe7);
INSERT INTO alinkedlist VALUES (
5,1468,'01                              ','BARRANCA',4,144,0,0x0000000010894fe8);
INSERT INTO alinkedlist VALUES (
5,1469,'02                              ','ANDOAS',4,144,0,0x0000000010894fe9);
INSERT INTO alinkedlist VALUES (
5,1470,'03                              ','CAHUAPANAS',4,144,0,0x0000000010894fea);
INSERT INTO alinkedlist VALUES (
5,1471,'04                              ','MANSERICHE',4,144,0,0x0000000010894feb);
INSERT INTO alinkedlist VALUES (
5,1472,'05                              ','MORONA',4,144,0,0x0000000010894fec);
INSERT INTO alinkedlist VALUES (
5,1473,'06                              ','PASTAZA',4,144,0,0x0000000010894fed);
INSERT INTO alinkedlist VALUES (
5,1474,'01                              ','TAMBOPATA',4,145,0,0x0000000010894fee);
INSERT INTO alinkedlist VALUES (
5,1475,'02                              ','INAMBARI',4,145,0,0x0000000010894fef);
INSERT INTO alinkedlist VALUES (
5,1476,'03                              ','LAS PIEDRAS',4,145,0,0x0000000010894ff0);
INSERT INTO alinkedlist VALUES (
5,1477,'04                              ','LABERINTO',4,145,0,0x0000000010894ff1);
INSERT INTO alinkedlist VALUES (
5,1478,'01                              ','MANU',4,146,0,0x0000000010894ff2);
INSERT INTO alinkedlist VALUES (
5,1479,'02                              ','FITZCARRALD',4,146,0,0x0000000010894ff4);
INSERT INTO alinkedlist VALUES (
5,1480,'03                              ','MADRE DE DIOS',4,146,0,0x0000000010894ff5);
INSERT INTO alinkedlist VALUES (
5,1481,'04                              ','HUEPETUHE',4,146,0,0x0000000010894ff6);
INSERT INTO alinkedlist VALUES (
5,1482,'01                              ','IÑAPARI',4,147,0,0x0000000010894ff7);
INSERT INTO alinkedlist VALUES (
5,1483,'02                              ','IBERIA',4,147,0,0x0000000010894ff8);
INSERT INTO alinkedlist VALUES (
5,1484,'03                              ','TAHUAMANU',4,147,0,0x0000000010894ff9);
INSERT INTO alinkedlist VALUES (
5,1485,'01                              ','MOQUEGUA',4,148,0,0x0000000010894ffa);
INSERT INTO alinkedlist VALUES (
5,1486,'02                              ','CARUMAS',4,148,0,0x0000000010894ffb);
INSERT INTO alinkedlist VALUES (
5,1487,'03                              ','CUCHUMBAYA',4,148,0,0x0000000010894ffc);
INSERT INTO alinkedlist VALUES (
5,1488,'04                              ','SAN CRISTOBAL',4,148,0,0x0000000010894ffd);
INSERT INTO alinkedlist VALUES (
5,1489,'05                              ','TORATA',4,148,0,0x0000000010894ffe);
INSERT INTO alinkedlist VALUES (
5,1490,'06                              ','SAMEGUA',4,148,0,0x0000000010894fff);
INSERT INTO alinkedlist VALUES (
5,1491,'01                              ','OMATE',4,149,0,0x0000000010895001);
INSERT INTO alinkedlist VALUES (
5,1492,'02                              ','COALAQUE',4,149,0,0x0000000010895002);
INSERT INTO alinkedlist VALUES (
5,1493,'03                              ','CHOJATA',4,149,0,0x0000000010895003);
INSERT INTO alinkedlist VALUES (
5,1494,'04                              ','ICHUÑA',4,149,0,0x0000000010895004);
INSERT INTO alinkedlist VALUES (
5,1495,'05                              ','LA CAPILLA',4,149,0,0x0000000010895005);
INSERT INTO alinkedlist VALUES (
5,1496,'06                              ','LLOQUE',4,149,0,0x0000000010895006);
INSERT INTO alinkedlist VALUES (
5,1497,'07                              ','MATALAQUE',4,149,0,0x0000000010895007);
INSERT INTO alinkedlist VALUES (
5,1498,'08                              ','PUQUINA',4,149,0,0x0000000010895008);
INSERT INTO alinkedlist VALUES (
5,1499,'09                              ','QUINISTAQUILLAS',4,149,0,0x0000000010895009);
INSERT INTO alinkedlist VALUES (
5,1500,'10                              ','UBINAS',4,149,0,0x000000001089500a);
INSERT INTO alinkedlist VALUES (
5,1501,'11                              ','YUNGA',4,149,0,0x000000001089500b);
INSERT INTO alinkedlist VALUES (
5,1502,'01                              ','ILO',4,150,0,0x000000001089500c);
INSERT INTO alinkedlist VALUES (
5,1503,'02                              ','EL ALGARROBAL',4,150,0,0x000000001089500d);
INSERT INTO alinkedlist VALUES (
5,1504,'03                              ','PACOCHA',4,150,0,0x000000001089500e);
INSERT INTO alinkedlist VALUES (
5,1505,'01                              ','CHAUPIMARCA',4,151,0,0x000000001089500f);
INSERT INTO alinkedlist VALUES (
5,1506,'03                              ','HUACHON',4,151,0,0x0000000010895010);
INSERT INTO alinkedlist VALUES (
5,1507,'04                              ','HUARIACA',4,151,0,0x0000000010895011);
INSERT INTO alinkedlist VALUES (
5,1508,'05                              ','HUAYLLAY',4,151,0,0x0000000010895012);
INSERT INTO alinkedlist VALUES (
5,1509,'06                              ','NINACACA',4,151,0,0x0000000010895013);
INSERT INTO alinkedlist VALUES (
5,1510,'07                              ','PALLANCHACRA',4,151,0,0x0000000010895014);
INSERT INTO alinkedlist VALUES (
5,1511,'08                              ','PAUCARTAMBO',4,151,0,0x0000000010895015);
INSERT INTO alinkedlist VALUES (
5,1512,'09                              ','SAN FCO DE ASIS DE YARUSYACAN',4,151,0,0x0000000010895016);
INSERT INTO alinkedlist VALUES (
5,1513,'10                              ','SIMON BOLIVAR',4,151,0,0x0000000010895017);
INSERT INTO alinkedlist VALUES (
5,1514,'11                              ','TICLACAYAN',4,151,0,0x0000000010895018);
INSERT INTO alinkedlist VALUES (
5,1515,'12                              ','TINYAHUARCO',4,151,0,0x0000000010895019);
INSERT INTO alinkedlist VALUES (
5,1516,'13                              ','VICCO',4,151,0,0x000000001089501a);
INSERT INTO alinkedlist VALUES (
5,1517,'14                              ','YANACANCHA',4,151,0,0x000000001089501b);
INSERT INTO alinkedlist VALUES (
5,1518,'01                              ','YANAHUANCA',4,152,0,0x000000001089501c);
INSERT INTO alinkedlist VALUES (
5,1519,'02                              ','CHACAYAN',4,152,0,0x000000001089501d);
INSERT INTO alinkedlist VALUES (
5,1520,'03                              ','GOYLLARISQUIZGA',4,152,0,0x000000001089501f);
INSERT INTO alinkedlist VALUES (
5,1521,'04                              ','PAUCAR',4,152,0,0x0000000010895020);
INSERT INTO alinkedlist VALUES (
5,1522,'05                              ','SAN PEDRO DE PILLAO',4,152,0,0x0000000010895021);
INSERT INTO alinkedlist VALUES (
5,1523,'06                              ','SANTA ANA DE TUSI',4,152,0,0x0000000010895022);
INSERT INTO alinkedlist VALUES (
5,1524,'07                              ','TAPUC',4,152,0,0x0000000010895023);
INSERT INTO alinkedlist VALUES (
5,1525,'08                              ','VILCABAMBA',4,152,0,0x0000000010895024);
INSERT INTO alinkedlist VALUES (
5,1526,'01                              ','OXAPAMPA',4,153,0,0x0000000010895025);
INSERT INTO alinkedlist VALUES (
5,1527,'02                              ','CHONTABAMBA',4,153,0,0x0000000010895026);
INSERT INTO alinkedlist VALUES (
5,1528,'03                              ','HUANCABAMBA',4,153,0,0x0000000010895027);
INSERT INTO alinkedlist VALUES (
5,1529,'04                              ','PUERTO BERMUDEZ',4,153,0,0x0000000010895028);
INSERT INTO alinkedlist VALUES (
5,1530,'05                              ','VILLA RICA',4,153,0,0x0000000010895029);
INSERT INTO alinkedlist VALUES (
5,1531,'06                              ','POZUZO',4,153,0,0x000000001089502a);
INSERT INTO alinkedlist VALUES (
5,1532,'07                              ','PALCAZU',4,153,0,0x000000001089502b);
INSERT INTO alinkedlist VALUES (
5,1533,'08                              ','CONSTITUCION',4,153,0,0x000000001089502c);
INSERT INTO alinkedlist VALUES (
5,1534,'01                              ','PIURA',4,154,0,0x000000001089502d);
INSERT INTO alinkedlist VALUES (
5,1535,'03                              ','CASTILLA',4,154,0,0x000000001089502e);
INSERT INTO alinkedlist VALUES (
5,1536,'04                              ','CATACAOS',4,154,0,0x000000001089502f);
INSERT INTO alinkedlist VALUES (
5,1537,'05                              ','LA ARENA',4,154,0,0x0000000010895030);
INSERT INTO alinkedlist VALUES (
5,1538,'06                              ','LA UNION',4,154,0,0x0000000010895031);
INSERT INTO alinkedlist VALUES (
5,1539,'07                              ','LAS LOMAS',4,154,0,0x0000000010895032);
INSERT INTO alinkedlist VALUES (
5,1540,'09                              ','TAMBO GRANDE',4,154,0,0x0000000010895033);
INSERT INTO alinkedlist VALUES (
5,1541,'13                              ','CURA MORI',4,154,0,0x0000000010895034);
INSERT INTO alinkedlist VALUES (
5,1542,'14                              ','EL TALLAN',4,154,0,0x0000000010895035);
INSERT INTO alinkedlist VALUES (
5,1543,'15                              ','VEINTISEIS DE OCTUBRE',4,154,0,0x0000000010895036);
INSERT INTO alinkedlist VALUES (
5,1544,'01                              ','AYABACA',4,155,0,0x0000000010895037);
INSERT INTO alinkedlist VALUES (
5,1545,'02                              ','FRIAS',4,155,0,0x0000000010895038);
INSERT INTO alinkedlist VALUES (
5,1546,'03                              ','LAGUNAS',4,155,0,0x0000000010895039);
INSERT INTO alinkedlist VALUES (
5,1547,'04                              ','MONTERO',4,155,0,0x000000001089503a);
INSERT INTO alinkedlist VALUES (
5,1548,'05                              ','PACAIPAMPA',4,155,0,0x000000001089503b);
INSERT INTO alinkedlist VALUES (
5,1549,'06                              ','SAPILLICA',4,155,0,0x000000001089503c);
INSERT INTO alinkedlist VALUES (
5,1550,'07                              ','SICCHEZ',4,155,0,0x000000001089503d);
INSERT INTO alinkedlist VALUES (
5,1551,'08                              ','SUYO',4,155,0,0x000000001089503e);
INSERT INTO alinkedlist VALUES (
5,1552,'09                              ','JILILI',4,155,0,0x000000001089503f);
INSERT INTO alinkedlist VALUES (
5,1553,'10                              ','PAIMAS',4,155,0,0x0000000010895040);
INSERT INTO alinkedlist VALUES (
5,1554,'01                              ','HUANCABAMBA',4,156,0,0x0000000010895041);
INSERT INTO alinkedlist VALUES (
5,1555,'02                              ','CANCHAQUE',4,156,0,0x0000000010895042);
INSERT INTO alinkedlist VALUES (
5,1556,'03                              ','HUARMACA',4,156,0,0x0000000010895043);
INSERT INTO alinkedlist VALUES (
5,1557,'04                              ','SONDOR',4,156,0,0x0000000010895044);
INSERT INTO alinkedlist VALUES (
5,1558,'05                              ','SONDORILLO',4,156,0,0x0000000010895045);
INSERT INTO alinkedlist VALUES (
5,1559,'06                              ','EL CARMEN DE LA FRONTERA',4,156,0,0x0000000010895046);
INSERT INTO alinkedlist VALUES (
5,1560,'07                              ','SAN MIGUEL DE EL FAIQUE',4,156,0,0x0000000010895047);
INSERT INTO alinkedlist VALUES (
5,1561,'08                              ','LALAQUIZ',4,156,0,0x0000000010895048);
INSERT INTO alinkedlist VALUES (
5,1562,'01                              ','CHULUCANAS',4,157,0,0x0000000010895049);
INSERT INTO alinkedlist VALUES (
5,1563,'02                              ','BUENOS AIRES',4,157,0,0x000000001089504a);
INSERT INTO alinkedlist VALUES (
5,1564,'03                              ','CHALACO',4,157,0,0x000000001089504b);
INSERT INTO alinkedlist VALUES (
5,1565,'04                              ','MORROPON',4,157,0,0x000000001089504c);
INSERT INTO alinkedlist VALUES (
5,1566,'05                              ','SALITRAL',4,157,0,0x000000001089504d);
INSERT INTO alinkedlist VALUES (
5,1567,'06                              ','SANTA CATALINA DE MOSSA',4,157,0,0x000000001089504e);
INSERT INTO alinkedlist VALUES (
5,1568,'07                              ','SANTO DOMINGO',4,157,0,0x000000001089504f);
INSERT INTO alinkedlist VALUES (
5,1569,'08                              ','LA MATANZA',4,157,0,0x0000000010895050);
INSERT INTO alinkedlist VALUES (
5,1570,'09                              ','YAMANGO',4,157,0,0x0000000010895051);
INSERT INTO alinkedlist VALUES (
5,1571,'10                              ','SAN JUAN DE BIGOTE',4,157,0,0x0000000010895052);
INSERT INTO alinkedlist VALUES (
5,1572,'01                              ','PAITA',4,158,0,0x0000000010895053);
INSERT INTO alinkedlist VALUES (
5,1573,'02                              ','AMOTAPE',4,158,0,0x0000000010895054);
INSERT INTO alinkedlist VALUES (
5,1574,'03                              ','ARENAL',4,158,0,0x0000000010895055);
INSERT INTO alinkedlist VALUES (
5,1575,'04                              ','LA HUACA',4,158,0,0x0000000010895056);
INSERT INTO alinkedlist VALUES (
5,1576,'05                              ','COLAN',4,158,0,0x0000000010895057);
INSERT INTO alinkedlist VALUES (
5,1577,'06                              ','TAMARINDO',4,158,0,0x0000000010895058);
INSERT INTO alinkedlist VALUES (
5,1578,'07                              ','VICHAYAL',4,158,0,0x0000000010895059);
INSERT INTO alinkedlist VALUES (
5,1579,'01                              ','SULLANA',4,159,0,0x000000001089505a);
INSERT INTO alinkedlist VALUES (
5,1580,'02                              ','BELLAVISTA',4,159,0,0x000000001089505b);
INSERT INTO alinkedlist VALUES (
5,1581,'03                              ','LANCONES',4,159,0,0x000000001089505c);
INSERT INTO alinkedlist VALUES (
5,1582,'04                              ','MARCAVELICA',4,159,0,0x000000001089505d);
INSERT INTO alinkedlist VALUES (
5,1583,'05                              ','MIGUEL CHECA',4,159,0,0x000000001089505e);
INSERT INTO alinkedlist VALUES (
5,1584,'06                              ','QUERECOTILLO',4,159,0,0x000000001089505f);
INSERT INTO alinkedlist VALUES (
5,1585,'07                              ','SALITRAL',4,159,0,0x0000000010895060);
INSERT INTO alinkedlist VALUES (
5,1586,'08                              ','IGNACIO ESCUDERO',4,159,0,0x0000000010895061);
INSERT INTO alinkedlist VALUES (
5,1587,'01                              ','PARIÑAS',4,160,0,0x0000000010895062);
INSERT INTO alinkedlist VALUES (
5,1588,'02                              ','EL ALTO',4,160,0,0x0000000010895063);
INSERT INTO alinkedlist VALUES (
5,1589,'03                              ','LA BREA',4,160,0,0x0000000010895064);
INSERT INTO alinkedlist VALUES (
5,1590,'04                              ','LOBITOS',4,160,0,0x0000000010895065);
INSERT INTO alinkedlist VALUES (
5,1591,'05                              ','MANCORA',4,160,0,0x0000000010895066);
INSERT INTO alinkedlist VALUES (
5,1592,'06                              ','LOS ORGANOS',4,160,0,0x0000000010895067);
INSERT INTO alinkedlist VALUES (
5,1593,'01                              ','SECHURA',4,161,0,0x0000000010895068);
INSERT INTO alinkedlist VALUES (
5,1594,'02                              ','VICE',4,161,0,0x0000000010895069);
INSERT INTO alinkedlist VALUES (
5,1595,'03                              ','BERNAL',4,161,0,0x000000001089506a);
INSERT INTO alinkedlist VALUES (
5,1596,'04                              ','BELLAVISTA DE LA UNION',4,161,0,0x000000001089506b);
INSERT INTO alinkedlist VALUES (
5,1597,'05                              ','CRISTO NOS VALGA',4,161,0,0x000000001089506c);
INSERT INTO alinkedlist VALUES (
5,1598,'06                              ','RINCONADA-LLICUAR',4,161,0,0x000000001089506d);
INSERT INTO alinkedlist VALUES (
5,1599,'01                              ','PUNO',4,162,0,0x000000001089506e);
INSERT INTO alinkedlist VALUES (
5,1600,'02                              ','ACORA',4,162,0,0x000000001089506f);
INSERT INTO alinkedlist VALUES (
5,1601,'03                              ','ATUNCOLLA',4,162,0,0x0000000010895070);
INSERT INTO alinkedlist VALUES (
5,1602,'04                              ','CAPACHICA',4,162,0,0x0000000010895071);
INSERT INTO alinkedlist VALUES (
5,1603,'05                              ','COATA',4,162,0,0x0000000010895072);
INSERT INTO alinkedlist VALUES (
5,1604,'06                              ','CHUCUITO',4,162,0,0x0000000010895073);
INSERT INTO alinkedlist VALUES (
5,1605,'07                              ','HUATA',4,162,0,0x0000000010895074);
INSERT INTO alinkedlist VALUES (
5,1606,'08                              ','MAÑAZO',4,162,0,0x0000000010895075);
INSERT INTO alinkedlist VALUES (
5,1607,'09                              ','PAUCARCOLLA',4,162,0,0x0000000010895076);
INSERT INTO alinkedlist VALUES (
5,1608,'10                              ','PICHACANI',4,162,0,0x0000000010895077);
INSERT INTO alinkedlist VALUES (
5,1609,'11                              ','SAN ANTONIO',4,162,0,0x0000000010895078);
INSERT INTO alinkedlist VALUES (
5,1610,'12                              ','TIQUILLACA',4,162,0,0x0000000010895079);
INSERT INTO alinkedlist VALUES (
5,1611,'13                              ','VILQUE',4,162,0,0x000000001089507a);
INSERT INTO alinkedlist VALUES (
5,1612,'14                              ','PLATERIA',4,162,0,0x000000001089507b);
INSERT INTO alinkedlist VALUES (
5,1613,'15                              ','AMANTANI',4,162,0,0x000000001089507c);
INSERT INTO alinkedlist VALUES (
5,1614,'01                              ','AZANGARO',4,163,0,0x000000001089507d);
INSERT INTO alinkedlist VALUES (
5,1615,'02                              ','ACHAYA',4,163,0,0x000000001089507e);
INSERT INTO alinkedlist VALUES (
5,1616,'03                              ','ARAPA',4,163,0,0x000000001089507f);
INSERT INTO alinkedlist VALUES (
5,1617,'04                              ','ASILLO',4,163,0,0x0000000010895080);
INSERT INTO alinkedlist VALUES (
5,1618,'05                              ','CAMINACA',4,163,0,0x0000000010895081);
INSERT INTO alinkedlist VALUES (
5,1619,'06                              ','CHUPA',4,163,0,0x0000000010895082);
INSERT INTO alinkedlist VALUES (
5,1620,'07                              ','JOSE DOMINGO CHOQUEHUANCA',4,163,0,0x0000000010895083);
INSERT INTO alinkedlist VALUES (
5,1621,'08                              ','MUÑANI',4,163,0,0x0000000010895084);
INSERT INTO alinkedlist VALUES (
5,1622,'10                              ','POTONI',4,163,0,0x0000000010895085);
INSERT INTO alinkedlist VALUES (
5,1623,'12                              ','SAMAN',4,163,0,0x0000000010895086);
INSERT INTO alinkedlist VALUES (
5,1624,'13                              ','SAN ANTON',4,163,0,0x0000000010895087);
INSERT INTO alinkedlist VALUES (
5,1625,'14                              ','SAN JOSE',4,163,0,0x0000000010895088);
INSERT INTO alinkedlist VALUES (
5,1626,'15                              ','SAN JUAN DE SALINAS',4,163,0,0x0000000010895089);
INSERT INTO alinkedlist VALUES (
5,1627,'16                              ','SANTIAGO DE PUPUJA',4,163,0,0x000000001089508a);
INSERT INTO alinkedlist VALUES (
5,1628,'17                              ','TIRAPATA',4,163,0,0x000000001089508b);
INSERT INTO alinkedlist VALUES (
5,1629,'01                              ','MACUSANI',4,164,0,0x000000001089508c);
INSERT INTO alinkedlist VALUES (
5,1630,'02                              ','AJOYANI',4,164,0,0x000000001089508d);
INSERT INTO alinkedlist VALUES (
5,1631,'03                              ','AYAPATA',4,164,0,0x000000001089508e);
INSERT INTO alinkedlist VALUES (
5,1632,'04                              ','COASA',4,164,0,0x000000001089508f);
INSERT INTO alinkedlist VALUES (
5,1633,'05                              ','CORANI',4,164,0,0x0000000010895090);
INSERT INTO alinkedlist VALUES (
5,1634,'06                              ','CRUCERO',4,164,0,0x0000000010895091);
INSERT INTO alinkedlist VALUES (
5,1635,'07                              ','ITUATA',4,164,0,0x0000000010895092);
INSERT INTO alinkedlist VALUES (
5,1636,'08                              ','OLLACHEA',4,164,0,0x0000000010895093);
INSERT INTO alinkedlist VALUES (
5,1637,'09                              ','SAN GABAN',4,164,0,0x0000000010895094);
INSERT INTO alinkedlist VALUES (
5,1638,'10                              ','USICAYOS',4,164,0,0x0000000010895095);
INSERT INTO alinkedlist VALUES (
5,1639,'01                              ','JULI',4,165,0,0x0000000010895096);
INSERT INTO alinkedlist VALUES (
5,1640,'02                              ','DESAGUADERO',4,165,0,0x0000000010895097);
INSERT INTO alinkedlist VALUES (
5,1641,'03                              ','HUACULLANI',4,165,0,0x0000000010895098);
INSERT INTO alinkedlist VALUES (
5,1642,'06                              ','PISACOMA',4,165,0,0x0000000010895099);
INSERT INTO alinkedlist VALUES (
5,1643,'07                              ','POMATA',4,165,0,0x000000001089509a);
INSERT INTO alinkedlist VALUES (
5,1644,'10                              ','ZEPITA',4,165,0,0x000000001089509b);
INSERT INTO alinkedlist VALUES (
5,1645,'12                              ','KELLUYO',4,165,0,0x000000001089509c);
INSERT INTO alinkedlist VALUES (
5,1646,'01                              ','HUANCANE',4,166,0,0x000000001089509d);
INSERT INTO alinkedlist VALUES (
5,1647,'02                              ','COJATA',4,166,0,0x000000001089509e);
INSERT INTO alinkedlist VALUES (
5,1648,'04                              ','INCHUPALLA',4,166,0,0x000000001089509f);
INSERT INTO alinkedlist VALUES (
5,1649,'06                              ','PUSI',4,166,0,0x00000000108950a0);
INSERT INTO alinkedlist VALUES (
5,1650,'07                              ','ROSASPATA',4,166,0,0x00000000108950a1);
INSERT INTO alinkedlist VALUES (
5,1651,'08                              ','TARACO',4,166,0,0x00000000108950a2);
INSERT INTO alinkedlist VALUES (
5,1652,'09                              ','VILQUE CHICO',4,166,0,0x00000000108950a3);
INSERT INTO alinkedlist VALUES (
5,1653,'11                              ','HUATASANI',4,166,0,0x00000000108950a4);
INSERT INTO alinkedlist VALUES (
5,1654,'01                              ','LAMPA',4,167,0,0x00000000108950a5);
INSERT INTO alinkedlist VALUES (
5,1655,'02                              ','CABANILLA',4,167,0,0x00000000108950a6);
INSERT INTO alinkedlist VALUES (
5,1656,'03                              ','CALAPUJA',4,167,0,0x00000000108950a7);
INSERT INTO alinkedlist VALUES (
5,1657,'04                              ','NICASIO',4,167,0,0x00000000108950a8);
INSERT INTO alinkedlist VALUES (
5,1658,'05                              ','OCUVIRI',4,167,0,0x00000000108950a9);
INSERT INTO alinkedlist VALUES (
5,1659,'06                              ','PALCA',4,167,0,0x00000000108950aa);
INSERT INTO alinkedlist VALUES (
5,1660,'07                              ','PARATIA',4,167,0,0x00000000108950ab);
INSERT INTO alinkedlist VALUES (
5,1661,'08                              ','PUCARA',4,167,0,0x00000000108950ac);
INSERT INTO alinkedlist VALUES (
5,1662,'09                              ','SANTA LUCIA',4,167,0,0x00000000108950ad);
INSERT INTO alinkedlist VALUES (
5,1663,'10                              ','VILAVILA',4,167,0,0x00000000108950ae);
INSERT INTO alinkedlist VALUES (
5,1664,'01                              ','AYAVIRI',4,168,0,0x00000000108950af);
INSERT INTO alinkedlist VALUES (
5,1665,'02                              ','ANTAUTA',4,168,0,0x00000000108950b0);
INSERT INTO alinkedlist VALUES (
5,1666,'03                              ','CUPI',4,168,0,0x00000000108950b1);
INSERT INTO alinkedlist VALUES (
5,1667,'04                              ','LLALLI',4,168,0,0x00000000108950b2);
INSERT INTO alinkedlist VALUES (
5,1668,'05                              ','MACARI',4,168,0,0x00000000108950b3);
INSERT INTO alinkedlist VALUES (
5,1669,'06                              ','NUÑOA',4,168,0,0x00000000108950b4);
INSERT INTO alinkedlist VALUES (
5,1670,'07                              ','ORURILLO',4,168,0,0x00000000108950b5);
INSERT INTO alinkedlist VALUES (
5,1671,'08                              ','SANTA ROSA',4,168,0,0x00000000108950b6);
INSERT INTO alinkedlist VALUES (
5,1672,'09                              ','UMACHIRI',4,168,0,0x00000000108950b7);
INSERT INTO alinkedlist VALUES (
5,1673,'01                              ','SANDIA',4,169,0,0x00000000108950b8);
INSERT INTO alinkedlist VALUES (
5,1674,'03                              ','CUYOCUYO',4,169,0,0x00000000108950b9);
INSERT INTO alinkedlist VALUES (
5,1675,'04                              ','LIMBANI',4,169,0,0x00000000108950ba);
INSERT INTO alinkedlist VALUES (
5,1676,'05                              ','PHARA',4,169,0,0x00000000108950bb);
INSERT INTO alinkedlist VALUES (
5,1677,'06                              ','PATAMBUCO',4,169,0,0x00000000108950bc);
INSERT INTO alinkedlist VALUES (
5,1678,'07                              ','QUIACA',4,169,0,0x00000000108950bd);
INSERT INTO alinkedlist VALUES (
5,1679,'08                              ','SAN JUAN DEL ORO',4,169,0,0x00000000108950be);
INSERT INTO alinkedlist VALUES (
5,1680,'10                              ','YANAHUAYA',4,169,0,0x00000000108950bf);
INSERT INTO alinkedlist VALUES (
5,1681,'11                              ','ALTO INAMBARI',4,169,0,0x00000000108950c0);
INSERT INTO alinkedlist VALUES (
5,1682,'12                              ','SAN PEDRO DE PUTINA PUNCO',4,169,0,0x00000000108950c1);
INSERT INTO alinkedlist VALUES (
5,1683,'01                              ','JULIACA',4,170,0,0x00000000108950c2);
INSERT INTO alinkedlist VALUES (
5,1684,'02                              ','CABANA',4,170,0,0x00000000108950c3);
INSERT INTO alinkedlist VALUES (
5,1685,'03                              ','CABANILLAS',4,170,0,0x00000000108950c4);
INSERT INTO alinkedlist VALUES (
5,1686,'04                              ','CARACOTO',4,170,0,0x00000000108950c5);
INSERT INTO alinkedlist VALUES (
5,1687,'01                              ','YUNGUYO',4,171,0,0x00000000108950c6);
INSERT INTO alinkedlist VALUES (
5,1688,'02                              ','UNICACHI',4,171,0,0x00000000108950c7);
INSERT INTO alinkedlist VALUES (
5,1689,'03                              ','ANAPIA',4,171,0,0x00000000108950c8);
INSERT INTO alinkedlist VALUES (
5,1690,'04                              ','COPANI',4,171,0,0x00000000108950c9);
INSERT INTO alinkedlist VALUES (
5,1691,'05                              ','CUTURAPI',4,171,0,0x00000000108950ca);
INSERT INTO alinkedlist VALUES (
5,1692,'06                              ','OLLARAYA',4,171,0,0x00000000108950cb);
INSERT INTO alinkedlist VALUES (
5,1693,'07                              ','TINICACHI',4,171,0,0x00000000108950cc);
INSERT INTO alinkedlist VALUES (
5,1694,'01                              ','PUTINA',4,172,0,0x00000000108950cd);
INSERT INTO alinkedlist VALUES (
5,1695,'02                              ','PEDRO VILCA APAZA',4,172,0,0x00000000108950ce);
INSERT INTO alinkedlist VALUES (
5,1696,'03                              ','QUILCAPUNCU',4,172,0,0x00000000108950cf);
INSERT INTO alinkedlist VALUES (
5,1697,'04                              ','ANANEA',4,172,0,0x00000000108950d0);
INSERT INTO alinkedlist VALUES (
5,1698,'05                              ','SINA',4,172,0,0x00000000108950d1);
INSERT INTO alinkedlist VALUES (
5,1699,'01                              ','ILAVE',4,173,0,0x00000000108950d2);
INSERT INTO alinkedlist VALUES (
5,1700,'02                              ','PILCUYO',4,173,0,0x00000000108950d3);
INSERT INTO alinkedlist VALUES (
5,1701,'03                              ','SANTA ROSA',4,173,0,0x00000000108950d4);
INSERT INTO alinkedlist VALUES (
5,1702,'04                              ','CAPASO',4,173,0,0x00000000108950d5);
INSERT INTO alinkedlist VALUES (
5,1703,'05                              ','CONDURIRI',4,173,0,0x00000000108950d6);
INSERT INTO alinkedlist VALUES (
5,1704,'01                              ','MOHO',4,174,0,0x00000000108950d7);
INSERT INTO alinkedlist VALUES (
5,1705,'02                              ','CONIMA',4,174,0,0x00000000108950d8);
INSERT INTO alinkedlist VALUES (
5,1706,'03                              ','TILALI',4,174,0,0x00000000108950d9);
INSERT INTO alinkedlist VALUES (
5,1707,'04                              ','HUAYRAPATA',4,174,0,0x00000000108950da);
INSERT INTO alinkedlist VALUES (
5,1708,'01                              ','MOYOBAMBA',4,175,0,0x00000000108950db);
INSERT INTO alinkedlist VALUES (
5,1709,'02                              ','CALZADA',4,175,0,0x00000000108950dc);
INSERT INTO alinkedlist VALUES (
5,1710,'03                              ','HABANA',4,175,0,0x00000000108950dd);
INSERT INTO alinkedlist VALUES (
5,1711,'04                              ','JEPELACIO',4,175,0,0x00000000108950de);
INSERT INTO alinkedlist VALUES (
5,1712,'05                              ','SORITOR',4,175,0,0x00000000108950df);
INSERT INTO alinkedlist VALUES (
5,1713,'06                              ','YANTALO',4,175,0,0x00000000108950e0);
INSERT INTO alinkedlist VALUES (
5,1714,'01                              ','SAPOSOA',4,176,0,0x00000000108950e1);
INSERT INTO alinkedlist VALUES (
5,1715,'02                              ','PISCOYACU',4,176,0,0x00000000108950e2);
INSERT INTO alinkedlist VALUES (
5,1716,'03                              ','SACANCHE',4,176,0,0x00000000108950e3);
INSERT INTO alinkedlist VALUES (
5,1717,'04                              ','TINGO DE SAPOSOA',4,176,0,0x00000000108950e4);
INSERT INTO alinkedlist VALUES (
5,1718,'05                              ','ALTO SAPOSOA',4,176,0,0x00000000108950e5);
INSERT INTO alinkedlist VALUES (
5,1719,'06                              ','EL ESLABON',4,176,0,0x00000000108950e6);
INSERT INTO alinkedlist VALUES (
5,1720,'01                              ','LAMAS',4,177,0,0x00000000108950e7);
INSERT INTO alinkedlist VALUES (
5,1721,'03                              ','BARRANQUITA',4,177,0,0x00000000108950e8);
INSERT INTO alinkedlist VALUES (
5,1722,'04                              ','CAYNARACHI',4,177,0,0x00000000108950e9);
INSERT INTO alinkedlist VALUES (
5,1723,'05                              ','CUÑUMBUQUI',4,177,0,0x00000000108950ea);
INSERT INTO alinkedlist VALUES (
5,1724,'06                              ','PINTO RECODO',4,177,0,0x00000000108950eb);
INSERT INTO alinkedlist VALUES (
5,1725,'07                              ','RUMISAPA',4,177,0,0x00000000108950ec);
INSERT INTO alinkedlist VALUES (
5,1726,'11                              ','SHANAO',4,177,0,0x00000000108950ed);
INSERT INTO alinkedlist VALUES (
5,1727,'13                              ','TABALOSOS',4,177,0,0x00000000108950ee);
INSERT INTO alinkedlist VALUES (
5,1728,'14                              ','ZAPATERO',4,177,0,0x00000000108950ef);
INSERT INTO alinkedlist VALUES (
5,1729,'15                              ','ALONSO DE ALVARADO',4,177,0,0x00000000108950f0);
INSERT INTO alinkedlist VALUES (
5,1730,'16                              ','SAN ROQUE DE CUMBAZA',4,177,0,0x00000000108950f1);
INSERT INTO alinkedlist VALUES (
5,1731,'01                              ','JUANJUI',4,178,0,0x00000000108950f2);
INSERT INTO alinkedlist VALUES (
5,1732,'02                              ','CAMPANILLA',4,178,0,0x00000000108950f3);
INSERT INTO alinkedlist VALUES (
5,1733,'03                              ','HUICUNGO',4,178,0,0x00000000108950f4);
INSERT INTO alinkedlist VALUES (
5,1734,'04                              ','PACHIZA',4,178,0,0x00000000108950f5);
INSERT INTO alinkedlist VALUES (
5,1735,'05                              ','PAJARILLO',4,178,0,0x00000000108950f6);
INSERT INTO alinkedlist VALUES (
5,1736,'01                              ','RIOJA',4,179,0,0x00000000108950f7);
INSERT INTO alinkedlist VALUES (
5,1737,'02                              ','POSIC',4,179,0,0x00000000108950f8);
INSERT INTO alinkedlist VALUES (
5,1738,'03                              ','YORONGOS',4,179,0,0x00000000108950f9);
INSERT INTO alinkedlist VALUES (
5,1739,'04                              ','YURACYACU',4,179,0,0x00000000108950fa);
INSERT INTO alinkedlist VALUES (
5,1740,'05                              ','NUEVA CAJAMARCA',4,179,0,0x00000000108950fb);
INSERT INTO alinkedlist VALUES (
5,1741,'06                              ','ELIAS SOPLIN VARGAS',4,179,0,0x00000000108950fc);
INSERT INTO alinkedlist VALUES (
5,1742,'07                              ','SAN FERNANDO',4,179,0,0x00000000108950fd);
INSERT INTO alinkedlist VALUES (
5,1743,'08                              ','PARDO MIGUEL',4,179,0,0x00000000108950fe);
INSERT INTO alinkedlist VALUES (
5,1744,'09                              ','AWAJUN',4,179,0,0x00000000108950ff);
INSERT INTO alinkedlist VALUES (
5,1745,'01                              ','TARAPOTO',4,180,0,0x0000000010895101);
INSERT INTO alinkedlist VALUES (
5,1746,'02                              ','ALBERTO LEVEAU',4,180,0,0x0000000010895102);
INSERT INTO alinkedlist VALUES (
5,1747,'04                              ','CACATACHI',4,180,0,0x0000000010895103);
INSERT INTO alinkedlist VALUES (
5,1748,'06                              ','CHAZUTA',4,180,0,0x0000000010895104);
INSERT INTO alinkedlist VALUES (
5,1749,'07                              ','CHIPURANA',4,180,0,0x0000000010895105);
INSERT INTO alinkedlist VALUES (
5,1750,'08                              ','EL PORVENIR',4,180,0,0x0000000010895106);
INSERT INTO alinkedlist VALUES (
5,1751,'09                              ','HUIMBAYOC',4,180,0,0x0000000010895107);
INSERT INTO alinkedlist VALUES (
5,1752,'10                              ','JUAN GUERRA',4,180,0,0x0000000010895108);
INSERT INTO alinkedlist VALUES (
5,1753,'11                              ','MORALES',4,180,0,0x0000000010895109);
INSERT INTO alinkedlist VALUES (
5,1754,'12                              ','PAPAPLAYA',4,180,0,0x000000001089510a);
INSERT INTO alinkedlist VALUES (
5,1755,'16                              ','SAN ANTONIO',4,180,0,0x000000001089510b);
INSERT INTO alinkedlist VALUES (
5,1756,'20                              ','SAUCE',4,180,0,0x000000001089510c);
INSERT INTO alinkedlist VALUES (
5,1757,'21                              ','SHAPAJA',4,180,0,0x000000001089510d);
INSERT INTO alinkedlist VALUES (
5,1758,'22                              ','LA BANDA DE SHILCAYO',4,180,0,0x000000001089510e);
INSERT INTO alinkedlist VALUES (
5,1759,'01                              ','BELLAVISTA',4,181,0,0x000000001089510f);
INSERT INTO alinkedlist VALUES (
5,1760,'02                              ','SAN RAFAEL',4,181,0,0x0000000010895110);
INSERT INTO alinkedlist VALUES (
5,1761,'03                              ','SAN PABLO',4,181,0,0x0000000010895111);
INSERT INTO alinkedlist VALUES (
5,1762,'04                              ','ALTO BIAVO',4,181,0,0x0000000010895112);
INSERT INTO alinkedlist VALUES (
5,1763,'05                              ','HUALLAGA',4,181,0,0x0000000010895113);
INSERT INTO alinkedlist VALUES (
5,1764,'06                              ','BAJO BIAVO',4,181,0,0x0000000010895114);
INSERT INTO alinkedlist VALUES (
5,1765,'01                              ','TOCACHE',4,182,0,0x0000000010895115);
INSERT INTO alinkedlist VALUES (
5,1766,'02                              ','NUEVO PROGRESO',4,182,0,0x0000000010895116);
INSERT INTO alinkedlist VALUES (
5,1767,'03                              ','POLVORA',4,182,0,0x0000000010895117);
INSERT INTO alinkedlist VALUES (
5,1768,'04                              ','SHUNTE',4,182,0,0x0000000010895118);
INSERT INTO alinkedlist VALUES (
5,1769,'05                              ','UCHIZA',4,182,0,0x0000000010895119);
INSERT INTO alinkedlist VALUES (
5,1770,'01                              ','PICOTA',4,183,0,0x000000001089511a);
INSERT INTO alinkedlist VALUES (
5,1771,'02                              ','BUENOS AIRES',4,183,0,0x000000001089511b);
INSERT INTO alinkedlist VALUES (
5,1772,'03                              ','CASPIZAPA',4,183,0,0x000000001089511c);
INSERT INTO alinkedlist VALUES (
5,1773,'04                              ','PILLUANA',4,183,0,0x000000001089511d);
INSERT INTO alinkedlist VALUES (
5,1774,'05                              ','PUCACACA',4,183,0,0x000000001089511e);
INSERT INTO alinkedlist VALUES (
5,1775,'06                              ','SAN CRISTOBAL',4,183,0,0x000000001089511f);
INSERT INTO alinkedlist VALUES (
5,1776,'07                              ','SAN HILARION',4,183,0,0x0000000010895120);
INSERT INTO alinkedlist VALUES (
5,1777,'08                              ','TINGO DE PONASA',4,183,0,0x0000000010895121);
INSERT INTO alinkedlist VALUES (
5,1778,'09                              ','TRES UNIDOS',4,183,0,0x0000000010895122);
INSERT INTO alinkedlist VALUES (
5,1779,'10                              ','SHAMBOYACU',4,183,0,0x0000000010895123);
INSERT INTO alinkedlist VALUES (
5,1780,'01                              ','SAN JOSE DE SISA',4,184,0,0x0000000010895124);
INSERT INTO alinkedlist VALUES (
5,1781,'02                              ','AGUA BLANCA',4,184,0,0x0000000010895125);
INSERT INTO alinkedlist VALUES (
5,1782,'03                              ','SHATOJA',4,184,0,0x0000000010895126);
INSERT INTO alinkedlist VALUES (
5,1783,'04                              ','SAN MARTIN',4,184,0,0x0000000010895127);
INSERT INTO alinkedlist VALUES (
5,1784,'05                              ','SANTA ROSA',4,184,0,0x0000000010895128);
INSERT INTO alinkedlist VALUES (
5,1785,'01                              ','TACNA',4,185,0,0x0000000010895129);
INSERT INTO alinkedlist VALUES (
5,1786,'02                              ','CALANA',4,185,0,0x000000001089512a);
INSERT INTO alinkedlist VALUES (
5,1787,'04                              ','INCLAN',4,185,0,0x000000001089512b);
INSERT INTO alinkedlist VALUES (
5,1788,'07                              ','PACHIA',4,185,0,0x000000001089512c);
INSERT INTO alinkedlist VALUES (
5,1789,'08                              ','PALCA',4,185,0,0x000000001089512d);
INSERT INTO alinkedlist VALUES (
5,1790,'09                              ','POCOLLAY',4,185,0,0x000000001089512e);
INSERT INTO alinkedlist VALUES (
5,1791,'10                              ','SAMA',4,185,0,0x000000001089512f);
INSERT INTO alinkedlist VALUES (
5,1792,'11                              ','ALTO DE LA ALIANZA',4,185,0,0x0000000010895130);
INSERT INTO alinkedlist VALUES (
5,1793,'12                              ','CIUDAD NUEVA',4,185,0,0x0000000010895131);
INSERT INTO alinkedlist VALUES (
5,1794,'13                              ','CORONEL GREGORIO ALBARRACIN L.',4,185,0,0x0000000010895132);
INSERT INTO alinkedlist VALUES (
5,1795,'01                              ','TARATA',4,186,0,0x0000000010895133);
INSERT INTO alinkedlist VALUES (
5,1796,'05                              ','HEROES ALBARRACIN',4,186,0,0x0000000010895134);
INSERT INTO alinkedlist VALUES (
5,1797,'06                              ','ESTIQUE',4,186,0,0x0000000010895135);
INSERT INTO alinkedlist VALUES (
5,1798,'07                              ','ESTIQUE PAMPA',4,186,0,0x0000000010895136);
INSERT INTO alinkedlist VALUES (
5,1799,'10                              ','SITAJARA',4,186,0,0x0000000010895137);
INSERT INTO alinkedlist VALUES (
5,1800,'11                              ','SUSAPAYA',4,186,0,0x0000000010895138);
INSERT INTO alinkedlist VALUES (
5,1801,'12                              ','TARUCACHI',4,186,0,0x0000000010895139);
INSERT INTO alinkedlist VALUES (
5,1802,'13                              ','TICACO',4,186,0,0x000000001089513a);
INSERT INTO alinkedlist VALUES (
5,1803,'01                              ','LOCUMBA',4,187,0,0x000000001089513b);
INSERT INTO alinkedlist VALUES (
5,1804,'02                              ','ITE',4,187,0,0x000000001089513c);
INSERT INTO alinkedlist VALUES (
5,1805,'03                              ','ILABAYA',4,187,0,0x000000001089513d);
INSERT INTO alinkedlist VALUES (
5,1806,'01                              ','CANDARAVE',4,188,0,0x000000001089513e);
INSERT INTO alinkedlist VALUES (
5,1807,'02                              ','CAIRANI',4,188,0,0x000000001089513f);
INSERT INTO alinkedlist VALUES (
5,1808,'03                              ','CURIBAYA',4,188,0,0x0000000010895140);
INSERT INTO alinkedlist VALUES (
5,1809,'04                              ','HUANUARA',4,188,0,0x0000000010895141);
INSERT INTO alinkedlist VALUES (
5,1810,'05                              ','QUILAHUANI',4,188,0,0x0000000010895142);
INSERT INTO alinkedlist VALUES (
5,1811,'06                              ','CAMILACA',4,188,0,0x0000000010895143);
INSERT INTO alinkedlist VALUES (
5,1812,'01                              ','TUMBES',4,189,0,0x0000000010895144);
INSERT INTO alinkedlist VALUES (
5,1813,'02                              ','CORRALES',4,189,0,0x0000000010895145);
INSERT INTO alinkedlist VALUES (
5,1814,'03                              ','LA CRUZ',4,189,0,0x0000000010895146);
INSERT INTO alinkedlist VALUES (
5,1815,'04                              ','PAMPAS DE HOSPITAL',4,189,0,0x0000000010895147);
INSERT INTO alinkedlist VALUES (
5,1816,'05                              ','SAN JACINTO',4,189,0,0x0000000010895148);
INSERT INTO alinkedlist VALUES (
5,1817,'06                              ','SAN JUAN DE LA VIRGEN',4,189,0,0x0000000010895149);
INSERT INTO alinkedlist VALUES (
5,1818,'01                              ','ZORRITOS',4,190,0,0x000000001089514a);
INSERT INTO alinkedlist VALUES (
5,1819,'02                              ','CASITAS',4,190,0,0x000000001089514b);
INSERT INTO alinkedlist VALUES (
5,1820,'03                              ','CANOAS DE PUNTA SAL',4,190,0,0x000000001089514c);
INSERT INTO alinkedlist VALUES (
5,1821,'01                              ','ZARUMILLA',4,191,0,0x000000001089514d);
INSERT INTO alinkedlist VALUES (
5,1822,'02                              ','MATAPALO',4,191,0,0x000000001089514e);
INSERT INTO alinkedlist VALUES (
5,1823,'03                              ','PAPAYAL',4,191,0,0x000000001089514f);
INSERT INTO alinkedlist VALUES (
5,1824,'04                              ','AGUAS VERDES',4,191,0,0x0000000010895150);
INSERT INTO alinkedlist VALUES (
5,1825,'01                              ','CALLERIA',4,192,0,0x0000000010895151);
INSERT INTO alinkedlist VALUES (
5,1826,'02                              ','YARINACOCHA',4,192,0,0x0000000010895152);
INSERT INTO alinkedlist VALUES (
5,1827,'03                              ','MASISEA',4,192,0,0x0000000010895153);
INSERT INTO alinkedlist VALUES (
5,1828,'04                              ','CAMPOVERDE',4,192,0,0x0000000010895154);
INSERT INTO alinkedlist VALUES (
5,1829,'05                              ','IPARIA',4,192,0,0x0000000010895155);
INSERT INTO alinkedlist VALUES (
5,1830,'06                              ','NUEVA REQUENA',4,192,0,0x0000000010895156);
INSERT INTO alinkedlist VALUES (
5,1831,'07                              ','MANANTAY',4,192,0,0x0000000010895157);
INSERT INTO alinkedlist VALUES (
5,1832,'01                              ','PADRE ABAD',4,193,0,0x0000000010895158);
INSERT INTO alinkedlist VALUES (
5,1833,'02                              ','IRAZOLA',4,193,0,0x0000000010895159);
INSERT INTO alinkedlist VALUES (
5,1834,'03                              ','CURIMANA',4,193,0,0x000000001089515a);
INSERT INTO alinkedlist VALUES (
5,1835,'01                              ','RAIMONDI',4,194,0,0x000000001089515b);
INSERT INTO alinkedlist VALUES (
5,1836,'02                              ','TAHUANIA',4,194,0,0x000000001089515c);
INSERT INTO alinkedlist VALUES (
5,1837,'03                              ','YURUA',4,194,0,0x000000001089515d);
INSERT INTO alinkedlist VALUES (
5,1838,'04                              ','SEPAHUA',4,194,0,0x000000001089515e);
INSERT INTO alinkedlist VALUES (
5,1839,'01                              ','PURUS',4,195,0,0x000000001089515f);
INSERT INTO alinkedlist VALUES (
6,1,'1                               ','ABARTH',NULL,NULL,1,0x000000001064b2dc);
INSERT INTO alinkedlist VALUES (
6,2,'2                               ','ALFA ROMEO',NULL,NULL,1,0x000000001064b2dd);
INSERT INTO alinkedlist VALUES (
6,3,'3                               ','ARO',NULL,NULL,1,0x000000001064b2de);
INSERT INTO alinkedlist VALUES (
6,4,'4                               ','ASIA',NULL,NULL,1,0x000000001064b2df);
INSERT INTO alinkedlist VALUES (
6,5,'5                               ','ASIA MOTORS',NULL,NULL,1,0x000000001064b2e0);
INSERT INTO alinkedlist VALUES (
6,6,'6                               ','ASTON MARTIN',NULL,NULL,1,0x000000001064b2e1);
INSERT INTO alinkedlist VALUES (
6,7,'7                               ','AUDI',NULL,NULL,1,0x000000001064b2e2);
INSERT INTO alinkedlist VALUES (
6,8,'8                               ','AUSTIN',NULL,NULL,1,0x000000001064b2e3);
INSERT INTO alinkedlist VALUES (
6,9,'9                               ','AUVERLAND',NULL,NULL,1,0x000000001064b2e4);
INSERT INTO alinkedlist VALUES (
6,10,'10                              ','BENTLEY',NULL,NULL,1,0x000000001064b2e5);
INSERT INTO alinkedlist VALUES (
6,11,'11                              ','BERTONE',NULL,NULL,1,0x000000001064b2e6);
INSERT INTO alinkedlist VALUES (
6,12,'12                              ','BMW',NULL,NULL,1,0x000000001064b2e7);
INSERT INTO alinkedlist VALUES (
6,13,'13                              ','CADILLAC',NULL,NULL,1,0x000000001064b2e8);
INSERT INTO alinkedlist VALUES (
6,14,'14                              ','CHEVROLET',NULL,NULL,1,0x000000001064b2e9);
INSERT INTO alinkedlist VALUES (
6,15,'15                              ','CHRYSLER',NULL,NULL,1,0x000000001064b2ea);
INSERT INTO alinkedlist VALUES (
6,16,'16                              ','CITROEN',NULL,NULL,1,0x000000001064b2eb);
INSERT INTO alinkedlist VALUES (
6,17,'17                              ','CORVETTE',NULL,NULL,1,0x000000001064b2ec);
INSERT INTO alinkedlist VALUES (
6,18,'18                              ','DACIA',NULL,NULL,1,0x000000001064b2ed);
INSERT INTO alinkedlist VALUES (
6,19,'19                              ','DAEWOO',NULL,NULL,1,0x000000001064b2ee);
INSERT INTO alinkedlist VALUES (
6,20,'20                              ','DAF',NULL,NULL,1,0x000000001064b2ef);
INSERT INTO alinkedlist VALUES (
6,21,'21                              ','DAIHATSU',NULL,NULL,1,0x000000001064b2f0);
INSERT INTO alinkedlist VALUES (
6,22,'22                              ','DAIMLER',NULL,NULL,1,0x000000001064b2f1);
INSERT INTO alinkedlist VALUES (
6,23,'23                              ','DODGE',NULL,NULL,1,0x000000001064b2f2);
INSERT INTO alinkedlist VALUES (
6,24,'24                              ','FERRARI',NULL,NULL,1,0x000000001064b2f3);
INSERT INTO alinkedlist VALUES (
6,25,'25                              ','FIAT',NULL,NULL,1,0x000000001064b2f4);
INSERT INTO alinkedlist VALUES (
6,26,'26                              ','FORD',NULL,NULL,1,0x000000001064b2f5);
INSERT INTO alinkedlist VALUES (
6,27,'27                              ','GALLOPER',NULL,NULL,1,0x000000001064b2f6);
INSERT INTO alinkedlist VALUES (
6,28,'28                              ','GMC',NULL,NULL,1,0x000000001064b2f7);
INSERT INTO alinkedlist VALUES (
6,29,'29                              ','HONDA',NULL,NULL,1,0x000000001064b2f8);
INSERT INTO alinkedlist VALUES (
6,30,'30                              ','HUMMER',NULL,NULL,1,0x000000001064b2f9);
INSERT INTO alinkedlist VALUES (
6,31,'31                              ','HYUNDAI',NULL,NULL,1,0x000000001064b2fa);
INSERT INTO alinkedlist VALUES (
6,32,'32                              ','INFINITI',NULL,NULL,1,0x000000001064b2fb);
INSERT INTO alinkedlist VALUES (
6,33,'33                              ','INNOCENTI',NULL,NULL,1,0x000000001064b2fc);
INSERT INTO alinkedlist VALUES (
6,34,'34                              ','ISUZU',NULL,NULL,1,0x000000001064b2fd);
INSERT INTO alinkedlist VALUES (
6,35,'35                              ','IVECO',NULL,NULL,1,0x000000001064b2fe);
INSERT INTO alinkedlist VALUES (
6,36,'36                              ','IVECO-PEGASO',NULL,NULL,1,0x000000001064b2ff);
INSERT INTO alinkedlist VALUES (
6,37,'37                              ','JAGUAR',NULL,NULL,1,0x000000001064b301);
INSERT INTO alinkedlist VALUES (
6,38,'38                              ','JEEP',NULL,NULL,1,0x000000001064b302);
INSERT INTO alinkedlist VALUES (
6,39,'39                              ','KIA',NULL,NULL,1,0x000000001064b303);
INSERT INTO alinkedlist VALUES (
6,40,'40                              ','LADA',NULL,NULL,1,0x000000001064b304);
INSERT INTO alinkedlist VALUES (
6,41,'41                              ','LAMBORGHINI',NULL,NULL,1,0x000000001064b305);
INSERT INTO alinkedlist VALUES (
6,42,'42                              ','LANCIA',NULL,NULL,1,0x000000001064b306);
INSERT INTO alinkedlist VALUES (
6,43,'43                              ','LAND-ROVER',NULL,NULL,1,0x000000001064b307);
INSERT INTO alinkedlist VALUES (
6,44,'44                              ','LDV',NULL,NULL,1,0x000000001064b308);
INSERT INTO alinkedlist VALUES (
6,45,'45                              ','LEXUS',NULL,NULL,1,0x000000001064b309);
INSERT INTO alinkedlist VALUES (
6,46,'46                              ','LOTUS',NULL,NULL,1,0x000000001064b30a);
INSERT INTO alinkedlist VALUES (
6,47,'47                              ','MAHINDRA',NULL,NULL,1,0x000000001064b30b);
INSERT INTO alinkedlist VALUES (
6,48,'48                              ','MASERATI',NULL,NULL,1,0x000000001064b30c);
INSERT INTO alinkedlist VALUES (
6,49,'49                              ','MAYBACH',NULL,NULL,1,0x000000001064b30d);
INSERT INTO alinkedlist VALUES (
6,50,'50                              ','MAZDA',NULL,NULL,1,0x000000001064b30e);
INSERT INTO alinkedlist VALUES (
6,51,'51                              ','MERCEDES-BENZ',NULL,NULL,1,0x000000001064b30f);
INSERT INTO alinkedlist VALUES (
6,52,'52                              ','MG',NULL,NULL,1,0x000000001064b310);
INSERT INTO alinkedlist VALUES (
6,53,'53                              ','MINI',NULL,NULL,1,0x000000001064b311);
INSERT INTO alinkedlist VALUES (
6,54,'54                              ','MITSUBISHI',NULL,NULL,1,0x000000001064b312);
INSERT INTO alinkedlist VALUES (
6,55,'55                              ','MORGAN',NULL,NULL,1,0x000000001064b313);
INSERT INTO alinkedlist VALUES (
6,56,'56                              ','NISSAN',NULL,NULL,1,0x000000001064b314);
INSERT INTO alinkedlist VALUES (
6,57,'57                              ','OPEL',NULL,NULL,1,0x000000001064b315);
INSERT INTO alinkedlist VALUES (
6,58,'58                              ','PEUGEOT',NULL,NULL,1,0x000000001064b316);
INSERT INTO alinkedlist VALUES (
6,59,'59                              ','PONTIAC',NULL,NULL,1,0x000000001064b317);
INSERT INTO alinkedlist VALUES (
6,60,'60                              ','PORSCHE',NULL,NULL,1,0x000000001064b318);
INSERT INTO alinkedlist VALUES (
6,61,'61                              ','RENAULT',NULL,NULL,1,0x000000001064b319);
INSERT INTO alinkedlist VALUES (
6,62,'62                              ','ROLLS-ROYCE',NULL,NULL,1,0x000000001064b31a);
INSERT INTO alinkedlist VALUES (
6,63,'63                              ','ROVER',NULL,NULL,1,0x000000001064b31b);
INSERT INTO alinkedlist VALUES (
6,64,'64                              ','SAAB',NULL,NULL,1,0x000000001064b31c);
INSERT INTO alinkedlist VALUES (
6,65,'65                              ','SANTANA',NULL,NULL,1,0x000000001064b31d);
INSERT INTO alinkedlist VALUES (
6,66,'66                              ','SEAT',NULL,NULL,1,0x000000001064b31e);
INSERT INTO alinkedlist VALUES (
6,67,'67                              ','SKODA',NULL,NULL,1,0x000000001064b31f);
INSERT INTO alinkedlist VALUES (
6,68,'68                              ','SMART',NULL,NULL,1,0x000000001064b320);
INSERT INTO alinkedlist VALUES (
6,69,'69                              ','SSANGYONG',NULL,NULL,1,0x000000001064b321);
INSERT INTO alinkedlist VALUES (
6,70,'70                              ','SUBARU',NULL,NULL,1,0x000000001064b322);
INSERT INTO alinkedlist VALUES (
6,71,'71                              ','SUZUKI',NULL,NULL,1,0x000000001064b323);
INSERT INTO alinkedlist VALUES (
6,72,'72                              ','TALBOT',NULL,NULL,1,0x000000001064b324);
INSERT INTO alinkedlist VALUES (
6,73,'73                              ','TATA',NULL,NULL,1,0x000000001064b325);
INSERT INTO alinkedlist VALUES (
6,74,'74                              ','TOYOTA',NULL,NULL,1,0x000000001064b326);
INSERT INTO alinkedlist VALUES (
6,75,'75                              ','UMM',NULL,NULL,1,0x000000001064b327);
INSERT INTO alinkedlist VALUES (
6,76,'76                              ','VAZ',NULL,NULL,1,0x000000001064b328);
INSERT INTO alinkedlist VALUES (
6,77,'77                              ','VOLKSWAGEN',NULL,NULL,1,0x000000001064b329);
INSERT INTO alinkedlist VALUES (
6,78,'78                              ','VOLVO',NULL,NULL,1,0x000000001064b32a);
INSERT INTO alinkedlist VALUES (
6,79,'79                              ','WARTBURG',NULL,NULL,1,0x000000001064b32b);
INSERT INTO alinkedlist VALUES (
6,80,'80                              ','Otros',NULL,NULL,0,0x000000001064b32c);
INSERT INTO alinkedlist VALUES (
7,1,'1                               ','500',6,1,1,0x000000001064b32d);
INSERT INTO alinkedlist VALUES (
7,2,'2                               ','GRANDE PUNTO',6,1,1,0x000000001064b32e);
INSERT INTO alinkedlist VALUES (
7,3,'3                               ','PUNTO EVO',6,1,1,0x000000001064b32f);
INSERT INTO alinkedlist VALUES (
7,4,'4                               ','500C',6,1,1,0x000000001064b330);
INSERT INTO alinkedlist VALUES (
7,5,'5                               ','695',6,1,1,0x000000001064b331);
INSERT INTO alinkedlist VALUES (
7,6,'6                               ','PUNTO',6,1,1,0x000000001064b332);
INSERT INTO alinkedlist VALUES (
7,7,'7                               ','155',6,2,1,0x000000001064b333);
INSERT INTO alinkedlist VALUES (
7,8,'8                               ','156',6,2,1,0x000000001064b334);
INSERT INTO alinkedlist VALUES (
7,9,'9                               ','159',6,2,1,0x000000001064b335);
INSERT INTO alinkedlist VALUES (
7,10,'10                              ','164',6,2,1,0x000000001064b336);
INSERT INTO alinkedlist VALUES (
7,11,'11                              ','145',6,2,1,0x000000001064b337);
INSERT INTO alinkedlist VALUES (
7,12,'12                              ','147',6,2,1,0x000000001064b338);
INSERT INTO alinkedlist VALUES (
7,13,'13                              ','146',6,2,1,0x000000001064b339);
INSERT INTO alinkedlist VALUES (
7,14,'14                              ','GTV',6,2,1,0x000000001064b33a);
INSERT INTO alinkedlist VALUES (
7,15,'15                              ','SPIDER',6,2,1,0x000000001064b33b);
INSERT INTO alinkedlist VALUES (
7,16,'16                              ','166',6,2,1,0x000000001064b33c);
INSERT INTO alinkedlist VALUES (
7,17,'17                              ','GT',6,2,1,0x000000001064b33d);
INSERT INTO alinkedlist VALUES (
7,18,'18                              ','CROSSWAGON',6,2,1,0x000000001064b33e);
INSERT INTO alinkedlist VALUES (
7,19,'19                              ','BRERA',6,2,1,0x000000001064b33f);
INSERT INTO alinkedlist VALUES (
7,20,'20                              ','90',6,2,1,0x000000001064b340);
INSERT INTO alinkedlist VALUES (
7,21,'21                              ','75',6,2,1,0x000000001064b341);
INSERT INTO alinkedlist VALUES (
7,22,'22                              ','33',6,2,1,0x000000001064b342);
INSERT INTO alinkedlist VALUES (
7,23,'23                              ','GIULIETTA',6,2,1,0x000000001064b343);
INSERT INTO alinkedlist VALUES (
7,24,'24                              ','SPRINT',6,2,1,0x000000001064b344);
INSERT INTO alinkedlist VALUES (
7,25,'25                              ','MITO',6,2,1,0x000000001064b345);
INSERT INTO alinkedlist VALUES (
7,26,'26                              ','EXPANDER',6,3,1,0x000000001064b346);
INSERT INTO alinkedlist VALUES (
7,27,'27                              ','10',6,3,1,0x000000001064b347);
INSERT INTO alinkedlist VALUES (
7,28,'28                              ','24',6,3,1,0x000000001064b348);
INSERT INTO alinkedlist VALUES (
7,29,'29                              ','DACIA',6,3,1,0x000000001064b349);
INSERT INTO alinkedlist VALUES (
7,30,'30                              ','ROCSTA',6,4,1,0x000000001064b34a);
INSERT INTO alinkedlist VALUES (
7,31,'31                              ','ROCSTA',6,5,1,0x000000001064b34b);
INSERT INTO alinkedlist VALUES (
7,32,'32                              ','DB7',6,6,1,0x000000001064b34c);
INSERT INTO alinkedlist VALUES (
7,33,'33                              ','V8',6,6,1,0x000000001064b34d);
INSERT INTO alinkedlist VALUES (
7,34,'34                              ','DB9',6,6,1,0x000000001064b34e);
INSERT INTO alinkedlist VALUES (
7,35,'35                              ','VANQUISH',6,6,1,0x000000001064b34f);
INSERT INTO alinkedlist VALUES (
7,36,'36                              ','V8 VANTAGE',6,6,1,0x000000001064b350);
INSERT INTO alinkedlist VALUES (
7,37,'37                              ','VANTAGE',6,6,1,0x000000001064b351);
INSERT INTO alinkedlist VALUES (
7,38,'38                              ','DBS',6,6,1,0x000000001064b352);
INSERT INTO alinkedlist VALUES (
7,39,'39                              ','VOLANTE',6,6,1,0x000000001064b353);
INSERT INTO alinkedlist VALUES (
7,40,'40                              ','VIRAGE',6,6,1,0x000000001064b354);
INSERT INTO alinkedlist VALUES (
7,41,'41                              ','VANTAGE V8',6,6,1,0x000000001064b355);
INSERT INTO alinkedlist VALUES (
7,42,'42                              ','VANTAGE V12',6,6,1,0x000000001064b356);
INSERT INTO alinkedlist VALUES (
7,43,'43                              ','RAPIDE',6,6,1,0x000000001064b357);
INSERT INTO alinkedlist VALUES (
7,44,'44                              ','CYGNET',6,6,1,0x000000001064b358);
INSERT INTO alinkedlist VALUES (
7,45,'45                              ','80',6,7,1,0x000000001064b359);
INSERT INTO alinkedlist VALUES (
7,46,'46                              ','A4',6,7,1,0x000000001064b35a);
INSERT INTO alinkedlist VALUES (
7,47,'47                              ','A6',6,7,1,0x000000001064b35b);
INSERT INTO alinkedlist VALUES (
7,48,'48                              ','S6',6,7,1,0x000000001064b35c);
INSERT INTO alinkedlist VALUES (
7,49,'49                              ','COUPE',6,7,1,0x000000001064b35d);
INSERT INTO alinkedlist VALUES (
7,50,'50                              ','S2',6,7,1,0x000000001064b35e);
INSERT INTO alinkedlist VALUES (
7,51,'51                              ','RS2',6,7,1,0x000000001064b35f);
INSERT INTO alinkedlist VALUES (
7,52,'52                              ','A8',6,7,1,0x000000001064b360);
INSERT INTO alinkedlist VALUES (
7,53,'53                              ','CABRIOLET',6,7,1,0x000000001064b361);
INSERT INTO alinkedlist VALUES (
7,54,'54                              ','S8',6,7,1,0x000000001064b362);
INSERT INTO alinkedlist VALUES (
7,55,'55                              ','A3',6,7,1,0x000000001064b363);
INSERT INTO alinkedlist VALUES (
7,56,'56                              ','S4',6,7,1,0x000000001064b364);
INSERT INTO alinkedlist VALUES (
7,57,'57                              ','TT',6,7,1,0x000000001064b365);
INSERT INTO alinkedlist VALUES (
7,58,'58                              ','S3',6,7,1,0x000000001064b366);
INSERT INTO alinkedlist VALUES (
7,59,'59                              ','ALLROAD QUATTRO',6,7,1,0x000000001064b367);
INSERT INTO alinkedlist VALUES (
7,60,'60                              ','RS4',6,7,1,0x000000001064b368);
INSERT INTO alinkedlist VALUES (
7,61,'61                              ','A2',6,7,1,0x000000001064b369);
INSERT INTO alinkedlist VALUES (
7,62,'62                              ','RS6',6,7,1,0x000000001064b36a);
INSERT INTO alinkedlist VALUES (
7,63,'63                              ','Q7',6,7,1,0x000000001064b36b);
INSERT INTO alinkedlist VALUES (
7,64,'64                              ','R8',6,7,1,0x000000001064b36c);
INSERT INTO alinkedlist VALUES (
7,65,'65                              ','A5',6,7,1,0x000000001064b36d);
INSERT INTO alinkedlist VALUES (
7,66,'66                              ','S5',6,7,1,0x000000001064b36e);
INSERT INTO alinkedlist VALUES (
7,67,'67                              ','V8',6,7,1,0x000000001064b36f);
INSERT INTO alinkedlist VALUES (
7,68,'68                              ','200',6,7,1,0x000000001064b370);
INSERT INTO alinkedlist VALUES (
7,69,'69                              ','100',6,7,1,0x000000001064b371);
INSERT INTO alinkedlist VALUES (
7,70,'70                              ','90',6,7,1,0x000000001064b372);
INSERT INTO alinkedlist VALUES (
7,71,'71                              ','TTS',6,7,1,0x000000001064b373);
INSERT INTO alinkedlist VALUES (
7,72,'72                              ','Q5',6,7,1,0x000000001064b374);
INSERT INTO alinkedlist VALUES (
7,73,'73                              ','A4 ALLROAD QUATTRO',6,7,1,0x000000001064b375);
INSERT INTO alinkedlist VALUES (
7,74,'74                              ','TT RS',6,7,1,0x000000001064b376);
INSERT INTO alinkedlist VALUES (
7,75,'75                              ','RS5',6,7,1,0x000000001064b377);
INSERT INTO alinkedlist VALUES (
7,76,'76                              ','A1',6,7,1,0x000000001064b378);
INSERT INTO alinkedlist VALUES (
7,77,'77                              ','A7',6,7,1,0x000000001064b379);
INSERT INTO alinkedlist VALUES (
7,78,'78                              ','RS3',6,7,1,0x000000001064b37a);
INSERT INTO alinkedlist VALUES (
7,79,'79                              ','Q3',6,7,1,0x000000001064b37b);
INSERT INTO alinkedlist VALUES (
7,80,'80                              ','A6 ALLROAD QUATTRO',6,7,1,0x000000001064b37c);
INSERT INTO alinkedlist VALUES (
7,81,'81                              ','S7',6,7,1,0x000000001064b37d);
INSERT INTO alinkedlist VALUES (
7,82,'82                              ','SQ5',6,7,1,0x000000001064b37e);
INSERT INTO alinkedlist VALUES (
7,83,'83                              ','MINI',6,8,1,0x000000001064b37f);
INSERT INTO alinkedlist VALUES (
7,84,'84                              ','MONTEGO',6,8,1,0x000000001064b380);
INSERT INTO alinkedlist VALUES (
7,85,'85                              ','MAESTRO',6,8,1,0x000000001064b381);
INSERT INTO alinkedlist VALUES (
7,86,'86                              ','METRO',6,8,1,0x000000001064b382);
INSERT INTO alinkedlist VALUES (
7,87,'87                              ','MINI MOKE',6,8,1,0x000000001064b383);
INSERT INTO alinkedlist VALUES (
7,88,'88                              ','DIESEL',6,9,1,0x000000001064b384);
INSERT INTO alinkedlist VALUES (
7,89,'89                              ','BROOKLANDS',6,10,1,0x000000001064b385);
INSERT INTO alinkedlist VALUES (
7,90,'90                              ','TURBO',6,10,1,0x000000001064b386);
INSERT INTO alinkedlist VALUES (
7,91,'91                              ','CONTINENTAL',6,10,1,0x000000001064b387);
INSERT INTO alinkedlist VALUES (
7,92,'92                              ','AZURE',6,10,1,0x000000001064b388);
INSERT INTO alinkedlist VALUES (
7,93,'93                              ','ARNAGE',6,10,1,0x000000001064b389);
INSERT INTO alinkedlist VALUES (
7,94,'94                              ','CONTINENTAL GT',6,10,1,0x000000001064b38a);
INSERT INTO alinkedlist VALUES (
7,95,'95                              ','CONTINENTAL FLYING SPUR',6,10,1,0x000000001064b38b);
INSERT INTO alinkedlist VALUES (
7,96,'96                              ','TURBO R',6,10,1,0x000000001064b38c);
INSERT INTO alinkedlist VALUES (
7,97,'97                              ','MULSANNE',6,10,1,0x000000001064b38d);
INSERT INTO alinkedlist VALUES (
7,98,'98                              ','EIGHT',6,10,1,0x000000001064b38e);
INSERT INTO alinkedlist VALUES (
7,99,'99                              ','CONTINENTAL GTC',6,10,1,0x000000001064b38f);
INSERT INTO alinkedlist VALUES (
7,100,'100                             ','CONTINENTAL SUPERSPORTS',6,10,1,0x000000001064b390);
INSERT INTO alinkedlist VALUES (
7,101,'101                             ','FREECLIMBER DIESEL',6,11,1,0x000000001064b391);
INSERT INTO alinkedlist VALUES (
7,102,'102                             ','SERIE 3',6,12,1,0x000000001064b392);
INSERT INTO alinkedlist VALUES (
7,103,'103                             ','SERIE 5',6,12,1,0x000000001064b393);
INSERT INTO alinkedlist VALUES (
7,104,'104                             ','COMPACT',6,12,1,0x000000001064b394);
INSERT INTO alinkedlist VALUES (
7,105,'105                             ','SERIE 7',6,12,1,0x000000001064b395);
INSERT INTO alinkedlist VALUES (
7,106,'106                             ','SERIE 8',6,12,1,0x000000001064b396);
INSERT INTO alinkedlist VALUES (
7,107,'107                             ','Z3',6,12,1,0x000000001064b397);
INSERT INTO alinkedlist VALUES (
7,108,'108                             ','Z4',6,12,1,0x000000001064b398);
INSERT INTO alinkedlist VALUES (
7,109,'109                             ','Z8',6,12,1,0x000000001064b399);
INSERT INTO alinkedlist VALUES (
7,110,'110                             ','X5',6,12,1,0x000000001064b39a);
INSERT INTO alinkedlist VALUES (
7,111,'111                             ','SERIE 6',6,12,1,0x000000001064b39b);
INSERT INTO alinkedlist VALUES (
7,112,'112                             ','X3',6,12,1,0x000000001064b39c);
INSERT INTO alinkedlist VALUES (
7,113,'113                             ','SERIE 1',6,12,1,0x000000001064b39d);
INSERT INTO alinkedlist VALUES (
7,114,'114                             ','Z1',6,12,1,0x000000001064b39e);
INSERT INTO alinkedlist VALUES (
7,115,'115                             ','X6',6,12,1,0x000000001064b39f);
INSERT INTO alinkedlist VALUES (
7,116,'116                             ','X1',6,12,1,0x000000001064b3a0);
INSERT INTO alinkedlist VALUES (
7,117,'117                             ','SEVILLE',6,13,1,0x000000001064b3a1);
INSERT INTO alinkedlist VALUES (
7,118,'118                             ','STS',6,13,1,0x000000001064b3a2);
INSERT INTO alinkedlist VALUES (
7,119,'119                             ','EL DORADO',6,13,1,0x000000001064b3a3);
INSERT INTO alinkedlist VALUES (
7,120,'120                             ','CTS',6,13,1,0x000000001064b3a4);
INSERT INTO alinkedlist VALUES (
7,121,'121                             ','XLR',6,13,1,0x000000001064b3a5);
INSERT INTO alinkedlist VALUES (
7,122,'122                             ','SRX',6,13,1,0x000000001064b3a6);
INSERT INTO alinkedlist VALUES (
7,123,'123                             ','ESCALADE',6,13,1,0x000000001064b3a7);
INSERT INTO alinkedlist VALUES (
7,124,'124                             ','BLS',6,13,1,0x000000001064b3a8);
INSERT INTO alinkedlist VALUES (
7,125,'125                             ','CORVETTE',6,14,1,0x000000001064b3a9);
INSERT INTO alinkedlist VALUES (
7,126,'126                             ','BLAZER',6,14,1,0x000000001064b3aa);
INSERT INTO alinkedlist VALUES (
7,127,'127                             ','ASTRO',6,14,1,0x000000001064b3ab);
INSERT INTO alinkedlist VALUES (
7,128,'128                             ','NUBIRA',6,14,1,0x000000001064b3ac);
INSERT INTO alinkedlist VALUES (
7,129,'129                             ','EVANDA',6,14,1,0x000000001064b3ad);
INSERT INTO alinkedlist VALUES (
7,130,'130                             ','TRANS SPORT',6,14,1,0x000000001064b3ae);
INSERT INTO alinkedlist VALUES (
7,131,'131                             ','CAMARO',6,14,1,0x000000001064b3af);
INSERT INTO alinkedlist VALUES (
7,132,'132                             ','MATIZ',6,14,1,0x000000001064b3b0);
INSERT INTO alinkedlist VALUES (
7,133,'133                             ','ALERO',6,14,1,0x000000001064b3b1);
INSERT INTO alinkedlist VALUES (
7,134,'134                             ','TAHOE',6,14,1,0x000000001064b3b2);
INSERT INTO alinkedlist VALUES (
7,135,'135                             ','TACUMA',6,14,1,0x000000001064b3b3);
INSERT INTO alinkedlist VALUES (
7,136,'136                             ','TRAILBLAZER',6,14,1,0x000000001064b3b4);
INSERT INTO alinkedlist VALUES (
7,137,'137                             ','KALOS',6,14,1,0x000000001064b3b5);
INSERT INTO alinkedlist VALUES (
7,138,'138                             ','AVEO',6,14,1,0x000000001064b3b6);
INSERT INTO alinkedlist VALUES (
7,139,'139                             ','LACETTI',6,14,1,0x000000001064b3b7);
INSERT INTO alinkedlist VALUES (
7,140,'140                             ','EPICA',6,14,1,0x000000001064b3b8);
INSERT INTO alinkedlist VALUES (
7,141,'141                             ','CAPTIVA',6,14,1,0x000000001064b3b9);
INSERT INTO alinkedlist VALUES (
7,142,'142                             ','HHR',6,14,1,0x000000001064b3ba);
INSERT INTO alinkedlist VALUES (
7,143,'143                             ','CRUZE',6,14,1,0x000000001064b3bb);
INSERT INTO alinkedlist VALUES (
7,144,'144                             ','SPARK',6,14,1,0x000000001064b3bc);
INSERT INTO alinkedlist VALUES (
7,145,'145                             ','ORLANDO',6,14,1,0x000000001064b3bd);
INSERT INTO alinkedlist VALUES (
7,146,'146                             ','VOLT',6,14,1,0x000000001064b3be);
INSERT INTO alinkedlist VALUES (
7,147,'147                             ','MALIBU',6,14,1,0x000000001064b3bf);
INSERT INTO alinkedlist VALUES (
7,148,'148                             ','VISION',6,15,1,0x000000001064b3c0);
INSERT INTO alinkedlist VALUES (
7,149,'149                             ','300M',6,15,1,0x000000001064b3c1);
INSERT INTO alinkedlist VALUES (
7,150,'150                             ','GRAND VOYAGER',6,15,1,0x000000001064b3c2);
INSERT INTO alinkedlist VALUES (
7,151,'151                             ','VIPER',6,15,1,0x000000001064b3c3);
INSERT INTO alinkedlist VALUES (
7,152,'152                             ','NEON',6,15,1,0x000000001064b3c4);
INSERT INTO alinkedlist VALUES (
7,153,'153                             ','VOYAGER',6,15,1,0x000000001064b3c5);
INSERT INTO alinkedlist VALUES (
7,154,'154                             ','STRATUS',6,15,1,0x000000001064b3c6);
INSERT INTO alinkedlist VALUES (
7,155,'155                             ','SEBRING',6,15,1,0x000000001064b3c7);
INSERT INTO alinkedlist VALUES (
7,156,'156                             ','SEBRING 200C',6,15,1,0x000000001064b3c8);
INSERT INTO alinkedlist VALUES (
7,157,'157                             ','NEW YORKER',6,15,1,0x000000001064b3c9);
INSERT INTO alinkedlist VALUES (
7,158,'158                             ','PT CRUISER',6,15,1,0x000000001064b3ca);
INSERT INTO alinkedlist VALUES (
7,159,'159                             ','CROSSFIRE',6,15,1,0x000000001064b3cb);
INSERT INTO alinkedlist VALUES (
7,160,'160                             ','300C',6,15,1,0x000000001064b3cc);
INSERT INTO alinkedlist VALUES (
7,161,'161                             ','LE BARON',6,15,1,0x000000001064b3cd);
INSERT INTO alinkedlist VALUES (
7,162,'162                             ','SARATOGA',6,15,1,0x000000001064b3ce);
INSERT INTO alinkedlist VALUES (
7,163,'163                             ','XANTIA',6,16,1,0x000000001064b3cf);
INSERT INTO alinkedlist VALUES (
7,164,'164                             ','XM',6,16,1,0x000000001064b3d0);
INSERT INTO alinkedlist VALUES (
7,165,'165                             ','AX',6,16,1,0x000000001064b3d1);
INSERT INTO alinkedlist VALUES (
7,166,'166                             ','ZX',6,16,1,0x000000001064b3d2);
INSERT INTO alinkedlist VALUES (
7,167,'167                             ','EVASION',6,16,1,0x000000001064b3d3);
INSERT INTO alinkedlist VALUES (
7,168,'168                             ','C8',6,16,1,0x000000001064b3d4);
INSERT INTO alinkedlist VALUES (
7,169,'169                             ','SAXO',6,16,1,0x000000001064b3d5);
INSERT INTO alinkedlist VALUES (
7,170,'170                             ','C2',6,16,1,0x000000001064b3d6);
INSERT INTO alinkedlist VALUES (
7,171,'171                             ','XSARA',6,16,1,0x000000001064b3d7);
INSERT INTO alinkedlist VALUES (
7,172,'172                             ','C4',6,16,1,0x000000001064b3d8);
INSERT INTO alinkedlist VALUES (
7,173,'173                             ','XSARA PICASSO',6,16,1,0x000000001064b3d9);
INSERT INTO alinkedlist VALUES (
7,174,'174                             ','C5',6,16,1,0x000000001064b3da);
INSERT INTO alinkedlist VALUES (
7,175,'175                             ','C3',6,16,1,0x000000001064b3db);
INSERT INTO alinkedlist VALUES (
7,176,'176                             ','C3 PLURIEL',6,16,1,0x000000001064b3dc);
INSERT INTO alinkedlist VALUES (
7,177,'177                             ','C1',6,16,1,0x000000001064b3dd);
INSERT INTO alinkedlist VALUES (
7,178,'178                             ','C6',6,16,1,0x000000001064b3de);
INSERT INTO alinkedlist VALUES (
7,179,'179                             ','GRAND C4 PICASSO',6,16,1,0x000000001064b3df);
INSERT INTO alinkedlist VALUES (
7,180,'180                             ','C4 PICASSO',6,16,1,0x000000001064b3e0);
INSERT INTO alinkedlist VALUES (
7,181,'181                             ','CCROSSER',6,16,1,0x000000001064b3e1);
INSERT INTO alinkedlist VALUES (
7,182,'182                             ','C15',6,16,1,0x000000001064b3e2);
INSERT INTO alinkedlist VALUES (
7,183,'183                             ','JUMPER',6,16,1,0x000000001064b3e3);
INSERT INTO alinkedlist VALUES (
7,184,'184                             ','JUMPY',6,16,1,0x000000001064b3e4);
INSERT INTO alinkedlist VALUES (
7,185,'185                             ','BERLINGO',6,16,1,0x000000001064b3e5);
INSERT INTO alinkedlist VALUES (
7,186,'186                             ','BX',6,16,1,0x000000001064b3e6);
INSERT INTO alinkedlist VALUES (
7,187,'187                             ','C25',6,16,1,0x000000001064b3e7);
INSERT INTO alinkedlist VALUES (
7,188,'188                             ','CX',6,16,1,0x000000001064b3e8);
INSERT INTO alinkedlist VALUES (
7,189,'189                             ','GSA',6,16,1,0x000000001064b3e9);
INSERT INTO alinkedlist VALUES (
7,190,'190                             ','VISA',6,16,1,0x000000001064b3ea);
INSERT INTO alinkedlist VALUES (
7,191,'191                             ','LNA',6,16,1,0x000000001064b3eb);
INSERT INTO alinkedlist VALUES (
7,192,'192                             ','2CV',6,16,1,0x000000001064b3ec);
INSERT INTO alinkedlist VALUES (
7,193,'193                             ','NEMO',6,16,1,0x000000001064b3ed);
INSERT INTO alinkedlist VALUES (
7,194,'194                             ','C4 SEDAN',6,16,1,0x000000001064b3ee);
INSERT INTO alinkedlist VALUES (
7,195,'195                             ','BERLINGO FIRST',6,16,1,0x000000001064b3ef);
INSERT INTO alinkedlist VALUES (
7,196,'196                             ','C3 PICASSO',6,16,1,0x000000001064b3f0);
INSERT INTO alinkedlist VALUES (
7,197,'197                             ','DS3',6,16,1,0x000000001064b3f1);
INSERT INTO alinkedlist VALUES (
7,198,'198                             ','CZERO',6,16,1,0x000000001064b3f2);
INSERT INTO alinkedlist VALUES (
7,199,'199                             ','DS4',6,16,1,0x000000001064b3f3);
INSERT INTO alinkedlist VALUES (
7,200,'200                             ','DS5',6,16,1,0x000000001064b3f4);
INSERT INTO alinkedlist VALUES (
7,201,'201                             ','C4 AIRCROSS',6,16,1,0x000000001064b3f5);
INSERT INTO alinkedlist VALUES (
7,202,'202                             ','CELYSEE',6,16,1,0x000000001064b3f6);
INSERT INTO alinkedlist VALUES (
7,203,'203                             ','CORVETTE',6,17,1,0x000000001064b3f7);
INSERT INTO alinkedlist VALUES (
7,204,'204                             ','CONTAC',6,18,1,0x000000001064b3f8);
INSERT INTO alinkedlist VALUES (
7,205,'205                             ','LOGAN',6,18,1,0x000000001064b3f9);
INSERT INTO alinkedlist VALUES (
7,206,'206                             ','SANDERO',6,18,1,0x000000001064b3fa);
INSERT INTO alinkedlist VALUES (
7,207,'207                             ','DUSTER',6,18,1,0x000000001064b3fb);
INSERT INTO alinkedlist VALUES (
7,208,'208                             ','LODGY',6,18,1,0x000000001064b3fc);
INSERT INTO alinkedlist VALUES (
7,209,'209                             ','NEXIA',6,19,1,0x000000001064b3fd);
INSERT INTO alinkedlist VALUES (
7,210,'210                             ','ARANOS',6,19,1,0x000000001064b3fe);
INSERT INTO alinkedlist VALUES (
7,211,'211                             ','LANOS',6,19,1,0x000000001064b3ff);
INSERT INTO alinkedlist VALUES (
7,212,'212                             ','NUBIRA',6,19,1,0x000000001064b401);
INSERT INTO alinkedlist VALUES (
7,213,'213                             ','COMPACT',6,19,1,0x000000001064b402);
INSERT INTO alinkedlist VALUES (
7,214,'214                             ','NUBIRA COMPACT',6,19,1,0x000000001064b403);
INSERT INTO alinkedlist VALUES (
7,215,'215                             ','LEGANZA',6,19,1,0x000000001064b404);
INSERT INTO alinkedlist VALUES (
7,216,'216                             ','EVANDA',6,19,1,0x000000001064b405);
INSERT INTO alinkedlist VALUES (
7,217,'217                             ','MATIZ',6,19,1,0x000000001064b406);
INSERT INTO alinkedlist VALUES (
7,218,'218                             ','TACUMA',6,19,1,0x000000001064b407);
INSERT INTO alinkedlist VALUES (
7,219,'219                             ','KALOS',6,19,1,0x000000001064b408);
INSERT INTO alinkedlist VALUES (
7,220,'220                             ','LACETTI',6,19,1,0x000000001064b409);
INSERT INTO alinkedlist VALUES (
7,221,'221                             ','APPLAUSE',6,21,1,0x000000001064b40a);
INSERT INTO alinkedlist VALUES (
7,222,'222                             ','CHARADE',6,21,1,0x000000001064b40b);
INSERT INTO alinkedlist VALUES (
7,223,'223                             ','ROCKY',6,21,1,0x000000001064b40c);
INSERT INTO alinkedlist VALUES (
7,224,'224                             ','FEROZA',6,21,1,0x000000001064b40d);
INSERT INTO alinkedlist VALUES (
7,225,'225                             ','TERIOS',6,21,1,0x000000001064b40e);
INSERT INTO alinkedlist VALUES (
7,226,'226                             ','SIRION',6,21,1,0x000000001064b40f);
INSERT INTO alinkedlist VALUES (
7,227,'227                             ','SERIE XJ',6,22,1,0x000000001064b410);
INSERT INTO alinkedlist VALUES (
7,228,'228                             ','XJ',6,22,1,0x000000001064b411);
INSERT INTO alinkedlist VALUES (
7,229,'229                             ','DOUBLE SIX',6,22,1,0x000000001064b412);
INSERT INTO alinkedlist VALUES (
7,230,'230                             ','SIX',6,22,1,0x000000001064b413);
INSERT INTO alinkedlist VALUES (
7,231,'231                             ','SERIES III',6,22,1,0x000000001064b414);
INSERT INTO alinkedlist VALUES (
7,232,'232                             ','VIPER',6,23,1,0x000000001064b415);
INSERT INTO alinkedlist VALUES (
7,233,'233                             ','CALIBER',6,23,1,0x000000001064b416);
INSERT INTO alinkedlist VALUES (
7,234,'234                             ','NITRO',6,23,1,0x000000001064b417);
INSERT INTO alinkedlist VALUES (
7,235,'235                             ','AVENGER',6,23,1,0x000000001064b418);
INSERT INTO alinkedlist VALUES (
7,236,'236                             ','JOURNEY',6,23,1,0x000000001064b419);
INSERT INTO alinkedlist VALUES (
7,237,'237                             ','F355',6,24,1,0x000000001064b41a);
INSERT INTO alinkedlist VALUES (
7,238,'238                             ','360',6,24,1,0x000000001064b41b);
INSERT INTO alinkedlist VALUES (
7,239,'239                             ','F430',6,24,1,0x000000001064b41c);
INSERT INTO alinkedlist VALUES (
7,240,'240                             ','F512 M',6,24,1,0x000000001064b41d);
INSERT INTO alinkedlist VALUES (
7,241,'241                             ','550 MARANELLO',6,24,1,0x000000001064b41e);
INSERT INTO alinkedlist VALUES (
7,242,'242                             ','575M MARANELLO',6,24,1,0x000000001064b41f);
INSERT INTO alinkedlist VALUES (
7,243,'243                             ','599',6,24,1,0x000000001064b420);
INSERT INTO alinkedlist VALUES (
7,244,'244                             ','456',6,24,1,0x000000001064b421);
INSERT INTO alinkedlist VALUES (
7,245,'245                             ','456M',6,24,1,0x000000001064b422);
INSERT INTO alinkedlist VALUES (
7,246,'246                             ','612',6,24,1,0x000000001064b423);
INSERT INTO alinkedlist VALUES (
7,247,'247                             ','F50',6,24,1,0x000000001064b424);
INSERT INTO alinkedlist VALUES (
7,248,'248                             ','ENZO',6,24,1,0x000000001064b425);
INSERT INTO alinkedlist VALUES (
7,249,'249                             ','SUPERAMERICA',6,24,1,0x000000001064b426);
INSERT INTO alinkedlist VALUES (
7,250,'250                             ','430',6,24,1,0x000000001064b427);
INSERT INTO alinkedlist VALUES (
7,251,'251                             ','348',6,24,1,0x000000001064b428);
INSERT INTO alinkedlist VALUES (
7,252,'252                             ','TESTAROSSA',6,24,1,0x000000001064b429);
INSERT INTO alinkedlist VALUES (
7,253,'253                             ','512',6,24,1,0x000000001064b42a);
INSERT INTO alinkedlist VALUES (
7,254,'254                             ','355',6,24,1,0x000000001064b42b);
INSERT INTO alinkedlist VALUES (
7,255,'255                             ','F40',6,24,1,0x000000001064b42c);
INSERT INTO alinkedlist VALUES (
7,256,'256                             ','412',6,24,1,0x000000001064b42d);
INSERT INTO alinkedlist VALUES (
7,257,'257                             ','MONDIAL',6,24,1,0x000000001064b42e);
INSERT INTO alinkedlist VALUES (
7,258,'258                             ','328',6,24,1,0x000000001064b42f);
INSERT INTO alinkedlist VALUES (
7,259,'259                             ','CALIFORNIA',6,24,1,0x000000001064b430);
INSERT INTO alinkedlist VALUES (
7,260,'260                             ','458',6,24,1,0x000000001064b431);
INSERT INTO alinkedlist VALUES (
7,261,'261                             ','FF',6,24,1,0x000000001064b432);
INSERT INTO alinkedlist VALUES (
7,262,'262                             ','CROMA',6,25,1,0x000000001064b433);
INSERT INTO alinkedlist VALUES (
7,263,'263                             ','CINQUECENTO',6,25,1,0x000000001064b434);
INSERT INTO alinkedlist VALUES (
7,264,'264                             ','SEICENTO',6,25,1,0x000000001064b435);
INSERT INTO alinkedlist VALUES (
7,265,'265                             ','PUNTO',6,25,1,0x000000001064b436);
INSERT INTO alinkedlist VALUES (
7,266,'266                             ','GRANDE PUNTO',6,25,1,0x000000001064b437);
INSERT INTO alinkedlist VALUES (
7,267,'267                             ','PANDA',6,25,1,0x000000001064b438);
INSERT INTO alinkedlist VALUES (
7,268,'268                             ','TIPO',6,25,1,0x000000001064b439);
INSERT INTO alinkedlist VALUES (
7,269,'269                             ','COUPE',6,25,1,0x000000001064b43a);
INSERT INTO alinkedlist VALUES (
7,270,'270                             ','UNO',6,25,1,0x000000001064b43b);
INSERT INTO alinkedlist VALUES (
7,271,'271                             ','ULYSSE',6,25,1,0x000000001064b43c);
INSERT INTO alinkedlist VALUES (
7,272,'272                             ','TEMPRA',6,25,1,0x000000001064b43d);
INSERT INTO alinkedlist VALUES (
7,273,'273                             ','MAREA',6,25,1,0x000000001064b43e);
INSERT INTO alinkedlist VALUES (
7,274,'274                             ','BARCHETTA',6,25,1,0x000000001064b43f);
INSERT INTO alinkedlist VALUES (
7,275,'275                             ','BRAVO',6,25,1,0x000000001064b440);
INSERT INTO alinkedlist VALUES (
7,276,'276                             ','STILO',6,25,1,0x000000001064b441);
INSERT INTO alinkedlist VALUES (
7,277,'277                             ','BRAVA',6,25,1,0x000000001064b442);
INSERT INTO alinkedlist VALUES (
7,278,'278                             ','PALIO WEEKEND',6,25,1,0x000000001064b443);
INSERT INTO alinkedlist VALUES (
7,279,'279                             ','600',6,25,1,0x000000001064b444);
INSERT INTO alinkedlist VALUES (
7,280,'280                             ','MULTIPLA',6,25,1,0x000000001064b445);
INSERT INTO alinkedlist VALUES (
7,281,'281                             ','IDEA',6,25,1,0x000000001064b446);
INSERT INTO alinkedlist VALUES (
7,282,'282                             ','SEDICI',6,25,1,0x000000001064b447);
INSERT INTO alinkedlist VALUES (
7,283,'283                             ','LINEA',6,25,1,0x000000001064b448);
INSERT INTO alinkedlist VALUES (
7,284,'284                             ','500',6,25,1,0x000000001064b449);
INSERT INTO alinkedlist VALUES (
7,285,'285                             ','FIORINO',6,25,1,0x000000001064b44a);
INSERT INTO alinkedlist VALUES (
7,286,'286                             ','DUCATO',6,25,1,0x000000001064b44b);
INSERT INTO alinkedlist VALUES (
7,287,'287                             ','DOBLO CARGO',6,25,1,0x000000001064b44c);
INSERT INTO alinkedlist VALUES (
7,288,'288                             ','DOBLO',6,25,1,0x000000001064b44d);
INSERT INTO alinkedlist VALUES (
7,289,'289                             ','STRADA',6,25,1,0x000000001064b44e);
INSERT INTO alinkedlist VALUES (
7,290,'290                             ','REGATA',6,25,1,0x000000001064b44f);
INSERT INTO alinkedlist VALUES (
7,291,'291                             ','TALENTO',6,25,1,0x000000001064b450);
INSERT INTO alinkedlist VALUES (
7,292,'292                             ','ARGENTA',6,25,1,0x000000001064b451);
INSERT INTO alinkedlist VALUES (
7,293,'293                             ','RITMO',6,25,1,0x000000001064b452);
INSERT INTO alinkedlist VALUES (
7,294,'294                             ','PUNTO CLASSIC',6,25,1,0x000000001064b453);
INSERT INTO alinkedlist VALUES (
7,295,'295                             ','QUBO',6,25,1,0x000000001064b454);
INSERT INTO alinkedlist VALUES (
7,296,'296                             ','PUNTO EVO',6,25,1,0x000000001064b455);
INSERT INTO alinkedlist VALUES (
7,297,'297                             ','500C',6,25,1,0x000000001064b456);
INSERT INTO alinkedlist VALUES (
7,298,'298                             ','FREEMONT',6,25,1,0x000000001064b457);
INSERT INTO alinkedlist VALUES (
7,299,'299                             ','PANDA CLASSIC',6,25,1,0x000000001064b458);
INSERT INTO alinkedlist VALUES (
7,300,'300                             ','500L',6,25,1,0x000000001064b459);
INSERT INTO alinkedlist VALUES (
7,301,'301                             ','MAVERICK',6,26,1,0x000000001064b45a);
INSERT INTO alinkedlist VALUES (
7,302,'302                             ','ESCORT',6,26,1,0x000000001064b45b);
INSERT INTO alinkedlist VALUES (
7,303,'303                             ','FOCUS',6,26,1,0x000000001064b45c);
INSERT INTO alinkedlist VALUES (
7,304,'304                             ','MONDEO',6,26,1,0x000000001064b45d);
INSERT INTO alinkedlist VALUES (
7,305,'305                             ','SCORPIO',6,26,1,0x000000001064b45e);
INSERT INTO alinkedlist VALUES (
7,306,'306                             ','FIESTA',6,26,1,0x000000001064b45f);
INSERT INTO alinkedlist VALUES (
7,307,'307                             ','PROBE',6,26,1,0x000000001064b460);
INSERT INTO alinkedlist VALUES (
7,308,'308                             ','EXPLORER',6,26,1,0x000000001064b461);
INSERT INTO alinkedlist VALUES (
7,309,'309                             ','GALAXY',6,26,1,0x000000001064b462);
INSERT INTO alinkedlist VALUES (
7,310,'310                             ','KA',6,26,1,0x000000001064b463);
INSERT INTO alinkedlist VALUES (
7,311,'311                             ','PUMA',6,26,1,0x000000001064b464);
INSERT INTO alinkedlist VALUES (
7,312,'312                             ','COUGAR',6,26,1,0x000000001064b465);
INSERT INTO alinkedlist VALUES (
7,313,'313                             ','FOCUS CMAX',6,26,1,0x000000001064b466);
INSERT INTO alinkedlist VALUES (
7,314,'314                             ','FUSION',6,26,1,0x000000001064b467);
INSERT INTO alinkedlist VALUES (
7,315,'315                             ','STREETKA',6,26,1,0x000000001064b468);
INSERT INTO alinkedlist VALUES (
7,316,'316                             ','CMAX',6,26,1,0x000000001064b469);
INSERT INTO alinkedlist VALUES (
7,317,'317                             ','SMAX',6,26,1,0x000000001064b46a);
INSERT INTO alinkedlist VALUES (
7,318,'318                             ','TRANSIT',6,26,1,0x000000001064b46b);
INSERT INTO alinkedlist VALUES (
7,319,'319                             ','COURIER',6,26,1,0x000000001064b46c);
INSERT INTO alinkedlist VALUES (
7,320,'320                             ','RANGER',6,26,1,0x000000001064b46d);
INSERT INTO alinkedlist VALUES (
7,321,'321                             ','SIERRA',6,26,1,0x000000001064b46e);
INSERT INTO alinkedlist VALUES (
7,322,'322                             ','ORION',6,26,1,0x000000001064b46f);
INSERT INTO alinkedlist VALUES (
7,323,'323                             ','PICK UP',6,26,1,0x000000001064b470);
INSERT INTO alinkedlist VALUES (
7,324,'324                             ','CAPRI',6,26,1,0x000000001064b471);
INSERT INTO alinkedlist VALUES (
7,325,'325                             ','GRANADA',6,26,1,0x000000001064b472);
INSERT INTO alinkedlist VALUES (
7,326,'326                             ','KUGA',6,26,1,0x000000001064b473);
INSERT INTO alinkedlist VALUES (
7,327,'327                             ','GRAND CMAX',6,26,1,0x000000001064b474);
INSERT INTO alinkedlist VALUES (
7,328,'328                             ','BMAX',6,26,1,0x000000001064b475);
INSERT INTO alinkedlist VALUES (
7,329,'329                             ','TOURNEO CUSTOM',6,26,1,0x000000001064b476);
INSERT INTO alinkedlist VALUES (
7,330,'330                             ','EXCEED',6,27,1,0x000000001064b477);
INSERT INTO alinkedlist VALUES (
7,331,'331                             ','SANTAMO',6,27,1,0x000000001064b478);
INSERT INTO alinkedlist VALUES (
7,332,'332                             ','SUPER EXCEED',6,27,1,0x000000001064b479);
INSERT INTO alinkedlist VALUES (
7,333,'333                             ','ACCORD',6,29,1,0x000000001064b47a);
INSERT INTO alinkedlist VALUES (
7,334,'334                             ','CIVIC',6,29,1,0x000000001064b47b);
INSERT INTO alinkedlist VALUES (
7,335,'335                             ','CRX',6,29,1,0x000000001064b47c);
INSERT INTO alinkedlist VALUES (
7,336,'336                             ','PRELUDE',6,29,1,0x000000001064b47d);
INSERT INTO alinkedlist VALUES (
7,337,'337                             ','NSX',6,29,1,0x000000001064b47e);
INSERT INTO alinkedlist VALUES (
7,338,'338                             ','LEGEND',6,29,1,0x000000001064b47f);
INSERT INTO alinkedlist VALUES (
7,339,'339                             ','CRV',6,29,1,0x000000001064b480);
INSERT INTO alinkedlist VALUES (
7,340,'340                             ','HRV',6,29,1,0x000000001064b481);
INSERT INTO alinkedlist VALUES (
7,341,'341                             ','LOGO',6,29,1,0x000000001064b482);
INSERT INTO alinkedlist VALUES (
7,342,'342                             ','S2000',6,29,1,0x000000001064b483);
INSERT INTO alinkedlist VALUES (
7,343,'343                             ','STREAM',6,29,1,0x000000001064b484);
INSERT INTO alinkedlist VALUES (
7,344,'344                             ','JAZZ',6,29,1,0x000000001064b485);
INSERT INTO alinkedlist VALUES (
7,345,'345                             ','FRV',6,29,1,0x000000001064b486);
INSERT INTO alinkedlist VALUES (
7,346,'346                             ','CONCERTO',6,29,1,0x000000001064b487);
INSERT INTO alinkedlist VALUES (
7,347,'347                             ','INSIGHT',6,29,1,0x000000001064b488);
INSERT INTO alinkedlist VALUES (
7,348,'348                             ','CRZ',6,29,1,0x000000001064b489);
INSERT INTO alinkedlist VALUES (
7,349,'349                             ','H2',6,30,1,0x000000001064b48a);
INSERT INTO alinkedlist VALUES (
7,350,'350                             ','H3',6,30,1,0x000000001064b48b);
INSERT INTO alinkedlist VALUES (
7,351,'351                             ','H3T',6,30,1,0x000000001064b48c);
INSERT INTO alinkedlist VALUES (
7,352,'352                             ','LANTRA',6,31,1,0x000000001064b48d);
INSERT INTO alinkedlist VALUES (
7,353,'353                             ','SONATA',6,31,1,0x000000001064b48e);
INSERT INTO alinkedlist VALUES (
7,354,'354                             ','ELANTRA',6,31,1,0x000000001064b48f);
INSERT INTO alinkedlist VALUES (
7,355,'355                             ','ACCENT',6,31,1,0x000000001064b490);
INSERT INTO alinkedlist VALUES (
7,356,'356                             ','SCOUPE',6,31,1,0x000000001064b491);
INSERT INTO alinkedlist VALUES (
7,357,'357                             ','COUPE',6,31,1,0x000000001064b492);
INSERT INTO alinkedlist VALUES (
7,358,'358                             ','ATOS',6,31,1,0x000000001064b493);
INSERT INTO alinkedlist VALUES (
7,359,'359                             ','H1',6,31,1,0x000000001064b494);
INSERT INTO alinkedlist VALUES (
7,360,'360                             ','ATOS PRIME',6,31,1,0x000000001064b495);
INSERT INTO alinkedlist VALUES (
7,361,'361                             ','XG',6,31,1,0x000000001064b496);
INSERT INTO alinkedlist VALUES (
7,362,'362                             ','TRAJET',6,31,1,0x000000001064b497);
INSERT INTO alinkedlist VALUES (
7,363,'363                             ','SANTA FE',6,31,1,0x000000001064b498);
INSERT INTO alinkedlist VALUES (
7,364,'364                             ','TERRACAN',6,31,1,0x000000001064b499);
INSERT INTO alinkedlist VALUES (
7,365,'365                             ','MATRIX',6,31,1,0x000000001064b49a);
INSERT INTO alinkedlist VALUES (
7,366,'366                             ','GETZ',6,31,1,0x000000001064b49b);
INSERT INTO alinkedlist VALUES (
7,367,'367                             ','TUCSON',6,31,1,0x000000001064b49c);
INSERT INTO alinkedlist VALUES (
7,368,'368                             ','I30',6,31,1,0x000000001064b49d);
INSERT INTO alinkedlist VALUES (
7,369,'369                             ','PONY',6,31,1,0x000000001064b49e);
INSERT INTO alinkedlist VALUES (
7,370,'370                             ','GRANDEUR',6,31,1,0x000000001064b49f);
INSERT INTO alinkedlist VALUES (
7,371,'371                             ','I10',6,31,1,0x000000001064b4a0);
INSERT INTO alinkedlist VALUES (
7,372,'372                             ','I800',6,31,1,0x000000001064b4a1);
INSERT INTO alinkedlist VALUES (
7,373,'373                             ','SONATA FL',6,31,1,0x000000001064b4a2);
INSERT INTO alinkedlist VALUES (
7,374,'374                             ','IX55',6,31,1,0x000000001064b4a3);
INSERT INTO alinkedlist VALUES (
7,375,'375                             ','I20',6,31,1,0x000000001064b4a4);
INSERT INTO alinkedlist VALUES (
7,376,'376                             ','IX35',6,31,1,0x000000001064b4a5);
INSERT INTO alinkedlist VALUES (
7,377,'377                             ','IX20',6,31,1,0x000000001064b4a6);
INSERT INTO alinkedlist VALUES (
7,378,'378                             ','GENESIS',6,31,1,0x000000001064b4a7);
INSERT INTO alinkedlist VALUES (
7,379,'379                             ','I40',6,31,1,0x000000001064b4a8);
INSERT INTO alinkedlist VALUES (
7,380,'380                             ','VELOSTER',6,31,1,0x000000001064b4a9);
INSERT INTO alinkedlist VALUES (
7,381,'381                             ','G',6,32,1,0x000000001064b4aa);
INSERT INTO alinkedlist VALUES (
7,382,'382                             ','EX',6,32,1,0x000000001064b4ab);
INSERT INTO alinkedlist VALUES (
7,383,'383                             ','FX',6,32,1,0x000000001064b4ac);
INSERT INTO alinkedlist VALUES (
7,384,'384                             ','M',6,32,1,0x000000001064b4ad);
INSERT INTO alinkedlist VALUES (
7,385,'385                             ','ELBA',6,33,1,0x000000001064b4ae);
INSERT INTO alinkedlist VALUES (
7,386,'386                             ','MINITRE',6,33,1,0x000000001064b4af);
INSERT INTO alinkedlist VALUES (
7,387,'387                             ','TROOPER',6,34,1,0x000000001064b4b0);
INSERT INTO alinkedlist VALUES (
7,388,'388                             ','PICK UP',6,34,1,0x000000001064b4b1);
INSERT INTO alinkedlist VALUES (
7,389,'389                             ','D MAX',6,34,1,0x000000001064b4b2);
INSERT INTO alinkedlist VALUES (
7,390,'390                             ','RODEO',6,34,1,0x000000001064b4b3);
INSERT INTO alinkedlist VALUES (
7,391,'391                             ','DMAX',6,34,1,0x000000001064b4b4);
INSERT INTO alinkedlist VALUES (
7,392,'392                             ','TRROPER',6,34,1,0x000000001064b4b5);
INSERT INTO alinkedlist VALUES (
7,393,'393                             ','DAILY',6,35,1,0x000000001064b4b6);
INSERT INTO alinkedlist VALUES (
7,394,'394                             ','MASSIF',6,35,1,0x000000001064b4b7);
INSERT INTO alinkedlist VALUES (
7,395,'395                             ','DAILY',6,36,1,0x000000001064b4b8);
INSERT INTO alinkedlist VALUES (
7,396,'396                             ','DUTY',6,36,1,0x000000001064b4b9);
INSERT INTO alinkedlist VALUES (
7,397,'397                             ','SERIE XJ',6,37,1,0x000000001064b4ba);
INSERT INTO alinkedlist VALUES (
7,398,'398                             ','SERIE XK',6,37,1,0x000000001064b4bb);
INSERT INTO alinkedlist VALUES (
7,399,'399                             ','XJ',6,37,1,0x000000001064b4bc);
INSERT INTO alinkedlist VALUES (
7,400,'400                             ','STYPE',6,37,1,0x000000001064b4bd);
INSERT INTO alinkedlist VALUES (
7,401,'401                             ','XF',6,37,1,0x000000001064b4be);
INSERT INTO alinkedlist VALUES (
7,402,'402                             ','XTYPE',6,37,1,0x000000001064b4bf);
INSERT INTO alinkedlist VALUES (
7,403,'403                             ','WRANGLER',6,38,1,0x000000001064b4c0);
INSERT INTO alinkedlist VALUES (
7,404,'404                             ','CHEROKEE',6,38,1,0x000000001064b4c1);
INSERT INTO alinkedlist VALUES (
7,405,'405                             ','GRAND CHEROKEE',6,38,1,0x000000001064b4c2);
INSERT INTO alinkedlist VALUES (
7,406,'406                             ','COMMANDER',6,38,1,0x000000001064b4c3);
INSERT INTO alinkedlist VALUES (
7,407,'407                             ','COMPASS',6,38,1,0x000000001064b4c4);
INSERT INTO alinkedlist VALUES (
7,408,'408                             ','WRANGLER UNLIMITED',6,38,1,0x000000001064b4c5);
INSERT INTO alinkedlist VALUES (
7,409,'409                             ','PATRIOT',6,38,1,0x000000001064b4c6);
INSERT INTO alinkedlist VALUES (
7,410,'410                             ','SPORTAGE',6,39,1,0x000000001064b4c7);
INSERT INTO alinkedlist VALUES (
7,411,'411                             ','SEPHIA',6,39,1,0x000000001064b4c8);
INSERT INTO alinkedlist VALUES (
7,412,'412                             ','SEPHIA II',6,39,1,0x000000001064b4c9);
INSERT INTO alinkedlist VALUES (
7,413,'413                             ','PRIDE',6,39,1,0x000000001064b4ca);
INSERT INTO alinkedlist VALUES (
7,414,'414                             ','CLARUS',6,39,1,0x000000001064b4cb);
INSERT INTO alinkedlist VALUES (
7,415,'415                             ','SHUMA',6,39,1,0x000000001064b4cc);
INSERT INTO alinkedlist VALUES (
7,416,'416                             ','CARNIVAL',6,39,1,0x000000001064b4cd);
INSERT INTO alinkedlist VALUES (
7,417,'417                             ','JOICE',6,39,1,0x000000001064b4ce);
INSERT INTO alinkedlist VALUES (
7,418,'418                             ','MAGENTIS',6,39,1,0x000000001064b4cf);
INSERT INTO alinkedlist VALUES (
7,419,'419                             ','CARENS',6,39,1,0x000000001064b4d0);
INSERT INTO alinkedlist VALUES (
7,420,'420                             ','RIO',6,39,1,0x000000001064b4d1);
INSERT INTO alinkedlist VALUES (
7,421,'421                             ','CERATO',6,39,1,0x000000001064b4d2);
INSERT INTO alinkedlist VALUES (
7,422,'422                             ','SORENTO',6,39,1,0x000000001064b4d3);
INSERT INTO alinkedlist VALUES (
7,423,'423                             ','OPIRUS',6,39,1,0x000000001064b4d4);
INSERT INTO alinkedlist VALUES (
7,424,'424                             ','PICANTO',6,39,1,0x000000001064b4d5);
INSERT INTO alinkedlist VALUES (
7,425,'425                             ','CEED',6,39,1,0x000000001064b4d6);
INSERT INTO alinkedlist VALUES (
7,426,'426                             ','CEED SPORTY WAGON',6,39,1,0x000000001064b4d7);
INSERT INTO alinkedlist VALUES (
7,427,'427                             ','PROCEED',6,39,1,0x000000001064b4d8);
INSERT INTO alinkedlist VALUES (
7,428,'428                             ','K2500 FRONTIER',6,39,1,0x000000001064b4d9);
INSERT INTO alinkedlist VALUES (
7,429,'429                             ','K2500',6,39,1,0x000000001064b4da);
INSERT INTO alinkedlist VALUES (
7,430,'430                             ','SOUL',6,39,1,0x000000001064b4db);
INSERT INTO alinkedlist VALUES (
7,431,'431                             ','VENGA',6,39,1,0x000000001064b4dc);
INSERT INTO alinkedlist VALUES (
7,432,'432                             ','OPTIMA',6,39,1,0x000000001064b4dd);
INSERT INTO alinkedlist VALUES (
7,433,'433                             ','CEED SPORTSWAGON',6,39,1,0x000000001064b4de);
INSERT INTO alinkedlist VALUES (
7,434,'434                             ','SAMARA',6,40,1,0x000000001064b4df);
INSERT INTO alinkedlist VALUES (
7,435,'435                             ','NIVA',6,40,1,0x000000001064b4e0);
INSERT INTO alinkedlist VALUES (
7,436,'436                             ','SAGONA',6,40,1,0x000000001064b4e1);
INSERT INTO alinkedlist VALUES (
7,437,'437                             ','STAWRA 2110',6,40,1,0x000000001064b4e2);
INSERT INTO alinkedlist VALUES (
7,438,'438                             ','214',6,40,1,0x000000001064b4e3);
INSERT INTO alinkedlist VALUES (
7,439,'439                             ','KALINA',6,40,1,0x000000001064b4e4);
INSERT INTO alinkedlist VALUES (
7,440,'440                             ','SERIE 2100',6,40,1,0x000000001064b4e5);
INSERT INTO alinkedlist VALUES (
7,441,'441                             ','PRIORA',6,40,1,0x000000001064b4e6);
INSERT INTO alinkedlist VALUES (
7,442,'442                             ','GALLARDO',6,41,1,0x000000001064b4e7);
INSERT INTO alinkedlist VALUES (
7,443,'443                             ','MURCIELAGO',6,41,1,0x000000001064b4e8);
INSERT INTO alinkedlist VALUES (
7,444,'444                             ','AVENTADOR',6,41,1,0x000000001064b4e9);
INSERT INTO alinkedlist VALUES (
7,445,'445                             ','DELTA',6,42,1,0x000000001064b4ea);
INSERT INTO alinkedlist VALUES (
7,446,'446                             ','K',6,42,1,0x000000001064b4eb);
INSERT INTO alinkedlist VALUES (
7,447,'447                             ','Y10',6,42,1,0x000000001064b4ec);
INSERT INTO alinkedlist VALUES (
7,448,'448                             ','DEDRA',6,42,1,0x000000001064b4ed);
INSERT INTO alinkedlist VALUES (
7,449,'449                             ','LYBRA',6,42,1,0x000000001064b4ee);
INSERT INTO alinkedlist VALUES (
7,450,'450                             ','Z',6,42,1,0x000000001064b4ef);
INSERT INTO alinkedlist VALUES (
7,451,'451                             ','Y',6,42,1,0x000000001064b4f0);
INSERT INTO alinkedlist VALUES (
7,452,'452                             ','YPSILON',6,42,1,0x000000001064b4f1);
INSERT INTO alinkedlist VALUES (
7,453,'453                             ','THESIS',6,42,1,0x000000001064b4f2);
INSERT INTO alinkedlist VALUES (
7,454,'454                             ','PHEDRA',6,42,1,0x000000001064b4f3);
INSERT INTO alinkedlist VALUES (
7,455,'455                             ','MUSA',6,42,1,0x000000001064b4f4);
INSERT INTO alinkedlist VALUES (
7,456,'456                             ','THEMA',6,42,1,0x000000001064b4f5);
INSERT INTO alinkedlist VALUES (
7,457,'457                             ','ZETA',6,42,1,0x000000001064b4f6);
INSERT INTO alinkedlist VALUES (
7,458,'458                             ','KAPPA',6,42,1,0x000000001064b4f7);
INSERT INTO alinkedlist VALUES (
7,459,'459                             ','TREVI',6,42,1,0x000000001064b4f8);
INSERT INTO alinkedlist VALUES (
7,460,'460                             ','PRISMA',6,42,1,0x000000001064b4f9);
INSERT INTO alinkedlist VALUES (
7,461,'461                             ','A112',6,42,1,0x000000001064b4fa);
INSERT INTO alinkedlist VALUES (
7,462,'462                             ','YPSILON ELEFANTINO',6,42,1,0x000000001064b4fb);
INSERT INTO alinkedlist VALUES (
7,463,'463                             ','VOYAGER',6,42,1,0x000000001064b4fc);
INSERT INTO alinkedlist VALUES (
7,464,'464                             ','RANGE ROVER',6,43,1,0x000000001064b4fd);
INSERT INTO alinkedlist VALUES (
7,465,'465                             ','DEFENDER',6,43,1,0x000000001064b4fe);
INSERT INTO alinkedlist VALUES (
7,466,'466                             ','DISCOVERY',6,43,1,0x000000001064b4ff);
INSERT INTO alinkedlist VALUES (
7,467,'467                             ','FREELANDER',6,43,1,0x000000001064b501);
INSERT INTO alinkedlist VALUES (
7,468,'468                             ','RANGE ROVER SPORT',6,43,1,0x000000001064b502);
INSERT INTO alinkedlist VALUES (
7,469,'469                             ','DISCOVERY 4',6,43,1,0x000000001064b503);
INSERT INTO alinkedlist VALUES (
7,470,'470                             ','RANGE ROVER EVOQUE',6,43,1,0x000000001064b504);
INSERT INTO alinkedlist VALUES (
7,471,'471                             ','MAXUS',6,44,1,0x000000001064b505);
INSERT INTO alinkedlist VALUES (
7,472,'472                             ','LS400',6,45,1,0x000000001064b506);
INSERT INTO alinkedlist VALUES (
7,473,'473                             ','LS430',6,45,1,0x000000001064b507);
INSERT INTO alinkedlist VALUES (
7,474,'474                             ','GS300',6,45,1,0x000000001064b508);
INSERT INTO alinkedlist VALUES (
7,475,'475                             ','IS200',6,45,1,0x000000001064b509);
INSERT INTO alinkedlist VALUES (
7,476,'476                             ','RX300',6,45,1,0x000000001064b50a);
INSERT INTO alinkedlist VALUES (
7,477,'477                             ','GS430',6,45,1,0x000000001064b50b);
INSERT INTO alinkedlist VALUES (
7,478,'478                             ','GS460',6,45,1,0x000000001064b50c);
INSERT INTO alinkedlist VALUES (
7,479,'479                             ','SC430',6,45,1,0x000000001064b50d);
INSERT INTO alinkedlist VALUES (
7,480,'480                             ','IS300',6,45,1,0x000000001064b50e);
INSERT INTO alinkedlist VALUES (
7,481,'481                             ','IS250',6,45,1,0x000000001064b50f);
INSERT INTO alinkedlist VALUES (
7,482,'482                             ','RX400H',6,45,1,0x000000001064b510);
INSERT INTO alinkedlist VALUES (
7,483,'483                             ','IS220D',6,45,1,0x000000001064b511);
INSERT INTO alinkedlist VALUES (
7,484,'484                             ','RX350',6,45,1,0x000000001064b512);
INSERT INTO alinkedlist VALUES (
7,485,'485                             ','GS450H',6,45,1,0x000000001064b513);
INSERT INTO alinkedlist VALUES (
7,486,'486                             ','LS460',6,45,1,0x000000001064b514);
INSERT INTO alinkedlist VALUES (
7,487,'487                             ','LS600H',6,45,1,0x000000001064b515);
INSERT INTO alinkedlist VALUES (
7,488,'488                             ','LS',6,45,1,0x000000001064b516);
INSERT INTO alinkedlist VALUES (
7,489,'489                             ','GS',6,45,1,0x000000001064b517);
INSERT INTO alinkedlist VALUES (
7,490,'490                             ','IS',6,45,1,0x000000001064b518);
INSERT INTO alinkedlist VALUES (
7,491,'491                             ','SC',6,45,1,0x000000001064b519);
INSERT INTO alinkedlist VALUES (
7,492,'492                             ','RX',6,45,1,0x000000001064b51a);
INSERT INTO alinkedlist VALUES (
7,493,'493                             ','CT',6,45,1,0x000000001064b51b);
INSERT INTO alinkedlist VALUES (
7,494,'494                             ','ELISE',6,46,1,0x000000001064b51c);
INSERT INTO alinkedlist VALUES (
7,495,'495                             ','EXIGE',6,46,1,0x000000001064b51d);
INSERT INTO alinkedlist VALUES (
7,496,'496                             ','BOLERO PICKUP',6,47,1,0x000000001064b51e);
INSERT INTO alinkedlist VALUES (
7,497,'497                             ','GOA PICKUP',6,47,1,0x000000001064b51f);
INSERT INTO alinkedlist VALUES (
7,498,'498                             ','GOA',6,47,1,0x000000001064b520);
INSERT INTO alinkedlist VALUES (
7,499,'499                             ','CJ',6,47,1,0x000000001064b521);
INSERT INTO alinkedlist VALUES (
7,500,'500                             ','PIKUP',6,47,1,0x000000001064b522);
INSERT INTO alinkedlist VALUES (
7,501,'501                             ','THAR',6,47,1,0x000000001064b523);
INSERT INTO alinkedlist VALUES (
7,502,'502                             ','GHIBLI',6,48,1,0x000000001064b524);
INSERT INTO alinkedlist VALUES (
7,503,'503                             ','SHAMAL',6,48,1,0x000000001064b525);
INSERT INTO alinkedlist VALUES (
7,504,'504                             ','QUATTROPORTE',6,48,1,0x000000001064b526);
INSERT INTO alinkedlist VALUES (
7,505,'505                             ','3200 GT',6,48,1,0x000000001064b527);
INSERT INTO alinkedlist VALUES (
7,506,'506                             ','COUPE',6,48,1,0x000000001064b528);
INSERT INTO alinkedlist VALUES (
7,507,'507                             ','SPYDER',6,48,1,0x000000001064b529);
INSERT INTO alinkedlist VALUES (
7,508,'508                             ','GRANSPORT',6,48,1,0x000000001064b52a);
INSERT INTO alinkedlist VALUES (
7,509,'509                             ','GRANTURISMO',6,48,1,0x000000001064b52b);
INSERT INTO alinkedlist VALUES (
7,510,'510                             ','430',6,48,1,0x000000001064b52c);
INSERT INTO alinkedlist VALUES (
7,511,'511                             ','BITURBO',6,48,1,0x000000001064b52d);
INSERT INTO alinkedlist VALUES (
7,512,'512                             ','228',6,48,1,0x000000001064b52e);
INSERT INTO alinkedlist VALUES (
7,513,'513                             ','224',6,48,1,0x000000001064b52f);
INSERT INTO alinkedlist VALUES (
7,514,'514                             ','GRANCABRIO',6,48,1,0x000000001064b530);
INSERT INTO alinkedlist VALUES (
7,515,'515                             ','MAYBACH',6,49,1,0x000000001064b531);
INSERT INTO alinkedlist VALUES (
7,516,'516                             ','XEDOS 6',6,50,1,0x000000001064b532);
INSERT INTO alinkedlist VALUES (
7,517,'517                             ','626',6,50,1,0x000000001064b533);
INSERT INTO alinkedlist VALUES (
7,518,'518                             ','121',6,50,1,0x000000001064b534);
INSERT INTO alinkedlist VALUES (
7,519,'519                             ','XEDOS 9',6,50,1,0x000000001064b535);
INSERT INTO alinkedlist VALUES (
7,520,'520                             ','323',6,50,1,0x000000001064b536);
INSERT INTO alinkedlist VALUES (
7,521,'521                             ','MX3',6,50,1,0x000000001064b537);
INSERT INTO alinkedlist VALUES (
7,522,'522                             ','RX7',6,50,1,0x000000001064b538);
INSERT INTO alinkedlist VALUES (
7,523,'523                             ','MX5',6,50,1,0x000000001064b539);
INSERT INTO alinkedlist VALUES (
7,524,'524                             ','MAZDA3',6,50,1,0x000000001064b53a);
INSERT INTO alinkedlist VALUES (
7,525,'525                             ','MPV',6,50,1,0x000000001064b53b);
INSERT INTO alinkedlist VALUES (
7,526,'526                             ','DEMIO',6,50,1,0x000000001064b53c);
INSERT INTO alinkedlist VALUES (
7,527,'527                             ','PREMACY',6,50,1,0x000000001064b53d);
INSERT INTO alinkedlist VALUES (
7,528,'528                             ','TRIBUTE',6,50,1,0x000000001064b53e);
INSERT INTO alinkedlist VALUES (
7,529,'529                             ','MAZDA6',6,50,1,0x000000001064b53f);
INSERT INTO alinkedlist VALUES (
7,530,'530                             ','MAZDA2',6,50,1,0x000000001064b540);
INSERT INTO alinkedlist VALUES (
7,531,'531                             ','RX8',6,50,1,0x000000001064b541);
INSERT INTO alinkedlist VALUES (
7,532,'532                             ','MAZDA5',6,50,1,0x000000001064b542);
INSERT INTO alinkedlist VALUES (
7,533,'533                             ','CX7',6,50,1,0x000000001064b543);
INSERT INTO alinkedlist VALUES (
7,534,'534                             ','SERIE B',6,50,1,0x000000001064b544);
INSERT INTO alinkedlist VALUES (
7,535,'535                             ','B2500',6,50,1,0x000000001064b545);
INSERT INTO alinkedlist VALUES (
7,536,'536                             ','BT50',6,50,1,0x000000001064b546);
INSERT INTO alinkedlist VALUES (
7,537,'537                             ','MX6',6,50,1,0x000000001064b547);
INSERT INTO alinkedlist VALUES (
7,538,'538                             ','929',6,50,1,0x000000001064b548);
INSERT INTO alinkedlist VALUES (
7,539,'539                             ','CX5',6,50,1,0x000000001064b549);
INSERT INTO alinkedlist VALUES (
7,540,'540                             ','CLASE C',6,51,1,0x000000001064b54a);
INSERT INTO alinkedlist VALUES (
7,541,'541                             ','CLASE E',6,51,1,0x000000001064b54b);
INSERT INTO alinkedlist VALUES (
7,542,'542                             ','CLASE SL',6,51,1,0x000000001064b54c);
INSERT INTO alinkedlist VALUES (
7,543,'543                             ','CLASE S',6,51,1,0x000000001064b54d);
INSERT INTO alinkedlist VALUES (
7,544,'544                             ','CLASE CL',6,51,1,0x000000001064b54e);
INSERT INTO alinkedlist VALUES (
7,545,'545                             ','CLASE G',6,51,1,0x000000001064b54f);
INSERT INTO alinkedlist VALUES (
7,546,'546                             ','CLASE SLK',6,51,1,0x000000001064b550);
INSERT INTO alinkedlist VALUES (
7,547,'547                             ','CLASE V',6,51,1,0x000000001064b551);
INSERT INTO alinkedlist VALUES (
7,548,'548                             ','VIANO',6,51,1,0x000000001064b552);
INSERT INTO alinkedlist VALUES (
7,549,'549                             ','CLASE CLK',6,51,1,0x000000001064b553);
INSERT INTO alinkedlist VALUES (
7,550,'550                             ','CLASE A',6,51,1,0x000000001064b554);
INSERT INTO alinkedlist VALUES (
7,551,'551                             ','CLASE M',6,51,1,0x000000001064b555);
INSERT INTO alinkedlist VALUES (
7,552,'552                             ','VANEO',6,51,1,0x000000001064b556);
INSERT INTO alinkedlist VALUES (
7,553,'553                             ','SLKLASSE',6,51,1,0x000000001064b557);
INSERT INTO alinkedlist VALUES (
7,554,'554                             ','SLR MCLAREN',6,51,1,0x000000001064b558);
INSERT INTO alinkedlist VALUES (
7,555,'555                             ','CLASE CLS',6,51,1,0x000000001064b559);
INSERT INTO alinkedlist VALUES (
7,556,'556                             ','CLASE R',6,51,1,0x000000001064b55a);
INSERT INTO alinkedlist VALUES (
7,557,'557                             ','CLASE GL',6,51,1,0x000000001064b55b);
INSERT INTO alinkedlist VALUES (
7,558,'558                             ','CLASE B',6,51,1,0x000000001064b55c);
INSERT INTO alinkedlist VALUES (
7,559,'559                             ','100D',6,51,1,0x000000001064b55d);
INSERT INTO alinkedlist VALUES (
7,560,'560                             ','140D',6,51,1,0x000000001064b55e);
INSERT INTO alinkedlist VALUES (
7,561,'561                             ','180D',6,51,1,0x000000001064b55f);
INSERT INTO alinkedlist VALUES (
7,562,'562                             ','SPRINTER',6,51,1,0x000000001064b560);
INSERT INTO alinkedlist VALUES (
7,563,'563                             ','VITO',6,51,1,0x000000001064b561);
INSERT INTO alinkedlist VALUES (
7,564,'564                             ','TRANSPORTER',6,51,1,0x000000001064b562);
INSERT INTO alinkedlist VALUES (
7,565,'565                             ','280',6,51,1,0x000000001064b563);
INSERT INTO alinkedlist VALUES (
7,566,'566                             ','220',6,51,1,0x000000001064b564);
INSERT INTO alinkedlist VALUES (
7,567,'567                             ','200',6,51,1,0x000000001064b565);
INSERT INTO alinkedlist VALUES (
7,568,'568                             ','190',6,51,1,0x000000001064b566);
INSERT INTO alinkedlist VALUES (
7,569,'569                             ','600',6,51,1,0x000000001064b567);
INSERT INTO alinkedlist VALUES (
7,570,'570                             ','400',6,51,1,0x000000001064b568);
INSERT INTO alinkedlist VALUES (
7,571,'571                             ','CLASE SL R129',6,51,1,0x000000001064b569);
INSERT INTO alinkedlist VALUES (
7,572,'572                             ','300',6,51,1,0x000000001064b56a);
INSERT INTO alinkedlist VALUES (
7,573,'573                             ','500',6,51,1,0x000000001064b56b);
INSERT INTO alinkedlist VALUES (
7,574,'574                             ','420',6,51,1,0x000000001064b56c);
INSERT INTO alinkedlist VALUES (
7,575,'575                             ','260',6,51,1,0x000000001064b56d);
INSERT INTO alinkedlist VALUES (
7,576,'576                             ','230',6,51,1,0x000000001064b56e);
INSERT INTO alinkedlist VALUES (
7,577,'577                             ','CLASE CLC',6,51,1,0x000000001064b56f);
INSERT INTO alinkedlist VALUES (
7,578,'578                             ','CLASE GLK',6,51,1,0x000000001064b570);
INSERT INTO alinkedlist VALUES (
7,579,'579                             ','SLS AMG',6,51,1,0x000000001064b571);
INSERT INTO alinkedlist VALUES (
7,580,'580                             ','MGF',6,52,1,0x000000001064b572);
INSERT INTO alinkedlist VALUES (
7,581,'581                             ','TF',6,52,1,0x000000001064b573);
INSERT INTO alinkedlist VALUES (
7,582,'582                             ','ZR',6,52,1,0x000000001064b574);
INSERT INTO alinkedlist VALUES (
7,583,'583                             ','ZS',6,52,1,0x000000001064b575);
INSERT INTO alinkedlist VALUES (
7,584,'584                             ','ZT',6,52,1,0x000000001064b576);
INSERT INTO alinkedlist VALUES (
7,585,'585                             ','ZTT',6,52,1,0x000000001064b577);
INSERT INTO alinkedlist VALUES (
7,586,'586                             ','MINI',6,52,1,0x000000001064b578);
INSERT INTO alinkedlist VALUES (
7,587,'587                             ','COUNTRYMAN',6,52,1,0x000000001064b579);
INSERT INTO alinkedlist VALUES (
7,588,'588                             ','PACEMAN',6,52,1,0x000000001064b57a);
INSERT INTO alinkedlist VALUES (
7,589,'589                             ','MONTERO',6,54,1,0x000000001064b57b);
INSERT INTO alinkedlist VALUES (
7,590,'590                             ','GALANT',6,54,1,0x000000001064b57c);
INSERT INTO alinkedlist VALUES (
7,591,'591                             ','COLT',6,54,1,0x000000001064b57d);
INSERT INTO alinkedlist VALUES (
7,592,'592                             ','SPACE WAGON',6,54,1,0x000000001064b57e);
INSERT INTO alinkedlist VALUES (
7,593,'593                             ','SPACE RUNNER',6,54,1,0x000000001064b57f);
INSERT INTO alinkedlist VALUES (
7,594,'594                             ','SPACE GEAR',6,54,1,0x000000001064b580);
INSERT INTO alinkedlist VALUES (
7,595,'595                             ','3000 GT',6,54,1,0x000000001064b581);
INSERT INTO alinkedlist VALUES (
7,596,'596                             ','CARISMA',6,54,1,0x000000001064b582);
INSERT INTO alinkedlist VALUES (
7,597,'597                             ','ECLIPSE',6,54,1,0x000000001064b583);
INSERT INTO alinkedlist VALUES (
7,598,'598                             ','SPACE STAR',6,54,1,0x000000001064b584);
INSERT INTO alinkedlist VALUES (
7,599,'599                             ','MONTERO SPORT',6,54,1,0x000000001064b585);
INSERT INTO alinkedlist VALUES (
7,600,'600                             ','MONTERO IO',6,54,1,0x000000001064b586);
INSERT INTO alinkedlist VALUES (
7,601,'601                             ','OUTLANDER',6,54,1,0x000000001064b587);
INSERT INTO alinkedlist VALUES (
7,602,'602                             ','LANCER',6,54,1,0x000000001064b588);
INSERT INTO alinkedlist VALUES (
7,603,'603                             ','GRANDIS',6,54,1,0x000000001064b589);
INSERT INTO alinkedlist VALUES (
7,604,'604                             ','L200',6,54,1,0x000000001064b58a);
INSERT INTO alinkedlist VALUES (
7,605,'605                             ','CANTER',6,54,1,0x000000001064b58b);
INSERT INTO alinkedlist VALUES (
7,606,'606                             ','300 GT',6,54,1,0x000000001064b58c);
INSERT INTO alinkedlist VALUES (
7,607,'607                             ','ASX',6,54,1,0x000000001064b58d);
INSERT INTO alinkedlist VALUES (
7,608,'608                             ','IMIEV',6,54,1,0x000000001064b58e);
INSERT INTO alinkedlist VALUES (
7,609,'609                             ','44',6,55,1,0x000000001064b58f);
INSERT INTO alinkedlist VALUES (
7,610,'610                             ','PLUS 8',6,55,1,0x000000001064b590);
INSERT INTO alinkedlist VALUES (
7,611,'611                             ','AERO 8',6,55,1,0x000000001064b591);
INSERT INTO alinkedlist VALUES (
7,612,'612                             ','V6',6,55,1,0x000000001064b592);
INSERT INTO alinkedlist VALUES (
7,613,'613                             ','ROADSTER',6,55,1,0x000000001064b593);
INSERT INTO alinkedlist VALUES (
7,614,'614                             ','4',6,55,1,0x000000001064b594);
INSERT INTO alinkedlist VALUES (
7,615,'615                             ','PLUS 4',6,55,1,0x000000001064b595);
INSERT INTO alinkedlist VALUES (
7,616,'616                             ','TERRANO II',6,56,1,0x000000001064b596);
INSERT INTO alinkedlist VALUES (
7,617,'617                             ','TERRANO',6,56,1,0x000000001064b597);
INSERT INTO alinkedlist VALUES (
7,618,'618                             ','MICRA',6,56,1,0x000000001064b598);
INSERT INTO alinkedlist VALUES (
7,619,'619                             ','SUNNY',6,56,1,0x000000001064b599);
INSERT INTO alinkedlist VALUES (
7,620,'620                             ','PRIMERA',6,56,1,0x000000001064b59a);
INSERT INTO alinkedlist VALUES (
7,621,'621                             ','SERENA',6,56,1,0x000000001064b59b);
INSERT INTO alinkedlist VALUES (
7,622,'622                             ','PATROL',6,56,1,0x000000001064b59c);
INSERT INTO alinkedlist VALUES (
7,623,'623                             ','MAXIMA QX',6,56,1,0x000000001064b59d);
INSERT INTO alinkedlist VALUES (
7,624,'624                             ','200 SX',6,56,1,0x000000001064b59e);
INSERT INTO alinkedlist VALUES (
7,625,'625                             ','300 ZX',6,56,1,0x000000001064b59f);
INSERT INTO alinkedlist VALUES (
7,626,'626                             ','PATROL GR',6,56,1,0x000000001064b5a0);
INSERT INTO alinkedlist VALUES (
7,627,'627                             ','100 NX',6,56,1,0x000000001064b5a1);
INSERT INTO alinkedlist VALUES (
7,628,'628                             ','ALMERA',6,56,1,0x000000001064b5a2);
INSERT INTO alinkedlist VALUES (
7,629,'629                             ','PATHFINDER',6,56,1,0x000000001064b5a3);
INSERT INTO alinkedlist VALUES (
7,630,'630                             ','ALMERA TINO',6,56,1,0x000000001064b5a4);
INSERT INTO alinkedlist VALUES (
7,631,'631                             ','XTRAIL',6,56,1,0x000000001064b5a5);
INSERT INTO alinkedlist VALUES (
7,632,'632                             ','350Z',6,56,1,0x000000001064b5a6);
INSERT INTO alinkedlist VALUES (
7,633,'633                             ','MURANO',6,56,1,0x000000001064b5a7);
INSERT INTO alinkedlist VALUES (
7,634,'634                             ','NOTE',6,56,1,0x000000001064b5a8);
INSERT INTO alinkedlist VALUES (
7,635,'635                             ','QASHQAI',6,56,1,0x000000001064b5a9);
INSERT INTO alinkedlist VALUES (
7,636,'636                             ','TIIDA',6,56,1,0x000000001064b5aa);
INSERT INTO alinkedlist VALUES (
7,637,'637                             ','VANETTE',6,56,1,0x000000001064b5ab);
INSERT INTO alinkedlist VALUES (
7,638,'638                             ','TRADE',6,56,1,0x000000001064b5ac);
INSERT INTO alinkedlist VALUES (
7,639,'639                             ','VANETTE CARGO',6,56,1,0x000000001064b5ad);
INSERT INTO alinkedlist VALUES (
7,640,'640                             ','PICKUP',6,56,1,0x000000001064b5ae);
INSERT INTO alinkedlist VALUES (
7,641,'641                             ','NAVARA',6,56,1,0x000000001064b5af);
INSERT INTO alinkedlist VALUES (
7,642,'642                             ','CABSTAR E',6,56,1,0x000000001064b5b0);
INSERT INTO alinkedlist VALUES (
7,643,'643                             ','CABSTAR',6,56,1,0x000000001064b5b1);
INSERT INTO alinkedlist VALUES (
7,644,'644                             ','MAXIMA',6,56,1,0x000000001064b5b2);
INSERT INTO alinkedlist VALUES (
7,645,'645                             ','CAMION',6,56,1,0x000000001064b5b3);
INSERT INTO alinkedlist VALUES (
7,646,'646                             ','PRAIRIE',6,56,1,0x000000001064b5b4);
INSERT INTO alinkedlist VALUES (
7,647,'647                             ','BLUEBIRD',6,56,1,0x000000001064b5b5);
INSERT INTO alinkedlist VALUES (
7,648,'648                             ','NP300 PICK UP',6,56,1,0x000000001064b5b6);
INSERT INTO alinkedlist VALUES (
7,649,'649                             ','QASHQAI2',6,56,1,0x000000001064b5b7);
INSERT INTO alinkedlist VALUES (
7,650,'650                             ','PIXO',6,56,1,0x000000001064b5b8);
INSERT INTO alinkedlist VALUES (
7,651,'651                             ','GTR',6,56,1,0x000000001064b5b9);
INSERT INTO alinkedlist VALUES (
7,652,'652                             ','370Z',6,56,1,0x000000001064b5ba);
INSERT INTO alinkedlist VALUES (
7,653,'653                             ','CUBE',6,56,1,0x000000001064b5bb);
INSERT INTO alinkedlist VALUES (
7,654,'654                             ','JUKE',6,56,1,0x000000001064b5bc);
INSERT INTO alinkedlist VALUES (
7,655,'655                             ','LEAF',6,56,1,0x000000001064b5bd);
INSERT INTO alinkedlist VALUES (
7,656,'656                             ','EVALIA',6,56,1,0x000000001064b5be);
INSERT INTO alinkedlist VALUES (
7,657,'657                             ','ASTRA',6,57,1,0x000000001064b5bf);
INSERT INTO alinkedlist VALUES (
7,658,'658                             ','VECTRA',6,57,1,0x000000001064b5c0);
INSERT INTO alinkedlist VALUES (
7,659,'659                             ','CALIBRA',6,57,1,0x000000001064b5c1);
INSERT INTO alinkedlist VALUES (
7,660,'660                             ','CORSA',6,57,1,0x000000001064b5c2);
INSERT INTO alinkedlist VALUES (
7,661,'661                             ','OMEGA',6,57,1,0x000000001064b5c3);
INSERT INTO alinkedlist VALUES (
7,662,'662                             ','FRONTERA',6,57,1,0x000000001064b5c4);
INSERT INTO alinkedlist VALUES (
7,663,'663                             ','TIGRA',6,57,1,0x000000001064b5c5);
INSERT INTO alinkedlist VALUES (
7,664,'664                             ','MONTEREY',6,57,1,0x000000001064b5c6);
INSERT INTO alinkedlist VALUES (
7,665,'665                             ','SINTRA',6,57,1,0x000000001064b5c7);
INSERT INTO alinkedlist VALUES (
7,666,'666                             ','ZAFIRA',6,57,1,0x000000001064b5c8);
INSERT INTO alinkedlist VALUES (
7,667,'667                             ','AGILA',6,57,1,0x000000001064b5c9);
INSERT INTO alinkedlist VALUES (
7,668,'668                             ','SPEEDSTER',6,57,1,0x000000001064b5ca);
INSERT INTO alinkedlist VALUES (
7,669,'669                             ','SIGNUM',6,57,1,0x000000001064b5cb);
INSERT INTO alinkedlist VALUES (
7,670,'670                             ','MERIVA',6,57,1,0x000000001064b5cc);
INSERT INTO alinkedlist VALUES (
7,671,'671                             ','ANTARA',6,57,1,0x000000001064b5cd);
INSERT INTO alinkedlist VALUES (
7,672,'672                             ','GT',6,57,1,0x000000001064b5ce);
INSERT INTO alinkedlist VALUES (
7,673,'673                             ','COMBO',6,57,1,0x000000001064b5cf);
INSERT INTO alinkedlist VALUES (
7,674,'674                             ','MOVANO',6,57,1,0x000000001064b5d0);
INSERT INTO alinkedlist VALUES (
7,675,'675                             ','VIVARO',6,57,1,0x000000001064b5d1);
INSERT INTO alinkedlist VALUES (
7,676,'676                             ','KADETT',6,57,1,0x000000001064b5d2);
INSERT INTO alinkedlist VALUES (
7,677,'677                             ','MONZA',6,57,1,0x000000001064b5d3);
INSERT INTO alinkedlist VALUES (
7,678,'678                             ','SENATOR',6,57,1,0x000000001064b5d4);
INSERT INTO alinkedlist VALUES (
7,679,'679                             ','REKORD',6,57,1,0x000000001064b5d5);
INSERT INTO alinkedlist VALUES (
7,680,'680                             ','MANTA',6,57,1,0x000000001064b5d6);
INSERT INTO alinkedlist VALUES (
7,681,'681                             ','ASCONA',6,57,1,0x000000001064b5d7);
INSERT INTO alinkedlist VALUES (
7,682,'682                             ','INSIGNIA',6,57,1,0x000000001064b5d8);
INSERT INTO alinkedlist VALUES (
7,683,'683                             ','ZAFIRA TOURER',6,57,1,0x000000001064b5d9);
INSERT INTO alinkedlist VALUES (
7,684,'684                             ','AMPERA',6,57,1,0x000000001064b5da);
INSERT INTO alinkedlist VALUES (
7,685,'685                             ','MOKKA',6,57,1,0x000000001064b5db);
INSERT INTO alinkedlist VALUES (
7,686,'686                             ','ADAM',6,57,1,0x000000001064b5dc);
INSERT INTO alinkedlist VALUES (
7,687,'687                             ','306',6,58,1,0x000000001064b5dd);
INSERT INTO alinkedlist VALUES (
7,688,'688                             ','605',6,58,1,0x000000001064b5de);
INSERT INTO alinkedlist VALUES (
7,689,'689                             ','106',6,58,1,0x000000001064b5df);
INSERT INTO alinkedlist VALUES (
7,690,'690                             ','205',6,58,1,0x000000001064b5e0);
INSERT INTO alinkedlist VALUES (
7,691,'691                             ','405',6,58,1,0x000000001064b5e1);
INSERT INTO alinkedlist VALUES (
7,692,'692                             ','406',6,58,1,0x000000001064b5e2);
INSERT INTO alinkedlist VALUES (
7,693,'693                             ','806',6,58,1,0x000000001064b5e3);
INSERT INTO alinkedlist VALUES (
7,694,'694                             ','807',6,58,1,0x000000001064b5e4);
INSERT INTO alinkedlist VALUES (
7,695,'695                             ','407',6,58,1,0x000000001064b5e5);
INSERT INTO alinkedlist VALUES (
7,696,'696                             ','307',6,58,1,0x000000001064b5e6);
INSERT INTO alinkedlist VALUES (
7,697,'697                             ','206',6,58,1,0x000000001064b5e7);
INSERT INTO alinkedlist VALUES (
7,698,'698                             ','607',6,58,1,0x000000001064b5e8);
INSERT INTO alinkedlist VALUES (
7,699,'699                             ','308',6,58,1,0x000000001064b5e9);
INSERT INTO alinkedlist VALUES (
7,700,'700                             ','307 SW',6,58,1,0x000000001064b5ea);
INSERT INTO alinkedlist VALUES (
7,701,'701                             ','206 SW',6,58,1,0x000000001064b5eb);
INSERT INTO alinkedlist VALUES (
7,702,'702                             ','407 SW',6,58,1,0x000000001064b5ec);
INSERT INTO alinkedlist VALUES (
7,703,'703                             ','1007',6,58,1,0x000000001064b5ed);
INSERT INTO alinkedlist VALUES (
7,704,'704                             ','107',6,58,1,0x000000001064b5ee);
INSERT INTO alinkedlist VALUES (
7,705,'705                             ','207',6,58,1,0x000000001064b5ef);
INSERT INTO alinkedlist VALUES (
7,706,'706                             ','4007',6,58,1,0x000000001064b5f0);
INSERT INTO alinkedlist VALUES (
7,707,'707                             ','BOXER',6,58,1,0x000000001064b5f1);
INSERT INTO alinkedlist VALUES (
7,708,'708                             ','PARTNER',6,58,1,0x000000001064b5f2);
INSERT INTO alinkedlist VALUES (
7,709,'709                             ','J5',6,58,1,0x000000001064b5f3);
INSERT INTO alinkedlist VALUES (
7,710,'710                             ','604',6,58,1,0x000000001064b5f4);
INSERT INTO alinkedlist VALUES (
7,711,'711                             ','505',6,58,1,0x000000001064b5f5);
INSERT INTO alinkedlist VALUES (
7,712,'712                             ','309',6,58,1,0x000000001064b5f6);
INSERT INTO alinkedlist VALUES (
7,713,'713                             ','BIPPER',6,58,1,0x000000001064b5f7);
INSERT INTO alinkedlist VALUES (
7,714,'714                             ','PARTNER ORIGIN',6,58,1,0x000000001064b5f8);
INSERT INTO alinkedlist VALUES (
7,715,'715                             ','3008',6,58,1,0x000000001064b5f9);
INSERT INTO alinkedlist VALUES (
7,716,'716                             ','5008',6,58,1,0x000000001064b5fa);
INSERT INTO alinkedlist VALUES (
7,717,'717                             ','RCZ',6,58,1,0x000000001064b5fb);
INSERT INTO alinkedlist VALUES (
7,718,'718                             ','508',6,58,1,0x000000001064b5fc);
INSERT INTO alinkedlist VALUES (
7,719,'719                             ','ION',6,58,1,0x000000001064b5fd);
INSERT INTO alinkedlist VALUES (
7,720,'720                             ','208',6,58,1,0x000000001064b5fe);
INSERT INTO alinkedlist VALUES (
7,721,'721                             ','4008',6,58,1,0x000000001064b5ff);
INSERT INTO alinkedlist VALUES (
7,722,'722                             ','TRANS SPORT',6,59,1,0x000000001064b601);
INSERT INTO alinkedlist VALUES (
7,723,'723                             ','FIREBIRD',6,59,1,0x000000001064b602);
INSERT INTO alinkedlist VALUES (
7,724,'724                             ','TRANS AM',6,59,1,0x000000001064b603);
INSERT INTO alinkedlist VALUES (
7,725,'725                             ','911',6,60,1,0x000000001064b604);
INSERT INTO alinkedlist VALUES (
7,726,'726                             ','BOXSTER',6,60,1,0x000000001064b605);
INSERT INTO alinkedlist VALUES (
7,727,'727                             ','CAYENNE',6,60,1,0x000000001064b606);
INSERT INTO alinkedlist VALUES (
7,728,'728                             ','CARRERA GT',6,60,1,0x000000001064b607);
INSERT INTO alinkedlist VALUES (
7,729,'729                             ','CAYMAN',6,60,1,0x000000001064b608);
INSERT INTO alinkedlist VALUES (
7,730,'730                             ','928',6,60,1,0x000000001064b609);
INSERT INTO alinkedlist VALUES (
7,731,'731                             ','968',6,60,1,0x000000001064b60a);
INSERT INTO alinkedlist VALUES (
7,732,'732                             ','944',6,60,1,0x000000001064b60b);
INSERT INTO alinkedlist VALUES (
7,733,'733                             ','924',6,60,1,0x000000001064b60c);
INSERT INTO alinkedlist VALUES (
7,734,'734                             ','PANAMERA',6,60,1,0x000000001064b60d);
INSERT INTO alinkedlist VALUES (
7,735,'735                             ','918',6,60,1,0x000000001064b60e);
INSERT INTO alinkedlist VALUES (
7,736,'736                             ','MEGANE',6,61,1,0x000000001064b60f);
INSERT INTO alinkedlist VALUES (
7,737,'737                             ','SAFRANE',6,61,1,0x000000001064b610);
INSERT INTO alinkedlist VALUES (
7,738,'738                             ','LAGUNA',6,61,1,0x000000001064b611);
INSERT INTO alinkedlist VALUES (
7,739,'739                             ','CLIO',6,61,1,0x000000001064b612);
INSERT INTO alinkedlist VALUES (
7,740,'740                             ','TWINGO',6,61,1,0x000000001064b613);
INSERT INTO alinkedlist VALUES (
7,741,'741                             ','NEVADA',6,61,1,0x000000001064b614);
INSERT INTO alinkedlist VALUES (
7,742,'742                             ','ESPACE',6,61,1,0x000000001064b615);
INSERT INTO alinkedlist VALUES (
7,743,'743                             ','SPIDER',6,61,1,0x000000001064b616);
INSERT INTO alinkedlist VALUES (
7,744,'744                             ','SCENIC',6,61,1,0x000000001064b617);
INSERT INTO alinkedlist VALUES (
7,745,'745                             ','GRAND ESPACE',6,61,1,0x000000001064b618);
INSERT INTO alinkedlist VALUES (
7,746,'746                             ','AVANTIME',6,61,1,0x000000001064b619);
INSERT INTO alinkedlist VALUES (
7,747,'747                             ','VEL SATIS',6,61,1,0x000000001064b61a);
INSERT INTO alinkedlist VALUES (
7,748,'748                             ','GRAND SCENIC',6,61,1,0x000000001064b61b);
INSERT INTO alinkedlist VALUES (
7,749,'749                             ','CLIO CAMPUS',6,61,1,0x000000001064b61c);
INSERT INTO alinkedlist VALUES (
7,750,'750                             ','MODUS',6,61,1,0x000000001064b61d);
INSERT INTO alinkedlist VALUES (
7,751,'751                             ','EXPRESS',6,61,1,0x000000001064b61e);
INSERT INTO alinkedlist VALUES (
7,752,'752                             ','TRAFIC',6,61,1,0x000000001064b61f);
INSERT INTO alinkedlist VALUES (
7,753,'753                             ','MASTER',6,61,1,0x000000001064b620);
INSERT INTO alinkedlist VALUES (
7,754,'754                             ','KANGOO',6,61,1,0x000000001064b621);
INSERT INTO alinkedlist VALUES (
7,755,'755                             ','MASCOTT',6,61,1,0x000000001064b622);
INSERT INTO alinkedlist VALUES (
7,756,'756                             ','MASTER PROPULSION',6,61,1,0x000000001064b623);
INSERT INTO alinkedlist VALUES (
7,757,'757                             ','MAXITY',6,61,1,0x000000001064b624);
INSERT INTO alinkedlist VALUES (
7,758,'758                             ','R19',6,61,1,0x000000001064b625);
INSERT INTO alinkedlist VALUES (
7,759,'759                             ','R25',6,61,1,0x000000001064b626);
INSERT INTO alinkedlist VALUES (
7,760,'760                             ','R5',6,61,1,0x000000001064b627);
INSERT INTO alinkedlist VALUES (
7,761,'761                             ','R21',6,61,1,0x000000001064b628);
INSERT INTO alinkedlist VALUES (
7,762,'762                             ','R4',6,61,1,0x000000001064b629);
INSERT INTO alinkedlist VALUES (
7,763,'763                             ','ALPINE',6,61,1,0x000000001064b62a);
INSERT INTO alinkedlist VALUES (
7,764,'764                             ','FUEGO',6,61,1,0x000000001064b62b);
INSERT INTO alinkedlist VALUES (
7,765,'765                             ','R18',6,61,1,0x000000001064b62c);
INSERT INTO alinkedlist VALUES (
7,766,'766                             ','R11',6,61,1,0x000000001064b62d);
INSERT INTO alinkedlist VALUES (
7,767,'767                             ','R9',6,61,1,0x000000001064b62e);
INSERT INTO alinkedlist VALUES (
7,768,'768                             ','R6',6,61,1,0x000000001064b62f);
INSERT INTO alinkedlist VALUES (
7,769,'769                             ','GRAND MODUS',6,61,1,0x000000001064b630);
INSERT INTO alinkedlist VALUES (
7,770,'770                             ','KANGOO COMBI',6,61,1,0x000000001064b631);
INSERT INTO alinkedlist VALUES (
7,771,'771                             ','KOLEOS',6,61,1,0x000000001064b632);
INSERT INTO alinkedlist VALUES (
7,772,'772                             ','FLUENCE',6,61,1,0x000000001064b633);
INSERT INTO alinkedlist VALUES (
7,773,'773                             ','WIND',6,61,1,0x000000001064b634);
INSERT INTO alinkedlist VALUES (
7,774,'774                             ','LATITUDE',6,61,1,0x000000001064b635);
INSERT INTO alinkedlist VALUES (
7,775,'775                             ','GRAND KANGOO COMBI',6,61,1,0x000000001064b636);
INSERT INTO alinkedlist VALUES (
7,776,'776                             ','SIVER DAWN',6,62,1,0x000000001064b637);
INSERT INTO alinkedlist VALUES (
7,777,'777                             ','SILVER SPUR',6,62,1,0x000000001064b638);
INSERT INTO alinkedlist VALUES (
7,778,'778                             ','PARK WARD',6,62,1,0x000000001064b639);
INSERT INTO alinkedlist VALUES (
7,779,'779                             ','SILVER SERAPH',6,62,1,0x000000001064b63a);
INSERT INTO alinkedlist VALUES (
7,780,'780                             ','CORNICHE',6,62,1,0x000000001064b63b);
INSERT INTO alinkedlist VALUES (
7,781,'781                             ','PHANTOM',6,62,1,0x000000001064b63c);
INSERT INTO alinkedlist VALUES (
7,782,'782                             ','TOURING',6,62,1,0x000000001064b63d);
INSERT INTO alinkedlist VALUES (
7,783,'783                             ','SILVIER',6,62,1,0x000000001064b63e);
INSERT INTO alinkedlist VALUES (
7,784,'784                             ','800',6,63,1,0x000000001064b63f);
INSERT INTO alinkedlist VALUES (
7,785,'785                             ','600',6,63,1,0x000000001064b640);
INSERT INTO alinkedlist VALUES (
7,786,'786                             ','100',6,63,1,0x000000001064b641);
INSERT INTO alinkedlist VALUES (
7,787,'787                             ','200',6,63,1,0x000000001064b642);
INSERT INTO alinkedlist VALUES (
7,788,'788                             ','COUPE',6,63,1,0x000000001064b643);
INSERT INTO alinkedlist VALUES (
7,789,'789                             ','400',6,63,1,0x000000001064b644);
INSERT INTO alinkedlist VALUES (
7,790,'790                             ','45',6,63,1,0x000000001064b645);
INSERT INTO alinkedlist VALUES (
7,791,'791                             ','CABRIOLET',6,63,1,0x000000001064b646);
INSERT INTO alinkedlist VALUES (
7,792,'792                             ','25',6,63,1,0x000000001064b647);
INSERT INTO alinkedlist VALUES (
7,793,'793                             ','MINI',6,63,1,0x000000001064b648);
INSERT INTO alinkedlist VALUES (
7,794,'794                             ','75',6,63,1,0x000000001064b649);
INSERT INTO alinkedlist VALUES (
7,795,'795                             ','STREETWISE',6,63,1,0x000000001064b64a);
INSERT INTO alinkedlist VALUES (
7,796,'796                             ','SD',6,63,1,0x000000001064b64b);
INSERT INTO alinkedlist VALUES (
7,797,'797                             ','900',6,64,1,0x000000001064b64c);
INSERT INTO alinkedlist VALUES (
7,798,'798                             ','93',6,64,1,0x000000001064b64d);
INSERT INTO alinkedlist VALUES (
7,799,'799                             ','9000',6,64,1,0x000000001064b64e);
INSERT INTO alinkedlist VALUES (
7,800,'800                             ','95',6,64,1,0x000000001064b64f);
INSERT INTO alinkedlist VALUES (
7,801,'801                             ','93X',6,64,1,0x000000001064b650);
INSERT INTO alinkedlist VALUES (
7,802,'802                             ','94X',6,64,1,0x000000001064b651);
INSERT INTO alinkedlist VALUES (
7,803,'803                             ','300',6,65,1,0x000000001064b652);
INSERT INTO alinkedlist VALUES (
7,804,'804                             ','350',6,65,1,0x000000001064b653);
INSERT INTO alinkedlist VALUES (
7,805,'805                             ','ANIBAL',6,65,1,0x000000001064b654);
INSERT INTO alinkedlist VALUES (
7,806,'806                             ','ANIBAL PICK UP',6,65,1,0x000000001064b655);
INSERT INTO alinkedlist VALUES (
7,807,'807                             ','IBIZA',6,66,1,0x000000001064b656);
INSERT INTO alinkedlist VALUES (
7,808,'808                             ','CORDOBA',6,66,1,0x000000001064b657);
INSERT INTO alinkedlist VALUES (
7,809,'809                             ','TOLEDO',6,66,1,0x000000001064b658);
INSERT INTO alinkedlist VALUES (
7,810,'810                             ','MARBELLA',6,66,1,0x000000001064b659);
INSERT INTO alinkedlist VALUES (
7,811,'811                             ','ALHAMBRA',6,66,1,0x000000001064b65a);
INSERT INTO alinkedlist VALUES (
7,812,'812                             ','AROSA',6,66,1,0x000000001064b65b);
INSERT INTO alinkedlist VALUES (
7,813,'813                             ','LEON',6,66,1,0x000000001064b65c);
INSERT INTO alinkedlist VALUES (
7,814,'814                             ','ALTEA',6,66,1,0x000000001064b65d);
INSERT INTO alinkedlist VALUES (
7,815,'815                             ','ALTEA XL',6,66,1,0x000000001064b65e);
INSERT INTO alinkedlist VALUES (
7,816,'816                             ','ALTEA FREETRACK',6,66,1,0x000000001064b65f);
INSERT INTO alinkedlist VALUES (
7,817,'817                             ','TERRA',6,66,1,0x000000001064b660);
INSERT INTO alinkedlist VALUES (
7,818,'818                             ','INCA',6,66,1,0x000000001064b661);
INSERT INTO alinkedlist VALUES (
7,819,'819                             ','MALAGA',6,66,1,0x000000001064b662);
INSERT INTO alinkedlist VALUES (
7,820,'820                             ','RONDA',6,66,1,0x000000001064b663);
INSERT INTO alinkedlist VALUES (
7,821,'821                             ','EXEO',6,66,1,0x000000001064b664);
INSERT INTO alinkedlist VALUES (
7,822,'822                             ','MII',6,66,1,0x000000001064b665);
INSERT INTO alinkedlist VALUES (
7,823,'823                             ','FELICIA',6,67,1,0x000000001064b666);
INSERT INTO alinkedlist VALUES (
7,824,'824                             ','FORMAN',6,67,1,0x000000001064b667);
INSERT INTO alinkedlist VALUES (
7,825,'825                             ','OCTAVIA',6,67,1,0x000000001064b668);
INSERT INTO alinkedlist VALUES (
7,826,'826                             ','OCTAVIA TOUR',6,67,1,0x000000001064b669);
INSERT INTO alinkedlist VALUES (
7,827,'827                             ','FABIA',6,67,1,0x000000001064b66a);
INSERT INTO alinkedlist VALUES (
7,828,'828                             ','SUPERB',6,67,1,0x000000001064b66b);
INSERT INTO alinkedlist VALUES (
7,829,'829                             ','ROOMSTER',6,67,1,0x000000001064b66c);
INSERT INTO alinkedlist VALUES (
7,830,'830                             ','SCOUT',6,67,1,0x000000001064b66d);
INSERT INTO alinkedlist VALUES (
7,831,'831                             ','PICKUP',6,67,1,0x000000001064b66e);
INSERT INTO alinkedlist VALUES (
7,832,'832                             ','FAVORIT',6,67,1,0x000000001064b66f);
INSERT INTO alinkedlist VALUES (
7,833,'833                             ','130',6,67,1,0x000000001064b670);
INSERT INTO alinkedlist VALUES (
7,834,'834                             ','S',6,67,1,0x000000001064b671);
INSERT INTO alinkedlist VALUES (
7,835,'835                             ','YETI',6,67,1,0x000000001064b672);
INSERT INTO alinkedlist VALUES (
7,836,'836                             ','CITIGO',6,67,1,0x000000001064b673);
INSERT INTO alinkedlist VALUES (
7,837,'837                             ','RAPID',6,67,1,0x000000001064b674);
INSERT INTO alinkedlist VALUES (
7,838,'838                             ','SMART',6,68,1,0x000000001064b675);
INSERT INTO alinkedlist VALUES (
7,839,'839                             ','CITYCOUPE',6,68,1,0x000000001064b676);
INSERT INTO alinkedlist VALUES (
7,840,'840                             ','FORTWO',6,68,1,0x000000001064b677);
INSERT INTO alinkedlist VALUES (
7,841,'841                             ','CABRIO',6,68,1,0x000000001064b678);
INSERT INTO alinkedlist VALUES (
7,842,'842                             ','CROSSBLADE',6,68,1,0x000000001064b679);
INSERT INTO alinkedlist VALUES (
7,843,'843                             ','ROADSTER',6,68,1,0x000000001064b67a);
INSERT INTO alinkedlist VALUES (
7,844,'844                             ','FORFOUR',6,68,1,0x000000001064b67b);
INSERT INTO alinkedlist VALUES (
7,845,'845                             ','KORANDO',6,69,1,0x000000001064b67c);
INSERT INTO alinkedlist VALUES (
7,846,'846                             ','FAMILY',6,69,1,0x000000001064b67d);
INSERT INTO alinkedlist VALUES (
7,847,'847                             ','K4D',6,69,1,0x000000001064b67e);
INSERT INTO alinkedlist VALUES (
7,848,'848                             ','MUSSO',6,69,1,0x000000001064b67f);
INSERT INTO alinkedlist VALUES (
7,849,'849                             ','KORANDO KJ',6,69,1,0x000000001064b680);
INSERT INTO alinkedlist VALUES (
7,850,'850                             ','REXTON',6,69,1,0x000000001064b681);
INSERT INTO alinkedlist VALUES (
7,851,'851                             ','REXTON II',6,69,1,0x000000001064b682);
INSERT INTO alinkedlist VALUES (
7,852,'852                             ','RODIUS',6,69,1,0x000000001064b683);
INSERT INTO alinkedlist VALUES (
7,853,'853                             ','KYRON',6,69,1,0x000000001064b684);
INSERT INTO alinkedlist VALUES (
7,854,'854                             ','ACTYON',6,69,1,0x000000001064b685);
INSERT INTO alinkedlist VALUES (
7,855,'855                             ','SPORTS PICK UP',6,69,1,0x000000001064b686);
INSERT INTO alinkedlist VALUES (
7,856,'856                             ','ACTYON SPORTS PICK UP',6,69,1,0x000000001064b687);
INSERT INTO alinkedlist VALUES (
7,857,'857                             ','KODANDO',6,69,1,0x000000001064b688);
INSERT INTO alinkedlist VALUES (
7,858,'858                             ','LEGACY',6,70,1,0x000000001064b689);
INSERT INTO alinkedlist VALUES (
7,859,'859                             ','IMPREZA',6,70,1,0x000000001064b68a);
INSERT INTO alinkedlist VALUES (
7,860,'860                             ','SVX',6,70,1,0x000000001064b68b);
INSERT INTO alinkedlist VALUES (
7,861,'861                             ','JUSTY',6,70,1,0x000000001064b68c);
INSERT INTO alinkedlist VALUES (
7,862,'862                             ','OUTBACK',6,70,1,0x000000001064b68d);
INSERT INTO alinkedlist VALUES (
7,863,'863                             ','FORESTER',6,70,1,0x000000001064b68e);
INSERT INTO alinkedlist VALUES (
7,864,'864                             ','G3X JUSTY',6,70,1,0x000000001064b68f);
INSERT INTO alinkedlist VALUES (
7,865,'865                             ','B9 TRIBECA',6,70,1,0x000000001064b690);
INSERT INTO alinkedlist VALUES (
7,866,'866                             ','XT',6,70,1,0x000000001064b691);
INSERT INTO alinkedlist VALUES (
7,867,'867                             ','1800',6,70,1,0x000000001064b692);
INSERT INTO alinkedlist VALUES (
7,868,'868                             ','TRIBECA',6,70,1,0x000000001064b693);
INSERT INTO alinkedlist VALUES (
7,869,'869                             ','WRX STI',6,70,1,0x000000001064b694);
INSERT INTO alinkedlist VALUES (
7,870,'870                             ','TREZIA',6,70,1,0x000000001064b695);
INSERT INTO alinkedlist VALUES (
7,871,'871                             ','XV',6,70,1,0x000000001064b696);
INSERT INTO alinkedlist VALUES (
7,872,'872                             ','BRZ',6,70,1,0x000000001064b697);
INSERT INTO alinkedlist VALUES (
7,873,'873                             ','MARUTI',6,71,1,0x000000001064b698);
INSERT INTO alinkedlist VALUES (
7,874,'874                             ','SWIFT',6,71,1,0x000000001064b699);
INSERT INTO alinkedlist VALUES (
7,875,'875                             ','VITARA',6,71,1,0x000000001064b69a);
INSERT INTO alinkedlist VALUES (
7,876,'876                             ','BALENO',6,71,1,0x000000001064b69b);
INSERT INTO alinkedlist VALUES (
7,877,'877                             ','SAMURAI',6,71,1,0x000000001064b69c);
INSERT INTO alinkedlist VALUES (
7,878,'878                             ','ALTO',6,71,1,0x000000001064b69d);
INSERT INTO alinkedlist VALUES (
7,879,'879                             ','WAGON R',6,71,1,0x000000001064b69e);
INSERT INTO alinkedlist VALUES (
7,880,'880                             ','JIMNY',6,71,1,0x000000001064b69f);
INSERT INTO alinkedlist VALUES (
7,881,'881                             ','GRAND VITARA',6,71,1,0x000000001064b6a0);
INSERT INTO alinkedlist VALUES (
7,882,'882                             ','IGNIS',6,71,1,0x000000001064b6a1);
INSERT INTO alinkedlist VALUES (
7,883,'883                             ','LIANA',6,71,1,0x000000001064b6a2);
INSERT INTO alinkedlist VALUES (
7,884,'884                             ','GRAND VITARA XL7',6,71,1,0x000000001064b6a3);
INSERT INTO alinkedlist VALUES (
7,885,'885                             ','SX4',6,71,1,0x000000001064b6a4);
INSERT INTO alinkedlist VALUES (
7,886,'886                             ','SPLASH',6,71,1,0x000000001064b6a5);
INSERT INTO alinkedlist VALUES (
7,887,'887                             ','KIZASHI',6,71,1,0x000000001064b6a6);
INSERT INTO alinkedlist VALUES (
7,888,'888                             ','SAMBA',6,72,1,0x000000001064b6a7);
INSERT INTO alinkedlist VALUES (
7,889,'889                             ','TAGORA',6,72,1,0x000000001064b6a8);
INSERT INTO alinkedlist VALUES (
7,890,'890                             ','SOLARA',6,72,1,0x000000001064b6a9);
INSERT INTO alinkedlist VALUES (
7,891,'891                             ','HORIZON',6,72,1,0x000000001064b6aa);
INSERT INTO alinkedlist VALUES (
7,892,'892                             ','TELCOSPORT',6,73,1,0x000000001064b6ab);
INSERT INTO alinkedlist VALUES (
7,893,'893                             ','TELCO',6,73,1,0x000000001064b6ac);
INSERT INTO alinkedlist VALUES (
7,894,'894                             ','SUMO',6,73,1,0x000000001064b6ad);
INSERT INTO alinkedlist VALUES (
7,895,'895                             ','SAFARI',6,73,1,0x000000001064b6ae);
INSERT INTO alinkedlist VALUES (
7,896,'896                             ','INDICA',6,73,1,0x000000001064b6af);
INSERT INTO alinkedlist VALUES (
7,897,'897                             ','INDIGO',6,73,1,0x000000001064b6b0);
INSERT INTO alinkedlist VALUES (
7,898,'898                             ','GRAND SAFARI',6,73,1,0x000000001064b6b1);
INSERT INTO alinkedlist VALUES (
7,899,'899                             ','TL PICK UP',6,73,1,0x000000001064b6b2);
INSERT INTO alinkedlist VALUES (
7,900,'900                             ','XENON PICK UP',6,73,1,0x000000001064b6b3);
INSERT INTO alinkedlist VALUES (
7,901,'901                             ','VISTA',6,73,1,0x000000001064b6b4);
INSERT INTO alinkedlist VALUES (
7,902,'902                             ','XENON',6,73,1,0x000000001064b6b5);
INSERT INTO alinkedlist VALUES (
7,903,'903                             ','ARIA',6,73,1,0x000000001064b6b6);
INSERT INTO alinkedlist VALUES (
7,904,'904                             ','CARINA E',6,74,1,0x000000001064b6b7);
INSERT INTO alinkedlist VALUES (
7,905,'905                             ','4RUNNER',6,74,1,0x000000001064b6b8);
INSERT INTO alinkedlist VALUES (
7,906,'906                             ','CAMRY',6,74,1,0x000000001064b6b9);
INSERT INTO alinkedlist VALUES (
7,907,'907                             ','RAV4',6,74,1,0x000000001064b6ba);
INSERT INTO alinkedlist VALUES (
7,908,'908                             ','CELICA',6,74,1,0x000000001064b6bb);
INSERT INTO alinkedlist VALUES (
7,909,'909                             ','SUPRA',6,74,1,0x000000001064b6bc);
INSERT INTO alinkedlist VALUES (
7,910,'910                             ','PASEO',6,74,1,0x000000001064b6bd);
INSERT INTO alinkedlist VALUES (
7,911,'911                             ','LAND CRUISER 80',6,74,1,0x000000001064b6be);
INSERT INTO alinkedlist VALUES (
7,912,'912                             ','LAND CRUISER 100',6,74,1,0x000000001064b6bf);
INSERT INTO alinkedlist VALUES (
7,913,'913                             ','LAND CRUISER',6,74,1,0x000000001064b6c0);
INSERT INTO alinkedlist VALUES (
7,914,'914                             ','LAND CRUISER 90',6,74,1,0x000000001064b6c1);
INSERT INTO alinkedlist VALUES (
7,915,'915                             ','COROLLA',6,74,1,0x000000001064b6c2);
INSERT INTO alinkedlist VALUES (
7,916,'916                             ','AURIS',6,74,1,0x000000001064b6c3);
INSERT INTO alinkedlist VALUES (
7,917,'917                             ','AVENSIS',6,74,1,0x000000001064b6c4);
INSERT INTO alinkedlist VALUES (
7,918,'918                             ','PICNIC',6,74,1,0x000000001064b6c5);
INSERT INTO alinkedlist VALUES (
7,919,'919                             ','YARIS',6,74,1,0x000000001064b6c6);
INSERT INTO alinkedlist VALUES (
7,920,'920                             ','YARIS VERSO',6,74,1,0x000000001064b6c7);
INSERT INTO alinkedlist VALUES (
7,921,'921                             ','MR2',6,74,1,0x000000001064b6c8);
INSERT INTO alinkedlist VALUES (
7,922,'922                             ','PREVIA',6,74,1,0x000000001064b6c9);
INSERT INTO alinkedlist VALUES (
7,923,'923                             ','PRIUS',6,74,1,0x000000001064b6ca);
INSERT INTO alinkedlist VALUES (
7,924,'924                             ','AVENSIS VERSO',6,74,1,0x000000001064b6cb);
INSERT INTO alinkedlist VALUES (
7,925,'925                             ','COROLLA VERSO',6,74,1,0x000000001064b6cc);
INSERT INTO alinkedlist VALUES (
7,926,'926                             ','COROLLA SEDAN',6,74,1,0x000000001064b6cd);
INSERT INTO alinkedlist VALUES (
7,927,'927                             ','AYGO',6,74,1,0x000000001064b6ce);
INSERT INTO alinkedlist VALUES (
7,928,'928                             ','HILUX',6,74,1,0x000000001064b6cf);
INSERT INTO alinkedlist VALUES (
7,929,'929                             ','DYNA',6,74,1,0x000000001064b6d0);
INSERT INTO alinkedlist VALUES (
7,930,'930                             ','LAND CRUISER 200',6,74,1,0x000000001064b6d1);
INSERT INTO alinkedlist VALUES (
7,931,'931                             ','VERSO',6,74,1,0x000000001064b6d2);
INSERT INTO alinkedlist VALUES (
7,932,'932                             ','IQ',6,74,1,0x000000001064b6d3);
INSERT INTO alinkedlist VALUES (
7,933,'933                             ','URBAN CRUISER',6,74,1,0x000000001064b6d4);
INSERT INTO alinkedlist VALUES (
7,934,'934                             ','GT86',6,74,1,0x000000001064b6d5);
INSERT INTO alinkedlist VALUES (
7,935,'935                             ','100',6,75,1,0x000000001064b6d6);
INSERT INTO alinkedlist VALUES (
7,936,'936                             ','121',6,75,1,0x000000001064b6d7);
INSERT INTO alinkedlist VALUES (
7,937,'937                             ','214',6,76,1,0x000000001064b6d8);
INSERT INTO alinkedlist VALUES (
7,938,'938                             ','110 STAWRA',6,76,1,0x000000001064b6d9);
INSERT INTO alinkedlist VALUES (
7,939,'939                             ','111 STAWRA',6,76,1,0x000000001064b6da);
INSERT INTO alinkedlist VALUES (
7,940,'940                             ','215',6,76,1,0x000000001064b6db);
INSERT INTO alinkedlist VALUES (
7,941,'941                             ','112 STAWRA',6,76,1,0x000000001064b6dc);
INSERT INTO alinkedlist VALUES (
7,942,'942                             ','PASSAT',6,77,1,0x000000001064b6dd);
INSERT INTO alinkedlist VALUES (
7,943,'943                             ','GOLF',6,77,1,0x000000001064b6de);
INSERT INTO alinkedlist VALUES (
7,944,'944                             ','VENTO',6,77,1,0x000000001064b6df);
INSERT INTO alinkedlist VALUES (
7,945,'945                             ','POLO',6,77,1,0x000000001064b6e0);
INSERT INTO alinkedlist VALUES (
7,946,'946                             ','CORRADO',6,77,1,0x000000001064b6e1);
INSERT INTO alinkedlist VALUES (
7,947,'947                             ','SHARAN',6,77,1,0x000000001064b6e2);
INSERT INTO alinkedlist VALUES (
7,948,'948                             ','LUPO',6,77,1,0x000000001064b6e3);
INSERT INTO alinkedlist VALUES (
7,949,'949                             ','BORA',6,77,1,0x000000001064b6e4);
INSERT INTO alinkedlist VALUES (
7,950,'950                             ','JETTA',6,77,1,0x000000001064b6e5);
INSERT INTO alinkedlist VALUES (
7,951,'951                             ','NEW BEETLE',6,77,1,0x000000001064b6e6);
INSERT INTO alinkedlist VALUES (
7,952,'952                             ','PHAETON',6,77,1,0x000000001064b6e7);
INSERT INTO alinkedlist VALUES (
7,953,'953                             ','TOUAREG',6,77,1,0x000000001064b6e8);
INSERT INTO alinkedlist VALUES (
7,954,'954                             ','TOURAN',6,77,1,0x000000001064b6e9);
INSERT INTO alinkedlist VALUES (
7,955,'955                             ','MULTIVAN',6,77,1,0x000000001064b6ea);
INSERT INTO alinkedlist VALUES (
7,956,'956                             ','CADDY',6,77,1,0x000000001064b6eb);
INSERT INTO alinkedlist VALUES (
7,957,'957                             ','GOLF PLUS',6,77,1,0x000000001064b6ec);
INSERT INTO alinkedlist VALUES (
7,958,'958                             ','FOX',6,77,1,0x000000001064b6ed);
INSERT INTO alinkedlist VALUES (
7,959,'959                             ','EOS',6,77,1,0x000000001064b6ee);
INSERT INTO alinkedlist VALUES (
7,960,'960                             ','CARAVELLE',6,77,1,0x000000001064b6ef);
INSERT INTO alinkedlist VALUES (
7,961,'961                             ','TIGUAN',6,77,1,0x000000001064b6f0);
INSERT INTO alinkedlist VALUES (
7,962,'962                             ','TRANSPORTER',6,77,1,0x000000001064b6f1);
INSERT INTO alinkedlist VALUES (
7,963,'963                             ','LT',6,77,1,0x000000001064b6f2);
INSERT INTO alinkedlist VALUES (
7,964,'964                             ','TARO',6,77,1,0x000000001064b6f3);
INSERT INTO alinkedlist VALUES (
7,965,'965                             ','CRAFTER',6,77,1,0x000000001064b6f4);
INSERT INTO alinkedlist VALUES (
7,966,'966                             ','CALIFORNIA',6,77,1,0x000000001064b6f5);
INSERT INTO alinkedlist VALUES (
7,967,'967                             ','SANTANA',6,77,1,0x000000001064b6f6);
INSERT INTO alinkedlist VALUES (
7,968,'968                             ','SCIROCCO',6,77,1,0x000000001064b6f7);
INSERT INTO alinkedlist VALUES (
7,969,'969                             ','PASSAT CC',6,77,1,0x000000001064b6f8);
INSERT INTO alinkedlist VALUES (
7,970,'970                             ','AMAROK',6,77,1,0x000000001064b6f9);
INSERT INTO alinkedlist VALUES (
7,971,'971                             ','BEETLE',6,77,1,0x000000001064b6fa);
INSERT INTO alinkedlist VALUES (
7,972,'972                             ','UP',6,77,1,0x000000001064b6fb);
INSERT INTO alinkedlist VALUES (
7,973,'973                             ','CC',6,77,1,0x000000001064b6fc);
INSERT INTO alinkedlist VALUES (
7,974,'974                             ','440',6,78,1,0x000000001064b6fd);
INSERT INTO alinkedlist VALUES (
7,975,'975                             ','850',6,78,1,0x000000001064b6fe);
INSERT INTO alinkedlist VALUES (
7,976,'976                             ','S70',6,78,1,0x000000001064b6ff);
INSERT INTO alinkedlist VALUES (
7,977,'977                             ','V70',6,78,1,0x000000001064b701);
INSERT INTO alinkedlist VALUES (
7,978,'978                             ','V70 CLASSIC',6,78,1,0x000000001064b702);
INSERT INTO alinkedlist VALUES (
7,979,'979                             ','940',6,78,1,0x000000001064b703);
INSERT INTO alinkedlist VALUES (
7,980,'980                             ','480',6,78,1,0x000000001064b704);
INSERT INTO alinkedlist VALUES (
7,981,'981                             ','460',6,78,1,0x000000001064b705);
INSERT INTO alinkedlist VALUES (
7,982,'982                             ','960',6,78,1,0x000000001064b706);
INSERT INTO alinkedlist VALUES (
7,983,'983                             ','S90',6,78,1,0x000000001064b707);
INSERT INTO alinkedlist VALUES (
7,984,'984                             ','V90',6,78,1,0x000000001064b708);
INSERT INTO alinkedlist VALUES (
7,985,'985                             ','CLASSIC',6,78,1,0x000000001064b709);
INSERT INTO alinkedlist VALUES (
7,986,'986                             ','S40',6,78,1,0x000000001064b70a);
INSERT INTO alinkedlist VALUES (
7,987,'987                             ','V40',6,78,1,0x000000001064b70b);
INSERT INTO alinkedlist VALUES (
7,988,'988                             ','V50',6,78,1,0x000000001064b70c);
INSERT INTO alinkedlist VALUES (
7,989,'989                             ','V70 XC',6,78,1,0x000000001064b70d);
INSERT INTO alinkedlist VALUES (
7,990,'990                             ','XC70',6,78,1,0x000000001064b70e);
INSERT INTO alinkedlist VALUES (
7,991,'991                             ','C70',6,78,1,0x000000001064b70f);
INSERT INTO alinkedlist VALUES (
7,992,'992                             ','S80',6,78,1,0x000000001064b710);
INSERT INTO alinkedlist VALUES (
7,993,'993                             ','S60',6,78,1,0x000000001064b711);
INSERT INTO alinkedlist VALUES (
7,994,'994                             ','XC90',6,78,1,0x000000001064b712);
INSERT INTO alinkedlist VALUES (
7,995,'995                             ','C30',6,78,1,0x000000001064b713);
INSERT INTO alinkedlist VALUES (
7,996,'996                             ','780',6,78,1,0x000000001064b714);
INSERT INTO alinkedlist VALUES (
7,997,'997                             ','760',6,78,1,0x000000001064b715);
INSERT INTO alinkedlist VALUES (
7,998,'998                             ','740',6,78,1,0x000000001064b716);
INSERT INTO alinkedlist VALUES (
7,999,'999                             ','240',6,78,1,0x000000001064b717);
INSERT INTO alinkedlist VALUES (
7,1000,'1000                            ','360',6,78,1,0x000000001064b718);
INSERT INTO alinkedlist VALUES (
7,1001,'1001                            ','340',6,78,1,0x000000001064b719);
INSERT INTO alinkedlist VALUES (
7,1002,'1002                            ','XC60',6,78,1,0x000000001064b71a);
INSERT INTO alinkedlist VALUES (
7,1003,'1003                            ','V60',6,78,1,0x000000001064b71b);
INSERT INTO alinkedlist VALUES (
7,1004,'1004                            ','V40 CROSS COUNTRY',6,78,1,0x000000001064b71c);
INSERT INTO alinkedlist VALUES (
7,1005,'1005                            ','353',6,79,1,0x000000001064b71d);
INSERT INTO alinkedlist VALUES (
7,1006,'1006                            ','MINI',6,53,1,0x000000001064b71e);
INSERT INTO alinkedlist VALUES (
7,1007,'1007                            ','COUNTRYMAN',6,53,1,0x000000001064b71f);
INSERT INTO alinkedlist VALUES (
7,1008,'1008                            ','PACEMAN',6,53,1,0x000000001064b720);
INSERT INTO alinkedlist VALUES (
7,1009,'1009                            ','Otros',6,80,0,0x000000001064b721);
INSERT INTO alinkedlist VALUES (
7,1010,'1010                            ','HIACE',6,74,1,0x0000000010ae381f);
INSERT INTO alinkedlist VALUES (
7,1011,'1011                            ','SENTRA',6,56,1,0x0000000010ae37f5);
INSERT INTO alinkedlist VALUES (
8,1,'1                               ','AGRALE',NULL,NULL,1,0x0000000010649c18);
INSERT INTO alinkedlist VALUES (
8,2,'2                               ','CHANGAN',NULL,NULL,1,0x0000000010649c19);
INSERT INTO alinkedlist VALUES (
8,3,'3                               ','CHUNZHOU',NULL,NULL,1,0x0000000010649c1a);
INSERT INTO alinkedlist VALUES (
8,4,'4                               ','DAEWOO',NULL,NULL,1,0x0000000010649c1b);
INSERT INTO alinkedlist VALUES (
8,5,'5                               ','DENWAY',NULL,NULL,1,0x0000000010649c1c);
INSERT INTO alinkedlist VALUES (
8,6,'6                               ','DIMEX',NULL,NULL,1,0x0000000010649c1d);
INSERT INTO alinkedlist VALUES (
8,7,'7                               ','DONG FENG',NULL,NULL,1,0x0000000010649c1e);
INSERT INTO alinkedlist VALUES (
8,8,'8                               ','FAW',NULL,NULL,1,0x0000000010649c1f);
INSERT INTO alinkedlist VALUES (
8,9,'9                               ','FORD',NULL,NULL,1,0x0000000010649c20);
INSERT INTO alinkedlist VALUES (
8,10,'10                              ','FOTON',NULL,NULL,1,0x0000000010649c21);
INSERT INTO alinkedlist VALUES (
8,11,'11                              ','GOLDEN DRAGON',NULL,NULL,1,0x0000000010649c22);
INSERT INTO alinkedlist VALUES (
8,12,'12                              ','HENGTONG',NULL,NULL,1,0x0000000010649c23);
INSERT INTO alinkedlist VALUES (
8,13,'13                              ','HIGER',NULL,NULL,1,0x0000000010649c24);
INSERT INTO alinkedlist VALUES (
8,14,'14                              ','HINO',NULL,NULL,1,0x0000000010649c25);
INSERT INTO alinkedlist VALUES (
8,15,'15                              ','HUANGHAI',NULL,NULL,1,0x0000000010649c26);
INSERT INTO alinkedlist VALUES (
8,16,'16                              ','HYUNDAI',NULL,NULL,1,0x0000000010649c27);
INSERT INTO alinkedlist VALUES (
8,17,'17                              ','INTERNATIONAL',NULL,NULL,1,0x0000000010649c28);
INSERT INTO alinkedlist VALUES (
8,18,'18                              ','ISUZU',NULL,NULL,1,0x0000000010649c29);
INSERT INTO alinkedlist VALUES (
8,19,'19                              ','IVECO',NULL,NULL,1,0x0000000010649c2a);
INSERT INTO alinkedlist VALUES (
8,20,'20                              ','JAC',NULL,NULL,1,0x0000000010649c2b);
INSERT INTO alinkedlist VALUES (
8,21,'21                              ','JIANGSU',NULL,NULL,1,0x0000000010649c2c);
INSERT INTO alinkedlist VALUES (
8,22,'22                              ','JINBEI',NULL,NULL,1,0x0000000010649c2d);
INSERT INTO alinkedlist VALUES (
8,23,'23                              ','KING LONG',NULL,NULL,1,0x0000000010649c2e);
INSERT INTO alinkedlist VALUES (
8,24,'24                              ','MARCOPOLO',NULL,NULL,1,0x0000000010649c2f);
INSERT INTO alinkedlist VALUES (
8,25,'25                              ','MERCEDES BENZ',NULL,NULL,1,0x0000000010649c30);
INSERT INTO alinkedlist VALUES (
8,26,'26                              ','MITSUBISHI FUSO',NULL,NULL,1,0x0000000010649c31);
INSERT INTO alinkedlist VALUES (
8,27,'27                              ','MODASA',NULL,NULL,1,0x0000000010649c32);
INSERT INTO alinkedlist VALUES (
8,28,'28                              ','MUDAN',NULL,NULL,1,0x0000000010649c33);
INSERT INTO alinkedlist VALUES (
8,29,'29                              ','NISSAN',NULL,NULL,1,0x0000000010649c34);
INSERT INTO alinkedlist VALUES (
8,30,'30                              ','SCANIA',NULL,NULL,1,0x0000000010649c35);
INSERT INTO alinkedlist VALUES (
8,31,'31                              ','TATA',NULL,NULL,1,0x0000000010649c36);
INSERT INTO alinkedlist VALUES (
8,32,'32                              ','TOYOTA',NULL,NULL,1,0x0000000010649c37);
INSERT INTO alinkedlist VALUES (
8,33,'33                              ','VASQUEZ',NULL,NULL,1,0x0000000010649c38);
INSERT INTO alinkedlist VALUES (
8,34,'34                              ','VOLKSWAGEN',NULL,NULL,1,0x0000000010649c39);
INSERT INTO alinkedlist VALUES (
8,35,'35                              ','VOLVO',NULL,NULL,1,0x0000000010649c3a);
INSERT INTO alinkedlist VALUES (
8,36,'36                              ','WUZHOULONG',NULL,NULL,1,0x0000000010649c3b);
INSERT INTO alinkedlist VALUES (
8,37,'37                              ','YAXING',NULL,NULL,1,0x0000000010649c3c);
INSERT INTO alinkedlist VALUES (
8,38,'38                              ','YOUYI',NULL,NULL,1,0x0000000010649c3d);
INSERT INTO alinkedlist VALUES (
8,39,'39                              ','YUTONG',NULL,NULL,1,0x0000000010649c3e);
INSERT INTO alinkedlist VALUES (
8,40,'40                              ','ZHONG TONG',NULL,NULL,1,0x0000000010649c3f);
INSERT INTO alinkedlist VALUES (
8,41,'41                              ','ZONDA',NULL,NULL,1,0x0000000010649c40);
INSERT INTO alinkedlist VALUES (
8,42,'42                              ','Otros',NULL,NULL,0,0x0000000010649c41);
INSERT INTO alinkedlist VALUES (
9,1,'1                               ','MA 9.0 TCA PLUS',8,1,1,0x0000000010649c43);
INSERT INTO alinkedlist VALUES (
9,2,'2                               ','MA TCA PLUS II 8.5 CH/BUS',8,1,1,0x0000000010649c42);
INSERT INTO alinkedlist VALUES (
9,3,'3                               ','MA TCA SUPER 8.5 CH/BUS',8,1,1,0x0000000010649c44);
INSERT INTO alinkedlist VALUES (
9,4,'4                               ','MATCA 8.5',8,1,1,0x0000000010649c45);
INSERT INTO alinkedlist VALUES (
9,5,'5                               ','INC 103D SC6101',8,2,1,0x0000000010649c46);
INSERT INTO alinkedlist VALUES (
9,6,'6                               ','INC 103G SC6101',8,2,1,0x0000000010649c47);
INSERT INTO alinkedlist VALUES (
9,7,'7                               ','INC GRAND BUFFALO SC6608BF',8,2,1,0x0000000010649c48);
INSERT INTO alinkedlist VALUES (
9,8,'8                               ','INCAPOWER CITIZEN',8,2,1,0x0000000010649c49);
INSERT INTO alinkedlist VALUES (
9,9,'9                               ','INCAPOWER METRO DIESEL',8,2,1,0x0000000010649c4a);
INSERT INTO alinkedlist VALUES (
9,10,'10                              ','INCAPOWER METRO GAS',8,2,1,0x0000000010649c4b);
INSERT INTO alinkedlist VALUES (
9,11,'11                              ','JNQ6601 MINIBUS GNV 23 ASIENT.',8,3,1,0x0000000010649c4c);
INSERT INTO alinkedlist VALUES (
9,12,'12                              ','JNQ6670',8,3,1,0x0000000010649c4d);
INSERT INTO alinkedlist VALUES (
9,13,'13                              ','JNQ6701',8,3,1,0x0000000010649c4e);
INSERT INTO alinkedlist VALUES (
9,14,'14                              ','JNQ6701 MINIBUS 28 ASIENTOS',8,3,1,0x0000000010649c4f);
INSERT INTO alinkedlist VALUES (
9,15,'15                              ','BF120',8,4,1,0x0000000010649c50);
INSERT INTO alinkedlist VALUES (
9,16,'16                              ','CN6750',8,5,1,0x0000000010649c51);
INSERT INTO alinkedlist VALUES (
9,17,'17                              ','GZ6590',8,5,1,0x0000000010649c52);
INSERT INTO alinkedlist VALUES (
9,18,'18                              ','GZ6701',8,5,1,0x0000000010649c53);
INSERT INTO alinkedlist VALUES (
9,19,'19                              ','GZ6750E',8,5,1,0x0000000010649c54);
INSERT INTO alinkedlist VALUES (
9,20,'20                              ','GZ6750S',8,5,1,0x0000000010649c55);
INSERT INTO alinkedlist VALUES (
9,21,'21                              ','GZ6750T',8,5,1,0x0000000010649c56);
INSERT INTO alinkedlist VALUES (
9,22,'22                              ','433-160',8,6,1,0x0000000010649c57);
INSERT INTO alinkedlist VALUES (
9,23,'23                              ','552-190',8,6,1,0x0000000010649c58);
INSERT INTO alinkedlist VALUES (
9,24,'24                              ','552-190 80 PSJ.',8,6,1,0x0000000010649c59);
INSERT INTO alinkedlist VALUES (
9,25,'25                              ','553-190',8,6,1,0x0000000010649c5a);
INSERT INTO alinkedlist VALUES (
9,26,'26                              ','555-185',8,6,1,0x0000000010649c5b);
INSERT INTO alinkedlist VALUES (
9,27,'27                              ','555-191',8,6,1,0x0000000010649c5c);
INSERT INTO alinkedlist VALUES (
9,28,'28                              ','654-210',8,6,1,0x0000000010649c5d);
INSERT INTO alinkedlist VALUES (
9,29,'29                              ','654-250',8,6,1,0x0000000010649c5e);
INSERT INTO alinkedlist VALUES (
9,30,'30                              ','F12-370/DD',8,6,1,0x0000000010649c5f);
INSERT INTO alinkedlist VALUES (
9,31,'31                              ','DFA6740KC',8,7,1,0x0000000010649c60);
INSERT INTO alinkedlist VALUES (
9,32,'32                              ','CA6780A80',8,8,1,0x0000000010649c61);
INSERT INTO alinkedlist VALUES (
9,33,'33                              ','B-1618',8,9,1,0x0000000010649c62);
INSERT INTO alinkedlist VALUES (
9,34,'34                              ','B-1618 BUS CH',8,9,1,0x0000000010649c63);
INSERT INTO alinkedlist VALUES (
9,35,'35                              ','AUV 2.7L 18+1',8,10,1,0x0000000010649c64);
INSERT INTO alinkedlist VALUES (
9,36,'36                              ','AUV 2.7L 27+1',8,10,1,0x0000000010649c65);
INSERT INTO alinkedlist VALUES (
9,37,'37                              ','AUV 4.5L 27+1 AC',8,10,1,0x0000000010649c66);
INSERT INTO alinkedlist VALUES (
9,38,'38                              ','AUV 4.5L 33+1+1',8,10,1,0x0000000010649c67);
INSERT INTO alinkedlist VALUES (
9,39,'39                              ','AUV 4.5L 33+1+1 AC',8,10,1,0x0000000010649c68);
INSERT INTO alinkedlist VALUES (
9,40,'40                              ','XML6103J13',8,11,1,0x0000000010649c69);
INSERT INTO alinkedlist VALUES (
9,41,'41                              ','XML6125J13CN',8,11,1,0x0000000010649c6a);
INSERT INTO alinkedlist VALUES (
9,42,'42                              ','XML6125J13CN - AUTOMATICA',8,11,1,0x0000000010649c6b);
INSERT INTO alinkedlist VALUES (
9,43,'43                              ','XML6125J13CN - MOTOR DELANTERO',8,11,1,0x0000000010649c6c);
INSERT INTO alinkedlist VALUES (
9,44,'44                              ','XML6125J13CN CUMMINS GNV CGE 250HP  EURO III, CANADIENSE',8,11,1,0x0000000010649c6d);
INSERT INTO alinkedlist VALUES (
9,45,'45                              ','XML6126J13 - 12.8 METROS',8,11,1,0x0000000010649c6e);
INSERT INTO alinkedlist VALUES (
9,46,'46                              ','XML6127J12CN',8,11,1,0x0000000010649c6f);
INSERT INTO alinkedlist VALUES (
9,47,'47                              ','XML6127J12CN CUMMINS GNV CGE-280HP 8.3,  EURO lll',8,11,1,0x0000000010649c70);
INSERT INTO alinkedlist VALUES (
9,48,'48                              ','XML6127J13 CUMMINS ISL 310HP 8.3L,  EURO lll  ELECTRÓNICO',8,11,1,0x0000000010649c71);
INSERT INTO alinkedlist VALUES (
9,49,'49                              ','XML6807J23',8,11,1,0x0000000010649c72);
INSERT INTO alinkedlist VALUES (
9,50,'50                              ','XML6925J13CN CUMMINS GNV BGE195HP 30 EURO III, Canadiense',8,11,1,0x0000000010649c73);
INSERT INTO alinkedlist VALUES (
9,51,'51                              ','CKZ6126N3',8,12,1,0x0000000010649c74);
INSERT INTO alinkedlist VALUES (
9,52,'52                              ','1830F INTERPROVINCIAL',8,13,1,0x0000000010649c75);
INSERT INTO alinkedlist VALUES (
9,53,'53                              ','6126 EURO 3',8,13,1,0x0000000010649c76);
INSERT INTO alinkedlist VALUES (
9,54,'54                              ','6126T INTERURBANO',8,13,1,0x0000000010649c77);
INSERT INTO alinkedlist VALUES (
9,55,'55                              ','6129GC URBANO',8,13,1,0x0000000010649c78);
INSERT INTO alinkedlist VALUES (
9,56,'56                              ','6129QE3 INTERPROVINCIAL',8,13,1,0x0000000010649c79);
INSERT INTO alinkedlist VALUES (
9,57,'57                              ','6142SQE3L INTERPROVINCIAL',8,13,1,0x0000000010649c7a);
INSERT INTO alinkedlist VALUES (
9,58,'58                              ','6728 EURO 3',8,13,1,0x0000000010649c7b);
INSERT INTO alinkedlist VALUES (
9,59,'59                              ','6729G URBANO',8,13,1,0x0000000010649c7c);
INSERT INTO alinkedlist VALUES (
9,60,'60                              ','6758 CHASIS MOTORIZADO',8,13,1,0x0000000010649c7d);
INSERT INTO alinkedlist VALUES (
9,61,'61                              ','6796 EURO 3',8,13,1,0x0000000010649c7e);
INSERT INTO alinkedlist VALUES (
9,62,'62                              ','6796 INTERURBANO',8,13,1,0x0000000010649c7f);
INSERT INTO alinkedlist VALUES (
9,63,'63                              ','6896 EURO 3',8,13,1,0x0000000010649c80);
INSERT INTO alinkedlist VALUES (
9,64,'64                              ','6896 INTERURBANO',8,13,1,0x0000000010649c81);
INSERT INTO alinkedlist VALUES (
9,65,'65                              ','6903GC URBANO',8,13,1,0x0000000010649c82);
INSERT INTO alinkedlist VALUES (
9,66,'66                              ','KLQ6100',8,13,1,0x0000000010649c83);
INSERT INTO alinkedlist VALUES (
9,67,'67                              ','KLQ6126T',8,13,1,0x0000000010649c84);
INSERT INTO alinkedlist VALUES (
9,68,'68                              ','KLQ6128G',8,13,1,0x0000000010649c85);
INSERT INTO alinkedlist VALUES (
9,69,'69                              ','KLQ6129',8,13,1,0x0000000010649c86);
INSERT INTO alinkedlist VALUES (
9,70,'70                              ','KLQ6129Q',8,13,1,0x0000000010649c87);
INSERT INTO alinkedlist VALUES (
9,71,'71                              ','KLQ6129QE3',8,13,1,0x0000000010649c88);
INSERT INTO alinkedlist VALUES (
9,72,'72                              ','KLQ6540',8,13,1,0x0000000010649c89);
INSERT INTO alinkedlist VALUES (
9,73,'73                              ','KLQ6608 TURISMO',8,13,1,0x0000000010649c8a);
INSERT INTO alinkedlist VALUES (
9,74,'74                              ','KLQ6608 URBANO',8,13,1,0x0000000010649c8b);
INSERT INTO alinkedlist VALUES (
9,75,'75                              ','KLQ6728G',8,13,1,0x0000000010649c8c);
INSERT INTO alinkedlist VALUES (
9,76,'76                              ','KLQ6758',8,13,1,0x0000000010649c8d);
INSERT INTO alinkedlist VALUES (
9,77,'77                              ','KLQ6796 TURISMO',8,13,1,0x0000000010649c8e);
INSERT INTO alinkedlist VALUES (
9,78,'78                              ','KLQ6896',8,13,1,0x0000000010649c8f);
INSERT INTO alinkedlist VALUES (
9,79,'79                              ','FC BUS',8,14,1,0x0000000010649c90);
INSERT INTO alinkedlist VALUES (
9,80,'80                              ','FD 194 BUS CARROZADO STD',8,14,1,0x0000000010649c91);
INSERT INTO alinkedlist VALUES (
9,81,'81                              ','FD 194 CHASIS BUS',8,14,1,0x0000000010649c92);
INSERT INTO alinkedlist VALUES (
9,82,'82                              ','FD 194 SA CHAS. BUS',8,14,1,0x0000000010649c93);
INSERT INTO alinkedlist VALUES (
9,83,'83                              ','FD 194 SA DE LUXE 40 PSJ.',8,14,1,0x0000000010649c94);
INSERT INTO alinkedlist VALUES (
9,84,'84                              ','FD 194 SA SS 40 PSJ.',8,14,1,0x0000000010649c95);
INSERT INTO alinkedlist VALUES (
9,85,'85                              ','FD 194 SA SSALON BUS CARROZADO 39 PSJ.',8,14,1,0x0000000010649c96);
INSERT INTO alinkedlist VALUES (
9,86,'86                              ','FD 194 SA TURISMO SATECI 33 PSJ.',8,14,1,0x0000000010649c97);
INSERT INTO alinkedlist VALUES (
9,87,'87                              ','LIESSE II',8,14,1,0x0000000010649c98);
INSERT INTO alinkedlist VALUES (
9,88,'88                              ','DD6129S71',8,15,1,0x0000000010649c99);
INSERT INTO alinkedlist VALUES (
9,89,'89                              ','AERO CITY BUS CARROZADO GNV',8,16,1,0x0000000010649c9a);
INSERT INTO alinkedlist VALUES (
9,90,'90                              ','AERO CITY URBANO GNV',8,16,1,0x0000000010649c9b);
INSERT INTO alinkedlist VALUES (
9,91,'91                              ','AERO EXPRESS B/CH',8,16,1,0x0000000010649c9c);
INSERT INTO alinkedlist VALUES (
9,92,'92                              ','AERO EXPRESS CHM TDI',8,16,1,0x0000000010649c9d);
INSERT INTO alinkedlist VALUES (
9,93,'93                              ','AERO SPACE B/CH',8,16,1,0x0000000010649c9e);
INSERT INTO alinkedlist VALUES (
9,94,'94                              ','AEROBUS SPACE',8,16,1,0x0000000010649c9f);
INSERT INTO alinkedlist VALUES (
9,95,'95                              ','AEROBUS SPACE LS',8,16,1,0x0000000010649ca0);
INSERT INTO alinkedlist VALUES (
9,96,'96                              ','BUS AERO CITY URBANO - D6AV (210 PS)',8,16,1,0x0000000010649ca1);
INSERT INTO alinkedlist VALUES (
9,97,'97                              ','BUS AERO TOWN - D6DA 6.6 TDI 34 PSJ',8,16,1,0x0000000010649ca2);
INSERT INTO alinkedlist VALUES (
9,98,'98                              ','BUS AERO TOWN B/C 6.6 TDI',8,16,1,0x0000000010649ca3);
INSERT INTO alinkedlist VALUES (
9,99,'99                              ','BUS AERO TOWN B/C 7.5 NA',8,16,1,0x0000000010649ca4);
INSERT INTO alinkedlist VALUES (
9,100,'100                             ','BUS AERO TOWN NA - D6BR 7.5 25 PSJ',8,16,1,0x0000000010649ca5);
INSERT INTO alinkedlist VALUES (
9,101,'101                             ','BUS COUNTY D4AL 24+1 SIN 3.3 AC',8,16,1,0x0000000010649ca6);
INSERT INTO alinkedlist VALUES (
9,102,'102                             ','BUS COUNTY D4AL 28+1 SIN 3.3 AC',8,16,1,0x0000000010649ca7);
INSERT INTO alinkedlist VALUES (
9,103,'103                             ','BUS COUNTY D4DA 28+1 3.9 AC',8,16,1,0x0000000010649ca8);
INSERT INTO alinkedlist VALUES (
9,104,'104                             ','COUNTY 3.3',8,16,1,0x0000000010649ca9);
INSERT INTO alinkedlist VALUES (
9,105,'105                             ','COUNTY 3.3 CBU 28+1 2X2 SEAT',8,16,1,0x0000000010649caa);
INSERT INTO alinkedlist VALUES (
9,106,'106                             ','COUNTY 3.9',8,16,1,0x0000000010649cab);
INSERT INTO alinkedlist VALUES (
9,107,'107                             ','COUNTY 3.9 B/CH',8,16,1,0x0000000010649cac);
INSERT INTO alinkedlist VALUES (
9,108,'108                             ','COUNTY 3.9 B/CH 7.05 EURO III',8,16,1,0x0000000010649cad);
INSERT INTO alinkedlist VALUES (
9,109,'109                             ','COUNTY 3.9 B/CH 7.05 EURO IV',8,16,1,0x0000000010649cae);
INSERT INTO alinkedlist VALUES (
9,110,'110                             ','COUNTY 3.9 CBU 28+1 2X2 SEAT',8,16,1,0x0000000010649caf);
INSERT INTO alinkedlist VALUES (
9,111,'111                             ','COUNTY 3.9 CBU 28+1 2X2 SEAT AC',8,16,1,0x0000000010649cb0);
INSERT INTO alinkedlist VALUES (
9,112,'112                             ','COUNTY 3.9 TDI',8,16,1,0x0000000010649cb1);
INSERT INTO alinkedlist VALUES (
9,113,'113                             ','COUNTY 7.2 3.9 TDI',8,16,1,0x0000000010649cb2);
INSERT INTO alinkedlist VALUES (
9,114,'114                             ','COUNTY BUS 28+1 AC',8,16,1,0x0000000010649cb3);
INSERT INTO alinkedlist VALUES (
9,115,'115                             ','COUNTY CBU 4x4 3.9',8,16,1,0x0000000010649cb4);
INSERT INTO alinkedlist VALUES (
9,116,'116                             ','COUNTY CHASIS',8,16,1,0x0000000010649cb5);
INSERT INTO alinkedlist VALUES (
9,117,'117                             ','COUNTY CHASIS BUS- NA',8,16,1,0x0000000010649cb6);
INSERT INTO alinkedlist VALUES (
9,118,'118                             ','COUNTY D4DB',8,16,1,0x0000000010649cb7);
INSERT INTO alinkedlist VALUES (
9,119,'119                             ','COUNTY E-III CBU 2 PUERTAS',8,16,1,0x0000000010649cb8);
INSERT INTO alinkedlist VALUES (
9,120,'120                             ','COUNTY E-III CBU 27+1 2X2 SEAT',8,16,1,0x0000000010649cb9);
INSERT INTO alinkedlist VALUES (
9,121,'121                             ','COUNTY E-III CBU 27+1 2X2 SEAT AC',8,16,1,0x0000000010649cba);
INSERT INTO alinkedlist VALUES (
9,122,'122                             ','COUNTY E-III CBU 27+1 4X4',8,16,1,0x0000000010649cbb);
INSERT INTO alinkedlist VALUES (
9,123,'123                             ','COUNTY II B/C',8,16,1,0x0000000010649cbc);
INSERT INTO alinkedlist VALUES (
9,124,'124                             ','COUNTY II CHM 4.0 TDI',8,16,1,0x0000000010649cbd);
INSERT INTO alinkedlist VALUES (
9,125,'125                             ','COUNTY III B/C',8,16,1,0x0000000010649cbe);
INSERT INTO alinkedlist VALUES (
9,126,'126                             ','COUNTY NA 3.9',8,16,1,0x0000000010649cbf);
INSERT INTO alinkedlist VALUES (
9,127,'127                             ','HD1000 AL',8,16,1,0x0000000010649cc0);
INSERT INTO alinkedlist VALUES (
9,128,'128                             ','SUPER AERO CITY B/C CHM TDI',8,16,1,0x0000000010649cc1);
INSERT INTO alinkedlist VALUES (
9,129,'129                             ','SUPER AERO CITY BUS CARROZADO',8,16,1,0x0000000010649cc2);
INSERT INTO alinkedlist VALUES (
9,130,'130                             ','SUPER AERO CITY CBU TDI',8,16,1,0x0000000010649cc3);
INSERT INTO alinkedlist VALUES (
9,131,'131                             ','SUPER AERO CITY CNG CBU',8,16,1,0x0000000010649cc4);
INSERT INTO alinkedlist VALUES (
9,132,'132                             ','UNIVERSE CARROZADO TDI',8,16,1,0x0000000010649cc5);
INSERT INTO alinkedlist VALUES (
9,133,'133                             ','UNIVERSE LUXURY',8,16,1,0x0000000010649cc6);
INSERT INTO alinkedlist VALUES (
9,134,'134                             ','3000 RE 4X2',8,17,1,0x0000000010649cc7);
INSERT INTO alinkedlist VALUES (
9,135,'135                             ','3000 RE OMNIBUS 4X2 45 ASIENTOS',8,17,1,0x0000000010649cc8);
INSERT INTO alinkedlist VALUES (
9,136,'136                             ','3000 SBA 6X4',8,17,1,0x0000000010649cc9);
INSERT INTO alinkedlist VALUES (
9,137,'137                             ','BUS 1652 NOVELL',8,17,1,0x0000000010649cca);
INSERT INTO alinkedlist VALUES (
9,138,'138                             ','BUS 3900 SENIOR',8,17,1,0x0000000010649ccb);
INSERT INTO alinkedlist VALUES (
9,139,'139                             ','FE COMM BUS',8,17,1,0x0000000010649ccc);
INSERT INTO alinkedlist VALUES (
9,140,'140                             ','IC BUS FE',8,17,1,0x0000000010649ccd);
INSERT INTO alinkedlist VALUES (
9,141,'141                             ','SFC 4X2',8,17,1,0x0000000010649cce);
INSERT INTO alinkedlist VALUES (
9,142,'142                             ','SFC COMM BUS',8,17,1,0x0000000010649ccf);
INSERT INTO alinkedlist VALUES (
9,143,'143                             ','ELF',8,18,1,0x0000000010649cd0);
INSERT INTO alinkedlist VALUES (
9,144,'144                             ','JOURNEY',8,18,1,0x0000000010649cd1);
INSERT INTO alinkedlist VALUES (
9,145,'145                             ','A50.13',8,19,1,0x0000000010649cd2);
INSERT INTO alinkedlist VALUES (
9,146,'146                             ','BUS INTERPROVINCIAL CC170E22',8,19,1,0x0000000010649cd3);
INSERT INTO alinkedlist VALUES (
9,147,'147                             ','BUS URBANO CC170E22',8,19,1,0x0000000010649cd4);
INSERT INTO alinkedlist VALUES (
9,148,'148                             ','CC170E22',8,19,1,0x0000000010649cd5);
INSERT INTO alinkedlist VALUES (
9,149,'149                             ','CC170E22 CHASIS MOTORIZADO',8,19,1,0x0000000010649cd6);
INSERT INTO alinkedlist VALUES (
9,150,'150                             ','DAILY A36.13',8,19,1,0x0000000010649cd7);
INSERT INTO alinkedlist VALUES (
9,151,'151                             ','DAILY A42.13',8,19,1,0x0000000010649cd8);
INSERT INTO alinkedlist VALUES (
9,152,'152                             ','DAILY A50.13',8,19,1,0x0000000010649cd9);
INSERT INTO alinkedlist VALUES (
9,153,'153                             ','DAILY V36.13',8,19,1,0x0000000010649cda);
INSERT INTO alinkedlist VALUES (
9,154,'154                             ','DAILY V42.13',8,19,1,0x0000000010649cdb);
INSERT INTO alinkedlist VALUES (
9,155,'155                             ','DAILY V50.13',8,19,1,0x0000000010649cdc);
INSERT INTO alinkedlist VALUES (
9,156,'156                             ','SCUDATO 59.12SHM',8,19,1,0x0000000010649cdd);
INSERT INTO alinkedlist VALUES (
9,157,'157                             ','HFC6770KY3 CH/MOTORIZADO',8,20,1,0x0000000010649cde);
INSERT INTO alinkedlist VALUES (
9,158,'158                             ','HFC6900K3Y',8,20,1,0x0000000010649cdf);
INSERT INTO alinkedlist VALUES (
9,159,'159                             ','HK3730K2',8,20,1,0x0000000010649ce0);
INSERT INTO alinkedlist VALUES (
9,160,'160                             ','HK6110KY',8,20,1,0x0000000010649ce1);
INSERT INTO alinkedlist VALUES (
9,161,'161                             ','HK6700',8,20,1,0x0000000010649ce2);
INSERT INTO alinkedlist VALUES (
9,162,'162                             ','HK6700 OMNIBUS 22 ASIENT.',8,20,1,0x0000000010649ce3);
INSERT INTO alinkedlist VALUES (
9,163,'163                             ','HK6700K2 OMNIBUS 4X2 28 ASIENT.',8,20,1,0x0000000010649ce4);
INSERT INTO alinkedlist VALUES (
9,164,'164                             ','HK6750K',8,20,1,0x0000000010649ce5);
INSERT INTO alinkedlist VALUES (
9,165,'165                             ','HK6880K OMNIBUS 35 ASIENT',8,20,1,0x0000000010649ce6);
INSERT INTO alinkedlist VALUES (
9,166,'166                             ','HK6901KY',8,20,1,0x0000000010649ce7);
INSERT INTO alinkedlist VALUES (
9,167,'167                             ','HK6920G',8,20,1,0x0000000010649ce8);
INSERT INTO alinkedlist VALUES (
9,168,'168                             ','LO915/42.5',8,20,1,0x0000000010649ce9);
INSERT INTO alinkedlist VALUES (
9,169,'169                             ','ZGT6700',8,21,1,0x0000000010649cea);
INSERT INTO alinkedlist VALUES (
9,170,'170                             ','H2L DELUXE E3 DSL 16S',8,22,1,0x0000000010649ceb);
INSERT INTO alinkedlist VALUES (
9,171,'171                             ','HAISE 15S MINIBUS 2.7',8,22,1,0x0000000010649cec);
INSERT INTO alinkedlist VALUES (
9,172,'172                             ','HAISE 15S MINIBUS 2.7 TD',8,22,1,0x0000000010649ced);
INSERT INTO alinkedlist VALUES (
9,173,'173                             ','HAISE JINBEI MINIBUS 15S DSL E3',8,22,1,0x0000000010649cee);
INSERT INTO alinkedlist VALUES (
9,174,'174                             ','HAISE MINIBUS 2.7',8,22,1,0x0000000010649cef);
INSERT INTO alinkedlist VALUES (
9,175,'175                             ','HAISE MPFI 15S MINIBUS 2.2',8,22,1,0x0000000010649cf0);
INSERT INTO alinkedlist VALUES (
9,176,'176                             ','FULL TURISMO XMQ6123Y OMNIBUS',8,23,1,0x0000000010649cf1);
INSERT INTO alinkedlist VALUES (
9,177,'177                             ','FULL TURISMO XMQ6126Y',8,23,1,0x0000000010649cf2);
INSERT INTO alinkedlist VALUES (
9,178,'178                             ','XMQ6120C2',8,23,1,0x0000000010649cf3);
INSERT INTO alinkedlist VALUES (
9,179,'179                             ','XMQ6759Y',8,23,1,0x0000000010649cf4);
INSERT INTO alinkedlist VALUES (
9,180,'180                             ','XMQ6759Y4',8,23,1,0x0000000010649cf5);
INSERT INTO alinkedlist VALUES (
9,181,'181                             ','XMQ6940G',8,23,1,0x0000000010649cf6);
INSERT INTO alinkedlist VALUES (
9,182,'182                             ','VOLARE A6',8,24,1,0x0000000010649cf7);
INSERT INTO alinkedlist VALUES (
9,183,'183                             ','VOLARE A6 EJECUTIVO 17 ASIENT.',8,24,1,0x0000000010649cf8);
INSERT INTO alinkedlist VALUES (
9,184,'184                             ','VOLARE W8',8,24,1,0x0000000010649cf9);
INSERT INTO alinkedlist VALUES (
9,185,'185                             ','VOLARE W8 EJECUTIVO 28 ASIENTOS',8,24,1,0x0000000010649cfa);
INSERT INTO alinkedlist VALUES (
9,186,'186                             ','VOLARE W8 URBANO 27 ASIENT.',8,24,1,0x0000000010649cfb);
INSERT INTO alinkedlist VALUES (
9,187,'187                             ','VOLARE W9',8,24,1,0x0000000010649cfc);
INSERT INTO alinkedlist VALUES (
9,188,'188                             ','VOLARE W9 28 ASIENTOS',8,24,1,0x0000000010649cfd);
INSERT INTO alinkedlist VALUES (
9,189,'189                             ','VOLARE W9 32 4X2 32 ASIEN. 8.5PBV',8,24,1,0x0000000010649cfe);
INSERT INTO alinkedlist VALUES (
9,190,'190                             ','VOLARE W9 8.5PBV 4X2 28 ASIEN.',8,24,1,0x0000000010649cff);
INSERT INTO alinkedlist VALUES (
9,191,'191                             ','VOLARE W9 URBANO 28 ASIENT.',8,24,1,0x0000000010649d01);
INSERT INTO alinkedlist VALUES (
9,192,'192                             ','914',8,25,1,0x0000000010649d02);
INSERT INTO alinkedlist VALUES (
9,193,'193                             ','CH 1622',8,25,1,0x0000000010649d03);
INSERT INTO alinkedlist VALUES (
9,194,'194                             ','LO 914 URBANO',8,25,1,0x0000000010649d04);
INSERT INTO alinkedlist VALUES (
9,195,'195                             ','LO 915/42.5 CH/BUS 4X2',8,25,1,0x0000000010649d05);
INSERT INTO alinkedlist VALUES (
9,196,'196                             ','LO 915/48 BRUCE THUNDER - INTERPROVINCIAL',8,25,1,0x0000000010649d06);
INSERT INTO alinkedlist VALUES (
9,197,'197                             ','LO-915 42.5',8,25,1,0x0000000010649d07);
INSERT INTO alinkedlist VALUES (
9,198,'198                             ','LO-915 48',8,25,1,0x0000000010649d08);
INSERT INTO alinkedlist VALUES (
9,199,'199                             ','MBO-800',8,25,1,0x0000000010649d09);
INSERT INTO alinkedlist VALUES (
9,200,'200                             ','O-400 RSD OMNIBUS 6X2',8,25,1,0x0000000010649d0a);
INSERT INTO alinkedlist VALUES (
9,201,'201                             ','O-400 RSE OMNIBUS 4X2',8,25,1,0x0000000010649d0b);
INSERT INTO alinkedlist VALUES (
9,202,'202                             ','O-400RSD',8,25,1,0x0000000010649d0c);
INSERT INTO alinkedlist VALUES (
9,203,'203                             ','O-400RSE',8,25,1,0x0000000010649d0d);
INSERT INTO alinkedlist VALUES (
9,204,'204                             ','O500 CHASIS R 1830/30',8,25,1,0x0000000010649d0e);
INSERT INTO alinkedlist VALUES (
9,205,'205                             ','O500 CHASIS RS 1836/30',8,25,1,0x0000000010649d0f);
INSERT INTO alinkedlist VALUES (
9,206,'206                             ','O500 CHASIS RSD 2436/30',8,25,1,0x0000000010649d10);
INSERT INTO alinkedlist VALUES (
9,207,'207                             ','O500 CHASIS RSDD 2742/30',8,25,1,0x0000000010649d11);
INSERT INTO alinkedlist VALUES (
9,208,'208                             ','O500 R',8,25,1,0x0000000010649d12);
INSERT INTO alinkedlist VALUES (
9,209,'209                             ','O500 R 1830',8,25,1,0x0000000010649d13);
INSERT INTO alinkedlist VALUES (
9,210,'210                             ','O500 R 1830 COML CAMPIONE 3.45',8,25,1,0x0000000010649d14);
INSERT INTO alinkedlist VALUES (
9,211,'211                             ','O-500 R OMNIBUS 4X2',8,25,1,0x0000000010649d15);
INSERT INTO alinkedlist VALUES (
9,212,'212                             ','O-500 RDS OMNIBUS 6X2',8,25,1,0x0000000010649d16);
INSERT INTO alinkedlist VALUES (
9,213,'213                             ','O500 RS',8,25,1,0x0000000010649d17);
INSERT INTO alinkedlist VALUES (
9,214,'214                             ','O500 RS 1836 CHASIS',8,25,1,0x0000000010649d18);
INSERT INTO alinkedlist VALUES (
9,215,'215                             ','O500 RS 1836 COML CAMPIONE 3.65',8,25,1,0x0000000010649d19);
INSERT INTO alinkedlist VALUES (
9,216,'216                             ','O-500 RS OMNIBUS 4X2',8,25,1,0x0000000010649d1a);
INSERT INTO alinkedlist VALUES (
9,217,'217                             ','O500 RSD 2336/30',8,25,1,0x0000000010649d1b);
INSERT INTO alinkedlist VALUES (
9,218,'218                             ','O500 RSD 2436 CHASIS',8,25,1,0x0000000010649d1c);
INSERT INTO alinkedlist VALUES (
9,219,'219                             ','O500 RSD 2436 COML CAMPIONE 3.65 15 METROS',8,25,1,0x0000000010649d1d);
INSERT INTO alinkedlist VALUES (
9,220,'220                             ','O500 RSD 2436 COML CAMPIONE 4.05 15 METROS',8,25,1,0x0000000010649d1e);
INSERT INTO alinkedlist VALUES (
9,221,'221                             ','O500 RSD 2436 MARCOPOLO PARADISSO 1800 DD UTIL',8,25,1,0x0000000010649d1f);
INSERT INTO alinkedlist VALUES (
9,222,'222                             ','O500 RSD 6X2',8,25,1,0x0000000010649d20);
INSERT INTO alinkedlist VALUES (
9,223,'223                             ','OF 1721/59 COML CAMPIONE 3.45',8,25,1,0x0000000010649d21);
INSERT INTO alinkedlist VALUES (
9,224,'224                             ','OF 1721/59 MARCOPOLO URBANO',8,25,1,0x0000000010649d22);
INSERT INTO alinkedlist VALUES (
9,225,'225                             ','OF 1721/59 METALBUS -INTERPROVINCIAL ANDINO',8,25,1,0x0000000010649d23);
INSERT INTO alinkedlist VALUES (
9,226,'226                             ','OF 1721/59 METALBUS -INTERPROVINCIAL COSTERO',8,25,1,0x0000000010649d24);
INSERT INTO alinkedlist VALUES (
9,227,'227                             ','OF 1721/59 OMNIBUS 4X2',8,25,1,0x0000000010649d25);
INSERT INTO alinkedlist VALUES (
9,228,'228                             ','OF 1722/59',8,25,1,0x0000000010649d26);
INSERT INTO alinkedlist VALUES (
9,229,'229                             ','OF 1730',8,25,1,0x0000000010649d27);
INSERT INTO alinkedlist VALUES (
9,230,'230                             ','OF CHASIS 1730/59',8,25,1,0x0000000010649d28);
INSERT INTO alinkedlist VALUES (
9,231,'231                             ','OF-1318',8,25,1,0x0000000010649d29);
INSERT INTO alinkedlist VALUES (
9,232,'232                             ','OF-1417',8,25,1,0x0000000010649d2a);
INSERT INTO alinkedlist VALUES (
9,233,'233                             ','OF-1721',8,25,1,0x0000000010649d2b);
INSERT INTO alinkedlist VALUES (
9,234,'234                             ','OF-1721 59',8,25,1,0x0000000010649d2c);
INSERT INTO alinkedlist VALUES (
9,235,'235                             ','OF-1722 OMNIBUS 4X2',8,25,1,0x0000000010649d2d);
INSERT INTO alinkedlist VALUES (
9,236,'236                             ','OH-1628',8,25,1,0x0000000010649d2e);
INSERT INTO alinkedlist VALUES (
9,237,'237                             ','MF 100',8,26,1,0x0000000010649d2f);
INSERT INTO alinkedlist VALUES (
9,238,'238                             ','ROSA',8,26,1,0x0000000010649d30);
INSERT INTO alinkedlist VALUES (
9,239,'239                             ','APOLO I',8,27,1,0x0000000010649d31);
INSERT INTO alinkedlist VALUES (
9,240,'240                             ','MD6701 MINIBUS 27 ASIENT.',8,28,1,0x0000000010649d32);
INSERT INTO alinkedlist VALUES (
9,241,'241                             ','MD6701 MINIBUS 4X2 27 ASIENTOS',8,28,1,0x0000000010649d33);
INSERT INTO alinkedlist VALUES (
9,242,'242                             ','MD6703D2HZ CH/MINIBUS',8,28,1,0x0000000010649d34);
INSERT INTO alinkedlist VALUES (
9,243,'243                             ','MD6728 MINIBUS 28 ASIENT.',8,28,1,0x0000000010649d35);
INSERT INTO alinkedlist VALUES (
9,244,'244                             ','CIVILIAN',8,29,1,0x0000000010649d36);
INSERT INTO alinkedlist VALUES (
9,245,'245                             ','F 270 HB4X2HZ CHASIS ÓMNIBUS',8,30,1,0x0000000010649d37);
INSERT INTO alinkedlist VALUES (
9,246,'246                             ','F 310 HB4X2HZ CHASIS ÓMNIBUS',8,30,1,0x0000000010649d38);
INSERT INTO alinkedlist VALUES (
9,247,'247                             ','F 310 HB6X2HA CHASIS ÓMNIBUS',8,30,1,0x0000000010649d39);
INSERT INTO alinkedlist VALUES (
9,248,'248                             ','F114HB4X2HZ 330 CHASIS ÓMNIBUS',8,30,1,0x0000000010649d3a);
INSERT INTO alinkedlist VALUES (
9,249,'249                             ','F230 4X2',8,30,1,0x0000000010649d3b);
INSERT INTO alinkedlist VALUES (
9,250,'250                             ','F250 B4x2',8,30,1,0x0000000010649d3c);
INSERT INTO alinkedlist VALUES (
9,251,'251                             ','F310 B4x2',8,30,1,0x0000000010649d3d);
INSERT INTO alinkedlist VALUES (
9,252,'252                             ','F310 B6x2',8,30,1,0x0000000010649d3e);
INSERT INTO alinkedlist VALUES (
9,253,'253                             ','F94 HZ 310 HB 4X2',8,30,1,0x0000000010649d3f);
INSERT INTO alinkedlist VALUES (
9,254,'254                             ','F94HB4X2HZ 220 SERIE 4 OMNIBUS',8,30,1,0x0000000010649d40);
INSERT INTO alinkedlist VALUES (
9,255,'255                             ','F94HB4X2HZ 260 SERIE 4 OMNIBUS',8,30,1,0x0000000010649d41);
INSERT INTO alinkedlist VALUES (
9,256,'256                             ','K124 IB NA 360 6X2',8,30,1,0x0000000010649d42);
INSERT INTO alinkedlist VALUES (
9,257,'257                             ','K124 IB NA 360 8X2',8,30,1,0x0000000010649d43);
INSERT INTO alinkedlist VALUES (
9,258,'258                             ','K124IB6X2NB 380 CHASIS ÓMNIBUS',8,30,1,0x0000000010649d44);
INSERT INTO alinkedlist VALUES (
9,259,'259                             ','K124IB6X2NB380 OMNIBUS',8,30,1,0x0000000010649d45);
INSERT INTO alinkedlist VALUES (
9,260,'260                             ','K124IB8X2NB 380 CHASIS ÓMNIBUS',8,30,1,0x0000000010649d46);
INSERT INTO alinkedlist VALUES (
9,261,'261                             ','K310 4X2',8,30,1,0x0000000010649d47);
INSERT INTO alinkedlist VALUES (
9,262,'262                             ','K310 B4x2',8,30,1,0x0000000010649d48);
INSERT INTO alinkedlist VALUES (
9,263,'263                             ','K360 B4x2',8,30,1,0x0000000010649d49);
INSERT INTO alinkedlist VALUES (
9,264,'264                             ','K360 B6x2',8,30,1,0x0000000010649d4a);
INSERT INTO alinkedlist VALUES (
9,265,'265                             ','K380 4X2',8,30,1,0x0000000010649d4b);
INSERT INTO alinkedlist VALUES (
9,266,'266                             ','K380 8X2',8,30,1,0x0000000010649d4c);
INSERT INTO alinkedlist VALUES (
9,267,'267                             ','K380 B 6X2',8,30,1,0x0000000010649d4d);
INSERT INTO alinkedlist VALUES (
9,268,'268                             ','K380B CHASIS ÓMNIBUS 6X2*4',8,30,1,0x0000000010649d4e);
INSERT INTO alinkedlist VALUES (
9,269,'269                             ','K410 B6x2',8,30,1,0x0000000010649d4f);
INSERT INTO alinkedlist VALUES (
9,270,'270                             ','K410 B6x2*4',8,30,1,0x0000000010649d50);
INSERT INTO alinkedlist VALUES (
9,271,'271                             ','K410 B8x2',8,30,1,0x0000000010649d51);
INSERT INTO alinkedlist VALUES (
9,272,'272                             ','K420 B 6X2',8,30,1,0x0000000010649d52);
INSERT INTO alinkedlist VALUES (
9,273,'273                             ','K420 B 8X2',8,30,1,0x0000000010649d53);
INSERT INTO alinkedlist VALUES (
9,274,'274                             ','K94IB4X2NB 310 CHASIS ÓMNIBUS',8,30,1,0x0000000010649d54);
INSERT INTO alinkedlist VALUES (
9,275,'275                             ','LPO 1316',8,31,1,0x0000000010649d55);
INSERT INTO alinkedlist VALUES (
9,276,'276                             ','COASTER DIESEL',8,32,1,0x0000000010649d56);
INSERT INTO alinkedlist VALUES (
9,277,'277                             ','COASTER DIESEL 30 PAS A/C',8,32,1,0x0000000010649d57);
INSERT INTO alinkedlist VALUES (
9,278,'278                             ','COASTER DIESEL AC',8,32,1,0x0000000010649d58);
INSERT INTO alinkedlist VALUES (
9,279,'279                             ','COASTER HIGH ROOF DX',8,32,1,0x0000000010649d59);
INSERT INTO alinkedlist VALUES (
9,280,'280                             ','COASTER HIGH ROOF GX',8,32,1,0x0000000010649d5a);
INSERT INTO alinkedlist VALUES (
9,281,'281                             ','COASTER HIGH ROOF LX',8,32,1,0x0000000010649d5b);
INSERT INTO alinkedlist VALUES (
9,282,'282                             ','COASTER HIGH ROOF SU',8,32,1,0x0000000010649d5c);
INSERT INTO alinkedlist VALUES (
9,283,'283                             ','COASTER HIGH ROOF SUPER',8,32,1,0x0000000010649d5d);
INSERT INTO alinkedlist VALUES (
9,284,'284                             ','MILENIUM III-3',8,33,1,0x0000000010649d5e);
INSERT INTO alinkedlist VALUES (
9,285,'285                             ','MILENIUM III-4',8,33,1,0x0000000010649d5f);
INSERT INTO alinkedlist VALUES (
9,286,'286                             ','17.210',8,34,1,0x0000000010649d60);
INSERT INTO alinkedlist VALUES (
9,287,'287                             ','17.210 OD INTERPROVINCIAL',8,34,1,0x0000000010649d61);
INSERT INTO alinkedlist VALUES (
9,288,'288                             ','17.210 OD URBANO',8,34,1,0x0000000010649d62);
INSERT INTO alinkedlist VALUES (
9,289,'289                             ','17.210OD A',8,34,1,0x0000000010649d63);
INSERT INTO alinkedlist VALUES (
9,290,'290                             ','17.230 EOD',8,34,1,0x0000000010649d64);
INSERT INTO alinkedlist VALUES (
9,291,'291                             ','17.240',8,34,1,0x0000000010649d65);
INSERT INTO alinkedlist VALUES (
9,292,'292                             ','18.310 OT INTERPROVINCIAL',8,34,1,0x0000000010649d66);
INSERT INTO alinkedlist VALUES (
9,293,'293                             ','9.150',8,34,1,0x0000000010649d67);
INSERT INTO alinkedlist VALUES (
9,294,'294                             ','9.150 EOD',8,34,1,0x0000000010649d68);
INSERT INTO alinkedlist VALUES (
9,295,'295                             ','9.150 OD TURISMO',8,34,1,0x0000000010649d69);
INSERT INTO alinkedlist VALUES (
9,296,'296                             ','9.150 OD URBANO',8,34,1,0x0000000010649d6a);
INSERT INTO alinkedlist VALUES (
9,297,'297                             ','9.150OD A',8,34,1,0x0000000010649d6b);
INSERT INTO alinkedlist VALUES (
9,298,'298                             ','B10M EE 6250 / COSTERO BRASIL',8,35,1,0x0000000010649d6c);
INSERT INTO alinkedlist VALUES (
9,299,'299                             ','B10M EE 6250 / COSTERO NACIONAL',8,35,1,0x0000000010649d6d);
INSERT INTO alinkedlist VALUES (
9,300,'300                             ','B12B EE 3000',8,35,1,0x0000000010649d6e);
INSERT INTO alinkedlist VALUES (
9,301,'301                             ','B12R 4X2',8,35,1,0x0000000010649d6f);
INSERT INTO alinkedlist VALUES (
9,302,'302                             ','B12R 6X2',8,35,1,0x0000000010649d70);
INSERT INTO alinkedlist VALUES (
9,303,'303                             ','B12R MARK CARRETERA 6X2',8,35,1,0x0000000010649d71);
INSERT INTO alinkedlist VALUES (
9,304,'304                             ','B270F 4X2',8,35,1,0x0000000010649d72);
INSERT INTO alinkedlist VALUES (
9,305,'305                             ','B430R 6X2',8,35,1,0x0000000010649d73);
INSERT INTO alinkedlist VALUES (
9,306,'306                             ','B7F EE 6000',8,35,1,0x0000000010649d74);
INSERT INTO alinkedlist VALUES (
9,307,'307                             ','B7F EE 6500',8,35,1,0x0000000010649d75);
INSERT INTO alinkedlist VALUES (
9,308,'308                             ','B7R 4X2',8,35,1,0x0000000010649d76);
INSERT INTO alinkedlist VALUES (
9,309,'309                             ','B7R CARRETERA 4X2',8,35,1,0x0000000010649d77);
INSERT INTO alinkedlist VALUES (
9,310,'310                             ','B7R EE 6300 / COSTERO BRASIL',8,35,1,0x0000000010649d78);
INSERT INTO alinkedlist VALUES (
9,311,'311                             ','B7R EE 6300 / COSTERO NACIONAL',8,35,1,0x0000000010649d79);
INSERT INTO alinkedlist VALUES (
9,312,'312                             ','B7R EE 6300 T. PERSONAL',8,35,1,0x0000000010649d7a);
INSERT INTO alinkedlist VALUES (
9,313,'313                             ','B7R EE 6300 URBANO',8,35,1,0x0000000010649d7b);
INSERT INTO alinkedlist VALUES (
9,314,'314                             ','B7R URBANO 4X2 AUTOMÁTICO',8,35,1,0x0000000010649d7c);
INSERT INTO alinkedlist VALUES (
9,315,'315                             ','B7R URBANO 4X2 MECÁNICO',8,35,1,0x0000000010649d7d);
INSERT INTO alinkedlist VALUES (
9,316,'316                             ','B9R 4X2',8,35,1,0x0000000010649d7e);
INSERT INTO alinkedlist VALUES (
9,317,'317                             ','FDG6121BG OMNIBUS 4X2 GNV 36 ASIENT.',8,36,1,0x0000000010649d7f);
INSERT INTO alinkedlist VALUES (
9,318,'318                             ','FDG6126C3',8,36,1,0x0000000010649d80);
INSERT INTO alinkedlist VALUES (
9,319,'319                             ','JS6608T2',8,37,1,0x0000000010649d81);
INSERT INTO alinkedlist VALUES (
9,320,'320                             ','YBL6120GH OMNIBUS GNV 38 ASIEN',8,37,1,0x0000000010649d82);
INSERT INTO alinkedlist VALUES (
9,321,'321                             ','YCAE150-20 CH/MOT. 4X2 4.3 DIESE',8,38,1,0x0000000010649d83);
INSERT INTO alinkedlist VALUES (
9,322,'322                             ','ZGT6700',8,38,1,0x0000000010649d84);
INSERT INTO alinkedlist VALUES (
9,323,'323                             ','ZK6107HA',8,39,1,0x0000000010649d85);
INSERT INTO alinkedlist VALUES (
9,324,'324                             ','ZK6118 BUS URBANO DE 12 MTS GNV',8,39,1,0x0000000010649d86);
INSERT INTO alinkedlist VALUES (
9,325,'325                             ','ZK6118H URBANO 12MT D2',8,39,1,0x0000000010649d87);
INSERT INTO alinkedlist VALUES (
9,326,'326                             ','ZK6118H URBANO 12MT GNV',8,39,1,0x0000000010649d88);
INSERT INTO alinkedlist VALUES (
9,327,'327                             ','ZK6118HG BUS URBANO DE 12 MTS',8,39,1,0x0000000010649d89);
INSERT INTO alinkedlist VALUES (
9,328,'328                             ','ZK6118HG GNV URBANO DE 12 MTS',8,39,1,0x0000000010649d8a);
INSERT INTO alinkedlist VALUES (
9,329,'329                             ','ZK6129H INTERPROV EJES 2',8,39,1,0x0000000010649d8b);
INSERT INTO alinkedlist VALUES (
9,330,'330                             ','ZK6129H S BUS INTERPROVINCIAL DE 2 EJES',8,39,1,0x0000000010649d8c);
INSERT INTO alinkedlist VALUES (
9,331,'331                             ','ZK6147 F BUS INTERPROVINCIAL DE 3 EJES',8,39,1,0x0000000010649d8d);
INSERT INTO alinkedlist VALUES (
9,332,'332                             ','ZK6737 U D2 URBANO 7 MTS.',8,39,1,0x0000000010649d8e);
INSERT INTO alinkedlist VALUES (
9,333,'333                             ','ZK6737D BUS TURISTICO DE 7MTS',8,39,1,0x0000000010649d8f);
INSERT INTO alinkedlist VALUES (
9,334,'334                             ','ZK6831HE BUS TURISTICO DE 8MTS',8,39,1,0x0000000010649d90);
INSERT INTO alinkedlist VALUES (
9,335,'335                             ','ZK6831HE F BUS TURISTICO DE 8MTS CON ACCESORIOS',8,39,1,0x0000000010649d91);
INSERT INTO alinkedlist VALUES (
9,336,'336                             ','ZK6896 BUS URBANO DE 9 MTS GNV',8,39,1,0x0000000010649d92);
INSERT INTO alinkedlist VALUES (
9,337,'337                             ','ZK6896HG BUS URBANO DE 9 MTS',8,39,1,0x0000000010649d93);
INSERT INTO alinkedlist VALUES (
9,338,'338                             ','ZK6896HG URBANO 9MT GNV',8,39,1,0x0000000010649d94);
INSERT INTO alinkedlist VALUES (
9,339,'339                             ','LCK6605DK MINIBUS 4X2 19 ASIENT.',8,40,1,0x0000000010649d95);
INSERT INTO alinkedlist VALUES (
9,340,'340                             ','LCK6660D-1A OMNIBUS 4X2 26 ASIENT.',8,40,1,0x0000000010649d96);
INSERT INTO alinkedlist VALUES (
9,341,'341                             ','LCK666OD-1A TRIUMPH EQUIPO 26 PSJ. FULL',8,40,1,0x0000000010649d97);
INSERT INTO alinkedlist VALUES (
9,342,'342                             ','LCK666OD-1A TRIUMPH STANDARD 26 PSJ.',8,40,1,0x0000000010649d98);
INSERT INTO alinkedlist VALUES (
9,343,'343                             ','LCK66O5DK TRIUMPH EQUIPO 18 PSJ. FULL',8,40,1,0x0000000010649d99);
INSERT INTO alinkedlist VALUES (
9,344,'344                             ','LCK66O5DK TRIUMPH STANDARD 18 PSJ.',8,40,1,0x0000000010649d9a);
INSERT INTO alinkedlist VALUES (
9,345,'345                             ','LCK6720D3E STD MINIBUS',8,40,1,0x0000000010649d9b);
INSERT INTO alinkedlist VALUES (
9,346,'346                             ','LCK6750D3E',8,40,1,0x0000000010649d9c);
INSERT INTO alinkedlist VALUES (
9,347,'347                             ','LCK6890T',8,40,1,0x0000000010649d9d);
INSERT INTO alinkedlist VALUES (
9,348,'348                             ','LCK6910GC',8,40,1,0x0000000010649d9e);
INSERT INTO alinkedlist VALUES (
9,349,'349                             ','Top 43',8,40,1,0x0000000010649d9f);
INSERT INTO alinkedlist VALUES (
9,350,'350                             ','TRIUMPH 21',8,40,1,0x0000000010649da0);
INSERT INTO alinkedlist VALUES (
9,351,'351                             ','TRIUMPH 25',8,40,1,0x0000000010649da1);
INSERT INTO alinkedlist VALUES (
9,352,'352                             ','TRIUMPH 25 TURISMO',8,40,1,0x0000000010649da2);
INSERT INTO alinkedlist VALUES (
9,353,'353                             ','YCK6116HGL A 7',8,41,1,0x0000000010649da3);
INSERT INTO alinkedlist VALUES (
9,354,'354                             ','YCK6116HGL OMNIBUS 51 ASIENTOS',8,41,1,0x0000000010649da4);
INSERT INTO alinkedlist VALUES (
9,355,'356                             ','Otros',8,42,0,0x0000000010649da5);
INSERT INTO alinkedlist VALUES (
10,1,'1                               ','AUTOCRAFT',NULL,NULL,1,0x0000000010649da6);
INSERT INTO alinkedlist VALUES (
10,2,'2                               ','BAW',NULL,NULL,1,0x0000000010649da7);
INSERT INTO alinkedlist VALUES (
10,3,'3                               ','BEIBEN',NULL,NULL,1,0x0000000010649da8);
INSERT INTO alinkedlist VALUES (
10,4,'4                               ','CAKY',NULL,NULL,1,0x0000000010649da9);
INSERT INTO alinkedlist VALUES (
10,5,'5                               ','CAMC',NULL,NULL,1,0x0000000010649daa);
INSERT INTO alinkedlist VALUES (
10,6,'6                               ','CHANGAN',NULL,NULL,1,0x0000000010649dab);
INSERT INTO alinkedlist VALUES (
10,7,'7                               ','CHENGLONG',NULL,NULL,1,0x0000000010649dac);
INSERT INTO alinkedlist VALUES (
10,8,'8                               ','CHEVROLET',NULL,NULL,1,0x0000000010649dad);
INSERT INTO alinkedlist VALUES (
10,9,'9                               ','DAEWOO',NULL,NULL,1,0x0000000010649dae);
INSERT INTO alinkedlist VALUES (
10,10,'10                              ','DAIHATSU',NULL,NULL,1,0x0000000010649daf);
INSERT INTO alinkedlist VALUES (
10,11,'11                              ','DAYUN',NULL,NULL,1,0x0000000010649db0);
INSERT INTO alinkedlist VALUES (
10,12,'12                              ','DIMEX',NULL,NULL,1,0x0000000010649db1);
INSERT INTO alinkedlist VALUES (
10,13,'13                              ','DMC',NULL,NULL,1,0x0000000010649db2);
INSERT INTO alinkedlist VALUES (
10,14,'14                              ','DONG FENG',NULL,NULL,1,0x0000000010649db3);
INSERT INTO alinkedlist VALUES (
10,15,'15                              ','FAW',NULL,NULL,1,0x0000000010649db4);
INSERT INTO alinkedlist VALUES (
10,16,'16                              ','FORD',NULL,NULL,1,0x0000000010649db5);
INSERT INTO alinkedlist VALUES (
10,17,'17                              ','FORLAND',NULL,NULL,1,0x0000000010649db6);
INSERT INTO alinkedlist VALUES (
10,18,'18                              ','FOTON',NULL,NULL,1,0x0000000010649db7);
INSERT INTO alinkedlist VALUES (
10,19,'19                              ','FREIGHTLINER',NULL,NULL,1,0x0000000010649db8);
INSERT INTO alinkedlist VALUES (
10,20,'20                              ','HIGER',NULL,NULL,1,0x0000000010649db9);
INSERT INTO alinkedlist VALUES (
10,21,'21                              ','HINO',NULL,NULL,1,0x0000000010649dba);
INSERT INTO alinkedlist VALUES (
10,22,'22                              ','HOWO',NULL,NULL,1,0x0000000010649dbb);
INSERT INTO alinkedlist VALUES (
10,23,'23                              ','HYUNDAI',NULL,NULL,1,0x0000000010649dbc);
INSERT INTO alinkedlist VALUES (
10,24,'24                              ','INCAPOWER',NULL,NULL,1,0x0000000010649dbd);
INSERT INTO alinkedlist VALUES (
10,25,'25                              ','INTERNATIONAL',NULL,NULL,1,0x0000000010649dbe);
INSERT INTO alinkedlist VALUES (
10,26,'26                              ','ISUZU',NULL,NULL,1,0x0000000010649dbf);
INSERT INTO alinkedlist VALUES (
10,27,'27                              ','IVECO',NULL,NULL,1,0x0000000010649dc0);
INSERT INTO alinkedlist VALUES (
10,28,'28                              ','JAC',NULL,NULL,1,0x0000000010649dc1);
INSERT INTO alinkedlist VALUES (
10,29,'29                              ','JINBEI',NULL,NULL,1,0x0000000010649dc2);
INSERT INTO alinkedlist VALUES (
10,30,'30                              ','JMC',NULL,NULL,1,0x0000000010649dc3);
INSERT INTO alinkedlist VALUES (
10,31,'31                              ','KAMA',NULL,NULL,1,0x0000000010649dc4);
INSERT INTO alinkedlist VALUES (
10,32,'32                              ','KAMAZ',NULL,NULL,1,0x0000000010649dc5);
INSERT INTO alinkedlist VALUES (
10,33,'33                              ','KENWORTH',NULL,NULL,1,0x0000000010649dc6);
INSERT INTO alinkedlist VALUES (
10,34,'34                              ','KIA',NULL,NULL,1,0x0000000010649dc7);
INSERT INTO alinkedlist VALUES (
10,35,'35                              ','LUWANG',NULL,NULL,1,0x0000000010649dc8);
INSERT INTO alinkedlist VALUES (
10,36,'36                              ','MACK',NULL,NULL,1,0x0000000010649dc9);
INSERT INTO alinkedlist VALUES (
10,37,'37                              ','MAN',NULL,NULL,1,0x0000000010649dca);
INSERT INTO alinkedlist VALUES (
10,38,'38                              ','MAZDA',NULL,NULL,1,0x0000000010649dcb);
INSERT INTO alinkedlist VALUES (
10,39,'39                              ','MERCEDES BENZ',NULL,NULL,1,0x0000000010649dcc);
INSERT INTO alinkedlist VALUES (
10,40,'40                              ','MITSUBISHI FUSO',NULL,NULL,1,0x0000000010649dcd);
INSERT INTO alinkedlist VALUES (
10,41,'41                              ','MUDAN',NULL,NULL,1,0x0000000010649dce);
INSERT INTO alinkedlist VALUES (
10,42,'42                              ','NISSAN',NULL,NULL,1,0x0000000010649dcf);
INSERT INTO alinkedlist VALUES (
10,43,'43                              ','NORTH BENZ',NULL,NULL,1,0x0000000010649dd0);
INSERT INTO alinkedlist VALUES (
10,44,'44                              ','PETERBILT',NULL,NULL,1,0x0000000010649dd1);
INSERT INTO alinkedlist VALUES (
10,45,'45                              ','QINGQI',NULL,NULL,1,0x0000000010649dd2);
INSERT INTO alinkedlist VALUES (
10,46,'46                              ','RENAULT',NULL,NULL,1,0x0000000010649dd3);
INSERT INTO alinkedlist VALUES (
10,47,'47                              ','SCANIA',NULL,NULL,1,0x0000000010649dd4);
INSERT INTO alinkedlist VALUES (
10,48,'48                              ','SHAANXI HEAVY',NULL,NULL,1,0x0000000010649dd5);
INSERT INTO alinkedlist VALUES (
10,49,'49                              ','SHACMAN',NULL,NULL,1,0x0000000010649dd6);
INSERT INTO alinkedlist VALUES (
10,50,'50                              ','SHAZHOU',NULL,NULL,1,0x0000000010649dd7);
INSERT INTO alinkedlist VALUES (
10,51,'51                              ','SHIFENG',NULL,NULL,1,0x0000000010649dd8);
INSERT INTO alinkedlist VALUES (
10,52,'52                              ','SINOTRUK',NULL,NULL,1,0x0000000010649dd9);
INSERT INTO alinkedlist VALUES (
10,53,'53                              ','SITOM',NULL,NULL,1,0x0000000010649dda);
INSERT INTO alinkedlist VALUES (
10,54,'54                              ','STRONG',NULL,NULL,1,0x0000000010649ddb);
INSERT INTO alinkedlist VALUES (
10,55,'55                              ','TOYOTA',NULL,NULL,1,0x0000000010649ddc);
INSERT INTO alinkedlist VALUES (
10,56,'56                              ','VOLKSWAGEN',NULL,NULL,1,0x0000000010649ddd);
INSERT INTO alinkedlist VALUES (
10,57,'57                              ','VOLLAND',NULL,NULL,1,0x0000000010649dde);
INSERT INTO alinkedlist VALUES (
10,58,'58                              ','VOLVO',NULL,NULL,1,0x0000000010649ddf);
INSERT INTO alinkedlist VALUES (
10,59,'59                              ','WARRIOR',NULL,NULL,1,0x0000000010649de0);
INSERT INTO alinkedlist VALUES (
10,60,'60                              ','XCMG',NULL,NULL,1,0x0000000010649de1);
INSERT INTO alinkedlist VALUES (
10,61,'61                              ','XINKAI',NULL,NULL,1,0x0000000010649de2);
INSERT INTO alinkedlist VALUES (
10,62,'62                              ','YUEJIN',NULL,NULL,1,0x0000000010649de3);
INSERT INTO alinkedlist VALUES (
10,63,'63                              ','ZHONG YOU',NULL,NULL,1,0x0000000010649de4);
INSERT INTO alinkedlist VALUES (
10,64,'64                              ','Otros',NULL,NULL,0,0x0000000010649de5);
INSERT INTO alinkedlist VALUES (
11,1,'1                               ','EXOR',10,1,1,0x0000000010649de6);
INSERT INTO alinkedlist VALUES (
11,2,'2                               ','EXOR 6.0',10,1,1,0x0000000010649de7);
INSERT INTO alinkedlist VALUES (
11,3,'3                               ','BJ1044P4L5Y 4.5PBV BARANDA C/S',10,2,1,0x0000000010649de8);
INSERT INTO alinkedlist VALUES (
11,4,'4                               ','BJ1044P4L5Y CAMIÓN 2.00 TN',10,2,1,0x0000000010649de9);
INSERT INTO alinkedlist VALUES (
11,5,'5                               ','BJ1065P6L6Y BARANDA 4X2',10,2,1,0x0000000010649dea);
INSERT INTO alinkedlist VALUES (
11,6,'6                               ','BJ1065P6L6Y BARANDA 4X2 6.4T PBV',10,2,1,0x0000000010649deb);
INSERT INTO alinkedlist VALUES (
11,7,'7                               ','BJ1065P6L6Y CAMIÓN 3.00 TN',10,2,1,0x0000000010649dec);
INSERT INTO alinkedlist VALUES (
11,8,'8                               ','BJ1086P8L8F BARANDA 4X2',10,2,1,0x0000000010649ded);
INSERT INTO alinkedlist VALUES (
11,9,'9                               ','BJ1086P8L8F CAMIÓN 4.00 TN',10,2,1,0x0000000010649dee);
INSERT INTO alinkedlist VALUES (
11,10,'10                              ','BJ1086P8L8F REBATIBL 8.2PBV BARANDA 4X2',10,2,1,0x0000000010649def);
INSERT INTO alinkedlist VALUES (
11,11,'11                              ','INCAPOWER B100',10,2,1,0x0000000010649df0);
INSERT INTO alinkedlist VALUES (
11,12,'12                              ','INCAPOWER B30',10,2,1,0x0000000010649df1);
INSERT INTO alinkedlist VALUES (
11,13,'13                              ','INCAPOWER B40',10,2,1,0x0000000010649df2);
INSERT INTO alinkedlist VALUES (
11,14,'14                              ','INCAPOWER B50',10,2,1,0x0000000010649df3);
INSERT INTO alinkedlist VALUES (
11,15,'15                              ','INCAPOWER B60',10,2,1,0x0000000010649df4);
INSERT INTO alinkedlist VALUES (
11,16,'16                              ','N.B INC. 2538K',10,3,1,0x0000000010649df5);
INSERT INTO alinkedlist VALUES (
11,17,'17                              ','SC1040D',10,4,1,0x0000000010649df6);
INSERT INTO alinkedlist VALUES (
11,18,'18                              ','SC3040W',10,4,1,0x0000000010649df7);
INSERT INTO alinkedlist VALUES (
11,19,'19                              ','HN1250P38E8M3J CH-375',10,5,1,0x0000000010649df8);
INSERT INTO alinkedlist VALUES (
11,20,'20                              ','HN3230P38D1M3',10,5,1,0x0000000010649df9);
INSERT INTO alinkedlist VALUES (
11,21,'21                              ','HN3250P35C6M3',10,5,1,0x0000000010649dfa);
INSERT INTO alinkedlist VALUES (
11,22,'22                              ','HN3250P35C6M3 V-375-1',10,5,1,0x0000000010649dfb);
INSERT INTO alinkedlist VALUES (
11,23,'23                              ','HN3310P37C3M3 V-420',10,5,1,0x0000000010649dfc);
INSERT INTO alinkedlist VALUES (
11,24,'24                              ','HN4250G37CLM3 T-420',10,5,1,0x0000000010649dfd);
INSERT INTO alinkedlist VALUES (
11,25,'25                              ','HN4250HP40C2M3 T-420',10,5,1,0x0000000010649dfe);
INSERT INTO alinkedlist VALUES (
11,26,'26                              ','HN5250P35C6M3GJB M-340',10,5,1,0x0000000010649dff);
INSERT INTO alinkedlist VALUES (
11,27,'27                              ','HN5250P35C6M3GJB M-350',10,5,1,0x0000000010649e01);
INSERT INTO alinkedlist VALUES (
11,28,'28                              ','HN5250P35C6M3GJB M-380',10,5,1,0x0000000010649e02);
INSERT INTO alinkedlist VALUES (
11,29,'29                              ','T-420',10,5,1,0x0000000010649e03);
INSERT INTO alinkedlist VALUES (
11,30,'30                              ','SD1030D',10,6,1,0x0000000010649e04);
INSERT INTO alinkedlist VALUES (
11,31,'31                              ','SD1040D',10,6,1,0x0000000010649e05);
INSERT INTO alinkedlist VALUES (
11,32,'32                              ','EQ3259GE3',10,7,1,0x0000000010649e06);
INSERT INTO alinkedlist VALUES (
11,33,'33                              ','14,000 (D-70) 9 TN',10,8,1,0x0000000010649e07);
INSERT INTO alinkedlist VALUES (
11,34,'34                              ','BRIGADIER 6X4 18 TN',10,8,1,0x0000000010649e08);
INSERT INTO alinkedlist VALUES (
11,35,'35                              ','BRIGADIER 6X4 28 TN',10,8,1,0x0000000010649e09);
INSERT INTO alinkedlist VALUES (
11,36,'36                              ','FSR',10,8,1,0x0000000010649e0a);
INSERT INTO alinkedlist VALUES (
11,37,'37                              ','FSR-32',10,8,1,0x0000000010649e0b);
INSERT INTO alinkedlist VALUES (
11,38,'38                              ','FVR',10,8,1,0x0000000010649e0c);
INSERT INTO alinkedlist VALUES (
11,39,'39                              ','FVR- 32 ML (4X2)',10,8,1,0x0000000010649e0d);
INSERT INTO alinkedlist VALUES (
11,40,'40                              ','FVR- 32 ML (6X2)',10,8,1,0x0000000010649e0e);
INSERT INTO alinkedlist VALUES (
11,41,'41                              ','FVR 32ML',10,8,1,0x0000000010649e0f);
INSERT INTO alinkedlist VALUES (
11,42,'42                              ','KODIAC 4X2 11 TN',10,8,1,0x0000000010649e10);
INSERT INTO alinkedlist VALUES (
11,43,'43                              ','KODIAC 6X4 18 TN',10,8,1,0x0000000010649e11);
INSERT INTO alinkedlist VALUES (
11,44,'44                              ','KODIAK',10,8,1,0x0000000010649e12);
INSERT INTO alinkedlist VALUES (
11,45,'45                              ','NKR',10,8,1,0x0000000010649e13);
INSERT INTO alinkedlist VALUES (
11,46,'46                              ','NKR 3.5 TN',10,8,1,0x0000000010649e14);
INSERT INTO alinkedlist VALUES (
11,47,'47                              ','NKR RUEDA SIMPLE',10,8,1,0x0000000010649e15);
INSERT INTO alinkedlist VALUES (
11,48,'48                              ','NKR5 5E',10,8,1,0x0000000010649e16);
INSERT INTO alinkedlist VALUES (
11,49,'49                              ','NKR55EL-1EXY',10,8,1,0x0000000010649e17);
INSERT INTO alinkedlist VALUES (
11,50,'50                              ','NPR',10,8,1,0x0000000010649e18);
INSERT INTO alinkedlist VALUES (
11,51,'51                              ','NPR 1',10,8,1,0x0000000010649e19);
INSERT INTO alinkedlist VALUES (
11,52,'52                              ','NPR 4.5 TN',10,8,1,0x0000000010649e1a);
INSERT INTO alinkedlist VALUES (
11,53,'53                              ','NPR 4.8 TN',10,8,1,0x0000000010649e1b);
INSERT INTO alinkedlist VALUES (
11,54,'54                              ','NPR-70P',10,8,1,0x0000000010649e1c);
INSERT INTO alinkedlist VALUES (
11,55,'55                              ','2,000',10,9,1,0x0000000010649e1d);
INSERT INTO alinkedlist VALUES (
11,56,'56                              ','K6DVF CH/CAB 6X4',10,9,1,0x0000000010649e1e);
INSERT INTO alinkedlist VALUES (
11,57,'57                              ','N7DVF CH/CAB',10,9,1,0x0000000010649e1f);
INSERT INTO alinkedlist VALUES (
11,58,'58                              ','NOVUS 7542 REMOLCADOR',10,9,1,0x0000000010649e20);
INSERT INTO alinkedlist VALUES (
11,59,'59                              ','V3TVF REMOLCADOR 6X4',10,9,1,0x0000000010649e21);
INSERT INTO alinkedlist VALUES (
11,60,'60                              ','DELTA 250',10,10,1,0x0000000010649e22);
INSERT INTO alinkedlist VALUES (
11,61,'61                              ','DELTA 300',10,10,1,0x0000000010649e23);
INSERT INTO alinkedlist VALUES (
11,62,'62                              ','DELTA 300 4X2',10,10,1,0x0000000010649e24);
INSERT INTO alinkedlist VALUES (
11,63,'63                              ','DELTA 300 TOLVA REBATIBLE',10,10,1,0x0000000010649e25);
INSERT INTO alinkedlist VALUES (
11,64,'64                              ','DELTA 400',10,10,1,0x0000000010649e26);
INSERT INTO alinkedlist VALUES (
11,65,'65                              ','DYX3251',10,11,1,0x0000000010649e27);
INSERT INTO alinkedlist VALUES (
11,66,'66                              ','451 9 TN.',10,12,1,0x0000000010649e28);
INSERT INTO alinkedlist VALUES (
11,67,'67                              ','551 11 TN.',10,12,1,0x0000000010649e29);
INSERT INTO alinkedlist VALUES (
11,68,'68                              ','551 190/195',10,12,1,0x0000000010649e2a);
INSERT INTO alinkedlist VALUES (
11,69,'69                              ','551 6 M3 V',10,12,1,0x0000000010649e2b);
INSERT INTO alinkedlist VALUES (
11,70,'70                              ','650-195-70',10,12,1,0x0000000010649e2c);
INSERT INTO alinkedlist VALUES (
11,71,'71                              ','740 10 M3 V',10,12,1,0x0000000010649e2d);
INSERT INTO alinkedlist VALUES (
11,72,'72                              ','740 14 M3 V',10,12,1,0x0000000010649e2e);
INSERT INTO alinkedlist VALUES (
11,73,'73                              ','740 18 TN',10,12,1,0x0000000010649e2f);
INSERT INTO alinkedlist VALUES (
11,74,'74                              ','7400 TRACTO 370 HP',10,12,1,0x0000000010649e30);
INSERT INTO alinkedlist VALUES (
11,75,'75                              ','771-250/300',10,12,1,0x0000000010649e31);
INSERT INTO alinkedlist VALUES (
11,76,'76                              ','776-330',10,12,1,0x0000000010649e32);
INSERT INTO alinkedlist VALUES (
11,77,'77                              ','776-435',10,12,1,0x0000000010649e33);
INSERT INTO alinkedlist VALUES (
11,78,'78                              ','9100 TRACTO 370 HP',10,12,1,0x0000000010649e34);
INSERT INTO alinkedlist VALUES (
11,79,'79                              ','9100 TRACTO 435 HP',10,12,1,0x0000000010649e35);
INSERT INTO alinkedlist VALUES (
11,80,'80                              ','9400 TRACTO 435HP',10,12,1,0x0000000010649e36);
INSERT INTO alinkedlist VALUES (
11,81,'81                              ','971-435',10,12,1,0x0000000010649e37);
INSERT INTO alinkedlist VALUES (
11,82,'82                              ','D16-195',10,12,1,0x0000000010649e38);
INSERT INTO alinkedlist VALUES (
11,83,'83                              ','DYX3251',10,13,1,0x0000000010649e39);
INSERT INTO alinkedlist VALUES (
11,84,'84                              ','C42-712',10,14,1,0x0000000010649e3a);
INSERT INTO alinkedlist VALUES (
11,85,'85                              ','CLW5090GJY3',10,14,1,0x0000000010649e3b);
INSERT INTO alinkedlist VALUES (
11,86,'86                              ','CSC5258GSSE',10,14,1,0x0000000010649e3c);
INSERT INTO alinkedlist VALUES (
11,87,'87                              ','DF3053',10,14,1,0x0000000010649e3d);
INSERT INTO alinkedlist VALUES (
11,88,'88                              ','DFA1063DJ10 1063DJ10 CHASIS CABINA',10,14,1,0x0000000010649e3e);
INSERT INTO alinkedlist VALUES (
11,89,'89                              ','DFA1063DJ10 OLIMPIC 8 8',10,14,1,0x0000000010649e3f);
INSERT INTO alinkedlist VALUES (
11,90,'90                              ','DFA1065 OLIMPIC 8.5',10,14,1,0x0000000010649e40);
INSERT INTO alinkedlist VALUES (
11,91,'91                              ','DFA1065TZ5BD3',10,14,1,0x0000000010649e41);
INSERT INTO alinkedlist VALUES (
11,92,'92                              ','DFA1101GZ5AD6 1101GZ5AD6 BARANDA',10,14,1,0x0000000010649e42);
INSERT INTO alinkedlist VALUES (
11,93,'93                              ','DFA1101TZ5AD6 OLIMPIC 10',10,14,1,0x0000000010649e43);
INSERT INTO alinkedlist VALUES (
11,94,'94                              ','DFA1102 OLIMPIC 10.5',10,14,1,0x0000000010649e44);
INSERT INTO alinkedlist VALUES (
11,95,'95                              ','DFA1102GZ5AD6',10,14,1,0x0000000010649e45);
INSERT INTO alinkedlist VALUES (
11,96,'96                              ','DFA1121GZ6AD7',10,14,1,0x0000000010649e46);
INSERT INTO alinkedlist VALUES (
11,97,'97                              ','DFL 1140B',10,14,1,0x0000000010649e47);
INSERT INTO alinkedlist VALUES (
11,98,'98                              ','DFL1120B',10,14,1,0x0000000010649e48);
INSERT INTO alinkedlist VALUES (
11,99,'99                              ','DFL1140B KINGRUN 17',10,14,1,0x0000000010649e49);
INSERT INTO alinkedlist VALUES (
11,100,'100                             ','DFL1160',10,14,1,0x0000000010649e4a);
INSERT INTO alinkedlist VALUES (
11,101,'101                             ','DFL1250A',10,14,1,0x0000000010649e4b);
INSERT INTO alinkedlist VALUES (
11,102,'102                             ','DFL3160',10,14,1,0x0000000010649e4c);
INSERT INTO alinkedlist VALUES (
11,103,'103                             ','DFL3251A 3251A VOLQUETE',10,14,1,0x0000000010649e4d);
INSERT INTO alinkedlist VALUES (
11,104,'104                             ','DFL3251A1',10,14,1,0x0000000010649e4e);
INSERT INTO alinkedlist VALUES (
11,105,'105                             ','DFL3251A1 T-LIFT-17M3',10,14,1,0x0000000010649e4f);
INSERT INTO alinkedlist VALUES (
11,106,'106                             ','DFL4181A 4181A REMOLCADOR',10,14,1,0x0000000010649e50);
INSERT INTO alinkedlist VALUES (
11,107,'107                             ','DFL4251A 4251A REMOLCADOR',10,14,1,0x0000000010649e51);
INSERT INTO alinkedlist VALUES (
11,108,'108                             ','DFL4251A10 KINLAND 8X4',10,14,1,0x0000000010649e52);
INSERT INTO alinkedlist VALUES (
11,109,'109                             ','DFL4251A8 KINLAND 6X4',10,14,1,0x0000000010649e53);
INSERT INTO alinkedlist VALUES (
11,110,'110                             ','DFL4251A-930 KINLAND 6X4',10,14,1,0x0000000010649e54);
INSERT INTO alinkedlist VALUES (
11,111,'111                             ','E32-501 DF-610',10,14,1,0x0000000010649e55);
INSERT INTO alinkedlist VALUES (
11,112,'112                             ','E32-501 OLIMPIC 5',10,14,1,0x0000000010649e56);
INSERT INTO alinkedlist VALUES (
11,113,'113                             ','E33-861',10,14,1,0x0000000010649e57);
INSERT INTO alinkedlist VALUES (
11,114,'114                             ','EQ1146G1 CAMION 4X2',10,14,1,0x0000000010649e58);
INSERT INTO alinkedlist VALUES (
11,115,'115                             ','EQ1146GJ CAMION CISTERNA 4X2',10,14,1,0x0000000010649e59);
INSERT INTO alinkedlist VALUES (
11,116,'116                             ','EQ3252GT7',10,14,1,0x0000000010649e5a);
INSERT INTO alinkedlist VALUES (
11,117,'117                             ','H01-121 CAPTAIN 714',10,14,1,0x0000000010649e5b);
INSERT INTO alinkedlist VALUES (
11,118,'118                             ','KINGRUN 1.4 DFL1120B',10,14,1,0x0000000010649e5c);
INSERT INTO alinkedlist VALUES (
11,119,'119                             ','KINGRUN 1.6 DFL1120B',10,14,1,0x0000000010649e5d);
INSERT INTO alinkedlist VALUES (
11,120,'120                             ','KINGRUN 1.6 DFL1140',10,14,1,0x0000000010649e5e);
INSERT INTO alinkedlist VALUES (
11,121,'121                             ','KINLAND DFL4181A 4X2',10,14,1,0x0000000010649e5f);
INSERT INTO alinkedlist VALUES (
11,122,'122                             ','KINLAND DFL4251A 6X4',10,14,1,0x0000000010649e60);
INSERT INTO alinkedlist VALUES (
11,123,'123                             ','OLIMPIC 10 (CAB SIMPLE) DFA1101TZ5AD6',10,14,1,0x0000000010649e61);
INSERT INTO alinkedlist VALUES (
11,124,'124                             ','OLIMPIC 10 DFA1101GZ5AD6 (SUPER CAB)',10,14,1,0x0000000010649e62);
INSERT INTO alinkedlist VALUES (
11,125,'125                             ','OLIMPIC 13.5 DFA1121GZ6AD7',10,14,1,0x0000000010649e63);
INSERT INTO alinkedlist VALUES (
11,126,'126                             ','OLIMPIC 14 DFA1121GZ6AD7',10,14,1,0x0000000010649e64);
INSERT INTO alinkedlist VALUES (
11,127,'127                             ','OLIMPIC 17 Z38-002',10,14,1,0x0000000010649e65);
INSERT INTO alinkedlist VALUES (
11,128,'128                             ','OLIMPIC 5 JINBA E32-501',10,14,1,0x0000000010649e66);
INSERT INTO alinkedlist VALUES (
11,129,'129                             ','OLIMPIC 8 DFA1063DJ10',10,14,1,0x0000000010649e67);
INSERT INTO alinkedlist VALUES (
11,130,'130                             ','OLIMPIC 8.5 DFA1065TZ5BD3',10,14,1,0x0000000010649e68);
INSERT INTO alinkedlist VALUES (
11,131,'131                             ','OLIMPIC DFA1102GZAD6 10.5',10,14,1,0x0000000010649e69);
INSERT INTO alinkedlist VALUES (
11,132,'132                             ','Q22-801 DF- 410',10,14,1,0x0000000010649e6a);
INSERT INTO alinkedlist VALUES (
11,133,'133                             ','T-LIFT DFL3251A 6X4',10,14,1,0x0000000010649e6b);
INSERT INTO alinkedlist VALUES (
11,134,'134                             ','V4 DF-3042',10,14,1,0x0000000010649e6c);
INSERT INTO alinkedlist VALUES (
11,135,'135                             ','V6 DF-3053',10,14,1,0x0000000010649e6d);
INSERT INTO alinkedlist VALUES (
11,136,'136                             ','Z38-002 CHASIS CABINA',10,14,1,0x0000000010649e6e);
INSERT INTO alinkedlist VALUES (
11,137,'137                             ','CA1075PK2A81',10,15,1,0x0000000010649e6f);
INSERT INTO alinkedlist VALUES (
11,138,'138                             ','CA1083P9K2L1EA80',10,15,1,0x0000000010649e70);
INSERT INTO alinkedlist VALUES (
11,139,'139                             ','CA1161P1K2L2A80',10,15,1,0x0000000010649e71);
INSERT INTO alinkedlist VALUES (
11,140,'140                             ','CA1258P1K2L1171',10,15,1,0x0000000010649e72);
INSERT INTO alinkedlist VALUES (
11,141,'141                             ','CA3256P2K2T1A80',10,15,1,0x0000000010649e73);
INSERT INTO alinkedlist VALUES (
11,142,'142                             ','CA3256P2K2T1EA81',10,15,1,0x0000000010649e74);
INSERT INTO alinkedlist VALUES (
11,143,'143                             ','CA3300P2K2L1T4EA80',10,15,1,0x0000000010649e75);
INSERT INTO alinkedlist VALUES (
11,144,'144                             ','CA4258P2K2T1A80 REMOLCADOR 6X4',10,15,1,0x0000000010649e76);
INSERT INTO alinkedlist VALUES (
11,145,'145                             ','CA5083',10,15,1,0x0000000010649e77);
INSERT INTO alinkedlist VALUES (
11,146,'146                             ','CA5083XXXYK28',10,15,1,0x0000000010649e78);
INSERT INTO alinkedlist VALUES (
11,147,'147                             ','HALF ROUND 6X4',10,15,1,0x0000000010649e79);
INSERT INTO alinkedlist VALUES (
11,148,'148                             ','HALF ROUND 8X4',10,15,1,0x0000000010649e7a);
INSERT INTO alinkedlist VALUES (
11,149,'149                             ','915',10,16,1,0x0000000010649e7b);
INSERT INTO alinkedlist VALUES (
11,150,'150                             ','1,721',10,16,1,0x0000000010649e7c);
INSERT INTO alinkedlist VALUES (
11,151,'151                             ','2631 CORTO',10,16,1,0x0000000010649e7d);
INSERT INTO alinkedlist VALUES (
11,152,'152                             ','2631 LARGO',10,16,1,0x0000000010649e7e);
INSERT INTO alinkedlist VALUES (
11,153,'153                             ','CARGO 1622',10,16,1,0x0000000010649e7f);
INSERT INTO alinkedlist VALUES (
11,154,'154                             ','CARGO 2630',10,16,1,0x0000000010649e80);
INSERT INTO alinkedlist VALUES (
11,155,'155                             ','F-350 XL 4X4',10,16,1,0x0000000010649e81);
INSERT INTO alinkedlist VALUES (
11,156,'156                             ','F-800 160 HP 8 TN.',10,16,1,0x0000000010649e82);
INSERT INTO alinkedlist VALUES (
11,157,'157                             ','F-800 190 HP',10,16,1,0x0000000010649e83);
INSERT INTO alinkedlist VALUES (
11,158,'158                             ','F-800 210 HP 11 TN.',10,16,1,0x0000000010649e84);
INSERT INTO alinkedlist VALUES (
11,159,'159                             ','F-800 DEE 189\"',10,16,1,0x0000000010649e85);
INSERT INTO alinkedlist VALUES (
11,160,'160                             ','F-800 DEE 214\"',10,16,1,0x0000000010649e86);
INSERT INTO alinkedlist VALUES (
11,161,'161                             ','F-800 VOLQUETE 190 HP',10,16,1,0x0000000010649e87);
INSERT INTO alinkedlist VALUES (
11,162,'162                             ','F-800 VOLQUETE 250 HP',10,16,1,0x0000000010649e88);
INSERT INTO alinkedlist VALUES (
11,163,'163                             ','F-SUPER DUTY 210 HP 4 TN.',10,16,1,0x0000000010649e89);
INSERT INTO alinkedlist VALUES (
11,164,'164                             ','F-SUPER DUTY DEE 185\"',10,16,1,0x0000000010649e8a);
INSERT INTO alinkedlist VALUES (
11,165,'165                             ','FT-900 250 HP 17 TN.',10,16,1,0x0000000010649e8b);
INSERT INTO alinkedlist VALUES (
11,166,'166                             ','FT-900 DEE 238\"',10,16,1,0x0000000010649e8c);
INSERT INTO alinkedlist VALUES (
11,167,'167                             ','FT-900 VOLQUETE 250 HP',10,16,1,0x0000000010649e8d);
INSERT INTO alinkedlist VALUES (
11,168,'168                             ','LNT-8000 10M3 VOLQUETE',10,16,1,0x0000000010649e8e);
INSERT INTO alinkedlist VALUES (
11,169,'169                             ','LNT-8000 TRACTO 6X4',10,16,1,0x0000000010649e8f);
INSERT INTO alinkedlist VALUES (
11,170,'170                             ','LOUISVILLE DEE 172\"',10,16,1,0x0000000010649e90);
INSERT INTO alinkedlist VALUES (
11,171,'171                             ','LOUISVILLE DEE 196\"',10,16,1,0x0000000010649e91);
INSERT INTO alinkedlist VALUES (
11,172,'172                             ','LTS-9000 12M3 VOLQUETE 6X4 360 HP',10,16,1,0x0000000010649e92);
INSERT INTO alinkedlist VALUES (
11,173,'173                             ','LTS-9000 DEE 167\"',10,16,1,0x0000000010649e93);
INSERT INTO alinkedlist VALUES (
11,174,'174                             ','LTS-9000 TRACTO 6X4 300 HP',10,16,1,0x0000000010649e94);
INSERT INTO alinkedlist VALUES (
11,175,'175                             ','LTS-9000 TRACTO 6X4 365 HP',10,16,1,0x0000000010649e95);
INSERT INTO alinkedlist VALUES (
11,176,'176                             ','LTS-9000 TRACTO 6X4 430 HP',10,16,1,0x0000000010649e96);
INSERT INTO alinkedlist VALUES (
11,177,'177                             ','LTS-9000 VOLQUETE 6X4 360 HP',10,16,1,0x0000000010649e97);
INSERT INTO alinkedlist VALUES (
11,178,'178                             ','BJ1020 CARGA',10,17,1,0x0000000010649e98);
INSERT INTO alinkedlist VALUES (
11,179,'179                             ','BJ1041',10,17,1,0x0000000010649e99);
INSERT INTO alinkedlist VALUES (
11,180,'180                             ','BJ1043',10,17,1,0x0000000010649e9a);
INSERT INTO alinkedlist VALUES (
11,181,'181                             ','BJ1063',10,17,1,0x0000000010649e9b);
INSERT INTO alinkedlist VALUES (
11,182,'182                             ','BJ1063VCJFA -1',10,17,1,0x0000000010649e9c);
INSERT INTO alinkedlist VALUES (
11,183,'183                             ','FD 25 BJ3042V3PBB-B1',10,17,1,0x0000000010649e9d);
INSERT INTO alinkedlist VALUES (
11,184,'184                             ','INC F110 BJ5122V5PDC-A1',10,17,1,0x0000000010649e9e);
INSERT INTO alinkedlist VALUES (
11,185,'185                             ','INC F130 BJ5122V5PDC-1',10,17,1,0x0000000010649e9f);
INSERT INTO alinkedlist VALUES (
11,186,'186                             ','INC F45 BJ1059VCJD-3',10,17,1,0x0000000010649ea0);
INSERT INTO alinkedlist VALUES (
11,187,'187                             ','INC FD150 BJ3248DLPJE-S',10,17,1,0x0000000010649ea1);
INSERT INTO alinkedlist VALUES (
11,188,'188                             ','INC FD60 BJ3062V3PDB-B2',10,17,1,0x0000000010649ea2);
INSERT INTO alinkedlist VALUES (
11,189,'189                             ','INC FD80 BJ3062V3PDB-B3',10,17,1,0x0000000010649ea3);
INSERT INTO alinkedlist VALUES (
11,190,'190                             ','INCAPOWER',10,17,1,0x0000000010649ea4);
INSERT INTO alinkedlist VALUES (
11,191,'191                             ','INCAPOWER F 110',10,17,1,0x0000000010649ea5);
INSERT INTO alinkedlist VALUES (
11,192,'192                             ','INCAPOWER F100',10,17,1,0x0000000010649ea6);
INSERT INTO alinkedlist VALUES (
11,193,'193                             ','INCAPOWER F100-CB',10,17,1,0x0000000010649ea7);
INSERT INTO alinkedlist VALUES (
11,194,'194                             ','INCAPOWER F130',10,17,1,0x0000000010649ea8);
INSERT INTO alinkedlist VALUES (
11,195,'195                             ','INCAPOWER F130-CB',10,17,1,0x0000000010649ea9);
INSERT INTO alinkedlist VALUES (
11,196,'196                             ','INCAPOWER F40',10,17,1,0x0000000010649eaa);
INSERT INTO alinkedlist VALUES (
11,197,'197                             ','INCAPOWER F40-CB',10,17,1,0x0000000010649eab);
INSERT INTO alinkedlist VALUES (
11,198,'198                             ','INCAPOWER F45',10,17,1,0x0000000010649eac);
INSERT INTO alinkedlist VALUES (
11,199,'199                             ','INCAPOWER F65',10,17,1,0x0000000010649ead);
INSERT INTO alinkedlist VALUES (
11,200,'200                             ','INCAPOWER F65-CB',10,17,1,0x0000000010649eae);
INSERT INTO alinkedlist VALUES (
11,201,'201                             ','INCAPOWER FD 130',10,17,1,0x0000000010649eaf);
INSERT INTO alinkedlist VALUES (
11,202,'202                             ','INCAPOWER FD 150',10,17,1,0x0000000010649eb0);
INSERT INTO alinkedlist VALUES (
11,203,'203                             ','INCAPOWER FD 25',10,17,1,0x0000000010649eb1);
INSERT INTO alinkedlist VALUES (
11,204,'204                             ','INCAPOWER FD 60',10,17,1,0x0000000010649eb2);
INSERT INTO alinkedlist VALUES (
11,205,'205                             ','INCAPOWER FD 80',10,17,1,0x0000000010649eb3);
INSERT INTO alinkedlist VALUES (
11,206,'206                             ','AUMAN BJ1133VJPGG',10,18,1,0x0000000010649eb4);
INSERT INTO alinkedlist VALUES (
11,207,'207                             ','AUMAN BJ1143 13 TN',10,18,1,0x0000000010649eb5);
INSERT INTO alinkedlist VALUES (
11,208,'208                             ','AUMAN BJ1143VJPGN-1',10,18,1,0x0000000010649eb6);
INSERT INTO alinkedlist VALUES (
11,209,'209                             ','AUMAN BJ1167VJPGN-1',10,18,1,0x0000000010649eb7);
INSERT INTO alinkedlist VALUES (
11,210,'210                             ','BJ1043V8JE6D',10,18,1,0x0000000010649eb8);
INSERT INTO alinkedlist VALUES (
11,211,'211                             ','BJ3253',10,18,1,0x0000000010649eb9);
INSERT INTO alinkedlist VALUES (
11,212,'212                             ','BJ5046V8CE6',10,18,1,0x0000000010649eba);
INSERT INTO alinkedlist VALUES (
11,213,'213                             ','BJ5046V8CE6 FURGON 4X2 3.3 DIESEL',10,18,1,0x0000000010649ebb);
INSERT INTO alinkedlist VALUES (
11,214,'214                             ','FORLAND 1043',10,18,1,0x0000000010649ebc);
INSERT INTO alinkedlist VALUES (
11,215,'215                             ','FORLAND BJ1020 CAPACIDAD DE CARGA 2.0 TN',10,18,1,0x0000000010649ebd);
INSERT INTO alinkedlist VALUES (
11,216,'216                             ','FORLAND BJ1063 CARGA UTIL 5.4 TN',10,18,1,0x0000000010649ebe);
INSERT INTO alinkedlist VALUES (
11,217,'217                             ','OLLIN BJ 1069',10,18,1,0x0000000010649ebf);
INSERT INTO alinkedlist VALUES (
11,218,'218                             ','OLLIN BJ1039',10,18,1,0x0000000010649ec0);
INSERT INTO alinkedlist VALUES (
11,219,'219                             ','OLLIN BJ1043',10,18,1,0x0000000010649ec1);
INSERT INTO alinkedlist VALUES (
11,220,'220                             ','OLLIN BJ1069',10,18,1,0x0000000010649ec2);
INSERT INTO alinkedlist VALUES (
11,221,'221                             ','OLLIN BJ5121',10,18,1,0x0000000010649ec3);
INSERT INTO alinkedlist VALUES (
11,222,'222                             ','ARGOSY 6X4 60N DDC430 18',10,19,1,0x0000000010649ec4);
INSERT INTO alinkedlist VALUES (
11,223,'223                             ','CL 112 REMOLCADOR 6X4',10,19,1,0x0000000010649ec5);
INSERT INTO alinkedlist VALUES (
11,224,'224                             ','CL 120',10,19,1,0x0000000010649ec6);
INSERT INTO alinkedlist VALUES (
11,225,'225                             ','FL-112',10,19,1,0x0000000010649ec7);
INSERT INTO alinkedlist VALUES (
11,226,'226                             ','FL-80',10,19,1,0x0000000010649ec8);
INSERT INTO alinkedlist VALUES (
11,227,'227                             ','FLB 90',10,19,1,0x0000000010649ec9);
INSERT INTO alinkedlist VALUES (
11,228,'228                             ','FLC 112 CUMMINS',10,19,1,0x0000000010649eca);
INSERT INTO alinkedlist VALUES (
11,229,'229                             ','FLC 112 DETROIT 11 LTS.',10,19,1,0x0000000010649ecb);
INSERT INTO alinkedlist VALUES (
11,230,'230                             ','FLD 112 SD PARA TOLVA 6X4',10,19,1,0x0000000010649ecc);
INSERT INTO alinkedlist VALUES (
11,231,'231                             ','FLD 120 REMOLCADOR 6X4',10,19,1,0x0000000010649ecd);
INSERT INTO alinkedlist VALUES (
11,232,'232                             ','FLD 120 SD REMOLCADOR 6X4',10,19,1,0x0000000010649ece);
INSERT INTO alinkedlist VALUES (
11,233,'233                             ','FLD 120SD REMOLCADOR',10,19,1,0x0000000010649ecf);
INSERT INTO alinkedlist VALUES (
11,234,'234                             ','FLD112SD',10,19,1,0x0000000010649ed0);
INSERT INTO alinkedlist VALUES (
11,235,'235                             ','FLD120',10,19,1,0x0000000010649ed1);
INSERT INTO alinkedlist VALUES (
11,236,'236                             ','M2 106',10,19,1,0x0000000010649ed2);
INSERT INTO alinkedlist VALUES (
11,237,'237                             ','M2 112',10,19,1,0x0000000010649ed3);
INSERT INTO alinkedlist VALUES (
11,238,'238                             ','M2106-12',10,19,1,0x0000000010649ed4);
INSERT INTO alinkedlist VALUES (
11,239,'239                             ','MB 80',10,19,1,0x0000000010649ed5);
INSERT INTO alinkedlist VALUES (
11,240,'240                             ','SX5255GJBJR364C',10,20,1,0x0000000010649ed6);
INSERT INTO alinkedlist VALUES (
11,241,'241                             ','DUTRO',10,21,1,0x0000000010649ed7);
INSERT INTO alinkedlist VALUES (
11,242,'242                             ','FB2WGSA 5.5 TN.',10,21,1,0x0000000010649ed8);
INSERT INTO alinkedlist VALUES (
11,243,'243                             ','FC 9JJSA',10,21,1,0x0000000010649ed9);
INSERT INTO alinkedlist VALUES (
11,244,'244                             ','FC10',10,21,1,0x0000000010649eda);
INSERT INTO alinkedlist VALUES (
11,245,'245                             ','FC10 CH/CAB',10,21,1,0x0000000010649edb);
INSERT INTO alinkedlist VALUES (
11,246,'246                             ','FC3WJSA 7.5 TN.',10,21,1,0x0000000010649edc);
INSERT INTO alinkedlist VALUES (
11,247,'247                             ','FC4',10,21,1,0x0000000010649edd);
INSERT INTO alinkedlist VALUES (
11,248,'248                             ','FF 195',10,21,1,0x0000000010649ede);
INSERT INTO alinkedlist VALUES (
11,249,'249                             ','FF2HMSA',10,21,1,0x0000000010649edf);
INSERT INTO alinkedlist VALUES (
11,250,'250                             ','FG',10,21,1,0x0000000010649ee0);
INSERT INTO alinkedlist VALUES (
11,251,'251                             ','FM 8JLSD',10,21,1,0x0000000010649ee1);
INSERT INTO alinkedlist VALUES (
11,252,'252                             ','FM 8JRSA',10,21,1,0x0000000010649ee2);
INSERT INTO alinkedlist VALUES (
11,253,'253                             ','FM26',10,21,1,0x0000000010649ee3);
INSERT INTO alinkedlist VALUES (
11,254,'254                             ','FM8',10,21,1,0x0000000010649ee4);
INSERT INTO alinkedlist VALUES (
11,255,'255                             ','FS331',10,21,1,0x0000000010649ee5);
INSERT INTO alinkedlist VALUES (
11,256,'256                             ','FS331SD',10,21,1,0x0000000010649ee6);
INSERT INTO alinkedlist VALUES (
11,257,'257                             ','FS335',10,21,1,0x0000000010649ee7);
INSERT INTO alinkedlist VALUES (
11,258,'258                             ','FS335SA',10,21,1,0x0000000010649ee8);
INSERT INTO alinkedlist VALUES (
11,259,'259                             ','GH 8 JMSA 4X2 DSL',10,21,1,0x0000000010649ee9);
INSERT INTO alinkedlist VALUES (
11,260,'260                             ','GH17',10,21,1,0x0000000010649eea);
INSERT INTO alinkedlist VALUES (
11,261,'261                             ','GH17 CH/CAB',10,21,1,0x0000000010649eeb);
INSERT INTO alinkedlist VALUES (
11,262,'262                             ','SS60',10,21,1,0x0000000010649eec);
INSERT INTO alinkedlist VALUES (
11,263,'263                             ','ZS 1EMVD',10,21,1,0x0000000010649eed);
INSERT INTO alinkedlist VALUES (
11,264,'264                             ','ZS40',10,21,1,0x0000000010649eee);
INSERT INTO alinkedlist VALUES (
11,265,'265                             ','ZS60',10,21,1,0x0000000010649eef);
INSERT INTO alinkedlist VALUES (
11,266,'266                             ','ZZ1167M4611W',10,22,1,0x0000000010649ef0);
INSERT INTO alinkedlist VALUES (
11,267,'267                             ','ZZ3257',10,22,1,0x0000000010649ef1);
INSERT INTO alinkedlist VALUES (
11,268,'268                             ','ZZ3257N3447A1',10,22,1,0x0000000010649ef2);
INSERT INTO alinkedlist VALUES (
11,269,'269                             ','ZZ3257N3647A',10,22,1,0x0000000010649ef3);
INSERT INTO alinkedlist VALUES (
11,270,'270                             ','ZZ3257N3647B VOLQUETE 6X4',10,22,1,0x0000000010649ef4);
INSERT INTO alinkedlist VALUES (
11,271,'271                             ','ZZ3257N3647C',10,22,1,0x0000000010649ef5);
INSERT INTO alinkedlist VALUES (
11,272,'272                             ','ZZ3257N3647N1',10,22,1,0x0000000010649ef6);
INSERT INTO alinkedlist VALUES (
11,273,'273                             ','ZZ3257N3847A',10,22,1,0x0000000010649ef7);
INSERT INTO alinkedlist VALUES (
11,274,'274                             ','ZZ3257S3247B VOLQUETE 6X4',10,22,1,0x0000000010649ef8);
INSERT INTO alinkedlist VALUES (
11,275,'275                             ','ZZ3317N2867W',10,22,1,0x0000000010649ef9);
INSERT INTO alinkedlist VALUES (
11,276,'276                             ','ZZ3317S3061 VOLQUETE 8X4',10,22,1,0x0000000010649efa);
INSERT INTO alinkedlist VALUES (
11,277,'277                             ','H-100',10,23,1,0x0000000010649efb);
INSERT INTO alinkedlist VALUES (
11,278,'278                             ','HD 1000',10,23,1,0x0000000010649efc);
INSERT INTO alinkedlist VALUES (
11,279,'279                             ','HD 120',10,23,1,0x0000000010649efd);
INSERT INTO alinkedlist VALUES (
11,280,'280                             ','HD 160',10,23,1,0x0000000010649efe);
INSERT INTO alinkedlist VALUES (
11,281,'281                             ','HD 170',10,23,1,0x0000000010649eff);
INSERT INTO alinkedlist VALUES (
11,282,'282                             ','HD 250',10,23,1,0x0000000010649f01);
INSERT INTO alinkedlist VALUES (
11,283,'283                             ','HD 45',10,23,1,0x0000000010649f02);
INSERT INTO alinkedlist VALUES (
11,284,'284                             ','HD 65',10,23,1,0x0000000010649f03);
INSERT INTO alinkedlist VALUES (
11,285,'285                             ','HD 700',10,23,1,0x0000000010649f04);
INSERT INTO alinkedlist VALUES (
11,286,'286                             ','HD 72',10,23,1,0x0000000010649f05);
INSERT INTO alinkedlist VALUES (
11,287,'287                             ','HD1000',10,23,1,0x0000000010649f06);
INSERT INTO alinkedlist VALUES (
11,288,'288                             ','HD120',10,23,1,0x0000000010649f07);
INSERT INTO alinkedlist VALUES (
11,289,'289                             ','HD-160',10,23,1,0x0000000010649f08);
INSERT INTO alinkedlist VALUES (
11,290,'290                             ','HD-170',10,23,1,0x0000000010649f09);
INSERT INTO alinkedlist VALUES (
11,291,'291                             ','HD250',10,23,1,0x0000000010649f0a);
INSERT INTO alinkedlist VALUES (
11,292,'292                             ','HD-270',10,23,1,0x0000000010649f0b);
INSERT INTO alinkedlist VALUES (
11,293,'293                             ','HD-370',10,23,1,0x0000000010649f0c);
INSERT INTO alinkedlist VALUES (
11,294,'294                             ','HD-45',10,23,1,0x0000000010649f0d);
INSERT INTO alinkedlist VALUES (
11,295,'295                             ','HD-65',10,23,1,0x0000000010649f0e);
INSERT INTO alinkedlist VALUES (
11,296,'296                             ','HD-700',10,23,1,0x0000000010649f0f);
INSERT INTO alinkedlist VALUES (
11,297,'297                             ','HD-72',10,23,1,0x0000000010649f10);
INSERT INTO alinkedlist VALUES (
11,298,'298                             ','HD78',10,23,1,0x0000000010649f11);
INSERT INTO alinkedlist VALUES (
11,299,'299                             ','SUPER TURBO',10,23,1,0x0000000010649f12);
INSERT INTO alinkedlist VALUES (
11,300,'300                             ','TURBO',10,23,1,0x0000000010649f13);
INSERT INTO alinkedlist VALUES (
11,301,'301                             ','B30',10,24,1,0x0000000010649f14);
INSERT INTO alinkedlist VALUES (
11,302,'302                             ','B40',10,24,1,0x0000000010649f15);
INSERT INTO alinkedlist VALUES (
11,303,'303                             ','B50',10,24,1,0x0000000010649f16);
INSERT INTO alinkedlist VALUES (
11,304,'304                             ','B60',10,24,1,0x0000000010649f17);
INSERT INTO alinkedlist VALUES (
11,305,'305                             ','F100',10,24,1,0x0000000010649f18);
INSERT INTO alinkedlist VALUES (
11,306,'306                             ','F130',10,24,1,0x0000000010649f19);
INSERT INTO alinkedlist VALUES (
11,307,'307                             ','4,700',10,25,1,0x0000000010649f1a);
INSERT INTO alinkedlist VALUES (
11,308,'308                             ','4,900',10,25,1,0x0000000010649f1b);
INSERT INTO alinkedlist VALUES (
11,309,'309                             ','7,600',10,25,1,0x0000000010649f1c);
INSERT INTO alinkedlist VALUES (
11,310,'310                             ','8,100',10,25,1,0x0000000010649f1d);
INSERT INTO alinkedlist VALUES (
11,311,'311                             ','2554',10,25,1,0x0000000010649f1e);
INSERT INTO alinkedlist VALUES (
11,312,'312                             ','2574',10,25,1,0x0000000010649f1f);
INSERT INTO alinkedlist VALUES (
11,313,'313                             ','4200',10,25,1,0x0000000010649f20);
INSERT INTO alinkedlist VALUES (
11,314,'314                             ','4300',10,25,1,0x0000000010649f21);
INSERT INTO alinkedlist VALUES (
11,315,'315                             ','4400',10,25,1,0x0000000010649f22);
INSERT INTO alinkedlist VALUES (
11,316,'316                             ','5600',10,25,1,0x0000000010649f23);
INSERT INTO alinkedlist VALUES (
11,317,'317                             ','5900I',10,25,1,0x0000000010649f24);
INSERT INTO alinkedlist VALUES (
11,318,'318                             ','7300',10,25,1,0x0000000010649f25);
INSERT INTO alinkedlist VALUES (
11,319,'319                             ','7400',10,25,1,0x0000000010649f26);
INSERT INTO alinkedlist VALUES (
11,320,'320                             ','800I',10,25,1,0x0000000010649f27);
INSERT INTO alinkedlist VALUES (
11,321,'321                             ','8600',10,25,1,0x0000000010649f28);
INSERT INTO alinkedlist VALUES (
11,322,'322                             ','9200I',10,25,1,0x0000000010649f29);
INSERT INTO alinkedlist VALUES (
11,323,'323                             ','9400',10,25,1,0x0000000010649f2a);
INSERT INTO alinkedlist VALUES (
11,324,'324                             ','9800',10,25,1,0x0000000010649f2b);
INSERT INTO alinkedlist VALUES (
11,325,'325                             ','CENTENAL',10,25,1,0x0000000010649f2c);
INSERT INTO alinkedlist VALUES (
11,326,'326                             ','CF 600',10,25,1,0x0000000010649f2d);
INSERT INTO alinkedlist VALUES (
11,327,'327                             ','PAYSTAR',10,25,1,0x0000000010649f2e);
INSERT INTO alinkedlist VALUES (
11,328,'328                             ','PROSTAR PREMIUM REMOLCADOR 6X4',10,25,1,0x0000000010649f2f);
INSERT INTO alinkedlist VALUES (
11,329,'329                             ','FORWARD 1000',10,26,1,0x0000000010649f30);
INSERT INTO alinkedlist VALUES (
11,330,'330                             ','FORWARD 1300',10,26,1,0x0000000010649f31);
INSERT INTO alinkedlist VALUES (
11,331,'331                             ','FORWARD 1800',10,26,1,0x0000000010649f32);
INSERT INTO alinkedlist VALUES (
11,332,'332                             ','FORWARD 2000',10,26,1,0x0000000010649f33);
INSERT INTO alinkedlist VALUES (
11,333,'333                             ','FORWARD 500',10,26,1,0x0000000010649f34);
INSERT INTO alinkedlist VALUES (
11,334,'334                             ','FORWARD 800',10,26,1,0x0000000010649f35);
INSERT INTO alinkedlist VALUES (
11,335,'335                             ','FRR90SL',10,26,1,0x0000000010649f36);
INSERT INTO alinkedlist VALUES (
11,336,'336                             ','FTR34SLPDN',10,26,1,0x0000000010649f37);
INSERT INTO alinkedlist VALUES (
11,337,'337                             ','FVR',10,26,1,0x0000000010649f38);
INSERT INTO alinkedlist VALUES (
11,338,'338                             ','FVR34UL-QDEDS',10,26,1,0x0000000010649f39);
INSERT INTO alinkedlist VALUES (
11,339,'339                             ','FVZ34',10,26,1,0x0000000010649f3a);
INSERT INTO alinkedlist VALUES (
11,340,'340                             ','NLR55LEE1AY',10,26,1,0x0000000010649f3b);
INSERT INTO alinkedlist VALUES (
11,341,'341                             ','NPR75L',10,26,1,0x0000000010649f3c);
INSERT INTO alinkedlist VALUES (
11,342,'342                             ','NPR75LKL5VAYN',10,26,1,0x0000000010649f3d);
INSERT INTO alinkedlist VALUES (
11,343,'343                             ','NPS75LHJ5VAYN',10,26,1,0x0000000010649f3e);
INSERT INTO alinkedlist VALUES (
11,344,'344                             ','REWARD 300',10,26,1,0x0000000010649f3f);
INSERT INTO alinkedlist VALUES (
11,345,'345                             ','REWARD 500',10,26,1,0x0000000010649f40);
INSERT INTO alinkedlist VALUES (
11,346,'346                             ','ASTRA',10,27,1,0x0000000010649f41);
INSERT INTO alinkedlist VALUES (
11,347,'347                             ','DAILY 40.10WM',10,27,1,0x0000000010649f42);
INSERT INTO alinkedlist VALUES (
11,348,'348                             ','EUROCARGO',10,27,1,0x0000000010649f43);
INSERT INTO alinkedlist VALUES (
11,349,'349                             ','EUROTRAKKER 380E37H 6X4',10,27,1,0x0000000010649f44);
INSERT INTO alinkedlist VALUES (
11,350,'350                             ','EUROTRAKKER 380E37H 8ATE3TPT06',10,27,1,0x0000000010649f45);
INSERT INTO alinkedlist VALUES (
11,351,'351                             ','STRALIS',10,27,1,0x0000000010649f46);
INSERT INTO alinkedlist VALUES (
11,352,'352                             ','TRAKKER',10,27,1,0x0000000010649f47);
INSERT INTO alinkedlist VALUES (
11,353,'353                             ','GALLOP HFC4251KR1',10,28,1,0x0000000010649f48);
INSERT INTO alinkedlist VALUES (
11,354,'354                             ','HFC 1020K',10,28,1,0x0000000010649f49);
INSERT INTO alinkedlist VALUES (
11,355,'355                             ','HFC 1030K',10,28,1,0x0000000010649f4a);
INSERT INTO alinkedlist VALUES (
11,356,'356                             ','HFC 1040K 4 TON. TURBO INTERCOOLER',10,28,1,0x0000000010649f4b);
INSERT INTO alinkedlist VALUES (
11,357,'357                             ','HFC1035K',10,28,1,0x0000000010649f4c);
INSERT INTO alinkedlist VALUES (
11,358,'358                             ','HFC1043KN',10,28,1,0x0000000010649f4d);
INSERT INTO alinkedlist VALUES (
11,359,'359                             ','HFC1045K BARANDA 4X2',10,28,1,0x0000000010649f4e);
INSERT INTO alinkedlist VALUES (
11,360,'360                             ','HFC1045K2 BARANDA 4X2',10,28,1,0x0000000010649f4f);
INSERT INTO alinkedlist VALUES (
11,361,'361                             ','HFC1048K',10,28,1,0x0000000010649f50);
INSERT INTO alinkedlist VALUES (
11,362,'362                             ','HFC1055KN',10,28,1,0x0000000010649f51);
INSERT INTO alinkedlist VALUES (
11,363,'363                             ','HFC1061K',10,28,1,0x0000000010649f52);
INSERT INTO alinkedlist VALUES (
11,364,'364                             ','HFC1061L 8.5TN PBV CH/CAB 4X2',10,28,1,0x0000000010649f53);
INSERT INTO alinkedlist VALUES (
11,365,'365                             ','HFC1063K 9.8TN.PBV CH/CAB 4X2',10,28,1,0x0000000010649f54);
INSERT INTO alinkedlist VALUES (
11,366,'366                             ','HFC1063KR1',10,28,1,0x0000000010649f55);
INSERT INTO alinkedlist VALUES (
11,367,'367                             ','HFC1083KR1 BARANDA 4X2',10,28,1,0x0000000010649f56);
INSERT INTO alinkedlist VALUES (
11,368,'368                             ','HFC1131',10,28,1,0x0000000010649f57);
INSERT INTO alinkedlist VALUES (
11,369,'369                             ','HFC1131KR1',10,28,1,0x0000000010649f58);
INSERT INTO alinkedlist VALUES (
11,370,'370                             ','HFC1134KR1',10,28,1,0x0000000010649f59);
INSERT INTO alinkedlist VALUES (
11,371,'371                             ','HFC1180KR1',10,28,1,0x0000000010649f5a);
INSERT INTO alinkedlist VALUES (
11,372,'372                             ','HFC3048K',10,28,1,0x0000000010649f5b);
INSERT INTO alinkedlist VALUES (
11,373,'373                             ','HFC3072K VOLQUETE 4X2',10,28,1,0x0000000010649f5c);
INSERT INTO alinkedlist VALUES (
11,374,'374                             ','HFC3090KR1',10,28,1,0x0000000010649f5d);
INSERT INTO alinkedlist VALUES (
11,375,'375                             ','HFC4251KR1',10,28,1,0x0000000010649f5e);
INSERT INTO alinkedlist VALUES (
11,376,'376                             ','HFC4253K3R1 REMOLCADOR 6X4',10,28,1,0x0000000010649f5f);
INSERT INTO alinkedlist VALUES (
11,377,'377                             ','1043DAES CHASIS CABINADO',10,29,1,0x0000000010649f60);
INSERT INTO alinkedlist VALUES (
11,378,'378                             ','SY1040DY3S BARANDA',10,29,1,0x0000000010649f61);
INSERT INTO alinkedlist VALUES (
11,379,'379                             ','SY1041DW',10,29,1,0x0000000010649f62);
INSERT INTO alinkedlist VALUES (
11,380,'380                             ','SY1043DAES CH/CAB 4X2',10,29,1,0x0000000010649f63);
INSERT INTO alinkedlist VALUES (
11,381,'381                             ','SY1062DRY CH/CAB 4X2',10,29,1,0x0000000010649f64);
INSERT INTO alinkedlist VALUES (
11,382,'382                             ','SY1062DRY CHASIS CABINADO',10,29,1,0x0000000010649f65);
INSERT INTO alinkedlist VALUES (
11,383,'383                             ','SY1090DR1C BARANDA',10,29,1,0x0000000010649f66);
INSERT INTO alinkedlist VALUES (
11,384,'384                             ','SY1090DR1C CH/CAB 4X2',10,29,1,0x0000000010649f67);
INSERT INTO alinkedlist VALUES (
11,385,'385                             ','SY1090DR1C CHASIS CABINADO',10,29,1,0x0000000010649f68);
INSERT INTO alinkedlist VALUES (
11,386,'386                             ','SY1120BRJ CH/CAB 4X2',10,29,1,0x0000000010649f69);
INSERT INTO alinkedlist VALUES (
11,387,'387                             ','SY1120BRJ CHASIS CABINADO',10,29,1,0x0000000010649f6a);
INSERT INTO alinkedlist VALUES (
11,388,'388                             ','SY3030DL4H',10,29,1,0x0000000010649f6b);
INSERT INTO alinkedlist VALUES (
11,389,'389                             ','SY3040BY3Q',10,29,1,0x0000000010649f6c);
INSERT INTO alinkedlist VALUES (
11,390,'390                             ','SY3040BY4Q',10,29,1,0x0000000010649f6d);
INSERT INTO alinkedlist VALUES (
11,391,'391                             ','SY3040DYL',10,29,1,0x0000000010649f6e);
INSERT INTO alinkedlist VALUES (
11,392,'392                             ','SY3090BR1T VOLQUETE',10,29,1,0x0000000010649f6f);
INSERT INTO alinkedlist VALUES (
11,393,'393                             ','CARRYING',10,30,1,0x0000000010649f70);
INSERT INTO alinkedlist VALUES (
11,394,'394                             ','CITY 2.OT DIESEL CHASIS CABINA',10,30,1,0x0000000010649f71);
INSERT INTO alinkedlist VALUES (
11,395,'395                             ','CONVEY 4.0T',10,30,1,0x0000000010649f72);
INSERT INTO alinkedlist VALUES (
11,396,'396                             ','CONVEY 4.3 T.',10,30,1,0x0000000010649f73);
INSERT INTO alinkedlist VALUES (
11,397,'397                             ','CONVEY 5.3 T.',10,30,1,0x0000000010649f74);
INSERT INTO alinkedlist VALUES (
11,398,'398                             ','DUO CAB 2.0 T.',10,30,1,0x0000000010649f75);
INSERT INTO alinkedlist VALUES (
11,399,'399                             ','DUO CAB 4.0 T.',10,30,1,0x0000000010649f76);
INSERT INTO alinkedlist VALUES (
11,400,'400                             ','MOBILE WORKSHOP',10,30,1,0x0000000010649f77);
INSERT INTO alinkedlist VALUES (
11,401,'401                             ','N900',10,30,1,0x0000000010649f78);
INSERT INTO alinkedlist VALUES (
11,402,'402                             ','NHR',10,30,1,0x0000000010649f79);
INSERT INTO alinkedlist VALUES (
11,403,'403                             ','NKR',10,30,1,0x0000000010649f7a);
INSERT INTO alinkedlist VALUES (
11,404,'404                             ','NKR LWB',10,30,1,0x0000000010649f7b);
INSERT INTO alinkedlist VALUES (
11,405,'405                             ','TRIO CAB 4.0 T.',10,30,1,0x0000000010649f7c);
INSERT INTO alinkedlist VALUES (
11,406,'406                             ','KMC1031B',10,31,1,0x0000000010649f7d);
INSERT INTO alinkedlist VALUES (
11,407,'407                             ','KMC3020B',10,31,1,0x0000000010649f7e);
INSERT INTO alinkedlist VALUES (
11,408,'408                             ','5,325',10,32,1,0x0000000010649f7f);
INSERT INTO alinkedlist VALUES (
11,409,'409                             ','43,101',10,32,1,0x0000000010649f80);
INSERT INTO alinkedlist VALUES (
11,410,'410                             ','53,212',10,32,1,0x0000000010649f81);
INSERT INTO alinkedlist VALUES (
11,411,'411                             ','55,111',10,32,1,0x0000000010649f82);
INSERT INTO alinkedlist VALUES (
11,412,'412                             ','54112 260 HP',10,32,1,0x0000000010649f83);
INSERT INTO alinkedlist VALUES (
11,413,'413                             ','54112 T 220 HP',10,32,1,0x0000000010649f84);
INSERT INTO alinkedlist VALUES (
11,414,'414                             ','T2000',10,33,1,0x0000000010649f85);
INSERT INTO alinkedlist VALUES (
11,415,'415                             ','T300',10,33,1,0x0000000010649f86);
INSERT INTO alinkedlist VALUES (
11,416,'416                             ','T370 CAMION 17 TON',10,33,1,0x0000000010649f87);
INSERT INTO alinkedlist VALUES (
11,417,'417                             ','T370 CAMIÓN TALLER',10,33,1,0x0000000010649f88);
INSERT INTO alinkedlist VALUES (
11,418,'418                             ','T370 LUBRICADOR CAMIÓN',10,33,1,0x0000000010649f89);
INSERT INTO alinkedlist VALUES (
11,419,'419                             ','T370 TRUCK 4X2 FULL',10,33,1,0x0000000010649f8a);
INSERT INTO alinkedlist VALUES (
11,420,'420                             ','T370 TRUCK 6X4 FULL',10,33,1,0x0000000010649f8b);
INSERT INTO alinkedlist VALUES (
11,421,'421                             ','T370 VOLQUETE',10,33,1,0x0000000010649f8c);
INSERT INTO alinkedlist VALUES (
11,422,'422                             ','T460',10,33,1,0x0000000010649f8d);
INSERT INTO alinkedlist VALUES (
11,423,'423                             ','T600',10,33,1,0x0000000010649f8e);
INSERT INTO alinkedlist VALUES (
11,424,'424                             ','T660',10,33,1,0x0000000010649f8f);
INSERT INTO alinkedlist VALUES (
11,425,'425                             ','T800',10,33,1,0x0000000010649f90);
INSERT INTO alinkedlist VALUES (
11,426,'426                             ','TRACTO CITY',10,33,1,0x0000000010649f91);
INSERT INTO alinkedlist VALUES (
11,427,'427                             ','K-2500',10,34,1,0x0000000010649f92);
INSERT INTO alinkedlist VALUES (
11,428,'428                             ','K-2700',10,34,1,0x0000000010649f93);
INSERT INTO alinkedlist VALUES (
11,429,'429                             ','K-3000',10,34,1,0x0000000010649f94);
INSERT INTO alinkedlist VALUES (
11,430,'430                             ','K-3600',10,34,1,0x0000000010649f95);
INSERT INTO alinkedlist VALUES (
11,431,'431                             ','ZD3314',10,35,1,0x0000000010649f96);
INSERT INTO alinkedlist VALUES (
11,432,'432                             ','CXN613',10,36,1,0x0000000010649f97);
INSERT INTO alinkedlist VALUES (
11,433,'433                             ','CXU613E',10,36,1,0x0000000010649f98);
INSERT INTO alinkedlist VALUES (
11,434,'434                             ','GRANITE CV713',10,36,1,0x0000000010649f99);
INSERT INTO alinkedlist VALUES (
11,435,'435                             ','GU813E',10,36,1,0x0000000010649f9a);
INSERT INTO alinkedlist VALUES (
11,436,'436                             ','MR6885',10,36,1,0x0000000010649f9b);
INSERT INTO alinkedlist VALUES (
11,437,'437                             ','MRU613E',10,36,1,0x0000000010649f9c);
INSERT INTO alinkedlist VALUES (
11,438,'438                             ','VISION',10,36,1,0x0000000010649f9d);
INSERT INTO alinkedlist VALUES (
11,439,'439                             ','VISION ELITE',10,36,1,0x0000000010649f9e);
INSERT INTO alinkedlist VALUES (
11,440,'440                             ','26.440',10,37,1,0x0000000010649f9f);
INSERT INTO alinkedlist VALUES (
11,441,'441                             ','26.480',10,37,1,0x0000000010649fa0);
INSERT INTO alinkedlist VALUES (
11,442,'442                             ','33.360',10,37,1,0x0000000010649fa1);
INSERT INTO alinkedlist VALUES (
11,443,'443                             ','33.400',10,37,1,0x0000000010649fa2);
INSERT INTO alinkedlist VALUES (
11,444,'444                             ','40.440',10,37,1,0x0000000010649fa3);
INSERT INTO alinkedlist VALUES (
11,445,'445                             ','40.480',10,37,1,0x0000000010649fa4);
INSERT INTO alinkedlist VALUES (
11,446,'446                             ','41.480',10,37,1,0x0000000010649fa5);
INSERT INTO alinkedlist VALUES (
11,447,'447                             ','T-4.5 TURBO',10,38,1,0x0000000010649fa6);
INSERT INTO alinkedlist VALUES (
11,448,'448                             ','1,728',10,39,1,0x0000000010649fa7);
INSERT INTO alinkedlist VALUES (
11,449,'449                             ','2,428',10,39,1,0x0000000010649fa8);
INSERT INTO alinkedlist VALUES (
11,450,'450                             ','2,726',10,39,1,0x0000000010649fa9);
INSERT INTO alinkedlist VALUES (
11,451,'451                             ','1315C',10,39,1,0x0000000010649faa);
INSERT INTO alinkedlist VALUES (
11,452,'452                             ','1315C 4X2',10,39,1,0x0000000010649fab);
INSERT INTO alinkedlist VALUES (
11,453,'453                             ','1315C/48',10,39,1,0x0000000010649fac);
INSERT INTO alinkedlist VALUES (
11,454,'454                             ','1418/48',10,39,1,0x0000000010649fad);
INSERT INTO alinkedlist VALUES (
11,455,'455                             ','1520 4X2',10,39,1,0x0000000010649fae);
INSERT INTO alinkedlist VALUES (
11,456,'456                             ','1520/48',10,39,1,0x0000000010649faf);
INSERT INTO alinkedlist VALUES (
11,457,'457                             ','1618/48',10,39,1,0x0000000010649fb0);
INSERT INTO alinkedlist VALUES (
11,458,'458                             ','1623/48',10,39,1,0x0000000010649fb1);
INSERT INTO alinkedlist VALUES (
11,459,'459                             ','1623A',10,39,1,0x0000000010649fb2);
INSERT INTO alinkedlist VALUES (
11,460,'460                             ','1628/48',10,39,1,0x0000000010649fb3);
INSERT INTO alinkedlist VALUES (
11,461,'461                             ','1628/54',10,39,1,0x0000000010649fb4);
INSERT INTO alinkedlist VALUES (
11,462,'462                             ','1718/48',10,39,1,0x0000000010649fb5);
INSERT INTO alinkedlist VALUES (
11,463,'463                             ','1718K/36 4X2',10,39,1,0x0000000010649fb6);
INSERT INTO alinkedlist VALUES (
11,464,'464                             ','1718M/48',10,39,1,0x0000000010649fb7);
INSERT INTO alinkedlist VALUES (
11,465,'465                             ','1720/1720K',10,39,1,0x0000000010649fb8);
INSERT INTO alinkedlist VALUES (
11,466,'466                             ','1720/48',10,39,1,0x0000000010649fb9);
INSERT INTO alinkedlist VALUES (
11,467,'467                             ','1720/A42',10,39,1,0x0000000010649fba);
INSERT INTO alinkedlist VALUES (
11,468,'468                             ','1720A/42 4X4',10,39,1,0x0000000010649fbb);
INSERT INTO alinkedlist VALUES (
11,469,'469                             ','1720K/36',10,39,1,0x0000000010649fbc);
INSERT INTO alinkedlist VALUES (
11,470,'470                             ','1728/51',10,39,1,0x0000000010649fbd);
INSERT INTO alinkedlist VALUES (
11,471,'471                             ','1938S',10,39,1,0x0000000010649fbe);
INSERT INTO alinkedlist VALUES (
11,472,'472                             ','2423 B',10,39,1,0x0000000010649fbf);
INSERT INTO alinkedlist VALUES (
11,473,'473                             ','2423K',10,39,1,0x0000000010649fc0);
INSERT INTO alinkedlist VALUES (
11,474,'474                             ','2428/48',10,39,1,0x0000000010649fc1);
INSERT INTO alinkedlist VALUES (
11,475,'475                             ','2631K',10,39,1,0x0000000010649fc2);
INSERT INTO alinkedlist VALUES (
11,476,'476                             ','2638AK',10,39,1,0x0000000010649fc3);
INSERT INTO alinkedlist VALUES (
11,477,'477                             ','711',10,39,1,0x0000000010649fc4);
INSERT INTO alinkedlist VALUES (
11,478,'478                             ','712/42.5',10,39,1,0x0000000010649fc5);
INSERT INTO alinkedlist VALUES (
11,479,'479                             ','715C/37',10,39,1,0x0000000010649fc6);
INSERT INTO alinkedlist VALUES (
11,480,'480                             ','912/42.5',10,39,1,0x0000000010649fc7);
INSERT INTO alinkedlist VALUES (
11,481,'481                             ','914C',10,39,1,0x0000000010649fc8);
INSERT INTO alinkedlist VALUES (
11,482,'482                             ','915C',10,39,1,0x0000000010649fc9);
INSERT INTO alinkedlist VALUES (
11,483,'483                             ','915E',10,39,1,0x0000000010649fca);
INSERT INTO alinkedlist VALUES (
11,484,'484                             ','918/48',10,39,1,0x0000000010649fcb);
INSERT INTO alinkedlist VALUES (
11,485,'485                             ','ACTROS',10,39,1,0x0000000010649fcc);
INSERT INTO alinkedlist VALUES (
11,486,'486                             ','ATEGO',10,39,1,0x0000000010649fcd);
INSERT INTO alinkedlist VALUES (
11,487,'487                             ','AXOR',10,39,1,0x0000000010649fce);
INSERT INTO alinkedlist VALUES (
11,488,'488                             ','EQ3252GT7',10,39,1,0x0000000010649fcf);
INSERT INTO alinkedlist VALUES (
11,489,'489                             ','FPN 1718/48',10,39,1,0x0000000010649fd0);
INSERT INTO alinkedlist VALUES (
11,490,'490                             ','FPN 1720 CAMIÓN',10,39,1,0x0000000010649fd1);
INSERT INTO alinkedlist VALUES (
11,491,'491                             ','L/LK-1620',10,39,1,0x0000000010649fd2);
INSERT INTO alinkedlist VALUES (
11,492,'492                             ','L-1618/51',10,39,1,0x0000000010649fd3);
INSERT INTO alinkedlist VALUES (
11,493,'493                             ','L-2221',10,39,1,0x0000000010649fd4);
INSERT INTO alinkedlist VALUES (
11,494,'494                             ','L-2318/51',10,39,1,0x0000000010649fd5);
INSERT INTO alinkedlist VALUES (
11,495,'495                             ','LA/LAK-1418',10,39,1,0x0000000010649fd6);
INSERT INTO alinkedlist VALUES (
11,496,'496                             ','LAK 1418/42',10,39,1,0x0000000010649fd7);
INSERT INTO alinkedlist VALUES (
11,497,'497                             ','LK 1618/42',10,39,1,0x0000000010649fd8);
INSERT INTO alinkedlist VALUES (
11,498,'498                             ','LK 2318/42',10,39,1,0x0000000010649fd9);
INSERT INTO alinkedlist VALUES (
11,499,'499                             ','LK 2638 6X4',10,39,1,0x0000000010649fda);
INSERT INTO alinkedlist VALUES (
11,500,'500                             ','LK 2638/40 6X4',10,39,1,0x0000000010649fdb);
INSERT INTO alinkedlist VALUES (
11,501,'501                             ','LK-2635',10,39,1,0x0000000010649fdc);
INSERT INTO alinkedlist VALUES (
11,502,'502                             ','LS 2638/40 6X4',10,39,1,0x0000000010649fdd);
INSERT INTO alinkedlist VALUES (
11,503,'503                             ','LSS-2635/40',10,39,1,0x0000000010649fde);
INSERT INTO alinkedlist VALUES (
11,504,'504                             ','MB-800',10,39,1,0x0000000010649fdf);
INSERT INTO alinkedlist VALUES (
11,505,'505                             ','CANTER',10,40,1,0x0000000010649fe0);
INSERT INTO alinkedlist VALUES (
11,506,'506                             ','FUSO',10,40,1,0x0000000010649fe1);
INSERT INTO alinkedlist VALUES (
11,507,'507                             ','FUSO FK 750',10,40,1,0x0000000010649fe2);
INSERT INTO alinkedlist VALUES (
11,508,'508                             ','FUSO FM 1060',10,40,1,0x0000000010649fe3);
INSERT INTO alinkedlist VALUES (
11,509,'509                             ','MF CHASIS MOTORIZADO',10,40,1,0x0000000010649fe4);
INSERT INTO alinkedlist VALUES (
11,510,'510                             ','ZTP 1052W',10,41,1,0x0000000010649fe5);
INSERT INTO alinkedlist VALUES (
11,511,'511                             ','ZTP 1053W',10,41,1,0x0000000010649fe6);
INSERT INTO alinkedlist VALUES (
11,512,'512                             ','ZTP 1083W',10,41,1,0x0000000010649fe7);
INSERT INTO alinkedlist VALUES (
11,513,'513                             ','ATLAS DIES.',10,42,1,0x0000000010649fe8);
INSERT INTO alinkedlist VALUES (
11,514,'514                             ','CLG',10,42,1,0x0000000010649fe9);
INSERT INTO alinkedlist VALUES (
11,515,'515                             ','CMF',10,42,1,0x0000000010649fea);
INSERT INTO alinkedlist VALUES (
11,516,'516                             ','CONDOR 5',10,42,1,0x0000000010649feb);
INSERT INTO alinkedlist VALUES (
11,517,'517                             ','CONDOR 7',10,42,1,0x0000000010649fec);
INSERT INTO alinkedlist VALUES (
11,518,'518                             ','CONDOR 9',10,42,1,0x0000000010649fed);
INSERT INTO alinkedlist VALUES (
11,519,'519                             ','CW450 CORTO',10,42,1,0x0000000010649fee);
INSERT INTO alinkedlist VALUES (
11,520,'520                             ','CW450 LARGO',10,42,1,0x0000000010649fef);
INSERT INTO alinkedlist VALUES (
11,521,'521                             ','CWB450HDLA',10,42,1,0x0000000010649ff0);
INSERT INTO alinkedlist VALUES (
11,522,'522                             ','CWB450PHLA',10,42,1,0x0000000010649ff1);
INSERT INTO alinkedlist VALUES (
11,523,'523                             ','PKC210',10,42,1,0x0000000010649ff2);
INSERT INTO alinkedlist VALUES (
11,524,'524                             ','PKC210E',10,42,1,0x0000000010649ff3);
INSERT INTO alinkedlist VALUES (
11,525,'525                             ','PKC310',10,42,1,0x0000000010649ff4);
INSERT INTO alinkedlist VALUES (
11,526,'526                             ','U41',10,42,1,0x0000000010649ff5);
INSERT INTO alinkedlist VALUES (
11,527,'527                             ','INCAPOWER BEIBEN',10,43,1,0x0000000010649ff6);
INSERT INTO alinkedlist VALUES (
11,528,'528                             ','387',10,44,1,0x0000000010649ff7);
INSERT INTO alinkedlist VALUES (
11,529,'529                             ','388',10,44,1,0x0000000010649ff8);
INSERT INTO alinkedlist VALUES (
11,530,'530                             ','RUMI 4000/ZB1046JDD',10,45,1,0x0000000010649ff9);
INSERT INTO alinkedlist VALUES (
11,531,'531                             ','RUMI 6000/ZB1050KBPI',10,45,1,0x0000000010649ffa);
INSERT INTO alinkedlist VALUES (
11,532,'532                             ','ZB1046JDD BARANDA 4X2',10,45,1,0x0000000010649ffb);
INSERT INTO alinkedlist VALUES (
11,533,'533                             ','ZB1050KBPI 8.9 PBV BARANDA 4X2',10,45,1,0x0000000010649ffc);
INSERT INTO alinkedlist VALUES (
11,534,'534                             ','KERAK 440.35 6X4 XTREM',10,46,1,0x0000000010649ffd);
INSERT INTO alinkedlist VALUES (
11,535,'535                             ','KERAX 460.45 8X4 XTREM',10,46,1,0x0000000010649ffe);
INSERT INTO alinkedlist VALUES (
11,536,'536                             ','RENAULT KERAX 430',10,46,1,0x0000000010649fff);
INSERT INTO alinkedlist VALUES (
11,537,'537                             ','G380',10,47,1,0x000000001064a001);
INSERT INTO alinkedlist VALUES (
11,538,'538                             ','G410LB',10,47,1,0x000000001064a002);
INSERT INTO alinkedlist VALUES (
11,539,'539                             ','G420',10,47,1,0x000000001064a003);
INSERT INTO alinkedlist VALUES (
11,540,'540                             ','G460',10,47,1,0x000000001064a004);
INSERT INTO alinkedlist VALUES (
11,541,'541                             ','P114 CB NZ',10,47,1,0x000000001064a005);
INSERT INTO alinkedlist VALUES (
11,542,'542                             ','P124 CB NZ',10,47,1,0x000000001064a006);
INSERT INTO alinkedlist VALUES (
11,543,'543                             ','P124 CB NZ 400',10,47,1,0x000000001064a007);
INSERT INTO alinkedlist VALUES (
11,544,'544                             ','P310CB',10,47,1,0x000000001064a008);
INSERT INTO alinkedlist VALUES (
11,545,'545                             ','P310DB',10,47,1,0x000000001064a009);
INSERT INTO alinkedlist VALUES (
11,546,'546                             ','P360CB',10,47,1,0x000000001064a00a);
INSERT INTO alinkedlist VALUES (
11,547,'547                             ','P360LA',10,47,1,0x000000001064a00b);
INSERT INTO alinkedlist VALUES (
11,548,'548                             ','P360LB',10,47,1,0x000000001064a00c);
INSERT INTO alinkedlist VALUES (
11,549,'549                             ','P380',10,47,1,0x000000001064a00d);
INSERT INTO alinkedlist VALUES (
11,550,'550                             ','P410',10,47,1,0x000000001064a00e);
INSERT INTO alinkedlist VALUES (
11,551,'551                             ','P410LA',10,47,1,0x000000001064a00f);
INSERT INTO alinkedlist VALUES (
11,552,'552                             ','P410LB',10,47,1,0x000000001064a010);
INSERT INTO alinkedlist VALUES (
11,553,'553                             ','P420 B',10,47,1,0x000000001064a011);
INSERT INTO alinkedlist VALUES (
11,554,'554                             ','P420',10,47,1,0x000000001064a012);
INSERT INTO alinkedlist VALUES (
11,555,'555                             ','P460',10,47,1,0x000000001064a013);
INSERT INTO alinkedlist VALUES (
11,556,'556                             ','P94 CB HZ',10,47,1,0x000000001064a014);
INSERT INTO alinkedlist VALUES (
11,557,'557                             ','P94 CB NZ',10,47,1,0x000000001064a015);
INSERT INTO alinkedlist VALUES (
11,558,'558                             ','P94 DB',10,47,1,0x000000001064a016);
INSERT INTO alinkedlist VALUES (
11,559,'559                             ','P94 GB NZ',10,47,1,0x000000001064a017);
INSERT INTO alinkedlist VALUES (
11,560,'560                             ','P94LA P94LA6X4NA310 REMOLCADOR',10,47,1,0x000000001064a018);
INSERT INTO alinkedlist VALUES (
11,561,'561                             ','R113 E',10,47,1,0x000000001064a019);
INSERT INTO alinkedlist VALUES (
11,562,'562                             ','R113 H',10,47,1,0x000000001064a01a);
INSERT INTO alinkedlist VALUES (
11,563,'563                             ','R124',10,47,1,0x000000001064a01b);
INSERT INTO alinkedlist VALUES (
11,564,'564                             ','R460',10,47,1,0x000000001064a01c);
INSERT INTO alinkedlist VALUES (
11,565,'565                             ','R500',10,47,1,0x000000001064a01d);
INSERT INTO alinkedlist VALUES (
11,566,'566                             ','R580',10,47,1,0x000000001064a01e);
INSERT INTO alinkedlist VALUES (
11,567,'567                             ','T113 E',10,47,1,0x000000001064a01f);
INSERT INTO alinkedlist VALUES (
11,568,'568                             ','T113H 42',10,47,1,0x000000001064a020);
INSERT INTO alinkedlist VALUES (
11,569,'569                             ','T113H 54',10,47,1,0x000000001064a021);
INSERT INTO alinkedlist VALUES (
11,570,'570                             ','T114 CB NZ',10,47,1,0x000000001064a022);
INSERT INTO alinkedlist VALUES (
11,571,'571                             ','T124 GA NZ',10,47,1,0x000000001064a023);
INSERT INTO alinkedlist VALUES (
11,572,'572                             ','SX3254DT384',10,48,1,0x000000001064a024);
INSERT INTO alinkedlist VALUES (
11,573,'573                             ','SX3255DT384',10,48,1,0x000000001064a025);
INSERT INTO alinkedlist VALUES (
11,574,'574                             ','SX3314DT326',10,48,1,0x000000001064a026);
INSERT INTO alinkedlist VALUES (
11,575,'575                             ','CY009E-K',10,49,1,0x000000001064a027);
INSERT INTO alinkedlist VALUES (
11,576,'576                             ','F2000',10,49,1,0x000000001064a028);
INSERT INTO alinkedlist VALUES (
11,577,'577                             ','QDZ3254JM434',10,49,1,0x000000001064a029);
INSERT INTO alinkedlist VALUES (
11,578,'578                             ','SX3254DT384',10,49,1,0x000000001064a02a);
INSERT INTO alinkedlist VALUES (
11,579,'579                             ','SX3254DT384C',10,49,1,0x000000001064a02b);
INSERT INTO alinkedlist VALUES (
11,580,'580                             ','SX3254JS384',10,49,1,0x000000001064a02c);
INSERT INTO alinkedlist VALUES (
11,581,'581                             ','SX4254NT2941',10,49,1,0x000000001064a02d);
INSERT INTO alinkedlist VALUES (
11,582,'582                             ','ZTP1043W',10,50,1,0x000000001064a02e);
INSERT INTO alinkedlist VALUES (
11,583,'583                             ','ZTP1053W',10,50,1,0x000000001064a02f);
INSERT INTO alinkedlist VALUES (
11,584,'584                             ','ZTP1083W',10,50,1,0x000000001064a030);
INSERT INTO alinkedlist VALUES (
11,585,'585                             ','ZTP4015X',10,50,1,0x000000001064a031);
INSERT INTO alinkedlist VALUES (
11,586,'586                             ','F1',10,51,1,0x000000001064a032);
INSERT INTO alinkedlist VALUES (
11,587,'587                             ','F2',10,51,1,0x000000001064a033);
INSERT INTO alinkedlist VALUES (
11,588,'588                             ','F3',10,51,1,0x000000001064a034);
INSERT INTO alinkedlist VALUES (
11,589,'589                             ','SF 2810 ',10,51,1,0x000000001064a035);
INSERT INTO alinkedlist VALUES (
11,590,'590                             ','SF2810D',10,51,1,0x000000001064a036);
INSERT INTO alinkedlist VALUES (
11,591,'591                             ','A7',10,52,1,0x000000001064a037);
INSERT INTO alinkedlist VALUES (
11,592,'592                             ','CAMIÓN CARGO DRIVING TYPE 6X4',10,52,1,0x000000001064a038);
INSERT INTO alinkedlist VALUES (
11,593,'593                             ','CAMIÓN DRIVING TYPE TRACTOR 4X2',10,52,1,0x000000001064a039);
INSERT INTO alinkedlist VALUES (
11,594,'594                             ','CAMIÓN DRIVING TYPE TRACTOR 6X4',10,52,1,0x000000001064a03a);
INSERT INTO alinkedlist VALUES (
11,595,'595                             ','FN6X4-375 VOLQUETE 6X4',10,52,1,0x000000001064a03b);
INSERT INTO alinkedlist VALUES (
11,596,'596                             ','HOWO 371',10,52,1,0x000000001064a03c);
INSERT INTO alinkedlist VALUES (
11,597,'597                             ','TR4X2-336',10,52,1,0x000000001064a03d);
INSERT INTO alinkedlist VALUES (
11,598,'598                             ','TR6X4-375',10,52,1,0x000000001064a03e);
INSERT INTO alinkedlist VALUES (
11,599,'599                             ','VOLQUETE 380 V',10,52,1,0x000000001064a03f);
INSERT INTO alinkedlist VALUES (
11,600,'600                             ','VOLQUETE A7 380 C 6X4',10,52,1,0x000000001064a040);
INSERT INTO alinkedlist VALUES (
11,601,'601                             ','VOLQUETE A7 380 V 6X4',10,52,1,0x000000001064a041);
INSERT INTO alinkedlist VALUES (
11,602,'602                             ','VOLQUETE A7 420 6X4',10,52,1,0x000000001064a042);
INSERT INTO alinkedlist VALUES (
11,603,'603                             ','VOLQUETE A7 420 8X4',10,52,1,0x000000001064a043);
INSERT INTO alinkedlist VALUES (
11,604,'604                             ','VOLQUETE TIPPER DRIVING TYPE 6X4',10,52,1,0x000000001064a044);
INSERT INTO alinkedlist VALUES (
11,605,'605                             ','ZZ1257M4641V',10,52,1,0x000000001064a045);
INSERT INTO alinkedlist VALUES (
11,606,'606                             ','ZZ1257N4347N1',10,52,1,0x000000001064a046);
INSERT INTO alinkedlist VALUES (
11,607,'607                             ','ZZ1257N5847N1',10,52,1,0x000000001064a047);
INSERT INTO alinkedlist VALUES (
11,608,'608                             ','ZZ1317N4667N1',10,52,1,0x000000001064a048);
INSERT INTO alinkedlist VALUES (
11,609,'609                             ','ZZ3253N3841C',10,52,1,0x000000001064a049);
INSERT INTO alinkedlist VALUES (
11,610,'610                             ','ZZ3255S3845B',10,52,1,0x000000001064a04a);
INSERT INTO alinkedlist VALUES (
11,611,'611                             ','ZZ3257M4641',10,52,1,0x000000001064a04b);
INSERT INTO alinkedlist VALUES (
11,612,'612                             ','ZZ3257N3247B',10,52,1,0x000000001064a04c);
INSERT INTO alinkedlist VALUES (
11,613,'613                             ','ZZ3257N3447A1',10,52,1,0x000000001064a04d);
INSERT INTO alinkedlist VALUES (
11,614,'614                             ','ZZ3257N3647C',10,52,1,0x000000001064a04e);
INSERT INTO alinkedlist VALUES (
11,615,'615                             ','ZZ3257N3847B VOLQUETE 6X4',10,52,1,0x000000001064a04f);
INSERT INTO alinkedlist VALUES (
11,616,'616                             ','ZZ3257N3847C',10,52,1,0x000000001064a050);
INSERT INTO alinkedlist VALUES (
11,617,'617                             ','ZZ3257N3847N2',10,52,1,0x000000001064a051);
INSERT INTO alinkedlist VALUES (
11,618,'618                             ','ZZ3317N3267N1',10,52,1,0x000000001064a052);
INSERT INTO alinkedlist VALUES (
11,619,'619                             ','ZZ4187N3517C',10,52,1,0x000000001064a053);
INSERT INTO alinkedlist VALUES (
11,620,'620                             ','ZZ425783249V',10,52,1,0x000000001064a054);
INSERT INTO alinkedlist VALUES (
11,621,'621                             ','ZZ4257N3247N1B',10,52,1,0x000000001064a055);
INSERT INTO alinkedlist VALUES (
11,622,'622                             ','ZZ4257S3249V',10,52,1,0x000000001064a056);
INSERT INTO alinkedlist VALUES (
11,623,'623                             ','ZZ4257V3247N1B',10,52,1,0x000000001064a057);
INSERT INTO alinkedlist VALUES (
11,624,'624                             ','STQ1087L7Y1',10,53,1,0x000000001064a058);
INSERT INTO alinkedlist VALUES (
11,625,'625                             ','STQ3116L7Y53',10,53,1,0x000000001064a059);
INSERT INTO alinkedlist VALUES (
11,626,'626                             ','STQ3126L4Y43',10,53,1,0x000000001064a05a);
INSERT INTO alinkedlist VALUES (
11,627,'627                             ','STQ3129L3Y13',10,53,1,0x000000001064a05b);
INSERT INTO alinkedlist VALUES (
11,628,'628                             ','STQ3256L8Y9S3',10,53,1,0x000000001064a05c);
INSERT INTO alinkedlist VALUES (
11,629,'629                             ','FD3061P10K - 2',10,54,1,0x000000001064a05d);
INSERT INTO alinkedlist VALUES (
11,630,'630                             ','RUMI 4000',10,54,1,0x000000001064a05e);
INSERT INTO alinkedlist VALUES (
11,631,'631                             ','RUMI 6000',10,54,1,0x000000001064a05f);
INSERT INTO alinkedlist VALUES (
11,632,'632                             ','SACHU 4',10,54,1,0x000000001064a060);
INSERT INTO alinkedlist VALUES (
11,633,'633                             ','SACHU 6000 CAMIÓN VOLQUETE',10,54,1,0x000000001064a061);
INSERT INTO alinkedlist VALUES (
11,634,'634                             ','ZB1050KBP1',10,54,1,0x000000001064a062);
INSERT INTO alinkedlist VALUES (
11,635,'635                             ','ZB3047',10,54,1,0x000000001064a063);
INSERT INTO alinkedlist VALUES (
11,636,'636                             ','DYNA 400 COMMON RAIL TD',10,55,1,0x000000001064a064);
INSERT INTO alinkedlist VALUES (
11,637,'637                             ','DYNA 400 TURBO DIESEL',10,55,1,0x000000001064a065);
INSERT INTO alinkedlist VALUES (
11,638,'638                             ','FM8JRSA',10,55,1,0x000000001064a066);
INSERT INTO alinkedlist VALUES (
11,639,'639                             ','10.150E',10,56,1,0x000000001064a067);
INSERT INTO alinkedlist VALUES (
11,640,'640                             ','11-140',10,56,1,0x000000001064a068);
INSERT INTO alinkedlist VALUES (
11,641,'641                             ','12-140',10,56,1,0x000000001064a069);
INSERT INTO alinkedlist VALUES (
11,642,'642                             ','12-170',10,56,1,0x000000001064a06a);
INSERT INTO alinkedlist VALUES (
11,643,'643                             ','13.150 A',10,56,1,0x000000001064a06b);
INSERT INTO alinkedlist VALUES (
11,644,'644                             ','13.180 CAMIÓN 4X2 180 HP. 9 TON.',10,56,1,0x000000001064a06c);
INSERT INTO alinkedlist VALUES (
11,645,'645                             ','13-150',10,56,1,0x000000001064a06d);
INSERT INTO alinkedlist VALUES (
11,646,'646                             ','13-170',10,56,1,0x000000001064a06e);
INSERT INTO alinkedlist VALUES (
11,647,'647                             ','14-150',10,56,1,0x000000001064a06f);
INSERT INTO alinkedlist VALUES (
11,648,'648                             ','14-170',10,56,1,0x000000001064a070);
INSERT INTO alinkedlist VALUES (
11,649,'649                             ','15.180 A',10,56,1,0x000000001064a071);
INSERT INTO alinkedlist VALUES (
11,650,'650                             ','15.180 CAMIÓN 4X2 180 HP 10 TON.',10,56,1,0x000000001064a072);
INSERT INTO alinkedlist VALUES (
11,651,'651                             ','15.190E',10,56,1,0x000000001064a073);
INSERT INTO alinkedlist VALUES (
11,652,'652                             ','15-170',10,56,1,0x000000001064a074);
INSERT INTO alinkedlist VALUES (
11,653,'653                             ','15-190',10,56,1,0x000000001064a075);
INSERT INTO alinkedlist VALUES (
11,654,'654                             ','16-180',10,56,1,0x000000001064a076);
INSERT INTO alinkedlist VALUES (
11,655,'655                             ','16-220',10,56,1,0x000000001064a077);
INSERT INTO alinkedlist VALUES (
11,656,'656                             ','17.220 A',10,56,1,0x000000001064a078);
INSERT INTO alinkedlist VALUES (
11,657,'657                             ','17.220 CAMIÓN 4X2 218 HP 12 TON.',10,56,1,0x000000001064a079);
INSERT INTO alinkedlist VALUES (
11,658,'658                             ','17.250E',10,56,1,0x000000001064a07a);
INSERT INTO alinkedlist VALUES (
11,659,'659                             ','17-210',10,56,1,0x000000001064a07b);
INSERT INTO alinkedlist VALUES (
11,660,'660                             ','17-220',10,56,1,0x000000001064a07c);
INSERT INTO alinkedlist VALUES (
11,661,'661                             ','17-300',10,56,1,0x000000001064a07d);
INSERT INTO alinkedlist VALUES (
11,662,'662                             ','18.310 REMOLCADOR 4X2 303 HP 43 TON.',10,56,1,0x000000001064a07e);
INSERT INTO alinkedlist VALUES (
11,663,'663                             ','18.310T A',10,56,1,0x000000001064a07f);
INSERT INTO alinkedlist VALUES (
11,664,'664                             ','18-310 TRACTO',10,56,1,0x000000001064a080);
INSERT INTO alinkedlist VALUES (
11,665,'665                             ','19.320 (REMOLCADOR)',10,56,1,0x000000001064a081);
INSERT INTO alinkedlist VALUES (
11,666,'666                             ','19.320 E',10,56,1,0x000000001064a082);
INSERT INTO alinkedlist VALUES (
11,667,'667                             ','23.210',10,56,1,0x000000001064a083);
INSERT INTO alinkedlist VALUES (
11,668,'668                             ','23.220 CAMIÓN 6X2 218 HP 19 TON.',10,56,1,0x000000001064a084);
INSERT INTO alinkedlist VALUES (
11,669,'669                             ','24.250E',10,56,1,0x000000001064a085);
INSERT INTO alinkedlist VALUES (
11,670,'670                             ','24-220',10,56,1,0x000000001064a086);
INSERT INTO alinkedlist VALUES (
11,671,'671                             ','24-250',10,56,1,0x000000001064a087);
INSERT INTO alinkedlist VALUES (
11,672,'672                             ','26.220',10,56,1,0x000000001064a088);
INSERT INTO alinkedlist VALUES (
11,673,'673                             ','26.260 A',10,56,1,0x000000001064a089);
INSERT INTO alinkedlist VALUES (
11,674,'674                             ','26-260',10,56,1,0x000000001064a08a);
INSERT INTO alinkedlist VALUES (
11,675,'675                             ','26-300',10,56,1,0x000000001064a08b);
INSERT INTO alinkedlist VALUES (
11,676,'676                             ','26-310',10,56,1,0x000000001064a08c);
INSERT INTO alinkedlist VALUES (
11,677,'677                             ','31.260 CAMIÓN 6X4 256 HP 24 TON.',10,56,1,0x000000001064a08d);
INSERT INTO alinkedlist VALUES (
11,678,'678                             ','31.310 A',10,56,1,0x000000001064a08e);
INSERT INTO alinkedlist VALUES (
11,679,'679                             ','31.310 CAMIÓN 6X4 303 HP 24 TON.',10,56,1,0x000000001064a08f);
INSERT INTO alinkedlist VALUES (
11,680,'680                             ','31.310 REMOLCADOR 6X4 303 HP 45 TON.',10,56,1,0x000000001064a090);
INSERT INTO alinkedlist VALUES (
11,681,'681                             ','31.320',10,56,1,0x000000001064a091);
INSERT INTO alinkedlist VALUES (
11,682,'682                             ','31.370 A',10,56,1,0x000000001064a092);
INSERT INTO alinkedlist VALUES (
11,683,'683                             ','35-300',10,56,1,0x000000001064a093);
INSERT INTO alinkedlist VALUES (
11,684,'684                             ','40-300',10,56,1,0x000000001064a094);
INSERT INTO alinkedlist VALUES (
11,685,'685                             ','7.110',10,56,1,0x000000001064a095);
INSERT INTO alinkedlist VALUES (
11,686,'686                             ','7-110 CO',10,56,1,0x000000001064a096);
INSERT INTO alinkedlist VALUES (
11,687,'687                             ','7-110 S',10,56,1,0x000000001064a097);
INSERT INTO alinkedlist VALUES (
11,688,'688                             ','8.120 A',10,56,1,0x000000001064a098);
INSERT INTO alinkedlist VALUES (
11,689,'689                             ','8-120',10,56,1,0x000000001064a099);
INSERT INTO alinkedlist VALUES (
11,690,'690                             ','8-140',10,56,1,0x000000001064a09a);
INSERT INTO alinkedlist VALUES (
11,691,'691                             ','8-140 CO',10,56,1,0x000000001064a09b);
INSERT INTO alinkedlist VALUES (
11,692,'692                             ','8-150',10,56,1,0x000000001064a09c);
INSERT INTO alinkedlist VALUES (
11,693,'693                             ','8-150 TE',10,56,1,0x000000001064a09d);
INSERT INTO alinkedlist VALUES (
11,694,'694                             ','9.150 C',10,56,1,0x000000001064a09e);
INSERT INTO alinkedlist VALUES (
11,695,'695                             ','9-150',10,56,1,0x000000001064a09f);
INSERT INTO alinkedlist VALUES (
11,696,'696                             ','MD1044Z',10,57,1,0x000000001064a0a0);
INSERT INTO alinkedlist VALUES (
11,697,'697                             ','A30D 6X6',10,58,1,0x000000001064a0a1);
INSERT INTO alinkedlist VALUES (
11,698,'698                             ','A35D 6X6',10,58,1,0x000000001064a0a2);
INSERT INTO alinkedlist VALUES (
11,699,'699                             ','A40D 6X6',10,58,1,0x000000001064a0a3);
INSERT INTO alinkedlist VALUES (
11,700,'700                             ','F 10 FW',10,58,1,0x000000001064a0a4);
INSERT INTO alinkedlist VALUES (
11,701,'701                             ','F 10 TH',10,58,1,0x000000001064a0a5);
INSERT INTO alinkedlist VALUES (
11,702,'702                             ','F 12 FW',10,58,1,0x000000001064a0a6);
INSERT INTO alinkedlist VALUES (
11,703,'703                             ','F 12 FWGT',10,58,1,0x000000001064a0a7);
INSERT INTO alinkedlist VALUES (
11,704,'704                             ','F 12 TH',10,58,1,0x000000001064a0a8);
INSERT INTO alinkedlist VALUES (
11,705,'705                             ','F 12 THGT',10,58,1,0x000000001064a0a9);
INSERT INTO alinkedlist VALUES (
11,706,'706                             ','FH',10,58,1,0x000000001064a0aa);
INSERT INTO alinkedlist VALUES (
11,707,'707                             ','FL',10,58,1,0x000000001064a0ab);
INSERT INTO alinkedlist VALUES (
11,708,'708                             ','FM',10,58,1,0x000000001064a0ac);
INSERT INTO alinkedlist VALUES (
11,709,'709                             ','FMX',10,58,1,0x000000001064a0ad);
INSERT INTO alinkedlist VALUES (
11,710,'710                             ','NE',10,58,1,0x000000001064a0ae);
INSERT INTO alinkedlist VALUES (
11,711,'711                             ','NH',10,58,1,0x000000001064a0af);
INSERT INTO alinkedlist VALUES (
11,712,'712                             ','VM',10,58,1,0x000000001064a0b0);
INSERT INTO alinkedlist VALUES (
11,713,'713                             ','VNL64T670',10,58,1,0x000000001064a0b1);
INSERT INTO alinkedlist VALUES (
11,714,'714                             ','HN3320P35C6M',10,59,1,0x000000001064a0b2);
INSERT INTO alinkedlist VALUES (
11,715,'715                             ','NXG3251D3KC',10,60,1,0x000000001064a0b3);
INSERT INTO alinkedlist VALUES (
11,716,'716                             ','NXG5160CSY3',10,60,1,0x000000001064a0b4);
INSERT INTO alinkedlist VALUES (
11,717,'717                             ','XZJ5245JQZ16D',10,60,1,0x000000001064a0b5);
INSERT INTO alinkedlist VALUES (
11,718,'718                             ','HXK1041T',10,61,1,0x000000001064a0b6);
INSERT INTO alinkedlist VALUES (
11,719,'719                             ','NJ 1028',10,62,1,0x000000001064a0b7);
INSERT INTO alinkedlist VALUES (
11,720,'720                             ','NJ 1062',10,62,1,0x000000001064a0b8);
INSERT INTO alinkedlist VALUES (
11,721,'721                             ','NJ 1063',10,62,1,0x000000001064a0b9);
INSERT INTO alinkedlist VALUES (
11,722,'722                             ','NJ 1120',10,62,1,0x000000001064a0ba);
INSERT INTO alinkedlist VALUES (
11,723,'723                             ','NJ 3250',10,62,1,0x000000001064a0bb);
INSERT INTO alinkedlist VALUES (
11,724,'724                             ','NJ 4180',10,62,1,0x000000001064a0bc);
INSERT INTO alinkedlist VALUES (
11,725,'725                             ','NJ 4250',10,62,1,0x000000001064a0bd);
INSERT INTO alinkedlist VALUES (
11,726,'726                             ','NJ1028DB BARANDA',10,62,1,0x000000001064a0be);
INSERT INTO alinkedlist VALUES (
11,727,'727                             ','NJ1042DA',10,62,1,0x000000001064a0bf);
INSERT INTO alinkedlist VALUES (
11,728,'728                             ','NJ1050HDFJ',10,62,1,0x000000001064a0c0);
INSERT INTO alinkedlist VALUES (
11,729,'729                             ','NJ1050HDFL',10,62,1,0x000000001064a0c1);
INSERT INTO alinkedlist VALUES (
11,730,'730                             ','NJ1062DA',10,62,1,0x000000001064a0c2);
INSERT INTO alinkedlist VALUES (
11,731,'731                             ','NJ1063DAW',10,62,1,0x000000001064a0c3);
INSERT INTO alinkedlist VALUES (
11,732,'732                             ','NJ1120DYW',10,62,1,0x000000001064a0c4);
INSERT INTO alinkedlist VALUES (
11,733,'733                             ','NJ3250D8W1',10,62,1,0x000000001064a0c5);
INSERT INTO alinkedlist VALUES (
11,734,'734                             ','ZYT5200TCY',10,63,1,0x000000001064a0c6);
INSERT INTO alinkedlist VALUES (
11,735,'735                             ','Otros',10,64,0,0x000000001064a0c7);
INSERT INTO alinkedlist VALUES (
13,0,'00                              ','Transcore',NULL,NULL,1,0x000000001084b147);
INSERT INTO alinkedlist VALUES (
13,1,'01                              ','3M',NULL,NULL,1,0x000000001084b148);
INSERT INTO alinkedlist VALUES (
13,99,'99                              ','Cuenta anónima',NULL,NULL,0,0x000000001095cd27);
INSERT INTO alinkedlist VALUES (
14,0,'01                              ','RECARGA PORTAL WEB',NULL,NULL,1,0x0000000010f4122d);
INSERT INTO alinkedlist VALUES (
14,1,'02                              ','RECARGA AUTOMÁTICA',NULL,NULL,1,0x0000000010f40a6b);
INSERT INTO alinkedlist VALUES (
14,2,'03                              ','RECARGA AUTOMÁTICA (VISA)',NULL,NULL,1,0x0000000011305570);
INSERT INTO alinkedlist VALUES (
14,99,'99                              ','Otros',NULL,NULL,0,0x00000000113095cc);
INSERT INTO alinkedlist VALUES (
15,1,'01                              ','Anulación de la operación',NULL,NULL,0,0x000000001131e84d);
INSERT INTO alinkedlist VALUES (
15,2,'02                              ','Anulación por error en el RUC',NULL,NULL,0,0x000000001131e84e);
INSERT INTO alinkedlist VALUES (
15,3,'03                              ','Corrección por error en la descripción',NULL,NULL,0,0x000000001131e84f);
INSERT INTO alinkedlist VALUES (
15,4,'04                              ','Descuento global',NULL,NULL,0,0x000000001131e850);
INSERT INTO alinkedlist VALUES (
15,5,'05                              ','Descuento por ítem',NULL,NULL,0,0x000000001131e851);
INSERT INTO alinkedlist VALUES (
15,6,'06                              ','Devolución total',NULL,NULL,0,0x000000001131e852);
INSERT INTO alinkedlist VALUES (
15,7,'07                              ','Devolución por ítem',NULL,NULL,0,0x000000001131e853);
INSERT INTO alinkedlist VALUES (
15,8,'08                              ','Bonificación',NULL,NULL,0,0x000000001131e854);
INSERT INTO alinkedlist VALUES (
15,9,'09                              ','Disminución en el valor',NULL,NULL,0,0x000000001131e855);
INSERT INTO alinkedlist VALUES (
15,10,'10                              ','Otros conceptos',NULL,NULL,0,0x000000001131e856);
INSERT INTO alinkedlist VALUES (
16,1,'01                              ','Intereses por mora',NULL,NULL,0,0x000000001131e857);
INSERT INTO alinkedlist VALUES (
16,2,'02                              ','Aumento en el valor',NULL,NULL,0,0x000000001131e858);
INSERT INTO alinkedlist VALUES (
16,3,'03                              ','Penalidades / otros conceptos',NULL,NULL,0,0x000000001131e859);
");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
