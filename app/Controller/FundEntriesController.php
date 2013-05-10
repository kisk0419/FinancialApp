<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceController.php';

/**
 * Description of FundEntriesController
 *
 * @author baba
 */
class FundEntriesController extends FinanceController {
    
    public $uses = array(
        'FundPrimaryCategory', 
        'FundSecondaryCategory', 
        'FundEntry', 
        'Fund', 
        'FundEntryMode'
     );
    
    public $helpers = array('Fund');
    
    public function regist() {
        $family_id = $this->Auth->user('family_id');
        
        if ($this->request->is('post')) {
            $result = $this->Fund->saveMany($this->request->data['Fund']);
            
            if ($result == false) {
                $this->Session->setFlash('積立の登録に失敗しました。');
            }
            $year = $this->request->data['FundEntry']['year'];
            $month = $this->request->data['FundEntry']['month'];
            $this->redirect('/Funds/term?year=' . $year . '&month=' . $month);
        } else {
            $year = $this->request->query('year');
            $month = $this->request->query('month');
            if (!isset($year) || !isset($month) || $year < 1970 || $month < 1 || $month > 12) {
                throw new NotFoundException();
            }
            
            $entries = $this->FundEntry->getRegistDatas($family_id, $year, $month);
            
            $this->set('entries', $entries);
            
            $this->set('year', $year);
            $this->set('month', $month);
            
            $user_account = $this->Auth->user('account');
            $this->set('user_account', $user_account);
            
            $primary_category = $this->FundPrimaryCategory->find('list');
            $this->set('primary_category', $primary_category);
            $secondary_category = $this->FundSecondaryCategory->find('list');
            $this->set('secondary_category', $secondary_category);
            
            $this->render('regist');
        }
    }
    
    public function complete() {
        if ($this->request->is('get')) {
            if (!isset($this->request->pass[0])) {
                throw new NotFoundException();
            }
            $id = $this->request->pass[0];
            
            $family_id = $this->Auth->user('family_id');
            $entry = $this->FundEntry->find('first', array(
                'conditions' => array(
                    'FundEntry.id' => $id,
                    'FundEntry.family_id' => $family_id
                )
            ));
            if (count($entry)) {
                $entry['FundEntry']['is_completed'] = 1;
                $result = $this->FundEntry->save($entry);
                if ($result == false) {
                    $this->Session->setFlash('完了処理に失敗しました');
                }
            }
         }
         $this->redirect($this->referer());
            
    }
    
    public function settle() {
        if ($this->request->is('get')) {
            if (!isset($this->request->pass[0])) {
                throw new NotFoundException();
            }
            $id = $this->request->pass[0];
            
            $family_id = $this->getFamilyId();
            $entry = $this->FundEntry->find('first', array(
                'conditions' => array(
                    'FundEntry.id' => $id,
                    'FundEntry.family_id' => $family_id
                )
            ));
            if (count($entry)) {
                $entry['FundEntry']['is_settled'] = 1;
                $entry['FundEntry']['is_completed'] = 1;
                $result = $this->FundEntry->save($entry);
                if ($result == false) {
                    $this->Session->setFlash('清算処理に失敗しました');
                }
            }
        }
        $this->redirect($this->referer());
    }
    
    protected function getTableName() {
        return 'FundEntry';
    }
    
    protected function addUniqueData($function_name, &$detail, $data) {
        parent::addUniqueData($function_name, $detail, $data);
        
        $detail['start_year'] = $data['FundEntry']['start_year'];
        $detail['start_month'] = $data['FundEntry']['start_month'];
        $detail['fund_entry_mode_id'] = $data['FundEntry']['fund_entry_mode_id'];
        $detail['target_value'] = $data['FundEntry']['target_value'];
        $detail['amount'] = $data['FundEntry']['amount'];
        $detail['memo'] = $data['FundEntry']['memo'];
        $detail['is_completed'] = $data['FundEntry']['is_completed'];
        $detail['is_active'] = $data['FundEntry']['is_active'];
    }
    
    protected function setUniqueData($function_name) {
        parent::setUniqueData($function_name);
        
        $modes = $this->FundEntryMode->find('list');
        $this->set('modes', $modes);
    }
    
    protected function getPrimaryCategoryIdKey() {
        return 'fund_primary_category_id';
    }
    
    protected function getSecondaryCategoryIdKey() {
        return 'fund_secondary_category_id';
    }
    
    protected function getPrimaryCategoryTableName() {
        return 'FundPrimaryCategory';
    }
    
    protected function getSecondaryCategoryTableName() {
        return 'FundSecondaryCategory';
    }
}

?>
