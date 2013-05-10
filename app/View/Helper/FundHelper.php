<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FundHelper
 *
 * @author keisuke
 */
class FundHelper extends AppHelper {
    public function getEndTerm($mode, $year, $month, $target, $amount, $summary, $count) {
        $remain = $amount - $summary;
        if ($mode == 0) {
            $cnt = ceil($remain / $target);
        } else {
            $cnt = $target - $count;
            if ($cnt < 0) {
                $cnt = 0;
            }
        }
        $end_year = $year + (int)($cnt / 12);
        $end_month = $month + (int)($cnt % 12);
        if ($end_month > 12) {
            $end_year++;
            $end_month -= 12;
        }
        
        return $end_year . '/' . $end_month;
    }
    
    public function getProgressRate($is_completed, $is_settled, $summary, $amount) {
        if ($is_settled) {
            return '清算完了';
        }
        if ($is_completed) {
            return '積立完了';
        }
        if ($amount == 0) {
            return '0％';
        }
        $rate = round((double)$summary / $amount * 100);
        if ($rate >= 100) {
            return '目標達成';
        } else {
            return $rate . '％';
        }
    }
}

?>
