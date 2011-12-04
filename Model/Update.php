<?php
App::uses('AppModel', 'Model');
/**
 * Update Model
 */
class Update extends AppModel {
    
    /**
     * logs the success result in the updates table which automatically also
     * stores a new auto increment id and timestamp
     * @param boolean $success
     * @return boolean
     */
    public function log($success) {
        // TODO: this is probably an unnecessary step in cake...
        // but it does however add some simple validation
        // cleaner to use beforeSave probably
        $value = ($success) ? 1 : 0;
        // store the success as a new entry
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
