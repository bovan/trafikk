<?php
App::uses('AppModel', 'Model');
/**
 * Update Model
 *
 */
class Update extends AppModel {
    
    public function log($success) {
        $value = ($success) ? 1 : 0;
        $this->create();
        $data = array(
            'Update' => array(
                'success' => $value
        ));
        if ($this->save($data)) {
            return true;
        }
        return false;
    }
}
