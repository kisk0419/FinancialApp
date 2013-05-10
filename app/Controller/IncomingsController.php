<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceTermController.php';

/**
 * Description of IncomingsController
 *
 * @author keisuke
 */
class IncomingsController extends FinanceTermController {
  
    public $uses = array('Incoming', 'IncomingPrimaryCategory', 'IncomingSecondaryCategory', 'Company');
    public $helpers = array('Utility');
    
    protected function addUniqueData($function_name, &$detail, $data) {
        parent::addUniqueData($function_name, $detail, $data);
        
        $detail['amount'] = $data['Incoming']['amount'];
        $detail['company_id'] = $data['Incoming']['company_id'];
        $detail['memo'] = $data['Incoming']['memo'];
     }

    protected function getTableName() {
        return 'Incoming';
    }

    protected function setUniqueData($function_name) {
        parent::setUniqueData($function_name);
        
        $company = $this->Company->find('list');
        $this->set('company', $company);
    }
}

?>
