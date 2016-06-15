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
	public function view($id = null) {
		if (!$this->Report->exists($id)) {
			throw new NotFoundException(__('Invalid report'));
		}
		$options = array('conditions' => array('Report.' . $this->Report->primaryKey => $id));
		$this->set('report', $this->Report->find('first', $options));
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
                        }
                        next($this->request->data['Report']);
                    }
                        
			$this->Report->create();
                        print_r($this->request->data);
                        $uid = $this->Session->read('Auth.User.id');
                        $this->request->data['Report']['user_id'] = $uid;
			if ($this->Report->save($this->request->data)) {
                               
                                $rid = $this->Report->id;
				return $this->redirect('/reportimages/add/'.$rid);
                                
                                
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
	}}
