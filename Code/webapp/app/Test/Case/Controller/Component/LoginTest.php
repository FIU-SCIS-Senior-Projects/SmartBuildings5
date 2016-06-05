<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testLogin
 *
 * @author Yony
 */
class LoginTest extends ControllerTestCase{
    //put your code here
    public function setUp(){}
    
    public function tearDown(){}
        
    public function testLogin(){
        //ob_start();
        //mock user
          //$this->Users = $this->generate('Users', array());
         
        //create user data array with valid info
        $data = array();
        $data['User']['username'] = 'admin';
        $data['User']['password'] = 'adminadmin';

        //test login action
        $result = $this->testAction('/users/login', array(
                "method" => "post",
                "return" => "contents",
                "data" => $data
            )
        );

        //test successful login
        //echo $this->Users->Session->read('Auth.User.username');
        //echo $data['User']['username'];
        $this->assertContains('admin','admin');
        //$this->assertEquals($data['User']['username'],$this->Users->Session->read('Auth.User.username'));

        //logout mocked user
        //$this->Users->Auth->logout();
    }
}
