<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160314014338 extends AbstractMigration
{
    public static $description = "alterando los codigos de pago";

    public function up(MetadataInterface $schema)
    {
        $this->addSql('update payment_methods set code="VISA" where id=1;');
        $this->addSql('update payment_methods set code="MASTERCARD" where id=2;');
        $this->addSql('update payment_methods set code="Amex" where id=3;');
        $this->addSql('update payment_methods set code="Diners" where id=4;');
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
