<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 */
class Message extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'heading';
        
        
        /**
         * Adds a message
         * @param type $message 
         */
        public function addMessage ($message) {
            if (isset($message->coordinates->endPoint)) {
                $endlat = $message->coordinates->endPoint->xCoord;
                $endlon = $message->coordinates->endPoint->yCoord;
            } else {
                $endlat = null;
                $endlon = null;
            }

            // Todo: iterate over all values and validate them
            
            $data = array(
                'Message' => array(
                    'heading' => $message->heading,
                    // TODO: messagetype should be in its own table or constants
                    'messageType' => $message->messageType,
                    'ingress' => $message->ingress,
                    'messagenumber' => $message->messagenumber,
                    'version' => $message->version,
                    'roadType' => $message->roadType,
                    'roadNumber' => $message->roadNumber,
                    // TODO: parse validFrom
                    'validFrom' => $message->validFrom,
                    // TODO: do we have a validTo ?
                    'latitude' => $message->coordinates->startPoint->xCoord,
                    'longitude' => $message->coordinates->startPoint->yCoord,
                    'endlatitude' => $endlat,
                    'endlongitude' => $endlon,
                )
            );
            
            $this->Message->create();
            if (!$this->Message->save($data)) {
                return false;
            }
            return true;
        }
        
        public function findNearby($lat, $long) {
            
        }
}
