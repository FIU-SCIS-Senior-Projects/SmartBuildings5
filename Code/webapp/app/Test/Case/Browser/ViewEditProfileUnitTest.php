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
    
   public function testProfileLinkIsFunctional(){
        $this->timeouts()->implicitWait(2000);
        $this->url('/');
        $this->byLinkText('Login')->click();
        
        $first_name='admin';
        $last_name='admin';
        
        $form = $this->byTag('form');
        $form->byName('data[User][email]')->value('admin@admin.com');
        $form->byName('data[User][password]')->value('Passw0rd');
        $form->submit();
        
        //check username is displayed after login
        
        $this->assertTrue($this->isTextPresent($first_name.', '.$last_name));
        
        //click dropdown
        $this->byCssSelector('li a.dropdown-toggle')->click();
        //click profile
        $this->byXPath("//a[@href='/users/profile']")->click();
        
        $content = $this->byTag('h1')->text();
        $this->assertEquals('Edit Profile', $content);
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
