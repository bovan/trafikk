<?php
App::uses('AppController', 'Controller');
/**
 * Updates Controller
 *
 * @property Update $Update
 */
class UpdatesController extends AppController {

    public function log($success) {
        return $this->Update->log($success);
    }

}
