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
                $endlon = $message->coordinates->endPoint->xCoord;
                $endlat = $message->coordinates->endPoint->yCoord;
            } else {
                $endlat = NULL;
                $endlon = NULL;
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
                    'longitude' => floatval($message->coordinates->startPoint->xCoord),
                    'latitude' => floatval($message->coordinates->startPoint->yCoord),
                    'endlatitude' => floatval($endlat),
                    'endlongitude' => floatval($endlon),
                )
            );
            
            $this->create();
            if (!$this->save($data)) {
                return false;
            }
            return true;
        }
        
        public function findNearby($lat, $lon, $extended) {
            $latitude = floatval($lat);
            $longitude = floatval($lon);
            if (!is_float($longitude) || !is_float($latitude)) {
                return NULL;
            }
            
            // if extended search, use higher search range
            $range = ($extended) ? 3 : 1;
            $messages = $this->find('all', array(
                'conditions' => array(
                    'Message.latitude BETWEEN ? AND ?' => array($latitude - $range, $latitude + $range),
                    'Message.longitude BETWEEN ? AND ?' => array($longitude - $range, $longitude + $range)
                )
            ));

            // get distance from location
            foreach ($messages as $key => $message) {
                $msglat = $message['Message']['latitude'];
                $msglon = $message['Message']['longitude'];
                $messages[$key]['Message']['distance'] = $this->getDistance($latitude, $longitude, $msglat, $msglon);
            }
            return $messages;
        }
        
        /**
         * Calculates distance in km between one set of coords and another
         */
        private function getDistance($lat, $lon, $msglat, $msglon) {
            $dLon = $msglon - $lon;
            $diff = sin(deg2rad($lat)) * sin(deg2rad($msglat)) +
                cos(deg2rad($lat)) * cos(deg2rad($msglat)) * cos(deg2rad($dLon));
            $diff = acos($diff);
            $diff = rad2deg($diff);
            $km = $diff * 60 * 1.8531596;
            return intval($km);
        }
}
