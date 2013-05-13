<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceTermModel.php';

/**
 * Description of Outgoing
 *
 * @author baba
 */
class Outgoing extends FinanceTermModel {
    public $belongsTo = array(
        'OutgoingPrimaryCategory' => array('fields' => 'name'), 
        'OutgoingSecondaryCategory' => array('fields' => 'name'), 
        'Store' => array('fields' => 'name'), 
        'Family', 
        'User' => array(
            'foreignKey' => 'user_account',
            'fields' => 'name')
        );
    
    public $virtualFields = array(
        'term' => 'CONCAT(Outgoing.year, "/", Outgoing.month)');
    
    public function tallyPerDateInTerm($family_id, $year, $month) {
        $this->contain();
        $datas = $this->findByTerm($family_id, $year, $month);
        
        $results = array();
        foreach ($datas as $data) {
            $outgoing = $data['Outgoing'];
            
            if ($outgoing['is_fixed'] == 0) {
                $date = $outgoing['date'];
                if (array_key_exists($date, $results)) {
                    $results[$date] += $outgoing['unit_price'] * $outgoing['quantity'];
                } else {
                    $results[$date] = $outgoing['unit_price'] * $outgoing['quantity'];
                }
            }
        }
        
        return $results;
    }
    
    public function getSummary($family_id, $year, $month) {
        $options = array(
            'conditions' => array(
                'Outgoing.family_id' => $family_id,
                'Outgoing.year' => $year,
                'Outgoing.month' => $month
            )
        );
        
        $results = array();
        
        $total = $this->find('all', $options);
        $results['total'] = $this->calcSummaryOnly($total);
        
        $options['conditions']['is_fixed'] = 1;
        $fixed = $this->find('all', $options);
        $results['fixed'] = $this->calcSummaryOnly($fixed);
        
        $options['conditions']['is_fixed'] = 0;
        $values = $this->find('all', $options);
        $results['values'] = $this->calcSummaryOnly($values);
        
        return $results;
    }
    
    protected function getTableName() {
        return 'Outgoing';
    }

    protected function addUniqueData(&$detail, $data) {
        parent::addUniqueData($detail, $data);
        
        $detail['unit_price'] = $data['Outgoing']['unit_price'];
        $detail['quantity'] = $data['Outgoing']['quantity'];
        $detail['price'] = ($data['Outgoing']['unit_price'] * $data['Outgoing']['quantity']);
        $detail['memo'] = $data['Outgoing']['memo'];
        $detail['is_credit'] = $data['Outgoing']['is_credit'];
        $detail['store'] = $data['Store']['name'];
        $detail['type'] = ($data['Outgoing']['is_fixed'] == 1) ? '固定費' : '--';
    }

    protected function getSummaryValue($data) {
        return $data['Outgoing']['unit_price'] * $data['Outgoing']['quantity'];
    }
}

?>
