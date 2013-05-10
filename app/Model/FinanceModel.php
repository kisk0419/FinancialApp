<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'CategorySummary.php';

/**
 * Description of FinanceModel
 *
 * @author keisuke
 */
abstract class FinanceModel extends AppModel {
    public $actsAs = array('Containable');
    
    protected function findByFamilyId($family_id) {
        if (!isset($family_id)) {
            return array();
        }
        
        $options = array(
            'conditions' => array(
                $this->getTableName() . '.family_id' => $family_id
            )
        );
        return $this->find('all', $options);
    }
    
    public function getIndexData($family_id) {
        $datas = $this->findByFamilyId($family_id);
        $results = $this->createIndexData($datas);
        return $results;
    }
    
    protected function createIndexData($datas) {
        $details = array();
        $summary = 0;
        if ($datas == false) {
            $datas = array();
        }
        $table_name = $this->getTableName();
        foreach ($datas as $data) {
            $detail = array(
                'id' => $data[$table_name]['id'],
                'category_1' => $this->getPrimaryCategoryTable($data)['name'],
                'category_2' => $this->getSecondaryCategoryTable($data)['name'],
                'user' => $data['User']['name'],
            );
            $this->addUniqueData($detail, $data);
            $summary += $this->getSummaryValue($data);
            $details[] = $detail;
        }
        $result = array(
            'details' => $details,
            'summary' => $summary
        );
        return $result;
    }
    
    public function getData($family_id, $data_id) {
        $options = array(
            'conditions' => array(
                $this->getTableName() . '.id' => $data_id,
                $this->getTableName() . '.family_id' => $family_id
            )
        );
        
        $result = $this->find('first', $options);
        
        return $result;
    }
    
    public function deleteSafety($family_id, $data_id) {
        $options = array(
            $this->getTableName() . '.id' => $data_id,
            $this->getTableName() . '.family_id' => $family_id
        );
        
        return $this->deleteAll($options);
    }
    
    public function tally($family_id) {
        $datas = $this->findByFamilyId($family_id);
        return $this->calcSummary($datas);
    }
    
    protected function calcSummaryOnly($datas) {
        $summary = 0;
        foreach ($datas as $data) {
            $summary += $this->getSummaryValue($data);
        }
        
        return $summary;
    }
    
    protected function calcSummary($datas) {
        $categories = new CategorySummary();
        
        foreach ($datas as $data) {
            $primary_category_name = $this->getPrimaryCategoryTable($data)['name'];
            $secondary_category_name = $this->getSecondaryCategoryTable($data)['name'];
            $categories->add($primary_category_name, $secondary_category_name, $this->getSummaryValue($data));
        }
        $categories->calcRate();
        
        return $categories;
    }
    
    protected function addUniqueData(&$detail, $data) {}
    
    protected abstract function getTableName();
    protected abstract function getSummaryValue($data);
    
    protected function getPrimaryCategoryTable($data) {
        return $data[$this->getTableName() . 'PrimaryCategory'];
    }
    
    protected function getSecondaryCategoryTable($data) {
        return $data[$this->getTableName() . 'SecondaryCategory'];
    }
}

?>
