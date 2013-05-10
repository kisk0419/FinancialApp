<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceModel.php';
/**
 * Description of FundEntry
 *
 * @author baba
 */
class FundEntry extends FinanceModel {
    public $belongsTo = array(
        'FundPrimaryCategory' => array('fields' => array('id', 'name')), 
        'FundSecondaryCategory' => array('fields' => array('id', 'name')),
        'FundEntryMode' => array('fields' => array('id', 'text')),
        'Family', 
        'User' => array(
            'foreignKey' => 'user_account',
            'fields' => 'name'));
    
    public $hasMany = array(
        'Fund' => array(
            'fields' => array('amount', 'fund_entry_id'),
            'dependent' => true));
    
    public function getIndexData($family_id) {
        $this->contain(array('Family', 'FundPrimaryCategory', 'FundSecondaryCategory', 'User', 'FundEntryMode'));
        $datas = $this->getAllSummary($family_id);
        $results = $this->createIndexData($datas);
        return $results;
    }
    
    public function getSummaryData($family_id) {
        $results = array();
        $this->contain();
        $processing = $this->getProcessingSummary($family_id);
        $this->contain();
        $completed = $this->getCompletedSummary($family_id);
        $this->contain();
        $settled = $this->getSettledSummary($family_id);
        
        $results['processing'] = $processing;
        $results['completed'] = $completed;
        $results['settled'] = $settled;
        
        return $results;
    }
    
    public function getData($family_id, $data_id) {
        $this->contain(array('Family', 'FundPrimaryCategory', 'FundSecondaryCategory', 'User', 'FundEntryMode'));
        $entry = $this->findEntry($family_id, $data_id);
        $this->summaryEntry($entry);
        return $entry;
    }
    
    protected function summaryEntry(&$entry) {
        $options = array(
            'conditions' => array('fund_entry_id' => $entry['FundEntry']['id']),
            'fields' => array(
                'fund_entry_id', 
                'sum(Fund.amount) as Fund__summary', 
                'count(fund_entry_id) as Fund__count'),
            'group' => array('fund_entry_id')
        );
        $this->Fund->virtualFields['summary'] = 0;
        $this->Fund->virtualFields['count'] = 0;

        $summary = $this->Fund->find('all', $options);
        
        if (isset($summary[0])) {
            $entry['FundSummary'] = $summary[0]['Fund'];
        } else {
            $entry['FundSummary'] = array(
                'summary' => 0,
                'count' => 0
            );
        }
        return $entry;
    }
    
    protected function getAllSummary($family_id) {
        //$this->contain(array('Family', 'FundPrimaryCategory', 'FundSecondaryCategory', 'User', 'FundEntryMode'));
        $entries =  $this->findAllEntries($family_id);
        foreach ($entries as &$entry) {
            $this->summaryEntry($entry);
        }
        
        return $entries;
    }
    
    protected function getSettledSummary($family_id, $year = null, $month = null) {
        //$this->contain(array('Family', 'FundPrimaryCategory', 'FundSecondaryCategory', 'User', 'FundEntryMode'));
        $entries =  $this->findEntries($family_id, true, true, $year, $month);
        foreach ($entries as &$entry) {
            $this->summaryEntry($entry);
        }
        
        return $entries;
    }
    
    protected function getCompletedSummary($family_id, $year = null, $month = null) {
        //$this->contain(array('Family', 'FundPrimaryCategory', 'FundSecondaryCategory', 'User', 'FundEntryMode'));
        //$this->contain();
        $entries =  $this->findEntries($family_id, true, false, $year, $month);
        foreach ($entries as &$entry) {
            $this->summaryEntry($entry);
        }
        
        return $entries;
    }
    
    protected function getProcessingSummary($family_id, $year = null, $month = null) {
        //$this->contain(array('Family', 'FundPrimaryCategory', 'FundSecondaryCategory', 'User', 'FundEntryMode'));
        $entries =  $this->findEntries($family_id, false, false, $year, $month);
        foreach ($entries as &$entry) {
            $this->summaryEntry($entry);
        }
        
        return $entries;
    }
    
    public function getRegistDatas($family_id, $year, $month) {
        $this->contain(array('Family', 'FundPrimaryCategory', 'FundSecondaryCategory', 'User', 'FundEntryMode'));
        return $this->getProcessingSummary($family_id, $year, $month);
    }
    
    protected function findEntry($family_id, $entry_id) {
        $options = array(
            'conditions' => array(
                'FundEntry.family_id' => $family_id,
                'FundEntry.id' => $entry_id
            )
        );
        return $this->find('first', $options);
    }
    
    protected function findAllEntries($family_id) {
        $options = array(
            'conditions' => array(
                'FundEntry.family_id' => $family_id,
                'FundEntry.is_active' => 1
            )
        );
        
        return $this->find('all', $options);
    }
    
    protected function findEntries($family_id, $is_completed, $is_settled, $year, $month) {
        $options = array(
            'conditions' => array(
                'FundEntry.family_id' => $family_id,
                'FundEntry.is_active' => 1,
                'FundEntry.is_completed' => $is_completed,
                'FundEntry.is_settled' => $is_settled
            )
        );
        
        if (isset($year) && isset($month)) {
            $options['conditions']['OR'] = array(
                array(
                    'FundEntry.start_year' => $year,
                    'FundEntry.start_month <= ' => $month),
                array(
                    'FundEntry.start_year <' => $year,
                )
            );
        }
        
        return $this->find('all', $options);
    }
    
    protected function getSummaryValue($data) {
        return $data['FundEntry']['amount'];
    }

    protected function getTableName() {
        return 'FundEntry';
    }
    
    protected function addUniqueData(&$detail, $data) {
        parent::addUniqueData($detail, $data);
        
        $detail['amount'] = $data['FundEntry']['amount'];
        $detail['summary'] = $data['FundSummary']['summary'];
        $detail['count'] = $data['FundSummary']['count'];
        $detail['start_year'] = $data['FundEntry']['start_year'];
        $detail['start_month'] = $data['FundEntry']['start_month'];
        $detail['start_term'] = $data['FundEntry']['start_year'] . '/' . $data['FundEntry']['start_month'];
        $detail['fund_entry_mode_id'] = $data['FundEntryMode']['id'];
        $detail['fund_entry_mode'] = $data['FundEntryMode']['text'];
        $detail['target_value'] = $data['FundEntry']['target_value'];
        $detail['memo'] = $data['FundEntry']['memo'];
        $detail['is_completed'] = $data['FundEntry']['is_completed'];
        $detail['is_active'] = $data['FundEntry']['is_active'];
    }
    
    protected function getPrimaryCategoryTable($data) {
        return $data['FundPrimaryCategory'];
    }
    
    protected function getSecondaryCategoryTable($data) {
        return $data['FundSecondaryCategory'];
    }
}

?>
