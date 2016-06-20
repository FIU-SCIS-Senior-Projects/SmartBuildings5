<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('AppController', 'Controller');
App::import('Vendor', 'ImageTool', array('file' => 'ImageTool' . DS . 'ImageTool.php'));
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    var $name = 'Users';
    var $helpers = array('Html', 'Form', 'Time');
    var $uses = array('User');
    var $allowCookie = true;
    var $cookieTerm = '0';
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');       
    
        public function beforeFilter() {
            parent::beforeFilter();
            // Allow non-auth users to register and logout.
            $this->Auth->allow();//('add', 'logout', 'forgot_password','reset_password_token');
        }
       
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                        
                        if($this->request->data['user_role'] == 'mapper')
                        {
                            $this->request->data['User']['role_id'] = 1;
                        }else{
                            $this->request->data['User']['role_id'] = 2;
                        }
                        
                        $this->request->data['User']['profile_image'] = 'profile_placeholder.png';
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'), 'alert', array(
                                                        'plugin' => 'BoostCake',
                                                        'class' => 'alert-success'
                                                ));
                                
                                //attempt to login user
                                $this->login();
				
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

        
        public function login() {            
            
            //if already logged-in, redirect
            if($this->Auth->loggedIn()){
                return $this->redirect($this->Auth->redirectUrl());      
            }
            
            if ($this->request->is('post')) {        
                
                if ($this->Auth->login()) {
                    
                    $ACTIVE=1;$PENDING=2;$INACTIVE=3;
                    //check if acc status is pending for approval
                    if($this->Auth->user('account_status_id') == $PENDING){
                        $this->Session->setFlash(__('This account is pending for approval'), 'alert', array(
                                                                                    'plugin' => 'BoostCake',
                                                                                    'class' => 'alert-danger'
                                                                            ));
                        return $this->logout();                     
                    }else if($this->Auth->user('account_status_id') == $INACTIVE){
                        $this->Session->setFlash(__('This account is inactive'),'alert', array(
                                                                        'plugin' => 'BoostCake',
                                                                        'class' => 'alert-danger'
                                                                ));                    
                        return $this->logout();                      
                    }
                    return $this->redirect('/home');
                }
                
                $this->Session->setFlash(__('Invalid username or password'), 'alert', array(
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
                
                $uid = $this->Session->read('Auth.User.id');  
                
                if ($this->request->is(array('post', 'put'))) {
                    
                    if(empty($this->request->data['User']['password']) &&
                            empty($this->request->data['User']['password_repeat'])){
                        
                    }
                    
                     
                    if(!empty($this->request->data['User']['profile_image']['name'])){
                        
                        $success = $this->uploadProfileImage();
                        
                        if(!$success){ return; }
                    }else{
                        //if image not set, need to reassign image in the db in order to not crash the system
                        $options = array('conditions' => array('User.' . $this->User->primaryKey => $uid),'fields'=>array('profile_image'));
                        $image = $this->User->find('first', $options);
                        $this->request->data['User']['profile_image'] = $image['User']['profile_image'];
                    }
                        
                    
                    $this->request->data['User']['id'] = $uid;                   
                    
                    
                    if ($this->User->save($this->request->data)) {
                        
                        $this->Session->setFlash(__('The profile has been updated.'), 'alert', array(
                                                        'plugin' => 'BoostCake',
                                                        'class' => 'alert-success'
                                                ));
                        
                        $this->Session->write('Auth.User', array_merge(AuthComponent::User(), 
                                                 $this->request->data['User']) ); //updating all user session data

                        return $this->redirect(array('users' => 'profile'));
                    } else {
                        $this->Session->setFlash(__('There was a problem updating the profile.'), 'alert', array(
                                                        'plugin' => 'BoostCake',
                                                        'class' => 'alert-danger'
                                                ));
                    }
                    
                }else{
                    //pass db info to view
                    
                    $this->request->data = $this->User->find('first',array('conditions'=>array('User.id'=>$uid),
                                                                          'fields'=>array('first_name','last_name','email','company','position','company_url')));
                    $this->set('user', $this->request->data);
                    //set role
                    $this->set('roles', $this->User->Role->find('list'));
                    
                    //set profile image
                    $options = array('conditions' => array('User.' . $this->User->primaryKey => $uid),'fields'=>array('profile_image'));
                    $this->set('image', $this->User->find('first', $options));
                }
                                
            }else{
                $this->Session->setFlash(__('Please login to view profile'), 'alert', array(
                                                                    'plugin' => 'BoostCake',
                                                                    'class' => 'alert-danger'
                                                            ));
            }                        
        }
        
        private function uploadProfileImage(){
            
            $image = $this->request->data['User']['profile_image']; 
            //upload folder - make sure to create one in webroot
            $uploadFolder = "User";
            //full path to upload folder
            $uploadPath = IMAGES . $uploadFolder;
            $imageName = $image['name'];
            
            //filter uploaded image

            //check if image type fits one of allowed types
            $ext = substr(strtolower(strrchr($image['name'], '.')), 1); //get the extension
            $arr_ext = array('png','jpg', 'jpeg', 'gif'); //set allowed extensions
            
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
            if (file_exists($uploadPath . '/' . $imageName)) {
                //create full filename with timestamp
                $imageName = date('His') . $imageName;
            }
            //create full path with image name
            $full_image_path = $uploadPath . '/' . $imageName;
            //upload image to upload folder
            if (move_uploaded_file($image['tmp_name'], $full_image_path)) {
                $this->request->data['User']['profile_image'] = $imageName;

                //resize image
                $status = ImageTool::resize(array(
                    'input' => $full_image_path,
                    'output' => $full_image_path,
                    'width' => 300,
                    'height' => 300,
                    'mode' => 'fit',
                    'paddings' => false,
                ));

                return true;
            } else {
                $this->Session->setFlash(__('There was a problem uploading file. Please try again.'), 'alert', array(
                                                'plugin' => 'BoostCake',
                                                'class' => 'alert-danger'
                                        ));
                return false;
            }
                     
                
        }
        
        public function forgot_password() {

	     if (!empty($this->data)) {
                $user = $this->User->findByEmail($this->data['User']['email']);
                if (empty($user)) {
                    $this->Session->setflash('Sorry, the username entered was not found.');
                    $this->redirect('/users/forgot_password');
                } else {
                    $user = $this->__generatePasswordToken($user);
                    if ($this->User->save($user) && $this->__sendForgotPasswordEmail($user)) {
                        $this->Session->setFlash(__('Password reset instructions have been sent to your email address.
                                                    You have 24 hours to complete the request.'), 'alert', array(
                                                            'plugin' => 'BoostCake',
                                                            'class' => 'alert-warning'
                                                    ));
                        $this->redirect('/users/login');
                    }
                }
        }
    }

    /**
     * Allow user to reset password if $token is valid.
     * @return
     */
    public function reset_password_token($reset_password_token = null) {
        
        if ($this->request->is(array('post', 'put'))) {

                

                if ($this->User->save($this->request->data)) {
                        $this->Session->setFlash(__('The user has been saved.'), 'alert', array(
                                                'plugin' => 'BoostCake',
                                                'class' => 'alert-warning'
                                        ));

                        //reset token in db for this user
                        
                        //attempt to login user 
                       
                $this->request->data['User']['reset_password_token'] = '';
                $this->set('uid',$this->request->data['User']['id']);
                        

                        return $this->redirect('/users/login');

                } else {
                        $this->Session->setFlash(__('The password is incomplete or they do not match. Please, try again.'), 'alert', array(
                                                'plugin' => 'BoostCake',
                                                'class' => 'alert-danger'
                                        ));
                }
        }
          
        if ($reset_password_token == null){
            //put flash message token is null
            echo 'token null';
            return $this->redirect('/users/login');         
            
        }else{
            $this->request->data = $this->User->findByResetPasswordToken($reset_password_token);
            if(isset($this->request->data['User']['id'])){
                $this->request->data['User']['password'] = '';
                $this->set('uid',$this->request->data['User']['id']);
                                
                
            }else{
                //put flash message token is null
                echo 'token does not exists';
                return $this->redirect('/users/login');
            }
            

        }
        
    }
    /**
     * Generate a unique hash / token.
     * @param Object User
     * @return Object User
     */
    function __generatePasswordToken($user) {
        if (empty($user)) {
            return null;
        }
        // Generate a random string 100 chars in length.
        $token = "";
        for ($i = 0; $i < 100; $i++) {
            $d = rand(1, 100000) % 2;
            $d ? $token .= chr(rand(33,79)) : $token .= chr(rand(80,126));
        }
        (rand(1, 100000) % 2) ? $token = strrev($token) : $token = $token;
        // Generate hash of random string
        $hash = Security::hash($token, 'sha256', true);;
        for ($i = 0; $i < 20; $i++) {
            $hash = Security::hash($hash, 'sha256', true);
        }
        $user['User']['reset_password_token'] = $hash;
        $user['User']['token_created_at'] = date('Y-m-d H:i:s');
        return $user;
    }
    /**
     * Validate token created at time.
     * @param String $token_created_at
     * @return Boolean
     */
    function __validToken($token_created_at) {
        $expired = strtotime($token_created_at) + 86400;
        $time = strtotime("now");
        if ($time < $expired) {
            return true;
        }
        return false;
    }
    /**
     * Sends password reset email to user's email address.
     * @param $id
     * @return
     */
    function __sendForgotPasswordEmail($user = null) {
        if (!empty($user['User']['id'])) {
            //print_r($user);
            
            $Email = new CakeEmail('gmail');
            $Email->to ($user['User']['email']);
            $Email->subject ('Password Reset Request - DO NOT REPLY');
            $Email->viewVars(array('User' => $user));
            $Email->template('reset_password_request');
            $Email->emailFormat('html');
            $Email->send();
            return true;
        }
        return false;
    }
   
}

