<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OutgoSecondaryCategory
 *
 * @author keisuke
 */
class OutgoingSecondaryCategory extends AppModel {
    public $belongsTo = array('OutgoingPrimaryCategory');
}

?>
