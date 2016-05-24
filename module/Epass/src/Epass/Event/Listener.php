<?php

namespace Epass\Event;

use Zend\EventManager\EventManagerInterface,
    Zend\EventManager\ListenerAggregateInterface;

class Listener implements ListenerAggregateInterface
{

    const MAIL_EVENT = 'event.mail';

    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * Attach to an event manager
     *
     * @param  EventManagerInterface $events
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {

    }

    /**
     * Detach all our listeners from the event manager
     *
     * @param  EventManagerInterface $events
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {

    }

}
