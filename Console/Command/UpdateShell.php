<?php
/**
 * Update shell is the cron job which fetches new data
 */
class UpdateShell extends AppShell {
    
    public $uses = array('Message');
    
    public function main() {
        $this->out('Updating data at ' . date('Y-m-d H:i:s'));
        $result = $this->Message->updateData();
        if ($result['success'] == TRUE) {
            $this->out('Update complete');
            // TODO: add timestamp somewhere of when last update occurred
        }
        else {
            $this->out('Update failed');
        }
        
    }
}