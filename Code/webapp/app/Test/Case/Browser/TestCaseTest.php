<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of TestCase
 *
 * @author Yony
 */
class TestCase extends PHPUnit_Extensions_Selenium2TestCase{
    //put your code here
    
    public function setUp() {
        $this->setHost('webapp');
        $this->setPort(4444);
        $this->setBrowserUrl('http://webapp');
        $this->setBrowser('chrome');
    }
    
    public function tearDown() {
        $this->stop();
    }
    
    public function testHomePage(){
        $this->url('/home');
        $content = $this->byTag('h2')->text();
        $this-assertEquals('This is heading', $content);
        
    }
}
