<?php
App::uses('AppController', 'Controller');
/**
 * MapMarkers Controller
 *
 * @property MapMarker $MapMarker
 * @property PaginatorComponent $Paginator
 */
class MapMarkersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
        public function beforeFilter() {
            parent::beforeFilter();
            // Allow non-auth users to access home.
            $this->Auth->allow('index');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
//		$this->MapMarker->recursive = 0;
//		$this->set('mapMarkers', $this->Paginator->paginate());

                //save user position in session
                if ($this->request->is('ajax')) {
                    $this->Session->write('Users.lat', $this->request->data['lat']);
                    $this->Session->write('Users.lng', $this->request->data['lng']);
                }
                
                if ($this->request->is('post')) {   
                    //getting filter request
                    //print_r($this->request->data);
                    $result = $this->processFilter($this->request->data['MapMarker']);
//                    if(empty($result)){
//                        $result = $this->MapMarker->find('all');
//                    }
                }else if($this->request->is('get')){
                    // Select all the rows in the markers table
                    $result = $this->MapMarker->find('all');
                } 
                
                
                // Start XML file, create parent node
                $dom = new DOMDocument("1.0");
                $node = $dom->createElement("markers");
                $parnode = $dom->appendChild($node);
                
//                    print_r($mapmarkers);

                header("Content-type: text/xml");

                // Iterate through the rows, adding XML nodes for each

                foreach ($result as $mapmarkers) {
                    foreach ($mapmarkers as $mapmarker) {
                        // ADD TO XML DOCUMENT NODE
                        $node = $dom->createElement("marker");
                        $newnode = $parnode->appendChild($node);
                        $newnode->setAttribute("id", $mapmarker['id']);
                        $newnode->setAttribute("name",$mapmarker['name']);
                        $newnode->setAttribute("lat", $mapmarker['latitude']);
                        $newnode->setAttribute("lng", $mapmarker['longitude']);
                        $newnode->setAttribute("type", $mapmarker['type']);
                        //$newnode->setAttribute("address", $row['address']);

                    }
                }

                $this->set('xml_data',$dom->saveXML());
                echo $dom->saveXML();

	}
        
        public function processFilter($array) {
            // this cycle echoes all associative array
            $fieldsToQuery = array();
            $markersToFind = array();
//            $checkImages = false;
            $fieldsToQuery="";
            foreach($array as $key => $value)
            {
              if ($value == true) {
                    $field = $key;
                    
                    if($field == 'images'){
                        //look for reports that have images...
//                        $checkImages = true;
                        $this->loadModel('ReportImage');
                        $imagesResult = $this->ReportImage->find('all',array(
                        'fields'=>array('DISTINCT report_id')));
                        //print_r($imagesResult);
                        foreach ($imagesResult as $images) {
                            foreach ($images as $image) {
                                foreach ($image as $key => $value) {
                                    if($key == 'report_id'){
                                        $markersToFind['id'] = $value;
                                    }

                                }
                            }
                        }
                    }else{
                        if($field == 'electricity' ||
                           $field == 'water' ||
                           $field == 'road_access' ||
                           $field == 'telecommunication'){
                            $fieldsToQuery[$field] = false;
                        }else{
                            $fieldsToQuery[$field] = true;
                        }
                        
                    }
                    
                }
            }
            
            print_r($fieldsToQuery);
            print_r($markersToFind);
            
//            //if only selected images and there are no reports with images
//            if(empty($fieldsToQuery) && $checkImages && empty($markersToFind)){
//                return array();
//            }
//            //if nothing selected
//            if(empty($fieldsToQuery) && !$checkImages){
//                return array();
//            }
            
            if(!empty($fieldsToQuery)){
                $this->loadModel('Report');
                $reportResult = $this->Report->find('all', array(//'conditions' => $fieldsToQuery//array('electricity'=>false)
                                 'conditions' => array('or' => $fieldsToQuery)
                                 ));

                print_r($reportResult);

                foreach ($reportResult as $reports) {
                    foreach ($reports as $report) {
                        foreach ($report as $key => $value) {
                            if($key == 'id'){
                                array_push($markersToFind,$value);
                            }

                        }
                    }
                }
            }
            
            //$markersToFind = array_unique($markersToFind);
            print_r($markersToFind);
                
            $result = array();
            if(!empty($markersToFind)){
                $result = $this->MapMarker->find('all', array(
                             'conditions' => array('id' => $markersToFind)
                             ));
            }
            
            print_r($result);
            return $result;
            
        }

        /**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MapMarker->exists($id)) {
			throw new NotFoundException(__('Invalid map marker'));
		}
		$options = array('conditions' => array('MapMarker.' . $this->MapMarker->primaryKey => $id));
		$this->set('mapMarker', $this->MapMarker->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MapMarker->create();
			if ($this->MapMarker->save($this->request->data)) {
				$this->Session->setFlash(__('The map marker has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The map marker could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MapMarker->exists($id)) {
			throw new NotFoundException(__('Invalid map marker'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MapMarker->save($this->request->data)) {
				$this->Session->setFlash(__('The map marker has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The map marker could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MapMarker.' . $this->MapMarker->primaryKey => $id));
			$this->request->data = $this->MapMarker->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MapMarker->id = $id;
		if (!$this->MapMarker->exists()) {
			throw new NotFoundException(__('Invalid map marker'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MapMarker->delete()) {
			$this->Session->setFlash(__('The map marker has been deleted.'));
		} else {
			$this->Session->setFlash(__('The map marker could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
