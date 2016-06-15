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
		$this->MapMarker->recursive = 0;
		$this->set('mapMarkers', $this->Paginator->paginate());
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
