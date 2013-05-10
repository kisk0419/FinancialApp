<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfigsController
 *
 * @author baba
 */
class SettingsController extends AppController {
    
    public $uses = array('Setting', 'TermStartCondition', 'Family');
    
    public function index() {
        $this->checkAdmin();
        $settings = $this->Setting->getIndexData();
        
        $this->set('datas', $settings);
        $this->render('index');
    }
    
    public function add() {
        $this->checkAdmin();
        
        if ($this->request->is('post')) {
            $data = $this->request->data['Setting'];
            $result = $this->Setting->save($data);
            if ($result == false) {
                $this->Session->setFlash('設定の保存に失敗しました');
            }
            $this->redirect($this->request->data['info']['referer']);
        } else {
            $conditions = $this->TermStartCondition->find('list');
            $this->set('conditions', $conditions);
            
            $families = $this->Family->find('list');
            $this->set('families', $families);
            
            $this->set('referer', $this->referer());
            $this->render('add');
            return;
        }
    }
    
    public function edit() {
        if ($this->request->is('post')) {
            $data = $this->request->data['Setting'];
            $result = $this->Setting->save($data);
            if ($result == false) {
                $this->Session->setFlash('設定の保存に失敗しました');
            }
            $this->redirect($this->request->data['info']['referer']);
        } else {
            $setting = $this->Setting->getData($this->getFamilyId());
            if (count($setting) === 0) {
                throw new NotFoundException();
            }
            $this->request->data = $setting;
            
            $conditions = $this->TermStartCondition->find('list');
            $this->set('conditions', $conditions);
            
            $this->set('referer', $this->referer());
            $this->render('edit');
            return;
        }
    }
    
    public function delete() {
        if (isset($this->request->pass[0])) {
            $id = $this->request->pass[0];
            
            $result = $this->Setting->delete($id);
            if ($result == false) {
                $this->Session->setFlash('削除に失敗しました');
            }
        }
        $this->redirect($this->referer());
    }
}

?>
