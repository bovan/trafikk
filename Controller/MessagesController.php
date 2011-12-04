<?php

App::uses('AppController', 'Controller');

/**
 * Messages Controller
 *
 * @property Message $Message
 */
class MessagesController extends AppController {

    public $components = array('RequestHandler');
    
    
    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->setTitle('Meldinger');
        $this->Message->recursive = 0;
        $this->set('messages', $this->paginate());
    }
    
    public function nearby($lat = null, $lon = null, $extended = false) {
        // try to get any nearby messages
        $messages = $this->Message->findNearby($lat, $lon, $extended);
        
        // render it as JSON
        RequestHandlerComponent::setContent('json');
        $this->set('json', $messages);
        $this->layout = 'ajax';
        $this->render('/Elements/json');
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Message->id = $id;
        if (!$this->Message->exists()) {
            throw new NotFoundException(__('Invalid message'));
        }
        $this->set('message', $this->Message->read(null, $id));
    }

    /**
     * update method
     * TODO: create cron job
     */
    public function update() {
        
        $this->setTitle('Updating');
        
        $result = $this->Message->updateData();
        
        $this->set('json', $result);
        $this->layout = 'ajax';
        $this->render('/Elements/json');
    }

}
