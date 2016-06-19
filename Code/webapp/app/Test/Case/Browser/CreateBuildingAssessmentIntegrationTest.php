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
    
    public function testAssessmentReportIsCreated(){
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
        
        $form = $this->byTag('form');
        //$this->byXPath("//*[@id='ReportElectricity']")->click();
//        $form->byId('ReportElectricity')->click();
//        $form->byName('data[Report][road_access]')->click();
//        $form->byName('data[Report][food]')->click();
//        $form->byName('data[Report][first_aid]')->click();
//        $form->submit();
//        
        $this->byXPath("//textarea[@id='ReportComments']")->value('This is a test');
        $form->submit();

        $content = $this->byTag('h1')->text();
        $this->assertEquals('Assessment Images', $content);       
        
//        $form = $this->byTag('form');
        //$filebox = $this->byName('data[Report][report_image]');
       // $this->sendKeys($filebox, "D:\Users\Yony\Pictures\yonicel_leyva.jpg");
        //$this->byName('submit')->submit();

        //$this->assertTextPresent("kirk.jpg (image/jpeg)");

        
        $this->byId('complete')->click();
        
        
        $this->assertTrue($this->isTextPresent('map'));
        
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
