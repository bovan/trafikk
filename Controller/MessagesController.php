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
    
    public function nearby($lat = null, $lon = null) {
        // try to get any nearby messages
        $messages = $this->Message->findNearby($lat, $lon);
        
        // render it as JSON
        RequestHandlerComponent::setContent('json');
        $this->set('messages', $messages);
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
        
        App::uses('Xml', 'Utility');

        // get XML
        $url = 'http://www.vegvesen.no/trafikk/xml/search.xml?searchFocus.counties=2&searchFocus.counties=9&searchFocus.counties=6&searchFocus.counties=20&searchFocus.counties=4&searchFocus.counties=12&searchFocus.counties=15&searchFocus.counties=17&searchFocus.counties=18&searchFocus.counties=5&searchFocus.counties=3&searchFocus.counties=11&searchFocus.counties=14&searchFocus.counties=16&searchFocus.counties=8&searchFocus.counties=19&searchFocus.counties=10&searchFocus.counties=7&searchFocus.counties=1&searchFocus.messageType=17&searchFocus.messageType=19&searchFocus.messageType=20&searchFocus.messageType=18&searchFocus.messageType=22&searchFocus.messageType=23&searchFocus.sortOrder=0';
        $xml = Xml::build($url);

        // XML = simpleXML object (may look odd, but it's a silly XML!)
        $messages = $xml->{'result-array'}->result->messages;
        
        // if we got tons of messages, wipe the db
        // todo: could probably replace this with truncate
        if (count($messages->message) > 0) {
            $this->Message->deleteAll(array(true => true));
        }

        // add messages
        foreach ($messages->message as $message) {
            $success = $this->Message->addMessage($message);
            if (!success) {
                // TODO: add warning or stuff here
            }
        }
    }

}
