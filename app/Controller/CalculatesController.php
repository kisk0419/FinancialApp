<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalculateController
 *
 * @author baba
 */
class CalculatesController extends AppController {
    public $uses = array('Family', 'Outgoing', 'Incoming', 'Asset', 'Calculate', 'Fund', 'Setting', 'FundEntry');
    public $helpers = array('Utility');
    
    public function index() {
        $family_id = $this->Auth->user('family_id');
        
        $incoming_summary = $this->Incoming->tally($family_id);
        $outgoing_summary = $this->Outgoing->tally($family_id);
        $asset_summary = $this->Asset->tally($family_id);
        $fund_summary = $this->Fund->tally($family_id);
        
        $this->set('incoming_data', $incoming_summary);
        $this->set('outgoing_data', $outgoing_summary);
        $this->set('asset_data', $asset_summary);
        $this->set('fund_data', $fund_summary);
        
        $this->render('index');
    }
    
    public function term() {
        $family_id = $this->Auth->user('family_id');
        
        $year = $this->request->query('year');
        $month = $this->request->query('month');
        
        $incoming_summary = $this->Incoming->tallyByTerm($family_id, $year, $month);
        $outgoing_summary = $this->Outgoing->tallyByTerm($family_id, $year, $month);
        $asset_summary = $this->Asset->tallyByTerm($family_id, $year, $month);
        $fund_summary = $this->Fund->tallyByTerm($family_id, $year, $month);
        
        $this->set('incoming_data', $incoming_summary);
        $this->set('outgoing_data', $outgoing_summary);
        $this->set('asset_data', $asset_summary);
        $this->set('fund_data', $fund_summary);
        
        $this->render('index');
    }
    
    public function check() {
        $family_id = $this->getFamilyId();
        $year = $this->request->query('year');
        $month = $this->request->query('month');
        if (!isset($year) || !isset($month)) {
            throw new NotFoundException();
        }
        
        $incoming_summary = $this->Incoming->getSummary($family_id, $year, $month);
        $outgoing_summary = $this->Outgoing->getSummary($family_id, $year, $month);
        $outgoing_detail = $this->Outgoing->tallyPerDateInTerm($family_id, $year, $month);
        
        $asset_summary = $this->Asset->getSummary($family_id, $year, $month);
        $fund_summary = $this->Fund->getSummary($family_id, $year, $month);
        
        $budget = $this->Calculate->calcBudget($incoming_summary, $outgoing_summary, $asset_summary, $fund_summary);
        $setting = $this->Setting->getData($family_id);
        
        $daily_account = $this->Calculate->calcDailyAccount($outgoing_detail, $budget['budget'], $setting, $year, $month);
        
        $this->set('incoming_data', $incoming_summary);
        $this->set('outgoing_data', $outgoing_summary);
        $this->set('asset_data', $asset_summary);
        $this->set('fund_data', $fund_summary);
        $this->set('budget', $budget);
        $this->set('outgoing_detail', $outgoing_detail);
        $this->set('daily_account', $daily_account);
        
        $this->set('year', $year);
        $this->set('month', $month);
        
        $this->render('check');
    }
    
    public function stock() {
        $family_id = $this->getFamilyId();
        
        $asset_summary = $this->Asset->tally($family_id);
        $fund_summary = $this->FundEntry->getSummaryData($family_id);
        
        $assets_tallied = $this->Asset->tallyPerTerm($family_id);
        $setting = $this->Setting->getData($family_id);
        $assets_detail = $this->Calculate->calcAssets($assets_tallied, $setting);
        
        $fund_detail = $this->Calculate->calcFunds($fund_summary);
        
        $this->set('asset_data', $asset_summary);
        $this->set('asset_detail', $assets_detail);
        
        $this->set('fund_detail', $fund_detail);
        
        $this->render('stock');
    }
}

?>
