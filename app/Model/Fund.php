<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceTermModel.php';

/**
 * Description of Fund
 *
 * @author keisuke
 */
class Fund extends FinanceTermModel {
    public $belongsTo = array(
        'FundEntry' => array(
            'fields' => array('id', 'fund_primary_category_id', 'fund_secondary_category_id', 'is_completed', 'is_active')
        ),
        'Family', 
        'User' => array(
            'foreignKey' => 'user_account',
            'fields' => 'name')
    );

    public $virtualFields = array(
        'term' => 'CONCAT(Fund.year, "/", Fund.month)');
    
    public function getSummary($family_id, $year, $month) {
        $datas = $this->findByTerm($family_id, $year, $month);
        return $this->calcSummaryOnly($datas);
    }
    
    public function getHistoryData($family_id, $entry_id) {
        $this->contain(array(
            'FundEntry', 
            'FundEntry.FundPrimaryCategory', 
            'FundEntry.FundSecondaryCategory', 
            'User', 
            'Family'));
        
        $datas = $this->findByEntryId($family_id, $entry_id);
        
        return $this->createIndexData($datas);
    }
    public function tally($family_id) {
        $this->contain(array(
            'FundEntry', 
            'FundEntry.FundPrimaryCategory', 
            'FundEntry.FundSecondaryCategory', 
            'User', 
            'Family'));
        
        return parent::tally($family_id);
    }
    
    public function tallyByTerm($family_id, $year, $month) {
        $this->contain(array(
            'FundEntry', 
            'FundEntry.FundPrimaryCategory', 
            'FundEntry.FundSecondaryCategory', 
            'User', 
            'Family'));
        
        return parent::tallyByTerm($family_id, $year, $month);
    }
    
    protected function findByEntryId($family_id, $entry_id) {
        $options = array(
            'conditions' => array(
                'Fund.fund_entry_id' => $entry_id,
                'Fund.family_id' => $family_id
            ),
            'order' => array('Fund.year DESC', 'Fund.month DESC', 'Fund.date DESC')
        );
        
        return $this->find('all', $options);
    }
    
    protected function getSummaryValue($data) {
        return $data['Fund']['amount'];
    }

    protected function addUniqueData(&$detail, $data) {
        parent::addUniqueData($detail, $data);
        
        $detail['amount'] = $data['Fund']['amount'];
        $detail['is_completed'] = $data['FundEntry']['is_completed'];
        $detail['entry'] = $data['FundEntry']['id'];
        $detail['is_active'] = $data['FundEntry']['is_active'];
    }
    
    protected function getTableName() {
        return 'Fund';
    }
    
    protected function getPrimaryCategoryTable($data) {
        return $data['FundEntry']['FundPrimaryCategory'];
    }
    
    protected function getSecondaryCategoryTable($data) {
        return $data['FundEntry']['FundSecondaryCategory'];
    }
}

?>
