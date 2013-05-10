<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IncomeSecondaryCategory
 *
 * @author keisuke
 */
class IncomingSecondaryCategory extends AppModel {
    public $belongsTo = array('IncomingPrimaryCategory');
}

?>
