<?php

namespace Epass\Controller;

use Application\Form\SolicitudForm;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class SolicitudesController extends AbstractRestfulController
{
    public function create($data)
    {
        $form = new SolicitudForm();
        $form->setData($data);

        if ($form->isValid()) {
            $authService = $this->getServiceLocator()->get('AuthService');
            $user = $authService->getStorage()->read();

            // Send to Zendesk platform
            $zendesk = $this->serviceLocator->get('zendesk');
            $ticket = $zendesk->createTicket($data);

            // Save solicitud in database
            $solicitud = $ticket;
            $solicitud['ticket_id'] = $ticket['id'];
            $solicitud['user_id']   = $user->id;

            unset($solicitud['id']);
            unset($solicitud['requester']);
            unset($solicitud['type']);

            $solicitudTable = $this->serviceLocator->get('SolicitudesModel');
            $solicitudTable->save($solicitud);

            // Update user col zendesk_id

            return new JsonModel([
                'status' => 'ok',
                'data' => [
                    'ticket' => $ticket,
                    'solicitud' => $solicitud
                ]
            ]);
        }

        return new JsonModel([
            'status' => 'fail',
            'messages' => $form->getMessages()
        ]);
    }

    public function ajaxGetByUserAction()
    {
        $userId = $this->params()->fromRoute('id');

        $authService = $this->getServiceLocator()->get('AuthService');
        $zendesk = $this->getServiceLocator()->get('zendesk');
        $table = $this->serviceLocator->get('SolicitudesModel');

        $user = $authService->getStorage()->read();
        $solicitudes = $table->getAllByUser($user->id);

        $ids = [];
        foreach ($solicitudes as $solicitud) {
            array_push($ids, $solicitud['ticket_id']);
        }

        $tickets = $zendesk->getTickets($ids);

        return new JsonModel([
            'status' => 'ok',
            'ids' => $ids,
            'user_id' => $userId,
            'tickets' => $tickets,
            'data' => $table->getAllByUser($userId)
        ]);
    }

    /**
     * @param int $id User id
     * @return JsonModel
     */
    public function get($id)
    {
        $userId = $id;

        // Get ids tickets database by user
        $ticketIds = [];

        $zendesk = $this->serviceLocator->get('zendesk');
        $tickets = $zendesk->getTickets($ticketIds);

        return new JsonModel([
            'status' => 'ok',
            'id' => $id,
            'tickets' => $tickets
        ]);
    }

    public function ajaxTemasSolicitudesAction()
    {
        $table = $this->serviceLocator->get('SolicitudesModel');
        $response = $table->getTemas();        
        return new JsonModel([
            'status' => 'ok',
            'data' => $response
        ]);
    }

    public function ajaxSubtemasSolicitudesAction()
    {
        $id = $this->params()->fromRoute('id');
        $table = $this->serviceLocator->get('SolicitudesModel');
        $response = $table->getSubTemas($id);
        
        for ($i=0; $i<count($response); $i++) {
            //$new_response[] = array_map("utf8_encode", $response[$i]);
            $new_response[] = $response[$i];
        }

        return new JsonModel([
            'status' => 'ok',
            'data' => $response
        ]);
    }

    public function ajaxTemasZendeskAction()
    {
        $zendesk = $this->serviceLocator->get('zendesk');
        $response = $zendesk->getThemesValues();
        //$response = $zendesk->getValuesFieldTicket(30725898);
        $response = (array) $response;
        return new JsonModel($response);
    }

    public function getList()
    {
        $zendesk = $this->serviceLocator->get('zendesk');
        $tickets = $zendesk->getUser([1,2]);

        return new JsonModel([
            'status' => 'ok',
            'data'   => $tickets
        ]);
    }

    public function options()
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Allow', implode(',', array('POST'/* ,'DELETE','GET','PUT' */)));
        return $response;

    }

    public function getResponseWithHeader()
    {
        $response = $this->getResponse();
        $response->getHeaders()
                ->addHeaderLine('Access-Control-Allow-Origin', '*')
                ->addHeaderLine('Access-Control-Allow-Methods', 'POST')
                ->addHeaders(array('Content-Type' => 'application/json;charset=UTF-8'));
        return $response;

    }

}
