<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FundSecondaryCategory
 *
 * @author keisuke
 */
class FundSecondaryCategory extends AppModel {
    public $belongsTo = array('FundPrimaryCategory');
}

?>
