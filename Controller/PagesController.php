<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * Default helper
 *
 * @var array
 */
	public $helpers = array('Html');

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
        
        
        public function main() {
            $title = $this->getSiteTitle('Kart');
            $this->set(compact('title'));
            // render map
            $this->render('map');
        }
        
        public function xml_test() {
            $title = $this->getSiteTitle('XML Test');
            
            App::uses('Xml', 'Utility');
            
            // try cache
            $result = Cache::read('vegvesen_xml', 'halfhour');
            
            if (!$result) {
                // get XML
                $url = 'http://www.vegvesen.no/trafikk/xml/search.xml?searchFocus.counties=2&searchFocus.counties=9&searchFocus.counties=6&searchFocus.counties=20&searchFocus.counties=4&searchFocus.counties=12&searchFocus.counties=15&searchFocus.counties=17&searchFocus.counties=18&searchFocus.counties=5&searchFocus.counties=3&searchFocus.counties=11&searchFocus.counties=14&searchFocus.counties=16&searchFocus.counties=8&searchFocus.counties=19&searchFocus.counties=10&searchFocus.counties=7&searchFocus.counties=1&searchFocus.messageType=17&searchFocus.messageType=19&searchFocus.messageType=20&searchFocus.messageType=18&searchFocus.messageType=22&searchFocus.messageType=23&searchFocus.sortOrder=0';
                $xml = Xml::build($url);

                // XML = simpleXML object (may look odd, but it's a silly XML!)
                $messages = $xml->{'result-array'}->result->messages->message;
                    // foreach messages:
                    // ================
                    // 
                    // Essentials:
                    // ==========
                    //   heading - title
                    //   messageType - category
                    //   ingress - main message
                    //   
                    // Other useful properties:
                    // =======================
                    //   roadType = Ev/Rv
                    //   roadNumber = number of road (i.e. Ev + 6 = E6)
                    //   actualCounties => string county of origin
                    //   coordinates
                    //   urgency 


                // render some useful debug output for now
                Cache::write('vegvesen_xml', $messages->asXML(), 'halfhour');
            }
            else {
                $messages = Xml::build($result);
            }
            $count = count($messages);
            if ($count > 0) {
                $counter = "Number of messages = " . $count;
            }
            else {
                // SOMETHING WENT WRONG! (probably)
                die("didn't find any messages in the xml");
            }

            $this->set(compact('counter', 'title', 'messages'));
            $this->render('debug');
        }
}
