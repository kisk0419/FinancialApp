<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SerondaryCategory
 *
 * @author baba
 */
class SecondaryCategory {
    private $subject = '';
    private $total_price = 0;
    private $rate = 0;
    
    public function __construct($subject) {
        $this->subject = $subject;
    }
    
    public function subject() {
        return $this->subject;
    }
    
    public function totalPrice() {
        return $this->total_price;
    }
    
    public function add($value) {
        if (isset($value) && is_numeric($value)) {
            $this->total_price += $value;
        }
    }
    
    public function calcRate($total) {
        $this->rate = round(((double)$this->total_price / $total) * 100);
    }
    
    public function rate() {
        return $this->rate;
    }
}

?>
