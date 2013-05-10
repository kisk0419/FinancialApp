<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalculateHelper
 *
 * @author baba
 */
class UtilityHelper extends AppHelper {
    
    public function h($value) {
        if (is_numeric($value)) {
            return h(number_format($value));
        } else {
            return h($value);
        }
    }
    
    public function currencyTag($value, $tag = 'div', $class = '', $prefix = '', $suffix = '') {
        if (isset($value) && is_numeric($value) && $value < 0) {
            $class = $class . ' negative';
        }
        
        return '<' . $tag . ' class="' . $class . '">' . 
                $this->h($prefix) . $this->h($value) . $this->h($suffix) .
                '</' . $tag . '>';
    }
    
    public function evaluateTag($value, $tag = 'div', $class = '', $tooltip_id = '', $limit = 20) {
        if (isset($value) && is_numeric($value)) {
            if ($value > 20) {
                $class .= ' icon-heart';
            } else if ($value >= 0) {
                $class .= ' icon-thumbs-up';
            } else if ($value < -20) {
                $class .= ' icon-ambulance';
            } else {
                $class .= ' icon-thumbs-down';
            }
        } else {
            $class .= ' icon-minus';
        }
        $class .= ' tooltip-right';
        return '<' . $tag . ' class="evaluation"><i class="' . $class . 
                '" data-content="#tooltip' . $tooltip_id . '"/>' .
                '<tooltip class="tooltip-content" id="tooltip' . $tooltip_id . '">' . 
                $value . '％</tooltip></' . $tag . '>';
    }
    
    public function actionButton($link, $icon = '', $text = '', $confirm = null) {
        if (isset($confirm)) {
            $html = '<a href="' . $link . '" class="icon small button ' . 
                    $icon . '" onclick="return confirm("' . $confirm . '");">' . $text . '</a>';
        } else {
            $html = '<a href="' . $link . '" class="icon small button ' . 
                    $icon . '">' . $text . '</a>';
        }
        return $html;
    }
    
    public function confirmButton($link, $icon = '', $text = '', $size = '', $color = '', $confirm = null) {
        if (isset($confirm)) {
            $html = '<a href="' . $link . '" class="button ' . $size . ' ' . $color . ' ' . 
                    $icon . '" onclick="return confirm("' . $confirm . '");">' . $text . '</a>';
        } else {
            $html = '<a href="' . $link . '" class="button ' . $size . ' ' . $color . ' ' .  
                    $icon . '">' . $text . '</a>';
        }
        return $html;
    }
    
    public function termUrl($controller, $year, $month, $date = null) {
        $url = '/' . $controller . '/term?year=' . h($year) . '&month=' . h($month);
        if (isset($date)) {
            $url .= ('&date=' . h($date));
        }
        return $url;
    }
    
    public function tagetValue($mode, $value, $tag, $class) {
        if ($mode == 0) {
            return $this->currencyTag($value, $tag, $class, '￥', '/月');
        } else if ($mode == 1) {
            return $this->currencyTag($value, $tag, $class, '', '回');
        } else {
            return '--';
        }
    }
    
    public function fundEntryCheckBotton($entry_id, $is_completed, $is_settled) {
        if ($is_completed) {
            $html = $this->confirmButton(
                    '/FundEntries/complete/' . $entry_id,
                    '',
                    '清算中に戻す',
                    'medium',
                    'red');
        } else {
            $html = $this->confirmButton(
                    '/FundEntries/complete/' . $entry_id,
                    '',
                    '積立完了',
                    'medium',
                    'green');
        }
        
        if ($is_settled) {
            $html .= $this->confirmButton(
                    '/FundEntries/settle/' . $entry_id,
                    '',
                    '未精算に戻す',
                    'medium',
                    'red');
        } else {
            $html .= $this->confirmButton(
                    '/FundEntries/settle/' . $entry_id,
                    '',
                    '清算',
                    'medium',
                    'green');
        }
        
        return $html;
    }
}

?>
