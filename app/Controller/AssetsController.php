<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'FinanceTermController.php';

/**
 * Description of AssetsController
 *
 * @author keisuke
 */
class AssetsController extends FinanceTermController {
    public $uses = array('Asset', 'AssetPrimaryCategory', 'AssetSecondaryCategory', 'Bank');
     
    public function draw() {
        if ($this->request->is('post')) {
            $data = $this->request->data['Asset'];
            if ($data['amount'] > 0) {
                $data['amount'] *= -1;
            }
            $data['family_id'] = $this->getFamilyId();
            $data['user_account'] = $this->getUserAccount();
            
            $result = $this->Asset->save($data);
            if ($result == false) {
                $this->Session->setFlash('出金処理に失敗しました');
            }
            $this->redirect($this->request->data['Asset']['referer']);
        } else {
            $referer = $this->referer();
            $this->set('referer', $referer);
            
            $category_primary = $this->AssetPrimaryCategory->find('list');
            $category_secondary = $this->AssetSecondaryCategory->find('list');
            $this->set('category_primary', $category_primary);
            $this->set('category_secondary', $category_secondary);
            
            $this->setUniqueData('draw'); 
            
            $this->render('draw');
        }
    }
    
    protected function getTableName() {
        return 'Asset';
    }

    protected function addUniqueData($function_name, &$detail, $data) {
        parent::addUniqueData($function_name, $detail, $data);
        
        $detail['amount'] = $data['Asset']['amount'];
        $detail['is_draw'] = $data['Asset']['is_draw'];
        
        if ($detail['is_draw'] == 1 && $detail['amount'] > 0 ||
            $detail['is_draw'] == 0 && $detail['amount'] < 0) {
            $detail['amount'] *= -1;
        }
        
        $detail['bank_id'] = $data['Asset']['bank_id'];
        $detail['memo'] = $data['Asset']['memo'];
    }

    protected function setUniqueData($function_name) {
        parent::setUniqueData($function_name);
        
        $bank = $this->Bank->find('list');
        $this->set('bank', $bank);
    }
}

?>
