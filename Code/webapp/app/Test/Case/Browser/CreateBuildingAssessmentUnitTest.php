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
class RegistrationUnitTest extends PHPUnit_Extensions_Selenium2TestCase{
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
    
    public function testCreateAssessmentLinkIsFunctional(){
        $this->timeouts()->implicitWait(2000);
        //navigate to home
        $this->url('/');
        
        //click login
        $this->byLinkText('Login')->click();
        
        $first_name='admin';
        $last_name='admin';
        
        $email = 'admin@admin.com';
        $password = 'Passw0rd';
        
        $form = $this->byTag('form');
        $form->byName('data[User][email]')->value($email);
        $form->byName('data[User][password]')->value($password);
        $form->submit();
        
        //first login assert: check username is displayed
        $this->assertTrue($this->isTextPresent($first_name.', '.$last_name));
        
        $this->byLinkText('Create Assessment')->click();
        
        $content = $this->byTag('h1')->text();
        $this->assertEquals('Create Assessment', $content);
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
