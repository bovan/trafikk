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
        
        /**
         * gets new messages
         */
        public function updateData() {
            App::uses('Xml', 'Utility');
            // get XML
            $url = 'http://www.vegvesen.no/trafikk/xml/search.xml?searchFocus.counties=2&searchFocus.counties=9&searchFocus.counties=6&searchFocus.counties=20&searchFocus.counties=4&searchFocus.counties=12&searchFocus.counties=15&searchFocus.counties=17&searchFocus.counties=18&searchFocus.counties=5&searchFocus.counties=3&searchFocus.counties=11&searchFocus.counties=14&searchFocus.counties=16&searchFocus.counties=8&searchFocus.counties=19&searchFocus.counties=10&searchFocus.counties=7&searchFocus.counties=1&searchFocus.messageType=17&searchFocus.messageType=19&searchFocus.messageType=20&searchFocus.messageType=18&searchFocus.messageType=22&searchFocus.messageType=23&searchFocus.sortOrder=0';
            $xml = Xml::build($url);

            // XML = simpleXML object (may look odd, but it's a silly XML!)
            $messages = $xml->{'result-array'}->result->messages;

            // if we got tons of messages, wipe the db
            // todo: could probably replace this with truncate
            if (count($messages->message) > 0) {
                $this->deleteAll(array(true => true));
            }

            // add messages
            $result = array('success' => true);
            foreach ($messages->message as $message) {
                $success = $this->addMessage($message);
                if (!$success) {
                    $result['success'] = false;
                    // TODO: add warning or stuff here
                }
            }
            return $result;
        }
}
