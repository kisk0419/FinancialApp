<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceModel.php';
/**
 * Description of FixedOutgoingEntry
 *
 * @author baba
 */
class FixedOutgoingEntry extends FinanceModel {
    public $belongsTo = array(
        'OutgoingPrimaryCategory', 
        'OutgoingSecondaryCategory', 
        'Store', 
        'Family', 
        'User' => array(
            'foreignKey' => 'user_account',
            )
        );
    
    public function getRegistDatas($family_id) {
        return $this->findByFamilyIdAndActive($family_id);
    }
    
    protected function findByFamilyIdAndActive($family_id) {
        $options = array(
            'conditions' => array(
                'FixedOutgoingEntry.family_id' => $family_id,
                'FixedOutgoingEntry.is_active' => 1
            ),
        );
        return $this->find('all', $options);
    }
    
    protected function addUniqueData(&$detail, $data) {
        parent::addUniqueData($detail, $data);
        
        $detail['unit_price'] = $data['FixedOutgoingEntry']['unit_price'];
        $detail['quantity'] = $data['FixedOutgoingEntry']['quantity'];
        $detail['price'] = $data['FixedOutgoingEntry']['unit_price'] * $data['FixedOutgoingEntry']['quantity'];
        $detail['store'] = $data['Store']['name'];
        $detail['memo'] = $data['FixedOutgoingEntry']['memo'];
        $detail['is_active'] = $data['FixedOutgoingEntry']['is_active'];
    }
    
    protected function getSummaryValue($data) {
        return $data['FixedOutgoingEntry']['unit_price'] * $data['FixedOutgoingEntry']['quantity'];
    }

    protected function getTableName() {
        return 'FixedOutgoingEntry';
    }
    
    protected function getPrimaryCategoryTableName() {
        return 'OutgoingPrimaryCategory';
    }
    
    protected function getSecondaryCategoryTableName() {
        return 'OutgoingSecondaryCategory';
    }
}

?>
