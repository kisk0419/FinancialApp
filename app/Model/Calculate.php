<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calculate
 *
 * @author baba
 */
class Calculate {
    public function calcBudget($incoming, array $outgoing, $asset, $fund) {
        $budget = array();
        $budget['budget'] = $incoming - ($outgoing['fixed'] + $asset + $fund);
        $budget['remain'] = $budget['budget'] - $outgoing['values'];
        return $budget;
    }
    
    public function calcDailyAccount(array $outgoing_details, $budget, array $setting, $year, $month) {
        $dates = $this->calcDetailTerm($setting, $year, $month);
        $daily_budget = floor($budget / count($dates));
        $sub = $budget - ($daily_budget * count($dates));
        
        $account = array('detail' => array(), 'summary' => array());
        
        $daily_budget_sum = 0;
        $daily_outgoing = 0;
        $daily_remain = 0;
        $today = (new DateTime())->format('Y-m-d');
        $exists = false;
        $notset_count = 0;
        
        foreach ($outgoing_details as $i => $detail) {
            if (!array_search($i, $dates)) {
                $dates[] = $i;
            }
        }
        
        sort($dates);
        
        foreach ($dates as $date) {
            if (array_key_exists($date, $outgoing_details)) {
                $summary = $outgoing_details[$date];
            } else {
                $summary = 0;
            }
            if ($exists) {
                $data = array($date, $summary, '-', '-', '-');
                $notset_count++;
            } else {
                $today_remain = $daily_budget - $summary;
                $tmp_budget = ($daily_budget == 0) ? 0 : round((double)$today_remain / $daily_budget * 100);
                $data = array($date, $summary, $daily_budget, $today_remain, $tmp_budget);
                $daily_remain += $data[3];
                $daily_budget_sum += $daily_budget;
            }
            $daily_outgoing += $data[1];
            $account['detail'][] = $data;
            
            if ($date === $today) {
                $exists = true;
            }
        }
        
        $account['detail'][0][2] += $sub;
        $account['detail'][0][3] += $sub;
        $daily_remain += $sub;
        $daily_budget_sum += $sub;
        
        $account['summary'][] = '計';
        $account['summary'][] = $daily_outgoing;
        $account['summary'][] = $daily_budget_sum;
        $account['summary'][] = $daily_remain;
        $account['summary'][] = ($daily_budget_sum == 0) ? 0 : round((double)$daily_remain / $daily_budget_sum * 100);
        
        return $account;
    }
    
    public function calcDetailTerm(array $setting, $year, $month) {
        $day = $setting['Setting']['term_start_date'];
        $start_date = new DateTime($year . '-' . $month . '-' . $day);
        $end_date = new DateTime($year . '-' . $month . '-' . $day . ' 00:00:01');
        
        if ($setting['TermStartCondition']['value'] == 0) {
            $start_date->sub(new DateInterval('P1M'));
        } else {
            $end_date->add(new DateInterval('P1M'));
        }
        $end_date->sub(new DateInterval('P1D'));
        
        $period = new DatePeriod($start_date, new DateInterval('P1D'), $end_date);
        $terms = array();
       
        foreach ($period as $day) {
            $terms[] = $day->format('Y-m-d');
        }
        return $terms;
    }
    
    public function calcTerms($start_term, array $setting) {
        $today = new DateTime();
        $day = $setting['Setting']['term_start_date'];
        if ($setting['TermStartCondition']['value'] == 0 && $today->format('d') >= $day) {
            $today->add(new DateInterval('P1M'));
        } else if ($setting['TermStartCondition']['value'] == 1 && $today->format('d') < $day) {
            $today->sub(new DateInterval('P1M'));
        }
        $start = new DateTime($start_term .'/1');
        $period = new DatePeriod($start, new DateInterval('P1M'), $today);
        $terms = array();
       
        foreach ($period as $day) {
            $terms[] = $day->format('Y/n');
        }
        return $terms;
    }
    
    public function calcFunds(array $funds) {
        $processing = $funds['processing'];
        $completed = $funds['completed'];
        $settled = $funds['settled'];
        
        $stocks = array(
            'fund' => array(
                'details' => array(
                    'processing' => array(0, 0),
                    'completed' => array(0, 0),
                    'settled' => array(0, 0),
                ),
                'summary' => array(
                    'current' => array(0, 0),
                    'total' => array(0, 0)
                )
            )
        );
        
        foreach ($processing as $entry) {
            $stocks['fund']['details']['processing'][0] += $entry['FundSummary']['summary'];
            $stocks['fund']['details']['processing'][1]++;
        }
        
        foreach ($completed as $entry) {
            $stocks['fund']['details']['completed'][0] += $entry['FundSummary']['summary'];
            $stocks['fund']['details']['completed'][1]++;
        }
        
        foreach ($settled as $entry) {
            $stocks['fund']['details']['settled'][0] += $entry['FundSummary']['summary'];
            $stocks['fund']['details']['settled'][1]++;
        }
        
        $stocks['fund']['summary']['current'][0] = 
                $stocks['fund']['details']['processing'][0] + $stocks['fund']['details']['completed'][0];
        
        $stocks['fund']['summary']['current'][1] = 
                $stocks['fund']['details']['processing'][1] + $stocks['fund']['details']['completed'][1];
        
        $stocks['fund']['summary']['total'][0] = 
                $stocks['fund']['details']['processing'][0] + $stocks['fund']['details']['completed'][0] + $stocks['fund']['details']['settled'][0];
        
        $stocks['fund']['summary']['total'][1] = 
                $stocks['fund']['details']['processing'][1] + $stocks['fund']['details']['completed'][1] + $stocks['fund']['details']['settled'][1];
        
        return $stocks;
    }
    
    public function calcAssets(array $assets, array $setting) {
        end($assets['add']);
        end($assets['draw']);
        if (isset($assets['add'])) {
            $start_term = key($assets['add']);
        } else if (isset($assets['draw'])) {
            $start_term = key($assets['draw']);
        } else {
            $start_term = (new DateTime())->format('Y/m');
        }
        $terms = $this->calcTerms($start_term, $setting);
        
        $stocks = array(
            'asset' => array(
                'details' => array(),
                'summary' => array('計', 0, 0, 0)
            )
        );
        
        foreach ($terms as $term) {
            $stock = array($term, 0, 0, 0);
            if (array_key_exists($term, $assets['add'])) {
                $stock[1] += $assets['add'][$term];
            }
            if (array_key_exists($term, $assets['draw'])) {
                $stock[2] += $assets['draw'][$term];
            }
            $stock[3] = $stock[1] + $stock[2];
            $stocks['asset']['summary'][1] += $stock[1];
            $stocks['asset']['summary'][2] += $stock[2];
            $stocks['asset']['summary'][3] += $stock[3];
            
            $stocks['asset']['details'][] = $stock;
        }
        return $stocks;
    }
}

?>
