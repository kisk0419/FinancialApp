<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceTermController.php';
/**
 * Description of OutgoingsController
 *
 * @author keisuke
 */
class OutgoingsController extends FinanceTermController {
   
    public $uses = array(
        'Outgoing', 
        'OutgoingPrimaryCategory', 
        'OutgoingSecondaryCategory', 
        'Store',
        'Setting');
    
    public $helpers = array('Utility');
    
    protected function addUniqueData($function_name, &$detail, $data) {
        parent::addUniqueData($function_name, $detail, $data);
        
        $detail['unit_price'] = $data['Outgoing']['unit_price'];
        $detail['quantity'] = $data['Outgoing']['quantity'];
        $detail['store_id'] = $data['Outgoing']['store_id'];
        $detail['memo'] = $data['Outgoing']['memo'];
        $detail['is_credit'] = $data['Outgoing']['is_credit'];
        if ($detail['is_credit']) {
            if (isset($data['Outgoing']['credit_date'])) {
                $target_date = $data['Outgoing']['credit_date'];
            } else {
                $target_date = $data['Outgoing']['date'];
            }
            $credit_term = $this->getTerm($detail['family_id'], new DateTime($target_date['year'] . '-' . $target_date['month'] . '-' . $target_date['day']));
            $detail['date'] = $target_date;
            $detail['year'] = $credit_term['year'];
            $detail['month'] = $credit_term['month'];
        }
    }

    protected function getTableName() {
        return 'Outgoing';
    }

    protected function setUniqueData($function_name) {
        parent::setUniqueData($function_name);
        
        $date = $this->request->query('date');
        if (!isset($date)) {
            $date = (new DateTime())->format('Y-m-d');
        }
        $this->set('date', $date);
        
        $store = $this->Store->find('list');
        $this->set('store', $store);
    }

    protected function getTitle() {
        return '支出';
    }
}

?>
