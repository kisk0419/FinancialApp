<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceTermModel.php';

/**
 * Description of Incoming
 *
 * @author keisuke
 */
class Incoming extends FinanceTermModel {
    public $belongsTo = array(
        'IncomingPrimaryCategory' => array('fields' => 'name'), 
        'IncomingSecondaryCategory' => array('fields' => 'name'), 
        'Company' => array('fields' => 'name'), 
        'Family', 
        'User' => array(
            'foreignKey' => 'user_account',
            'fields' => 'name')
        );
    public $virtualFields = array(
        'term' => 'CONCAT(Incoming.year, "/", Incoming.month)');

    public function getSummary($family_id, $year, $month) {
        $datas = $this->findByTerm($family_id, $year, $month);
        return $this->calcSummaryOnly($datas);
    }
    
    protected function getTableName() {
        return 'Incoming';
    }

    protected function addUniqueData(&$detail, $data) {
        parent::addUniqueData($detail, $data);
        
        $detail['amount'] = $data['Incoming']['amount'];
        $detail['company'] = $data['Company']['name'];
        $detail['memo'] = $data['Incoming']['memo'];
    }

    protected function getSummaryValue($data) {
        return $data['Incoming']['amount'];
    }
}

?>
