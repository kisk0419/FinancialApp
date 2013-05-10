<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author baba
 */
class Setting extends AppModel {
    
    public $belongsTo = array(
        'TermStartCondition' => array(
            'fields' => array(
                'id', 'text', 'value'
            )
        ),
        'Family' => array(
            'fields' => array(
                'name'
            )
        )
    );
    
    public function getIndexData() {
        return $this->find('all');
    }
    
    public function getData($family_id) {
        $options = array(
            'conditions' => array(
                'Setting.family_id' => $family_id
            ),
            'order' => array('Setting.created DESC')
        );
        
        return $this->find('first', $options);
    }
}

?>
