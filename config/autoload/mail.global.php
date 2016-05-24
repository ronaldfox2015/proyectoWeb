<?php
return array(
  'mail' => array(
      'transport' => array(
        'options' => array(
            'host' => 'smtp.gmail.com',
            'port' => 465,
            'connection_class' => 'plain',
            'connection_config' => array(
                'username' => 'pruebas.epass',
                'password' => 'pruebas.epass123',
                'ssl' => 'ssl',
            ),
        ),
      ),
      'fromEmail' => 'contacto@epass.pe',
      'fromName' => 'e-pass',
      'toEmailAdmin' => 'samuel.marquez@clicksandbricks.pe',
      'toEmailAdminName' => 'e-pass',
      'toEmailInfoAfiliacion'=>'deybeecz@gmail.com',
      'toEmailNewAfiliation' => array(
            'karina.salazar@clicksandbricks.pe',
            'rgarcia@clicksandbricks.pe',
            'milagros.vallejos@clicksandbricks.pe'
       ),
      'enabled' => true,
      'list.allowed' => array(
          'enabled' => false,
          'domains' => array(
              'epass.pe',
          ),
          'emails' => array(
              'dchavez@clicksandbricks.pe',
              'karina.salazar@clicksandbricks.pe',
              'renzo.tejada@clicksandbricks.pe',
              'christian.gonzales@clicksandbricks.pe',
              'jhon.campos@clicksandbricks.pe',
              'martin.cruz@clicksandbricks.pe',
              'ronald.cutisaca@clicksandbricks.pe',
              'cesar.velasquez@clicksandbricks.pe',
              'daniel.moreno@clicksandbricks.pe',
              'samuel.marquez@clicksandbricks.pe',
              'juan.sanchez@clicksandbricks.pe',
              'aespinoza@clicksandbricks.pe'
          )
      ),
      'test.control' => array(
          'enabled' => true,
          'emails' => array(
              'dchavez@clicksandbricks.pe',
              'karina.salazar@clicksandbricks.pe',
              'renzo.tejada@clicksandbricks.pe',
              'jhon.campos@clicksandbricks.pe',
              'martin.cruz@clicksandbricks.pe',
              'ronald.cutisaca@clicksandbricks.pe',
              'cesar.velasquez@clicksandbricks.pe',
              'daniel.moreno@clicksandbricks.pe',
              'samuel.marquez@clicksandbricks.pe',
              'juan.sanchez@clicksandbricks.pe',
              'aespinoza@clicksandbricks.pe',
              'milagros.vallejos@clicksandbricks.pe'
          )
      ),
      'dir' => __DIR__ . '/../email',
      'show_log' => true
  ),
);
