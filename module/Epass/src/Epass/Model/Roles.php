<?php

namespace Epass\Model;
use Zend\Mvc\MvcEvent;

class Roles{
    
    public function getDbRoles(MvcEvent $e) {

        $dbAdapter = $e->getApplication()->getServiceManager()->get('adapter');
        $statement = $dbAdapter->query('SELECT roles.name rol, resources.name ruta, roles_resources.permission FROM roles_resources JOIN roles ON (roles_resources.role_id = roles.id) JOIN resources ON (roles_resources.resource_id = resources.id)');
        $results = $statement->execute()->getResource()->fetchAll();
        $roles = array();
        foreach($results as $result){
            $roles[$result['rol']][$result['permission']][] = $result['ruta'];
        }
        return $roles;
    }
    
    public function getRoles(){
        
        $roles_common = array('home','auth','personas','que-es-epass','beneficios','empresas',
                            'donde', 'como', 'afiliacion', 'preguntas-frecuentes', 'afiliate',
                            'recarga', 'descargar-comprobante', 'reclamaciones', 'auth/actions','front');
        
        return array(
            'publico'=> array(
                'allow' => $roles_common,
                'deny' => array(
                            'cuenta'
                )
            ),
            'usuario'=> array(
                'allow' => array_merge( 
                            $roles_common, 
                            array('cuenta', 'pasarelas', 'pasarelas/visa-confirm','reportes','vehiculos','comprobantes')
                        ),
            ),
            'usuario_recarga'=> array(
                'allow' => array_merge(
                            $roles_common, 
                            array('cuenta', 'pasarelas', 'pasarelas/visa-confirm')
                        ),
            ),
            'admin'=> array(
                'allow' => array_merge( 
                            $roles_common, 
                            array('cuenta','reportes','vehiculos','comprobantes')
                        ),
            ),
        );
    }
    
}
