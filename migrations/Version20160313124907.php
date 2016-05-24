<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160313124907 extends AbstractMigration
{
    public static $description = "Crear tabla de subtemas de solicitudes";
    public static $author = "Martin Cruz";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `solicitudes_subtheme` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(250) NOT NULL,
                `solicitudes_theme_id` INT NOT NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT now(),
                `updated_at` TIMESTAMP NOT NULL DEFAULT now(),
                PRIMARY KEY (`id`),
                INDEX `fk_solicitudes_subtheme_idx` (`solicitudes_theme_id` ASC),
                CONSTRAINT `fk_solicitudes_subtheme`
                  FOREIGN KEY (`solicitudes_theme_id`)
                  REFERENCES `solicitudes_theme` (`id`)
                  ON DELETE NO ACTION
                  ON UPDATE NO ACTION)
              ENGINE = InnoDB;

              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Alcance de los Servicios', 1);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Como Efectuar el Pago(Tarjeta, Efectivo, etc)', 1);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Documentación Requerida', 1);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Existencia de Promociones', 1);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Modalidades de Pago(Pre y Pos)', 1);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Puntos de Venta y/o afiliación', 1);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Tipos de Planes Pos Pago', 1);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Tipos de Planes Pre Pago', 1);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Verificación de Saldo', 1);

              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Accidente ocurrido en Vía de Peaje E Pass', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Daños al Vehículo por Mal Procedimiento inadecuado del Sistema', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Funcionamiento Incorrecto del Portal WEB', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Imposibilidad de Visualizar el resumen de Cuenta en Portal WEB', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Impresión Incorrecta de Boleta', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Impresión Incorrecta de Factura', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Mala Atención por Parte de Empresas Asociadas al Servicio E Pass', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Mala Atención por Parte de Funcionario de E pass - Área Atención al Cliente', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Mala Atención por Parte de Funcionario de E pass - Área Comercial', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Mala Atención por Parte de Funcionario de E pass - Área Operación', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('No conseguí pasar de forma automática en Estacionamiento', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('No conseguí pasar de forma automática en Peaje', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('No Reconocimiento de Débito por Transacción', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('No Reconocimiento de Monto de Recarga- Pre Pago', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('No Reconocimiento de Tasa de Mantenimiento - Pos Pago', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('No Reconocimiento de Tasa de Recarga- Pre Pago', 2);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Problemas con Carta Fianza', 2);

              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Atención', 3);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Calidad de Servicio', 3);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Otros', 3);

              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Adquisición de TAG Pre Pago Extra (Sin Vehiculo)', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Afiliación de Nuevo Cliente a Epass Pós Pago', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Afiliación de Nuevo Cliente a Epass Pre Pago', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Alta de Vehículo a Cuenta Preexistente Pos Pago', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Alta de Vehículo a Cuenta Preexistente Pre Pago', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Desafiliación de EPass para Clientes Pos Pago', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Desafiliación de EPass para Clientes Pre Pago', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Desbloqueo de TAG', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Entrega de TAG con cita programada con Cobro de Servicio (Pre Pagos)', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Entrega de TAG con cita programada (Pos Pagos Exclusivos)', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Reposición de TAG por pérdida, daño, robo o cambio de vehículo', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Solicitud de Actualización de Datos (Solamente PJ)', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Solicitud de Actualización de Datos (Solamente PN)', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Solicitud de adhesión a recarga automática', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Solicitud de cambio de Modalidad de Pos Pago para Pre Pago', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Solicitud de cambio de Modalidad de Pre Pago para Pos Pago', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Solicitud de Cambio de Plan de la misma modalidad (Pre Pago)', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Solicitud de Factura o Boleta', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Suspensión o Baja Definitiva de TAG por pérdida, robo o cambio de vehículo', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Suspensión o Baja Temporaria de TAG por Viaje, Mantenimiento, etc', 4);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Sustitución de TAG por defecto', 4);


              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Mejora de Atención', 5);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Mejora de Calidad de Servicio', 5);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Mejora de Procedimiento', 5);
              INSERT INTO solicitudes_subtheme (name, solicitudes_theme_id) values('Otros', 5);

                ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
