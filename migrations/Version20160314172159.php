<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160314172159 extends AbstractMigration
{

    public static $description = "Migration description";

    public function up(MetadataInterface $schema)
    {
        $this->addSql('ALTER TABLE `transaction_detail`    
 CHANGE `recharge_rate` `recharge_rate` DECIMAL(11) NOT NULL;
ALTER TABLE `transaction_detail`     
CHANGE `recharge_rate` `recharge_rate` DOUBLE NOT NULL; ');

    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);

    }

}
