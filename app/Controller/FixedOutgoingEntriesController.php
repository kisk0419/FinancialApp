<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceController.php';

/**
 * Description of FixedOutgoingEntries
 *
 * @author baba
 */
class FixedOutgoingEntriesController extends FinanceController {
    public $uses = array('OutgoingPrimaryCategory', 'OutgoingSecondaryCategory', 'Store', 'FixedOutgoingEntry', 'Outgoing');
    
    public function regist() {
        $family_id = $this->Auth->user('family_id');
        
        if ($this->request->is('post')) {
            $result = $this->Outgoing->saveMany($this->request->data['Outgoing']);
            
            if ($result == false) {
                $this->Session->setFlash('固定費の登録に失敗しました。');
            }
            $year = $this->request->data['FixedOutgoingEntry']['year'];
            $month = $this->request->data['FixedOutgoingEntry']['month'];
            $this->redirect('/Outgoings/term?year=' . $year . '&month=' . $month);
        } else {
            $year = $this->request->query('year');
            $month = $this->request->query('month');
            if (!isset($year) || !isset($month) || $year < 1970 || $month < 1 || $month > 12) {
                throw new NotFoundException();
            }
            
            $entries = $this->FixedOutgoingEntry->getRegistDatas($family_id);
            //$this->request->data = $entries;
            $this->set('entries', $entries);
            
            $store = $this->Store->find('list');
            $this->set('store', $store);
            
            $this->set('year', $year);
            $this->set('month', $month);
            
            $user_account = $this->Auth->user('account');
            $this->set('user_account', $user_account);
            
            $primary_category = $this->OutgoingPrimaryCategory->find('list');
            $this->set('primary_category', $primary_category);
            $secondary_category = $this->OutgoingSecondaryCategory->find('list');
            $this->set('secondary_category', $secondary_category);
            
            $this->render('regist');
        }
    }

    protected function getTableName() {
        return 'FixedOutgoingEntry';
    }

    protected function addUniqueData($function_name, &$detail, $data) {
        parent::addUniqueData($function_name, $detail, $data);
        
        $detail['unit_price'] = $data['FixedOutgoingEntry']['unit_price'];
        $detail['quantity'] = $data['FixedOutgoingEntry']['quantity'];
        $detail['store_id'] = $data['FixedOutgoingEntry']['store_id'];
        $detail['memo'] = $data['FixedOutgoingEntry']['memo'];
        $detail['is_active'] = $data['FixedOutgoingEntry']['is_active'];
    }
    
    protected function setUniqueData($function_name) {
        parent::setUniqueData($function_name);
        
        $store = $this->Store->find('list');
        $this->set('store', $store);
    }
    
    protected function getPrimaryCategoryIdKey() {
        return 'outgoing_primary_category_id';
    }
    
    protected function getSecondaryCategoryIdKey() {
        return 'outgoing_secondary_category_id';
    }
    
    protected function getPrimaryCategoryTableName() {
        return 'OutgoingPrimaryCategory';
    }
    
    protected function getSecondaryCategoryTableName() {
        return 'OutgoingSecondaryCategory';
    }
}

?>
