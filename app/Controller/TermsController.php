<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TermsController
 *
 * @author keisuke
 */
class TermsController extends AppController {
    private $months = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
    
    public function index() {
        if ($this->request->is('post')) {
            debug($this->request->data);
            
            $year_id = $this->request->data['Term']['year'];
            $month_id = $this->request->data['Term']['month'];
            $year = $this->Term->find('first', array('conditions' => array('id' => $year_id)));
            
            $this->redirect('/Terms/term?year=' . $year['Term']['year'] . '&month=' . $this->months[$month_id]);
        } else {
            $years = $this->Term->find('list');
            $this->set('years', $years);
            $this->set('months', $this->months);
            
            $this->render('index');
        }
    }
    
    public function term() {
        if ($this->request->is('post')) {
            $year_id = $this->request->data['Term']['year'];
            $month_id = $this->request->data['Term']['month'];
            $year_data = $this->Term->find('first', array('conditions' => array('id' => $year_id)));
            $year = $year_data['Term']['year'];
            $month = $this->months[$month_id];
        } else {
            $year = $this->request->query['year'];
            $month = $this->request->query['month'];
        }
        $years = $this->Term->find('list');
        
        $this->set('years', $years);
        $this->set('months', $this->months);
            
        $this->set('year', $year);
        $this->set('month', $month);
        
        $this->render('term');
    }
}

?>
