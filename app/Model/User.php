<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author keisuke
 */
class User extends AppModel {
    public $primaryKey = 'account';
    public $belongsTo = array('Family');
}

?>
