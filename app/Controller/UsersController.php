<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersController
 *
 * @author keisuke
 */
class UsersController extends AppController {
    public $scaffold;
    
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('ユーザ名かパスワードが不正です');
            }
        }
    }
    
    public function logout() {
        $this->Auth->logout();
        return $this->redirect('/');
    }
}

?>
