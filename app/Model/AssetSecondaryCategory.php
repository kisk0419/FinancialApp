<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AssetSecondaryCategory
 *
 * @author keisuke
 */
class AssetSecondaryCategory extends AppModel {
    public $belongsTo = array(
        'AssetPrimaryCategory' => array('fields' => array('id', 'name')));
}

?>
