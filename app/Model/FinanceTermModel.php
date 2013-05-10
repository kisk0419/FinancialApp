<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceModel.php';

/**
 * Description of FinanceTermModel
 *
 * @author baba
 */
abstract class FinanceTermModel extends FinanceModel {
    
    public function getIndexData($family_id, $year = null, $month = null, $date = null) {
        $datas = $this->findByTerm($family_id, $year, $month, $date);
        
        $results = $this->createIndexData($datas);
        return $results;
    }
    
    protected function findByTerm($family_id, $year, $month, $date = null) {
        if (!isset($family_id)) {
            return false;
        }
        $options = array(
            'conditions' => array(
                $this->getTableName() . '.family_id' => $family_id,
            ),
            'order' => array(
                $this->getTableName() . '.date'
            )
        );
        
        if (isset($year) && is_numeric($year)) {
            if ($year >= 1970) {
                $options['conditions'][$this->getTableName() . '.year'] = $year;
            } else {
                return false;
            }
        }
        if (isset($month) && is_numeric($month)) {
            if ($month >= 1 && $month <= 12) {
                $options['conditions'][$this->getTableName() . '.month'] = $month;
            } else {
                return false;
            }
        }
        if (isset($date)) {
            $options['conditions'][$this->getTableName() . '.date'] = $date;
        }
        return $this->find('all', $options);
    }
    
    public function tallyByTerm($family_id, $year, $month) {
        $datas = $this->findByTerm($family_id, $year, $month);
        return $this->calcSummary($datas);
    }
    
    protected function addUniqueData(&$detail, $data) {
        parent::addUniqueData($detail, $data);
        
        $detail['term'] = $data[$this->getTableName()]['term'];
        $detail['year'] = $data[$this->getTableName()]['year'];
        $detail['month'] = $data[$this->getTableName()]['month'];
        $detail['date'] = $data[$this->getTableName()]['date'];
    }
}

?>
