<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'DebugKit.Toolbar',
        'Session' => array(),
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'logoutAction' => array(
                'controller' => 'users',
                'action' => 'logout'
            ),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'fields' => array(
                        'username' => 'account',
                        'password' => 'password',
                    )
                )
            )
        ),
    );
    
    protected function getFamilyId() {
        return $this->Auth->user('family_id');
    }
    
    protected function getFamilyName() {
        return $this->Auth->user()['Family']['name'];
    }
    
    protected function getUserAccount() {
        return $this->Auth->user('account');
    }
    
    protected function isAdmin() {
        return ($this->Auth->user('is_admin') == 1);
    }
    
    protected function checkAdmin() {
        if (!$this->isAdmin()) {
            throw new ForbiddenException();
        }
    }
}
