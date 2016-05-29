<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Role
 *
 * @author Yony
 */
class Role extends AppModel{
    //put your code here
    public $hasMany = 'User';
    public $displayField = 'role_name';
}
