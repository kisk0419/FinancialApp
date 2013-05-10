<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceTermController.php';
/**
 * Description of FundsController
 *
 * @author keisuke
 */
class FundsController extends FinanceTermController {
    
    public $uses = array(
        'Fund', 
        'FundPrimaryCategory', 
        'FundSecondaryCategory', 
        'FundEntry');
    
    public function history() {
        if ($this->request->is('get')) {
            if (!isset($this->request->pass[0])) {
                throw new NotFoundException();
            }
            $id = $this->request->pass[0];
            
            $funds = $this->Fund->getHistoryData($this->getFamilyId(), $id);
            $this->set('datas', $funds);
            $this->set('entry_id', $id);
            $this->set('family_name', $this->getFamilyName());
            $this->render('history');
            return;
        }
        $this->redirect($this->referer());
    }
    
    protected function getTableName() {
        return 'Fund';
    }
    
    protected function addUniqueData($function_name, &$detail, $data) {
        parent::addUniqueData($function_name, $detail, $data);
        
        $detail['amount'] = $data['Fund']['amount'];
    }
    
    protected function setUniqueData($function_name) {
        parent::setUniqueData($function_name);
        
        $entries = $this->FundEntry->find('list');
        $this->set('entries', $entries);
    }
    
    protected function setContainCondition() {
        $this->Fund->contain(array('FundEntry.FundPrimaryCategory', 'FundEntry.FundSecondaryCategory', 'Family', 'User'));
    }
}

?>
