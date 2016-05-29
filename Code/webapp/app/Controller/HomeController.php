<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Yony
 */
class HomeController extends AppController{
    //put your code here
    
    public function beforeFilter() {
            parent::beforeFilter();
            // Allow non-auth users to access home.
            $this->Auth->allow('index');
    }
    
    public function index(){
        
    }
}