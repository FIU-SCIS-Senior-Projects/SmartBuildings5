<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');       
    
        public function beforeFilter() {
            parent::beforeFilter();
            // Allow non-auth users to register and logout.
            $this->Auth->allow('add', 'logout');
        }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'), 'alert', array(
                                                        'plugin' => 'BoostCake',
                                                        'class' => 'alert-success'
                                                ));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alert', array(
                                                        'plugin' => 'BoostCake',
                                                        'class' => 'alert-danger'
                                                ));
			}
		}
                
                //populate the role_id input in view except for admin
                $this->set('roles', $this->User->Role->find('list', array('conditions' => array('not' => array('Role.id' => 3)))));

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}
        
        public function login() {            
            
            //if already logged-in, redirect
            if($this->Auth->loggedIn()){
                return $this->redirect($this->Auth->redirectUrl());      
            }
            
            if ($this->request->is('post')) {        
                
                if ($this->Auth->login()) {
                    
                    //check if acc status is pending for approval
                    if($this->Auth->user('account_status_id') == 2){
                        $this->Session->setFlash(__('This account is pending for approval'), 'alert', array(
                                                                                    'plugin' => 'BoostCake',
                                                                                    'class' => 'alert-danger'
                                                                            ));
                        return $this->Auth->logout();                       
                    }else if($this->Auth->user('account_status_id') == 3){
                        $this->Session->setFlash(__('This account is inactive'),'alert', array(
                                                                        'plugin' => 'BoostCake',
                                                                        'class' => 'alert-danger'
                                                                ));                    
                        return $this->Auth->logout();                       
                    }
                    return $this->redirect('/home');
                }
                
                $this->Session->setFlash(__('Invalid username or password, try again'), 'alert', array(
                                                                                'plugin' => 'BoostCake',
                                                                                'class' => 'alert-danger'
                                                                        ));
                    
            }
        }

        public function logout() {
            return $this->redirect($this->Auth->logout());
        }
        
        public function profile(){
            if($this->Auth->loggedIn()){
                
                if ($this->request->is(array('post', 'put'))) {
                    //save info passed from view to db 
                    
                }else{
                    //pass db info to view
                    $uid = $this->Auth->user('id');
                    $this->request->data = $this->User->findById($uid);
                    $this->set('roles', $this->User->Role->find('list'));
                }
                                
            }else{
                $this->Session->setFlash(__('Please login to view profile'), 'alert', array(
                                                                    'plugin' => 'BoostCake',
                                                                    'class' => 'alert-danger'
                                                            ));
            }
                
            
                        
        }
}
