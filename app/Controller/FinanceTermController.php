<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceController.php';

/**
 * Description of FinanceWithTermController
 *
 * @author baba
 */
abstract class FinanceTermController extends FinanceController {
    
    public function term() {
        $table_name = $this->getTableName();
        
        $family_id = $this->Auth->user('family_id');
        $user = $this->Auth->user();
        $family_name = $user['Family']['name'];
        
        if (!$this->request->is('get')) {
            throw new ForbiddenException();
        }
        
        $year = $this->request->query('year');
        $month = $this->request->query('month');
        $date = $this->request->query('date');
        
        if (!isset($year) || !isset($month) || $year < 1970 || $month < 1 || $month > 12) {
            $term = $this->getCurrentTerm($family_id);
            $year = $term['year'];
            $month = $term['month'];
        }
        
        $this->setContainCondition();
        $datas = $this->$table_name->getIndexData($family_id, $year, $month, $date);
        
        $this->set('datas', $datas);
        $this->set('family_name', $family_name);
        $this->set('year', $year);
        $this->set('month', $month);
        if (isset($date)) {
            $this->set('date', (new DateTime($date))->format('(n月d日)'));
        }
        $this->set('referer', $this->referer());
        
        $this->render('term');
    }
    
    protected function addUniqueData($function_name, &$detail, $data) {
        $table_name = $this->getTableName();
            
        if ($function_name === 'add') {
            $detail['date'] = $data[$table_name]['date'];
            $detail['year'] = $data[$table_name]['year'];
            $detail['month'] = $data[$table_name]['month'];
        } else if ($function_name === 'edit') {
            $detail['date'] = $data[$table_name]['date'];
        }
    }
    
    protected function setUniqueData($function_name) {
        if ($function_name === 'add' || $function_name === 'draw') {
            $year = $this->request->query('year');
            $month = $this->request->query('month');
            if (!isset($year) || !isset($month) || $year < 1970 || $month < 1 || $month > 12) {
                throw new NotFoundException();
            }

            $this->set('year', $year);
            $this->set('month', $month);
        }
    }
}

?>
