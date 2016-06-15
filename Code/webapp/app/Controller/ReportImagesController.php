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
	public function add($report_id = null) {
            
            if ($report_id == NULL) {
			throw new NotFoundException(__('Invalid request'));
            }
            
            if ($this->request->is('post') || $this->request->is('put')) {
                if($this->request->data['btn'] == 'Complete'){
                    //check if we need to create marker
                    //check db in markers table:  
                        //if an entry does not exist with $report_id, create marker
                    
                    return $this->redirect('/home');
                }
                
                if(!empty($this->request->data['ReportImage']['report_image']['name'])){
                        
                        $success = $this->uploadImage();
                        
                        if(!$success){ return; }
                }else{
                    //if image not set, need to reassign image in the db in order to not crash the system
                    return $this->redirect('/reportimages/add/'.$report_id);
                }
                
                $this->request->data['ReportImage']['report_id'] = $report_id;                   
                    
                    
                if ($this->ReportImage->save($this->request->data)) {
                    
                } else {
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
        
        private function uploadImage(){
            
            $image = $this->request->data['ReportImage']['report_image']; 
            //full path to upload folder
            $uploadImgPath = IMAGES . 'Report/img';
            $uploadThumbPath = IMAGES . 'Report/thumbnail';
            $imageName = $image['name'];
            
            //filter uploaded image

            //check if image type fits one of allowed types
            $ext = substr(strtolower(strrchr($image['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
            
            if(!in_array($ext, $arr_ext)){           
                $this->Session->setFlash(__('Unacceptable image type.'), 'alert', array(
                                                        'plugin' => 'BoostCake',
                                                        'class' => 'alert-danger'
                                                ));
                return false;
            }            
            
            //file size limit needs to be set in php.ini, upload_max_filesize
            
//            $MAXSIZE = 20;
//            if($image['size'] > $MAXSIZE*1000){
//                $this->Session->setFlash(__('The image size is too large.'), 'alert', array(
//                                                        'plugin' => 'BoostCake',
//                                                        'class' => 'alert-danger'
//                                                ));
//                return false;
//            }
            
            //check if there wasn't errors uploading file on server
            if ($image['error'] != UPLOAD_ERR_OK) {
                $this->Session->setFlash(__('Error uploading image. ERR['.$image['error'].']'), 'alert', array(
                                                        'plugin' => 'BoostCake',
                                                        'class' => 'alert-danger'
                                                ));
                return false; 
            }
            
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
                $this->request->data['ReportImage']['report_image'] = $imageName;
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
            
            return true;                     
            
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
