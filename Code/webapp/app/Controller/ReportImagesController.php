<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'ImageTool', array('file' => 'ImageTool' . DS . 'ImageTool.php'));
/**
 * ReportImages Controller
 *
 * @property ReportImage $ReportImage
 * @property PaginatorComponent $Paginator
 */
class ReportImagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ReportImage->recursive = 0;
		$this->set('reportImages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ReportImage->exists($id)) {
			throw new NotFoundException(__('Invalid report image'));
		}
		$options = array('conditions' => array('ReportImage.' . $this->ReportImage->primaryKey => $id));
		$this->set('reportImage', $this->ReportImage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($report_id = NULL) {
            
            //echo $this->Session->read('Users.lat');
            //echo $this->Session->read('Users.lng');
            
            if ($report_id == NULL) {
                throw new NotFoundException(__('Invalid request'));
            }else{
                //check if reportid passed is in db. if not throw exception
                $this->loadModel('Report');
                $report = $this->Report->findById($report_id);
                if(empty($report['Report']['id'])){
                    throw new NotFoundException(__('Invalid request'));
                }
            }
                
            
            if ($this->request->is('post') || $this->request->is('put')) {
                if($this->request->data['btn'] == 'Complete'){
                    
                    //check if user has manually entered location
                    if(!empty($this->request->data['ReportImage']['lat']) && 
                       !empty($this->request->data['ReportImage']['lng']))
                    {
                       $this->Session->write('Users.lat',$this->request->data['ReportImage']['lat']);
                       $this->Session->write('Users.lng',$this->request->data['ReportImage']['lng']);
                    }
                            
                    
                    //check if location has been filled
                    if($this->Session->read('Users.lat')==NULL &&
                       $this->Session->read('Users.lng')==NULL)
                    {
                        $this->Session->setFlash(__('Plese submit a photo with geotag information Or manually enter the information bellow'), 'alert', array(
                                            'plugin' => 'BoostCake',
                                            'class' => 'alert-warning'
                                    )); 
                        $this->Session->write('Users.showLocForm',true);
                    }else{
                        
                        if($this->createMarker($report_id)){
                            
                            $this->Session->write('Users.showLat',$this->Session->read('Users.lat'));
                            $this->Session->write('Users.showLng',$this->Session->read('Users.lng'));
                            $this->resetGpsInfo();
                        
                            return $this->redirect('/home');
                        }
                    }
                    
                    return $this->redirect('/reportimages/add/'.$report_id);
                    
                }                
                                
                if(!empty($this->request->data['ReportImage']['report_image'][0]['name'])){
                        
                        $success = $this->uploadImages($report_id);
                        
                        if(!$success){ return; }
                }else{
                    //if image not set, need to reassign image in the db in order to not crash the system
                    return $this->redirect('/reportimages/add/'.$report_id);
                }

                    
                    
                if (!$this->ReportImage->saveMany($this->request->data)) {
                    
                    $this->Session->setFlash(__('There was a problem updating the image gallery.'), 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'
                                            ));
                }                
                
                
                return $this->redirect('/reportimages/add/'.$report_id);
            }
            
            //send images to view            
            $this->set('images',$this->ReportImage->find('all', array('conditions' => array('ReportImage.report_id' => $report_id))));
            
            $this->set('report_id',$report_id);
	}
        
        private function resetGpsInfo() {
             $this->Session->write('Users.lat',NULL);
             $this->Session->write('Users.lng',NULL);
             $this->Session->write('Users.showLocForm',NULL);
        }
        
        private function createMarker($report_id) {            
            
            
            //check if we need to create marker
            //check db in markers table:  
                //if an entry does not exist with $report_id, create marker
            /* validate user pos */
            $this->loadModel('MapMarker');
            $marker = $this->MapMarker->findById($report_id);
            if(empty($marker['MapMarker']['id'])){
                //save entry in db
                $this->MapMarker->create();
                $newmapmarker = array('MapMarker' => array(
                    'id' => $report_id,
                    'name' => $this->Session->read('Auth.User.first_name').' '.$this->Session->read('Auth.User.last_name'),
                    'latitude' => $this->Session->read('Users.lat'),
                    'longitude' => $this->Session->read('Users.lng'),
                    'type' => 'not_rated',
                ));
                if(!$this->MapMarker->save($newmapmarker)){
                    $this->Session->setFlash(__('There was a problem creating map marker.'), 'alert', array(
                                            'plugin' => 'BoostCake',
                                            'class' => 'alert-danger'
                                    ));
                    return false;
                }
                return true;
            }else{
                $this->Session->setFlash(__('This assessment already exists!.'), 'alert', array(
                                            'plugin' => 'BoostCake',
                                            'class' => 'alert-danger'
                                    ));                
                $this->resetGpsInfo();
                return $this->redirect('/home');
            }
        }


        private function uploadImages($report_id=NULL){
            
            
            $images = $this->request->data['ReportImage']['report_image']; 
            $this->request->data = '';
            $this->request->data['ReportImage'] = array();
            
         
            foreach ($images as $image) {

                //full path to upload folder
                $uploadImgPath = IMAGES . 'Report/img';
                $uploadThumbPath = IMAGES . 'Report/thumbnail';
                $imageName = $image['name'];

                //echo $imageName;
                //filter uploaded image

                //check if image type fits one of allowed types
                $ext = substr(strtolower(strrchr($imageName, '.')), 1); //get the extension
                $arr_ext = array('png','jpg', 'jpeg', 'gif'); //set allowed extensions

                if(!in_array($ext, $arr_ext)){           
                    $this->Session->setFlash(__('Unacceptable image type.'), 'alert', array(
                                                            'plugin' => 'BoostCake',
                                                            'class' => 'alert-danger'
                                                    ));
                    return false;
                }            

                //file size limit needs to be set in php.ini, upload_max_filesize

                //check if there wasn't errors uploading file on server
                if ($image['error'] != UPLOAD_ERR_OK) {
                    $this->Session->setFlash(__('Error uploading image. ERR['.$image['error'].']'), 'alert', array(
                                                            'plugin' => 'BoostCake',
                                                            'class' => 'alert-danger'
                                                    ));
                    return false; 
                }
                
                //echo $imageName ." :<br />\n";
                $exif = exif_read_data($image['tmp_name'], 'IFD0');
                //echo $exif===false ? "No header data found.<br />\n" : "Image contains headers<br />\n";
                
                if($exif==true){
                    $exif = exif_read_data($image['tmp_name'], 0, true);
                    //echo $imageName." :<br />\n";
                    foreach ($exif as $key => $section) {
                        foreach ($section as $name => $val) {
                            if($name == "GPSLatitude" || $name == "GPSLongitude"){
                                foreach ($val as $GPSname => $GPSvalue) {
                                    if($GPSname==2){
                                        $Rvalue = $this->calculate($GPSvalue);
                                        if($name == "GPSLatitude"){
                                            $this->Session->write('Users.lat',$Rvalue);
                                        } else {
                                            $this->Session->write('Users.lng',$Rvalue);
                                        }
                                    }                                        
                                    
                                }
                            }else{
                               // echo "$key.$name: $val<br />\n";
                            }
                        }
                    }
                }
                
                //return false;
                

                //proccess image upload                     

                //check if file exists in upload folder
                if (file_exists($uploadImgPath . '/' . $imageName)) {
                    //create full filename with timestamp
                    $imageName = date('His') . '_' . $imageName;
                }
                //create full path with image name
                $full_image_path = $uploadImgPath . '/' . $imageName;
                $full_thumb_path = $uploadThumbPath . '/' . $imageName;
                
                //upload image to upload folder
                if (move_uploaded_file($image['tmp_name'], $full_image_path)) {
                    
                    $record['report_image'] = $imageName;
                    $record['report_id'] = $report_id;
                    array_push($this->request->data,$record);
                    
                } else {
                    $this->Session->setFlash(__('There was a problem uploading file. Please try again.'), 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'
                                            ));
                    return false;
                }

                if (copy($full_image_path, $full_thumb_path)) {

                    //resize image
                    $status = ImageTool::resize(array(
                        'input' => $full_thumb_path,
                        'output' => $full_thumb_path,
                        'width' => 100,
                        'height' => 100,
                        'mode' => 'fit',
                        'paddings' => false,
                    ));
                } else {
                    $this->Session->setFlash(__('There was a problem uploading file. Please try again.'), 'alert', array(
                                                    'plugin' => 'BoostCake',
                                                    'class' => 'alert-danger'
                                            ));
                    return false;
                }
            }            
            $this->request->data['ReportImage']['report_id'] = '';
            
            //insert gis loc
            return true;                     
            
        }
        
        private function calculate( $mathString )    {
            
            $mathString = trim($mathString);
            $mathString = str_replace ('[^0-9\+-\*\/\(\) ]', '', $mathString); 

            echo $mathString."\n";
            $compute = create_function("", "return (" . $mathString . ");" );
            
            return 0 + @($compute());
        }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ReportImage->exists($id)) {
			throw new NotFoundException(__('Invalid report image'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ReportImage->save($this->request->data)) {
				$this->Session->setFlash(__('The report image has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The report image could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ReportImage.' . $this->ReportImage->primaryKey => $id));
			$this->request->data = $this->ReportImage->find('first', $options);
		}
		$reports = $this->ReportImage->Report->find('list');
		$this->set(compact('reports'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ReportImage->id = $id;
		if (!$this->ReportImage->exists()) {
			throw new NotFoundException(__('Invalid report image'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ReportImage->delete()) {
			$this->Session->setFlash(__('The report image has been deleted.'));
		} else {
			$this->Session->setFlash(__('The report image could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

        