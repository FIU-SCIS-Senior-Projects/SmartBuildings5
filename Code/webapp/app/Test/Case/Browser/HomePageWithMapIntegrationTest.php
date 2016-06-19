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
class LoginUnitTest extends PHPUnit_Extensions_Selenium2TestCase{
    //put your code here
    
    public function setUp() {
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowserUrl('http://localhost/webapp');
        $this->setBrowser('chrome');
    }
    
    public function tearDown() {
        $this->stop();
    } 
    
   public function testGISLocationIsDetected(){
        $this->timeouts()->implicitWait(2000);
        $this->url('/');
        $this->byXPath("//a[@href='/webapp/home']")->click();
//        $this->byLinkText('Login')->click();
        
//        $first_name='admin';
//        $last_name='admin';
//        
//        $form = $this->byTag('form');
//        $form->byName('data[User][email]')->value('admin@admin.com');
//        $form->byName('data[User][password]')->value('Passw0rd');
//        $form->submit();
        
        //check username is displayed after login
        
        
        
        $this->assertTrue($this->isTextPresent('map'));
        
          
        //$this->acceptAlert();
        
        $this->assertTrue($this->isTextPresent('Location found'));
        
        
        
        //click dropdown
        //$this->byCssSelector('li a.dropdown-toggle')->click();
        //click logout
        //$this->byXPath("//a[@href='/users/logout']")->click();
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
