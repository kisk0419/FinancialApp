<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of FinanceController
 *
 * @author keisuke
 */
abstract class FinanceController extends AppController {
    public function beforeRender() {
        parent::beforeRender();
        $this->set('header_title', $this->getTitle());
    }
    
    public function index() {
        $table_name = $this->getTableName();
        
        $family_id = $this->Auth->user('family_id');
        $user = $this->Auth->user();
        $family_name = $user['Family']['name'];
        
        $this->setContainCondition();
        $datas = $this->$table_name->getIndexData($family_id);
        
        $this->set('datas', $datas);
        $this->set('family_name', $family_name);
        
        $this->render('index');
    }
    
    public function delete() {
        $table_name = $this->getTableName();
        $family_id = $this->Auth->user('family_id');
        $id = $this->request->pass[0];
        
        $result = $this->$table_name->deleteSafety($family_id, $id);
        
        if (!$result) {
            $this->Session->setFlash('項目の削除に失敗しました。');
        }
        
        $this->redirect($this->referer());
    }
    
    public function show() {
        $table_name = $this->getTableName();
        $family_id = $this->Auth->user('family_id');
        $id = $this->request->pass[0];
        
        $this->setContainCondition();
        $data = $this->$table_name->getData($family_id, $id);
        
        $this->set('data', $data);
        $this->set('referer', $this->referer());
        $this->render('show');
    }
    
    public function add() {
        $table_name = $this->getTableName();
        $family_id = $this->Auth->user('family_id');
        $user = $this->Auth->user();
        
        if ($this->request->is('post')) {
            $primary_category_key = $this->getPrimaryCategoryIdKey();
            $secondary_category_key = $this->getSecondaryCategoryIdKey();
            
            $data = array(
                $primary_category_key => $this->request->data[$table_name][$primary_category_key],
                $secondary_category_key => $this->request->data[$table_name][$secondary_category_key],
                'family_id' => $family_id,
                'user_account' => $user['account']
            );
            
            $this->addUniqueData('add', $data, $this->request->data);
            
            $id = $this->$table_name->save($data);
            if ($id === false) {
                $this->render('add');
                return;
            }
            $this->redirect($this->request->data[$table_name]['referer']);
            return;
        } else if ($this->request->is('get')) {
            $primary_category_table = $this->getPrimaryCategoryTableName();
            $secondary_category_table = $this->getSecondaryCategoryTableName();
            
            $category_primary = $this->$primary_category_table->find('list');
            $category_secondary = $this->$secondary_category_table->find('list');
            
            $this->set('category_primary', $category_primary);
            $this->set('category_secondary', $category_secondary);
            
            $this->setUniqueData('add');
            
            $this->set('referer', $this->referer());
            
            $this->render('add');
        } else {
            throw new ForbiddenException();
        }
    }
    
    public function edit() {
        $table_name = $this->getTableName();
        $family_id = $this->Auth->user('family_id');
        $user = $this->Auth->user();
   
        if ($this->request->is('post')) {
            $primary_category_key = $this->getPrimaryCategoryIdKey();
            $secondary_category_key = $this->getSecondaryCategoryIdKey();
            
            $detail = array(
                'id' => $this->request->data[$table_name]['id'],
                'family_id' => $family_id,
                $primary_category_key => $this->request->data[$table_name][$primary_category_key],
                $secondary_category_key => $this->request->data[$table_name][$secondary_category_key],
                'user_account' => $user['account']
            );
            
            $this->addUniqueData('edit', $detail, $this->request->data);
            
            $id = $this->$table_name->save($detail);
            if ($id == false) {
                $this->render('edit');
                return;
            }
            $this->redirect($this->request->data[$table_name]['referer']);
            return;
        } else if ($this->request->is('get')){
            $id = $this->request->pass[0];

            $this->setContainCondition();
            $data = $this->$table_name->getData($family_id, $id);
            if ($data == false) {
                throw new NotFoundException();
            }
            $this->request->data = $data;

            $primary_category_table = $this->getPrimaryCategoryTableName();
            $secondary_category_table = $this->getSecondaryCategoryTableName();
            
            $category_primary = $this->$primary_category_table->find('list');
            $category_secondary = $this->$secondary_category_table->find('list');
            
            $this->set('category_primary', $category_primary);
            $this->set('category_secondary', $category_secondary);
            $this->setUniqueData('edit');
            $this->set('referer', $this->referer());
            
            $this->render('edit');
        } else {
            throw new ForbiddenException();
        }
    }
    
    protected function addUniqueData($function_name, &$detail, $data) {}
    
    protected function getPrimaryCategoryIdKey() {
        return strtolower($this->getTableName()) . '_primary_category_id';
    }
    
    protected function getSecondaryCategoryIdKey() {
        return strtolower($this->getTableName()) . '_secondary_category_id';
    }
    
    protected function getPrimaryCategoryTableName() {
        return $this->getTableName() . 'PrimaryCategory';
    }
    
    protected function getSecondaryCategoryTableName() {
        return $this->getTableName() . 'SecondaryCategory';
    }
    
    protected function getCurrentTerm($family_id) {
        $today = new DateTime();
        
        return $this->getTerm($family_id, $today);
    }
    
    protected function getTerm($family_id, DateTime $date) {
        $term = array();
        
        $setting = $this->Setting->getData($family_id);
        
        $day = $setting['Setting']['term_start_date'];
        if ($setting['TermStartCondition']['value'] == 0 && $date->format('d') >= $day) {
            $date->add(new DateInterval('P1M'));
        } else if ($setting['TermStartCondition']['value'] == 1 && $date->format('d') < $day) {
            $date->sub(new DateInterval('P1M'));
        }
        $term['year'] = $date->format('Y');
        $term['month'] = $date->format('n');
        
        return $term;
    }
    
    protected function setUniqueData($function_name) {}

    protected function setContainCondition() {}
    
    protected abstract function getTableName();
    
    protected abstract function getTitle();
}

?>
