<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceTermModel.php';

/**
 * Description of Asset
 *
 * @author keisuke
 */
class Asset extends FinanceTermModel {
    public $belongsTo = array(
        'AssetPrimaryCategory' => array('fields' => 'name'), 
        'AssetSecondaryCategory' => array('fields' => 'name'),
        'Family',
        'User' => array(
            'foreignKey' => 'user_account',
            'fields' => 'name'),
        'Bank' => array('fields' => 'name')
    );
    
    public $virtualFields = array(
        'term' => 'CONCAT(Asset.year, "/", Asset.month)');
    
    public function tallyPerTerm($family_id) {
        $this->contain();
        $datas = $this->findByFamilyId($family_id);
        
        $results = array('add' => array(), 'draw' => array());
        foreach ($datas as $data) {
            $asset = $data['Asset'];
            
            if ($asset['is_draw'] == 0) {
                $func = 'add';
            } else {
                $func = 'draw';
            }
            if (array_key_exists($data['Asset']['term'], $results[$func])) {
                $results[$func][$data['Asset']['term']] += $data['Asset']['amount'];
            } else {
                $results[$func][$data['Asset']['term']] = $data['Asset']['amount'];
            }
        }
        
        return $results;
    }
    
    public function getSummary($family_id, $year, $month) {
        $datas = $this->findByTerm($family_id, $year, $month);
        return $this->calcSummaryOnly($datas);
    }
    
    protected function getTableName() {
        return 'Asset';
    }

    protected function addUniqueData(&$detail, $data) {
        parent::addUniqueData($detail, $data);
        
        $detail['amount'] = $data['Asset']['amount'];
        $detail['memo'] = $data['Asset']['memo'];
        $detail['bank'] = $data['Bank']['name'];
    }

    protected function getSummaryValue($data) {
        return $data['Asset']['amount'];
    }
}

?>
