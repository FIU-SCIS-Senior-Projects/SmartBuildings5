<?php
App::uses('AppController', 'Controller');
/**
 * Reports Controller
 *
 * @property Report $Report
 * @property PaginatorComponent $Paginator
 */
class ReportsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
        
        
        public function beforeFilter() {
            parent::beforeFilter();
            // Allow non-auth users to register and logout.
            $this->Auth->allow('view');
        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Report->recursive = 0;
		$this->set('reports', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
        public  $comfirm = '';
        
	public function view($id = null) {
//          $comfirm = $this->Report->view();
		
                if ($this->request->is(array('get'))) {
                    
                    if (!$this->Report->exists($id)) {
			throw new NotFoundException(__('Invalid report'));
                    }
                    
                    $options = array('conditions' => array('Report.' . $this->Report->primaryKey => $id));
                    $result = $this->Report->find('first', $options);
                    
//                    print_r($result);


                    if ($result['Report']['electricity'] == true) { 
                        $result['Report']['electricity'] = 'Yes';
                    } 
                    else{
                        $result['Report']['electricity'] = 'No';
                    }
                    
                    if ($result['Report']['water'] == true) { 
                        $result['Report']['water'] = 'Yes';
                    } 
                    else{
                        $result['Report']['water'] = 'No';
                    }
                    if ($result['Report']['road_access'] == true) { 
                        $result['Report']['road_access'] = 'Yes';
                    } 
                    else{
                        $result['Report']['road_access'] = 'No';
                    }
                    if ($result['Report']['telecommunication'] == true) { 
                        $result['Report']['telecommunication'] = 'Yes';
                    } 
                    else{
                        $result['Report']['telecommunication'] = 'No';
                    }
                    if ($result['Report']['food'] == true) { 
                        $result['Report']['food'] = 'Yes';
                    } 
                    else{
                        $result['Report']['food'] = 'No';
                    }
                    if ($result['Report']['sanitation'] == true) { 
                        $result['Report']['sanitation'] = 'Yes';
                    } 
                    else{
                        $result['Report']['sanitation'] = 'No';
                    }
                     if ($result['Report']['first_aid'] == true) { 
                        $result['Report']['first_aid'] = 'Yes';
                    } 
                    else{
                        $result['Report']['first_aid'] = 'No';
                    }
                     if ($result['Report']['shelter'] == true) { 
                        $result['Report']['shelter'] = 'Yes';
                    } 
                    else{
                        $result['Report']['shelter'] = 'No';
                    }
                    
                    $result['Report']['created'] = date('F j, Y',strtotime(str_replace('-','/', $result['Report']['created'])));                    
                            
                    $this->set('report',$result);
                    
                    //send images to view  
                    $this->loadModel('ReportImage');
                    $this->set('images',$this->ReportImage->find('all', array('conditions' => array('ReportImage.report_id' => $id))));
                    $this->request->data['Report']['id']=$id;
                    
                    //get data for chart
                    $this->loadModel('Evaluation');
                     //$this->set('evaluations', 'arrayofdata');
                   // $evaluations=$this->Evaluation->find('count', array( 'conditions' => array('Evaluation.report_id' => $id)));
                    $safe=$this->Evaluation->find('count', array( 'conditions' => array('report_id' => $id ,'evaluation' => 'safe')));
                    $minorDamage=$this->Evaluation->find('count', array( 'conditions' => array('report_id' => $id ,'evaluation' => 'minor damage')));
                     $majorDamage=$this->Evaluation->find('count', array( 'conditions' => array('report_id' => $id ,'evaluation' => 'major damage')));
                      $insufficient=$this->Evaluation->find('count', array( 'conditions' => array('report_id' => $id ,'evaluation' => 'insufficient information')));
                    //print_r($safe);
                      
                    $this->set('safe', $safe);
                    $this->set('minorDamage', $minorDamage);
                    $this->set('majorDamage', $majorDamage);
                    $this->set('insufficient', $insufficient);
                    
                    
                }
                
                if ($this->request->is(array('post', 'put'))) {
                    //$this->request->data['Report']
//                    print_r($this->request->data);
                    $this->loadModel('Evaluation');
                     //save entry in db
                    $this->Evaluation->create();
                    $newEvaluation = array('Evaluation' => array(
                        'report_id' => $this->request->data['Report']['id'],
                        'evaluation' => $this->request->data['evaluation'],
                    ));
                    if(!$this->Evaluation->save($newEvaluation)){
                        $this->Session->setFlash(__('There was a problem submitting evaluation.'), 'alert', array(
                                                'plugin' => 'BoostCake',
                                                'class' => 'alert-danger'
                                        ));
                    }
                    
                    $this->Session->setFlash(__('Evaluation successful.'), 'alert', array(
                                                'plugin' => 'BoostCake',
                                                'class' => 'alert-success'
                                        ));
                    return $this->redirect('/reports/view/'.$this->request->data['Report']['id']);
                    
                }
        
        }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    
                    //parse result to boolean
                    while ($val = current($this->request->data['Report'])) {
                        if ($val == 'on') {
                            $this->request->data['Report'][key($this->request->data['Report'])] = true;
                        }else{
                            $this->request->data['Report'][key($this->request->data['Report'])] = false;
                        }
                        next($this->request->data['Report']);
                    }
                    
                    //check date
                    if(!empty($this->request->data("date"))){
                        $this->request->data["Report"]["created"] = $this->request->data("date")." ".date("H:i:s");
                    }    
//			$this->Report->create();
//                        echo ;
//                        return;
                    $uid = $this->Session->read('Auth.User.id');
                    $this->request->data['Report']['user_id'] = $uid;
                    if ($this->Report->save($this->request->data)) {

                            $rid = $this->Report->id;
                            return $this->redirect('/report_images/add/'.$rid);

                    } else {
                            $this->Session->setFlash(__('The report could not be saved. Please, try again.'));
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
		if (!$this->Report->exists($id)) {
			throw new NotFoundException(__('Invalid report'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Report->save($this->request->data)) {
				$this->Session->setFlash(__('The report has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The report could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Report.' . $this->Report->primaryKey => $id));
			$this->request->data = $this->Report->find('first', $options);
		}
		$users = $this->Report->User->find('list');
		$buildingConditions = $this->Report->BuildingCondition->find('list');
		$this->set(compact('users', 'buildingConditions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Report->id = $id;
		if (!$this->Report->exists()) {
			throw new NotFoundException(__('Invalid report'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Report->delete()) {
			$this->Session->setFlash(__('The report has been deleted.'));
		} else {
			$this->Session->setFlash(__('The report could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        
        
        
        
}
