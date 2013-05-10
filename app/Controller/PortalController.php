<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PortalController
 *
 * @author keisuke
 */
class PortalController extends AppController {
    public $uses = array('Setting');
    
    public function index() {
        $today = new DateTime();
        
        $setting = $this->Setting->getData($this->getFamilyId());
        
        $day = $setting['Setting']['term_start_date'];
        if ($setting['TermStartCondition']['value'] == 0 && $today->format('d') >= $day) {
            $today->add(new DateInterval('P1M'));
        } else if ($setting['TermStartCondition']['value'] == 1 && $today->format('d') < $day) {
            $today->sub(new DateInterval('P1M'));
        }
        
        $year = $today->format('Y');
        $month = $today->format('n');
        
        $this->redirect('/Calculates/check?year=' . $year . '&month=' . $month);
    }
    
    public function admin() {
        $this->checkAdmin();
        $this->render('admin');
    }
}

?>
