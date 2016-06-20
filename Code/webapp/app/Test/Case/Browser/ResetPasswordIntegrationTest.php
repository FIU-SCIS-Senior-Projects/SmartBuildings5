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
        $this->setBrowserUrl('http://webapp');
        $this->setBrowser('chrome');
    }
    
    public function tearDown() {
        $this->stop();
    } 
    
   public function testExistingUserWillBeSentEmail(){
        $this->timeouts()->implicitWait(2000);
        $this->url('/');
        $this->byLinkText('Login')->click();
        
        $this->byLinkText('Forgot password?')->click();
        
        $this->assertTrue($this->isTextPresent('Please enter the e-mail used during registration'));
        
         $form = $this->byTag('form');
        
        $form->byName('data[User][email]')->value('admin@admin.com');
        $form->submit();
        
        $this->assertTrue($this->isTextPresent('Password reset instructions have been sent to your email address'));        
        
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
