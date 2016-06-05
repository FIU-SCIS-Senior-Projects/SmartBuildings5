<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'PHPUnit/Autoload.php';

/**
 * Description of TestCase
 *
 * @author Yony
 */
class RegistrationIntegrationTest extends PHPUnit_Extensions_Selenium2TestCase{
    //put your code here
    
    public function setUp() {
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowserUrl('http://webapp');
        $this->setBrowser('chrome');
    }
    
    public function tearDown() {
        $this->stop();
    } 
    
    public function testEmailCannotBeRegisteredMoreThanOnce(){
        $this->timeouts()->implicitWait(2000);
        
       //navigate to home
        $this->url('/');
        
        //click login
        $this->byLinkText('Login')->click();
        
        //click register
        $this->byLinkText('Register')->click();
        
        //Assert tag is Registration
        $content = $this->byTag('h2')->text();
        $this->assertEquals('Registration', $content); 
        
        //new user info
        $lastName='new user';
        $firstName='new user';
        $password='passwor';
        $repeat_password='password'; 
        $email='admin@admin.com'; //existing email;
        $role = 1; //mapper
        
        //fill form
        $form = $this->byTag('form');
        $form->byName('data[User][last_name]')->value($lastName);
        $form->byName('data[User][first_name]')->value($firstName);
        $form->byName('data[User][password]')->value($password);
        $form->byName('data[User][password_repeat]')->value($repeat_password);
        $form->byName('data[User][email]')->value($email);
        $form->byName('data[User][role_id]')->value($role);
        $form->submit();
        
        //assert email is duplicate
        $this->assertTrue($this->isTextPresent('This email has already been taken'));
    }
    
    public function isTextPresent($search)
    {
        $source = $this->source();
        if ( strpos((string)$source,$search) !== FALSE){
            return true;
        }else{ 
            return false;
        }
    }
}
