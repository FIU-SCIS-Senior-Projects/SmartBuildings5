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
    
    public function testRegistrationLinkIsFunctional(){
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
    }
}
