<?php
/**
 * Update shell is the cron job which fetches new data
 */
class UpdateShell extends AppShell {
    // updates db using the Message model
    public $uses = array('Message');
    
    public function main() {
        $this->out('Updating data at ' . date('Y-m-d H:i:s'));
        $result = $this->Message->updateData();
        if ($result['success'] == TRUE) {
            $this->out('Update complete');
        }
        else {
            $this->out('Update failed');
        }
        
    }
}